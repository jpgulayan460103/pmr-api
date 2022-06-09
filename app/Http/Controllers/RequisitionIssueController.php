<?php

namespace App\Http\Controllers;

use App\Models\RequisitionIssue;
use App\Repositories\RequisitionIssueRepository;
use Illuminate\Http\Request;

class RequisitionIssueController extends Controller
{
    private $requisitionIssueRepository;

    public function __construct(RequisitionIssueRepository $requisitionIssueRepository)
    {
        $this->requisitionIssueRepository = $requisitionIssueRepository;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequisitionIssue  $requisitionIssue
     * @return \Illuminate\Http\Response
     */
    public function show(RequisitionIssue $requisitionIssue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequisitionIssue  $requisitionIssue
     * @return \Illuminate\Http\Response
     */
    public function edit(RequisitionIssue $requisitionIssue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RequisitionIssue  $requisitionIssue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequisitionIssue $requisitionIssue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequisitionIssue  $requisitionIssue
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequisitionIssue $requisitionIssue)
    {
        //
    }
}
