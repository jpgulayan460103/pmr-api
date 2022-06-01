<?php

namespace App\Http\Controllers;

use App\Models\ProcurementPlan;
use App\Repositories\FormProcessRepository;
use App\Repositories\FormRouteRepository;
use App\Repositories\ProcurementPlanRepository;
use Illuminate\Http\Request;

class ProcurementPlanController extends Controller
{
    private $procurementPlanRepository;

    public function __construct(ProcurementPlanRepository $procurementPlanRepository)
    {
        $this->procurementPlanRepository = $procurementPlanRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = $request->all();
        $items = $this->procurementPlanRepository->addItems();
        $data['total'] = $items['total_cost'];
        $procurement_plan = $this->procurementPlanRepository->create($data);
        $procurement_plan->items()->saveMany($items['items']);
        $form_process = (new FormProcessRepository())->procurementPlan($procurement_plan);
        $form_route = (new FormRouteRepository())->procurementPlan($procurement_plan, $form_process);
        return $procurement_plan;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcurementPlan  $procurementPlan
     * @return \Illuminate\Http\Response
     */
    public function show(ProcurementPlan $procurementPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProcurementPlan  $procurementPlan
     * @return \Illuminate\Http\Response
     */
    public function edit(ProcurementPlan $procurementPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProcurementPlan  $procurementPlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProcurementPlan $procurementPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcurementPlan  $procurementPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcurementPlan $procurementPlan)
    {
        //
    }
}
