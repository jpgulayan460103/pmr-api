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
        $date = Carbon::now();
        $approved_month = $this->reportRepository->totalPurchaseRequest('approved','monthly', $date);
        $approved_year = $this->reportRepository->totalPurchaseRequest('approved','yearly', $date);
        $pending_month = $this->reportRepository->totalPurchaseRequest('pending','monthly', $date);
        $pending_year = $this->reportRepository->totalPurchaseRequest('pending','yearly', $date);
        $yearly = $this->reportRepository->perMonthPurchaseRequest();
        $most_quantity_items = $this->reportRepository->mostRequestedItems($date, 'yearly', 'quantity');
        $most_cost_items = $this->reportRepository->mostRequestedItems($date, 'yearly', 'cost');
        $procurement_types = $this->reportRepository->procurementTypes($date, 'yearly');
        // return $procurementTypes;
        return [
            'approved_month' => $approved_month,
            'approved_year' => $approved_year,
            'pending_month' => $pending_month,
            'pending_year' => $pending_year,
            'yearly' => $yearly,
            'most_quantity_items' => $most_quantity_items,
            'most_cost_items' => $most_cost_items,
            'procurement_types' => $procurement_types,
        ];
    }
}
