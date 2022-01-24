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
class FormRouteController extends Controller
{

    private $formRouteRepository;

    public function __construct(FormRouteRepository $formRouteRepository)
    {
        $this->formRouteRepository = $formRouteRepository;
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
    public function show(FormRoute $formRoute)
    {
        //
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

    public function forApproval(Request $request)
    {
        $user = Auth::user();
        // $user = User::find(3);
        $offices_ids = $user->signatories->pluck('office_id');
        $filters['offices_ids'] = $offices_ids;
        $routes = $this->formRouteRepository->attach('form_routable,end_user,to_office,from_office,form_process,user.user_information')->getForApproval($request, $filters);
        // return $routes;
        return fractal($routes, new FormRouteTransformer)->parseIncludes('form_routable,end_user,to_office,from_office,form_process,user.user_information');
    }

    public function approve(Request $request, $id)
    {
        DB::beginTransaction();
        $formRoute = $this->formRouteRepository->attach('form_process')->getById($id);
        $formProcess = $formRoute->form_process;
        $formRoutes = $formProcess->form_routes;
        $step = 0;
        foreach ($formRoutes as $key => $route) {
            if($formRoute->status == "pending" && $route['status'] == "pending" && $formRoute->to_office_id == $formRoutes[$key]['office_id']){
                $formRoutes[$key]['status'] = "approved";
                $this->formRouteRepository->updateRoute($formRoute->id, ['status'=>'approved']);
                break;
            }elseif($formRoute->status == "with_issues" && $route['status'] == "pending" && $formRoute->from_office_id == $formRoutes[$key]['office_id']){
                $this->formRouteRepository->updateRoute($formRoute->id, ['status'=>'resolved', 'remarks' => $request->remarks]);
                break;
            }
            $step++;
        }
        // return $step;
        $lastRoute = $formRoutes[count($formRoutes) - 1];
        if($lastRoute['office_id'] == $formRoutes[$step]['office_id']){
            $form = $formRoute->form_routable;
            $this->formRouteRepository->completeForm($form);
        }else{
            $currentRoute = $formRoutes[$step];
            if($formRoute->to_office_id == $currentRoute['office_id']){
                $nextRoute = $formRoutes[$step + 1];
            }else{
                $nextRoute = $currentRoute;
            }
            // return $nextRoute;
            $createdNextRoute = $this->formRouteRepository->proceedNextRoute($formRoute, $nextRoute, $request->remarks);
        }
        $formRoute->form_process->form_routes = $formRoutes;
        $formRoute->form_process->save();
        // event(new NewMessage(['test' => 'asdasd']));
        DB::commit();
        return $formRoute;
    }

    public function reject(Request $request, $id)
    {
        $user = Auth::user();
        $this->formRouteRepository->updateRoute($id, ['status'=>'rejected','remarks' => $request->remarks]);
        $data = $request->all();
        $data['status'] = "with_issues";
        $data['remarks_by_id'] = $user->id;
        $this->formRouteRepository->create($data);
        // event(new NewMessage(['test' => 'asdasd']));
    }
}
