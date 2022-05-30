<?php

namespace App\Http\Controllers;

use App\Repositories\ReportRepository;
use Carbon\Carbon;
use clsTinyButStrong;
use clsOpenTBS;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    private $reportRepository;
    private $openTbs;
    private $tbs;
    
    public function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
        $this->tbs = new clsTinyButStrong(); // new instance of TBS
        $this->openTbs = new clsOpenTBS(); // new instance of TBS
    }
    
    public function tbs()
    {
        $this->tbs->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load the OpenTBS plugin
        // $template = 'tbs.xlsx';
        $template = '2015 PPMP format.xlsx';
        $this->tbs->LoadTemplate($template, OPENTBS_ALREADY_UTF8);
        
        global $yourname;
        $yourname  = "asdasdasd";

        $data = array();
        $data[] = [
            "code" => 123123,
            "item_name" => "asdasdasd",
            "quantity" => 12,
            "budget" => 232
        ];
        for ($i=0; $i < 10; $i++) { 
            $data[] = [
                "code" => 123123,
                "item_name" => "asdasdasd",
                "quantity" => 12,
                "budget" => 232
            ];
        }

        // $this->tbs->PlugIn(OPENTBS_SELECT_SHEET, "Cells and rows");
        $this->tbs->MergeBlock('a', $data);
        // $this->tbs->MergeField()
        $this->tbs->Show(OPENTBS_DOWNLOAD, "test.xlsx");

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
        $accounts = $this->reportRepository->accounts($date, $type, $dateRange, $end_user_id);
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
            'accounts' => $accounts,
            'mode_of_procurements' => $mode_of_procurements,
        ];
    }
}
