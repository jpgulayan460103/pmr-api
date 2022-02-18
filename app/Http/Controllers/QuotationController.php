<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuotationRequest;
use App\Models\Quotation;
use Illuminate\Http\Request;
use App\Repositories\QuotationRepository;
use niklasravnsborg\LaravelPdf\Facades\Pdf as FacadesPdf;

class QuotationController extends Controller
{
    private $quotationRepository;

    public function __construct(QuotationRepository $quotationRepository)
    {
        $this->quotationRepository = $quotationRepository;
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
    public function store(CreateQuotationRequest $request)
    {
        return $this->quotationRepository->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function show(Quotation $quotation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function edit(Quotation $quotation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->quotationRepository->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quotation $quotation)
    {
        //
    }

    public function pdf($id)
    {
        $pdf = FacadesPdf::loadView('pdf.quotation');
        $pdf->shrink_tables_to_fit = 1.4;
        $pdf->use_kwt = true;
        // $pdf->save('sad.pdf');
        return $pdf->stream('purchase-request-preview.pdf');
        return view('pdf.quotation');
        // return $data;
    }

}
