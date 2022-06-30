<?php

namespace App\Http\Controllers;

use App\Models\NoStockCertificate;
use App\Repositories\NoStockCertificateRepository;
use App\Transformers\NoStockCertificateTransformer;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf as FacadesPdf;

class NoStockCertificateController extends Controller
{
    private $noStockCertificateRepository;

    public function __construct(NoStockCertificateRepository $noStockCertificateRepository)
    {
        $this->noStockCertificateRepository = $noStockCertificateRepository;
        // $this->middleware('auth:api');
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
     * @param  \App\Models\NoStockCertificate  $noStockCertificate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $no_stock_certificate = $this->noStockCertificateRepository->attach('items')->getById($id);
        return fractal($no_stock_certificate, new NoStockCertificateTransformer)->parseIncludes('items');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NoStockCertificate  $noStockCertificate
     * @return \Illuminate\Http\Response
     */
    public function edit(NoStockCertificate $noStockCertificate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NoStockCertificate  $noStockCertificate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NoStockCertificate $noStockCertificate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NoStockCertificate  $noStockCertificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(NoStockCertificate $noStockCertificate)
    {
        //
    }

    public function pdf(Request $request, $uuid)
    {
        $no_stock_certificate = $this->noStockCertificateRepository->attach('items')->getByUuid($uuid);
        $no_stock_certificate = fractal($no_stock_certificate, new NoStockCertificateTransformer)->parseIncludes('items')->toArray();
        // return $no_stock_certificate;
        $config = [
            'instanceConfigurator' => function($mpdf) {
                $mpdf->AddPage('P');
                $mpdf->setFooter('Page {PAGENO} of {nbpg}');
            },
            'margin_left' => 6.35,
            'margin_right' => 6.35,
            'margin_top' => 6.35,
        ];
        $pdf = FacadesPdf::loadView('pdf.no-stock-certificate', $no_stock_certificate, [], $config);
        return $pdf->stream('certificate-of-non-availability-'.$no_stock_certificate['form_number'].'.pdf');
        return $pdf->download('certificate-of-non-availability-'.$no_stock_certificate['form_number'].'.pdf');
    }
}
