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
use Carbon\Carbon;
use Illuminate\Support\Str;

class FormRouteController extends Controller
{

    private $formRouteRepository;
    private $attach;

    public function __construct(FormRouteRepository $formRouteRepository)
    {
        $this->formRouteRepository = $formRouteRepository;
        $this->attach = 'form_routable,end_user,to_office,from_office,form_process,user.user_information';
        $this->middleware('auth:api');
        $this->middleware('role_or_permission:super-admin|admin|form.routing.pending.view',   ['only' => ['getPending']]);
        $this->middleware('role_or_permission:super-admin|admin|form.routing.disapproved.view',   ['only' => ['getRejected']]);
        $this->middleware('role_or_permission:super-admin|admin|form.routing.approved.view',   ['only' => ['getApproved']]);
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

    public function getRejected(Request $request)
    {
        $filters = $request->all();
        $routes = $this->formRouteRepository->attach($this->attach)->getProcessed('rejected', $filters);
        return fractal($routes, new FormRouteTransformer)->parseIncludes($this->attach);
    }
    public function getApproved(Request $request)
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
        $user = Auth::user();
        $formRoute = $this->formRouteRepository->getById($id);
        $current_route_code = $formRoute->route_code;
        $this->formRouteRepository->verifyRoute($formRoute, $user);
        DB::beginTransaction();
        try {            
            if($formRoute->status == "pending"){
                (new FormRouteRepository())->addFormNumber($formRoute);
                (new FormRouteRepository())->updateFormRoutable($request, $formRoute);
                (new FormRouteRepository())->updateProcurementManagement($formRoute);
            }
            $step = 0;
            //reinitialize for updated data
            $formRoute = $this->formRouteRepository->attach('form_process, form_routable.end_user')->getById($id);
            $formProcess = $formRoute->form_process;
            $formRoutes = $formProcess->form_routes;
            $form = $formRoute->form_routable;
            foreach ($formRoutes as $key => $route) {
                if($formRoute->status == "pending" && $route['status'] == "pending" && $formRoute->to_office_id == $formRoutes[$key]['office_id']){
                    $formRoutes[$key]['status'] = "approved";
                    $this->formRouteRepository->updateRoute($formRoute, ['status'=>'approved']);
                    break;
                }elseif($formRoute->status == "with_issues" && $route['status'] == "pending" && $formRoute->from_office_id == $formRoutes[$key]['office_id']){
                    $this->formRouteRepository->updateRoute($formRoute, ['status'=>'resolved', 'remarks' => request('remarks')]);
                    break;
                }
                $step++;
            }
            if($formRoute->route_code == "last_route" && $formRoute->status == "pending"){
                $action_taken = $this->formRouteRepository->completeForm($formRoute);
                $this->formRouteRepository->updateRoute($formRoute, ['action_taken'=> $action_taken ]);
                $nextRoute = [
                    'office_name' => "",
                    'office_id' => "",
                    'description' => $action_taken,
                ];
            }else{
                $currentRoute = $formRoutes[$step];
                if($formRoute->to_office_id == $currentRoute['office_id']){
                    $nextRoute = $formRoutes[$step + 1];
                }else{
                    $nextRoute = $currentRoute;
                }
                $createdNextRoute = $this->formRouteRepository->proceedNextRoute($formRoute, $nextRoute, request('remarks'));
                if($nextRoute['description_code'] == 'pr_approval_from_twg'){
                    $nextRoute['office_name'] .= " Techinical Working Group";
                }
                $action_taken = "Forwarded to ".$nextRoute['office_name'].".";
                $this->formRouteRepository->updateRoute($formRoute, ['action_taken'=> $action_taken]);
            }
            $formRoute->form_process->form_routes = $formRoutes;
            $formRoute->form_process->save();
            
            $return = [
                'form_route' => $formRoute,
                'next_route' => $nextRoute,
                'notify_offices' => $nextRoute['office_id'],
                'alert_message' => [
                    "message" => Str::headline($formRoute->route_type),
                    "action_taken" => $current_route_code != "last_route" ? $action_taken : "The ".strtolower(Str::headline($formRoute->route_type))." has completed its routing offices.",
                    "status" => $formRoute->status == "with_issues" ? "is resolved." : "is approved.",
                    "route_type" => $current_route_code,
                ],
                'notification_data' => [
                    "status" => $formRoute->status == "with_issues" ? "Resolved" : "For Approval",
                    "user" => $user->username,
                    "remarks" => $formRoute->status == "with_issues" ? request('remarks') : (isset($nextRoute) ? "For ".$nextRoute['description'] : "For Procurement Process"),
                    "form" => Str::headline($formRoute->route_type),
                    "datetime" => Carbon::now()->toDayDateTimeString()
                ],
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
        $user = Auth::user();
        $formRoute = $this->formRouteRepository->getById($id);
        $current_route_code = $formRoute->route_code;
        $this->formRouteRepository->verifyRoute($formRoute, $user);
        DB::beginTransaction();
        try {
            $formRoute = $this->formRouteRepository->attach('form_process,to_office,from_office, form_routable.end_user')->getById($id);
            $user = Auth::user();
            $data = $request->all();
            $data = $this->formRouteRepository->returnTo($id, $data);
            $data['status'] = "with_issues";
            $data['forwarded_by_id'] = $user->id;
            $data['remarks'] = request('remarks');
            $office = (new LibraryRepository)->getById($data['to_office_id']);
            $this->formRouteRepository->create($data);
            $this->formRouteRepository->updateRoute($formRoute, [
                'status'=>'rejected',
                'route_code'=>'rejected',
                'remarks' => request('remarks'),
                'action_taken' => "Returned to ".$office->name."."
            ]);
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
                'notification_title' => "Disapproved Purchase Request",
                'notification_message' => request('remarks'),
                'notification_data' => [
                    "status" => "Disapproved",
                    "user" => $user->username,
                    "remarks" => request('remarks'),
                    "form" => Str::headline($formRoute->route_type),
                    "datetime" => Carbon::now()->toDayDateTimeString()
                ],
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
