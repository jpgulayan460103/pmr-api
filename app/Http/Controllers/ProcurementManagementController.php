<?php

namespace App\Http\Controllers;

use App\Models\ProcurementManagement;
use App\Repositories\ProcurementManagementRepository;
use App\Transformers\ProcurementManagementTransformer;
use Illuminate\Http\Request;

class ProcurementManagementController extends Controller
{
    private $procurementManagementRepository;

    public function __construct(ProcurementManagementRepository $procurementManagementRepository)
    {
        $this->procurementManagementRepository = $procurementManagementRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->procurementManagementRepository->attach('items.item');
        return $this->procurementManagementRepository->getAll();
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
     * @param  \App\Models\ProcurementManagement  $procurementManagement
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $uuid)
    {
        $this->procurementManagementRepository->attach('items.procurement_plan_item.unit_of_measure, end_user');
        // $procurement_management = $this->procurementManagementRepository->getByUuid($uuid);
        $procurement_management = $this->procurementManagementRepository->getAll()->first();
        // return $procurement_management;
        return fractal($procurement_management, new ProcurementManagementTransformer)->parseIncludes('items.procurement_plan_item.unit_of_measure, end_user');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProcurementManagement  $procurementManagement
     * @return \Illuminate\Http\Response
     */
    public function edit(ProcurementManagement $procurementManagement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProcurementManagement  $procurementManagement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProcurementManagement $procurementManagement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcurementManagement  $procurementManagement
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcurementManagement $procurementManagement)
    {
        //
    }
}
