<?php

namespace App\Http\Controllers;

use App\Models\FormRoute;
use App\Models\User;
use App\Repositories\FormRouteRepository;
use App\Transformers\FormRouteTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $routes = $this->formRouteRepository->attach('form_routable,end_user,form_process')->getForApproval($request, $filters);
        return fractal($routes, new FormRouteTransformer)->parseIncludes('form_routable,end_user,form_process');
    }

    public function approve(Request $request, $id)
    {
        $formRoute = $this->formRouteRepository->attach('form_process')->getById($id);
        $formProcess = $formRoute->form_process;
        $formRoutes = $formProcess->form_routes;
        $step = 0;
        foreach ($formRoutes as $key => $route) {
            $step++;
            if($formRoute->to_office_id == $route['office_id']){
                $formRoutes[$key]['status'] = "approve";
                $latestRoute = $this->formRouteRepository->approveLatestRoute($formProcess['id']);
                break;
            }
        }
        if($step < count($formRoutes)){
            $nextRoute = $formRoutes[$step];
            $createdNextRoute = $this->formRouteRepository-> createNextRoute($latestRoute, $nextRoute);
        }else{
            $form = $formRoute->form_routable;
            $this->formRouteRepository->completeForm($form);
        }
        $formRoute->form_process->form_routes = $formRoutes;
        $formRoute->form_process->save();
        return $formRoute;
    }

    public function reject(Request $request, $id)
    {
        # code...
    }
}
