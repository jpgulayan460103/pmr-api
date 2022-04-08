<?php

namespace App\Http\Controllers;

use App\Repositories\ReportRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    private $reportRepository;

    public function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    public function purchaseRequest(Request $request)
    {
        $dateRange = $request->month ? $request->month : Carbon::now();
        if(is_array($dateRange)){
            $type =  "custom";
            $date = $dateRange[0];
        }else{
            $type =  "monthly";
            $date = Carbon::now();
        }

        $end_user_id = $request->end_user_id;
        
        $approved_month = $this->reportRepository->totalPurchaseRequest('approved', $type, $date, $dateRange, $end_user_id);
        $approved_year = $this->reportRepository->totalPurchaseRequest('approved','yearly', $date, $dateRange, $end_user_id);
        $pending_month = $this->reportRepository->totalPurchaseRequest('pending',$type, $date, $dateRange, $end_user_id);
        $pending_year = $this->reportRepository->totalPurchaseRequest('pending','yearly', $date, $dateRange, $end_user_id);
        $per_section = $this->reportRepository->perSectionPurchaseRequest('pending', $type, $date, $dateRange, $end_user_id);
        $yearly = $this->reportRepository->perMonthPurchaseRequest($date, $end_user_id);
        $most_quantity_items = $this->reportRepository->mostRequestedItems($date, $type, 'quantity', $dateRange, $end_user_id);
        $most_cost_items = $this->reportRepository->mostRequestedItems($date, $type, 'cost', $dateRange, $end_user_id);
        $procurement_types = $this->reportRepository->procurementTypes($date, $type, $dateRange, $end_user_id);
        $mode_of_procurements = $this->reportRepository->modeOfProcurements($date, $type, $dateRange, $end_user_id);
        // return $per_section;
        return [
            'approved_month' => $approved_month,
            'approved_year' => $approved_year,
            'pending_month' => $pending_month,
            'pending_year' => $pending_year,
            'per_section' => $per_section,
            'yearly' => $yearly,
            'most_quantity_items' => $most_quantity_items,
            'most_cost_items' => $most_cost_items,
            'procurement_types' => $procurement_types,
            'mode_of_procurements' => $mode_of_procurements,
        ];
    }
}
