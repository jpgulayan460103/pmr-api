<?php

namespace App\Http\Controllers;

use App\Models\FormRoute;
use App\Models\User;
use App\Repositories\FormRouteRepository;
use App\Transformers\FormRouteTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Events\NewMessage;
use App\Models\Library;
use App\Repositories\FormProcessRepository;
use App\Repositories\LibraryRepository;
use App\Repositories\PurchaseRequestRepository;
use App\Rules\LibraryExistRule;

class FormRouteController extends Controller
{

    private $formRouteRepository;
    private $attach;

    public function __construct(FormRouteRepository $formRouteRepository)
    {
        $this->formRouteRepository = $formRouteRepository;
        $this->attach = 'form_routable,end_user,to_office,from_office,form_process,user.user_information';
        $this->middleware('auth:api');
        $this->middleware('role_or_permission:super-admin|admin|form.routing.pending.view|form.routing.pending.all|purchase.requests.approve',   ['only' => ['getPending']]);
        $this->middleware('role_or_permission:super-admin|admin|form.routing.approved.view|form.routing.approved.all',   ['only' => ['approved']]);
        $this->middleware('role_or_permission:super-admin|admin|form.routing.disapproved.view|form.routing.disapproved.all',   ['only' => ['rejected']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    // }

    public function index(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FormRoute  $formRoute
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $formRoute = $this->formRouteRepository->attach('form_process')->getById($id);
        return fractal($formRoute, new FormRouteTransformer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormRoute  $formRoute
     * @return \Illuminate\Http\Response
     */
    public function edit(FormRoute $formRoute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FormRoute  $formRoute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormRoute $formRoute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormRoute  $formRoute
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormRoute $formRoute)
    {
        //
    }

    public function rejected(Request $request)
    {
        $filters = $request->all();
        $routes = $this->formRouteRepository->attach($this->attach)->getProcessed('rejected', $filters);
        return fractal($routes, new FormRouteTransformer)->parseIncludes($this->attach);
    }
    public function approved(Request $request)
    {
        $filters = $request->all();
        $routes = $this->formRouteRepository->attach($this->attach)->getProcessed('approved', $filters);
        return fractal($routes, new FormRouteTransformer)->parseIncludes($this->attach);
    }

    public function getPending(Request $request)
    {
        $filters = $request->all();
        $user = Auth::user();
        $offices_ids = $user->user_offices->pluck('office_id')->toArray();
        $groups_ids = $user->user_groups->pluck('group_id')->toArray();
        $filters['offices_ids'] = array_merge($groups_ids, $offices_ids);
        if($user->hasRole('super-admin')){
            unset($filters['offices_ids']);
        }
        $filters['total_cost'] = request('total_cost');
        $filters['total_cost_op'] = $filters['total_cost_op'] = ( request('total_cost_op') == "<=" ? request('total_cost_op') : ">=" );
        $routes = $this->formRouteRepository->attach($this->attach)->getPending($filters);
        return fractal($routes, new FormRouteTransformer)->parseIncludes($this->attach);
    }

    public function approve(Request $request, $id)
    {
        $this->formRouteRepository->verifyRoute($id);
        DB::beginTransaction();
        try {
            $this->formRouteRepository->modifyRoute($request, $id);
            $formRoute = $this->formRouteRepository->attach('form_process, form_routable.end_user')->getById($id);
            $formProcess = $formRoute->form_process;
            $formRoutes = $formProcess->form_routes;
            $step = 0;
            foreach ($formRoutes as $key => $route) {
                if($formRoute->status == "pending" && $route['status'] == "pending" && $formRoute->to_office_id == $formRoutes[$key]['office_id']){
                    $formRoutes[$key]['status'] = "approved";
                    $this->formRouteRepository->updateRoute($formRoute->id, ['status'=>'approved']);
                    break;
                }elseif($formRoute->status == "with_issues" && $route['status'] == "pending" && $formRoute->from_office_id == $formRoutes[$key]['office_id']){
                    $this->formRouteRepository->updateRoute($formRoute->id, ['status'=>'resolved', 'remarks' => request('remarks')]);
                    break;
                }
                $step++;
            }
            $lastRoute = $formRoutes[count($formRoutes) - 1];
            if($lastRoute['office_id'] == $formRoutes[$step]['office_id'] && $formRoute->remarks != "Finalization from the end user." && $formRoute->status == "pending"){
                $this->formRouteRepository->completeForm($formRoute);
                $this->formRouteRepository->updateRoute($formRoute->id, ['action_taken'=> "Approved for procurement process." ]);
            }else{
                $currentRoute = $formRoutes[$step];
                if($formRoute->to_office_id == $currentRoute['office_id']){
                    $nextRoute = $formRoutes[$step + 1];
                }else{
                    $nextRoute = $currentRoute;
                }
                $createdNextRoute = $this->formRouteRepository->proceedNextRoute($formRoute, $nextRoute, request('remarks'));
                if($nextRoute['description_code'] == 'aprroval_from_twg'){
                    $nextRoute['office_name'] .= " Techinical Working Group";
                }
                $this->formRouteRepository->updateRoute($formRoute->id, ['action_taken'=> "Forwarded to ".$nextRoute['office_name']."." ]);
            }
            $formRoute->form_process->form_routes = $formRoutes;
            $formRoute->form_process->save();
            $user = Auth::user();
            
            $procurement_office = (new LibraryRepository)->getUserSectionBy('title','PS');
            $return = [
                'form_route' => $formRoute,
                'next_route' => isset($nextRoute) ? $nextRoute : [
                    'office_name' => $procurement_office->name,
                    'office_id' => $procurement_office->id,
                    'description' => "Procurement Process"
                ],
                'notification_type' => 'approved_form',
                'notify_offices' => isset($nextRoute) ? $nextRoute['office_id'] : $procurement_office->id,
                'notification_title' => "New forwarded purchase request",
                'notification_message' =>  isset($nextRoute) ? "For ".$nextRoute['description'] : "For Procurement Process",
            ];
            DB::commit();
            try {
                event(new NewMessage($return));
            } catch (\Throwable $th) {
                // return $th;
            }
            return $return;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function reject(Request $request, $id)
    {
        $this->formRouteRepository->verifyRoute($id);
        DB::beginTransaction();
        try {
            $formRoute = $this->formRouteRepository->attach('form_process,to_office,from_office, form_routable.end_user')->getById($id);
            $user = Auth::user();
            $data = $request->all();
            $data = $this->formRouteRepository->returnTo($id, $data);
            $data['status'] = "with_issues";
            $data['remarks_by_id'] = $user->id;
            $data['remarks'] = request('remarks');
            $office = (new LibraryRepository)->getById($data['to_office_id']);
            $this->formRouteRepository->create($data);
            $this->formRouteRepository->updateRoute($id, ['status'=>'rejected','remarks' => request('remarks'), 'action_taken' => "Returned to ".$office->name."."]);
            $user = Auth::user();
            $form = $formRoute->form_routable;
            $return = [
                'form_route' => $formRoute,
                'next_route' => [
                    'office_name' => $office->name,
                    'office_id' => $office->id,
                    'description' => "Returned to ".$office->name."."
                ],
                'notification_type' => 'rejected_form',
                'notify_offices' => $office->id,
                'from_user' => $user,
                'notification_title' => "New disapproved purchase request",
                'notification_message' => request('remarks'),
            ];
            DB::commit();
            try {
                event(new NewMessage($return));
            } catch (\Throwable $th) {
                // return $th;
            }
            return $return;
        } catch (\Throwable $th) {
            throw $th;
        }
    }


}
