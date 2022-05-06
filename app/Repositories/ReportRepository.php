<?php

namespace App\Repositories;

use App\Models\PurchaseRequest;
use App\Models\User;
use App\Repositories\Interfaces\ReportRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportRepository implements ReportRepositoryInterface
{

    public function totalPurchaseRequest($type, $freq, $date, $dateRange = [], $end_user_id = null)
    {
        $custom_dates = [];
        if($freq == "custom"){
            $custom_dates = [
                Carbon::parse($dateRange[0])->copy()->startOfMonth(),
                Carbon::parse($dateRange[1])->copy()->endOfMonth(),
            ];
        }else{
            $first_day_month = Carbon::parse($date)->copy()->startOfMonth();
            $last_day_month = Carbon::parse($date)->copy()->endOfMonth();
            $first_day_year = Carbon::parse($date)->copy()->startOfYear();
            $last_day_year = Carbon::parse($date)->copy()->endOfYear();
        }

        $start_day = "";
        $end_day = "";

        $total = PurchaseRequest::where('status', $type);
        $total->select(
            DB::raw('ROUND(SUM(total_cost), 2) as sum_cost')
        );
        if($end_user_id){
            $total->where('end_user_id', $end_user_id);
        }
        switch ($freq) {
            case 'monthly':
                $total->whereBetween('pr_date', [
                    $first_day_month,
                    $last_day_month,
                ]);
                $start_day = $first_day_month;
                $end_day = $last_day_month;
                break;
            case 'yearly':
                $total->whereBetween('pr_date', [
                    $first_day_year,
                    $last_day_year,
                ]);
                $start_day = $first_day_year;
                $end_day = $last_day_year;
                break;
            case 'custom':
                $total->whereBetween('pr_date', $custom_dates);
                $start_day = $custom_dates[0];
                $end_day = $custom_dates[1];
                break;
            default:
                # code...
                break;
        }
        $total = $total->first();
        return [
            'data' => $total->sum_cost,
            'start_day' => $start_day->format("F d, Y"),
            'end_day' => $end_day->format("F d, Y"),
        ];
    }

    public function perMonthPurchaseRequest($date, $end_user_id = null)
    {

        $data = array();
        for ($i = 1; $i <= 12; $i++) {
            $year = Carbon::parse($date)->copy()->format('Y');
            $month = Carbon::create($year, $i, 1, 0, 0, 0);
            $approved_totals = $this->totalPurchaseRequest("approved", 'monthly', $month->toDateString(), [], $end_user_id);
            $pending_totals = $this->totalPurchaseRequest("pending", 'monthly', $month->toDateString(), [], $end_user_id);
            $data[] = [
                "month_short" => $month->shortMonthName,
                "month_full" => $month->monthName,
                "approved" => $approved_totals['data'] ? $approved_totals['data'] : 0,
                "pending" => $pending_totals['data'] ? $pending_totals['data'] : 0,
            ];
        }
        return [
            "data" => $data,
            'start_day' => $data[0]['month_full']." 1, $year",
            'end_day' => $data[11]['month_full']." 31, $year",
        ];
    }

    
    public function perSectionPurchaseRequest($type, $freq, $date, $dateRange = [], $end_user_id = null)
    {
        $custom_dates = [];
        if($freq == "custom"){
            $custom_dates = [
                Carbon::parse($dateRange[0])->copy()->startOfMonth(),
                Carbon::parse($dateRange[1])->copy()->endOfMonth(),
            ];
        }else{
            $first_day_month = Carbon::parse($date)->copy()->startOfMonth();
            $last_day_month = Carbon::parse($date)->copy()->endOfMonth();
            $first_day_year = Carbon::parse($date)->copy()->startOfYear();
            $last_day_year = Carbon::parse($date)->copy()->endOfYear();
        }

        $types = PurchaseRequest::with('end_user.parent');
        $types->select(
            DB::raw('ROUND(SUM(CASE WHEN status = "approved" THEN total_cost ELSE 0 END), 2) as approved'),
            DB::raw('ROUND(SUM(CASE WHEN status = "pending" THEN total_cost ELSE 0 END), 2) as pending'),
            'end_user_id'
        );
        if($end_user_id){
            $types->where('end_user_id', $end_user_id);
        }

        switch ($freq) {
            case 'monthly':
                $types->whereBetween('pr_date', [
                    $first_day_month,
                    $last_day_month,
                ]);
                $start_day = $first_day_month;
                $end_day = $last_day_month;
                break;
            case 'yearly':
                $types->whereBetween('pr_date', [
                    $first_day_year,
                    $last_day_year,
                ]);
                $start_day = $first_day_year;
                $end_day = $last_day_year;
                break;
            case 'custom':
                $types->whereBetween('pr_date', $custom_dates);
                $start_day = $custom_dates[0];
                $end_day = $custom_dates[1];
                break;
            default:
                # code...
                break;
        }
        $types->groupBy('end_user_id');
        $types = $types->get();
        $total = $this->totalPurchaseRequest('approved', $freq, $date, $dateRange, $end_user_id);
        $total = $total['data'];
        foreach ($types as $key => $type) {
            $type->key = ++$key;
            $type->section_name = $type->end_user->name;
            $type->section_title = $type->end_user->title;
            $type->section_id = $type->end_user->id;
            $type->division_id = $type->end_user->parent->id;
            $type->division_name = $type->end_user->parent->name;
            $type->division_title = $type->end_user->parent->title;
            // switch ($type->end_user->parent->title) {
            //     case 'OARDA':
            //     case 'OARDO':
            //     case 'ORD':
            //         $rd = (new LibraryRepository())->getUserDivisionBy('title', $type->end_user->parent->title);
            //         if($rd){
            //             $type->division_id = $rd->id;
            //             $type->division_name = $rd->name;
            //             $type->division_title = $rd->title;
            //         }else{
            //             $type->division_id = $type->id;
            //             $type->division_name =    $type->section_name;
            //             $type->division_title = $type->title;
            //         }
            //         break;
                
            //     default:
            //         # code...
            //         break;
            // }
            unset($type->end_user);
        }
        return [
            'data' => $types,
            'start_day' => $start_day->format("F d, Y"),
            'end_day' => $end_day->format("F d, Y"),
        ];
    }

    public function accounts($date, $freq, $dateRange = [], $end_user_id = null)
    {
        $custom_dates = [];
        if($freq == "custom"){
            $custom_dates = [
                Carbon::parse($dateRange[0])->copy()->startOfMonth(),
                Carbon::parse($dateRange[1])->copy()->endOfMonth(),
            ];
        }else{
            $first_day_month = Carbon::parse($date)->copy()->startOfMonth();
            $last_day_month = Carbon::parse($date)->copy()->endOfMonth();
            $first_day_year = Carbon::parse($date)->copy()->startOfYear();
            $last_day_year = Carbon::parse($date)->copy()->endOfYear();
        }

        $types = PurchaseRequest::with('account.parent')->where('status', "approved");
        $types->select(
            DB::raw('ROUND(SUM(total_cost), 2) as sum_cost'),
            'account_id'
        );
        if($end_user_id){
            $types->where('end_user_id', $end_user_id);
        }

        switch ($freq) {
            case 'monthly':
                $types->whereBetween('pr_date', [
                    $first_day_month,
                    $last_day_month,
                ]);
                $start_day = $first_day_month;
                $end_day = $last_day_month;
                break;
            case 'yearly':
                $types->whereBetween('pr_date', [
                    $first_day_year,
                    $last_day_year,
                ]);
                $start_day = $first_day_year;
                $end_day = $last_day_year;
                break;
            case 'custom':
                $types->whereBetween('pr_date', $custom_dates);
                $start_day = $custom_dates[0];
                $end_day = $custom_dates[1];
                break;
            
            default:
                # code...
                break;
        }
        $types->groupBy('account_id');
        $types = $types->get();
        $total = $this->totalPurchaseRequest('approved', $freq, $date, $dateRange, $end_user_id);
        $total = $total['data'];
        foreach ($types as $key => $type) {
            $type->key = ++$key;
            $type->name = $type->account->name;
            $type->account_id = $type->account->id;
            $type->account_classification = $type->account->parent->name;
            $type->account_classification_id = $type->account->parent->id;
            $type->account_percentage = round((($type->sum_cost / $total) * 100), 2);
            unset($type->account);
        }
        return [
            'data' => $types,
            'start_day' => $start_day->format("F d, Y"),
            'end_day' => $end_day->format("F d, Y"),
        ];
    }

    public function modeOfProcurements($date, $freq, $dateRange = [], $end_user_id = null)
    {
        $custom_dates = [];
        if($freq == "custom"){
            $custom_dates = [
                Carbon::parse($dateRange[0])->copy()->startOfMonth(),
                Carbon::parse($dateRange[1])->copy()->endOfMonth(),
            ];
        }else{
            $first_day_month = Carbon::parse($date)->copy()->startOfMonth();
            $last_day_month = Carbon::parse($date)->copy()->endOfMonth();
            $first_day_year = Carbon::parse($date)->copy()->startOfYear();
            $last_day_year = Carbon::parse($date)->copy()->endOfYear();
        }


        $types = PurchaseRequest::with('mode_of_procurement')->where('status', "approved");
        $types->select(
            DB::raw('ROUND(SUM(total_cost), 2) as sum_cost'),
            'mode_of_procurement_id'
        );
        if($end_user_id){
            $types->where('end_user_id', $end_user_id);
        }

        switch ($freq) {
            case 'monthly':
                $types->whereBetween('pr_date', [
                    $first_day_month,
                    $last_day_month,
                ]);
                $start_day = $first_day_month;
                $end_day = $last_day_month;
                break;
            case 'yearly':
                $types->whereBetween('pr_date', [
                    $first_day_year,
                    $last_day_year,
                ]);
                $start_day = $first_day_year;
                $end_day = $last_day_year;
                break;
            case 'custom':
                $types->whereBetween('pr_date', $custom_dates);
                $start_day = $custom_dates[0];
                $end_day = $custom_dates[1];
                break;
            
            default:
                # code...
                break;
        }

        $types->groupBy('mode_of_procurement_id');
        $types = $types->get();
        $total = $this->totalPurchaseRequest('approved', $freq, $date, $dateRange, $end_user_id);
        $total = $total['data'];
        foreach ($types as $key => $type) {
            $type->key = ++$key;
            $type->mode_of_procurement_id = $type->mode_of_procurement ? $type->mode_of_procurement->id : null;
            $type->name = $type->mode_of_procurement ? $type->mode_of_procurement->name : "";
            $type->mode_of_procurement_percentage = round((($type->sum_cost / $total) * 100), 2);
            if($type->mode_of_procurement){
                unset($type->mode_of_procurement);
            }
        }
        return [
            'data' => $types,
            'start_day' => $start_day->format("F d, Y"),
            'end_day' => $end_day->format("F d, Y"),
        ];
    }

    public function mostRequestedItems($date, $freq, $type, $dateRange = [], $end_user_id = null)
    {
        $custom_dates = [];
        if($freq == "custom"){
            $custom_dates = [
                Carbon::parse($dateRange[0])->copy()->startOfMonth(),
                Carbon::parse($dateRange[1])->copy()->endOfMonth(),
            ];
        }else{
            $first_day_month = Carbon::parse($date)->copy()->startOfMonth();
            $last_day_month = Carbon::parse($date)->copy()->endOfMonth();
            $first_day_year = Carbon::parse($date)->copy()->startOfYear();
            $last_day_year = Carbon::parse($date)->copy()->endOfYear();
        }
        $start_day = "";
        $end_day = "";

        $items = PurchaseRequest::where('status', "approved");
        $items->leftJoin('purchase_request_items', 'purchase_request_items.purchase_request_id', '=', 'purchase_requests.id');
        $items->select(
            'purchase_request_items.item_name',
            DB::raw('ROUND(SUM(total_unit_cost), 2) as sum_cost'),
            DB::raw('SUM(quantity) as sum_quantity')
        );
        if($end_user_id){
            $items->where('end_user_id', $end_user_id);
        }
        switch ($freq) {
            case 'monthly':
                $items->whereBetween('pr_date', [
                    $first_day_month,
                    $last_day_month,
                ]);
                $start_day = $first_day_month;
                $end_day = $last_day_month;
                break;
            case 'yearly':
                $items->whereBetween('pr_date', [
                    $first_day_year,
                    $last_day_year,
                ]);
                $start_day = $first_day_year;
                $end_day = $last_day_year;
                break;
            case 'custom':
                $items->whereBetween('pr_date', $custom_dates);
                $start_day = $custom_dates[0];
                $end_day = $custom_dates[1];
                break;
            
            default:
                # code...
                break;
        }
        $items->limit(100);
        $items->groupBy('purchase_request_items.item_name');
        if($type == "quantity"){
            $items->orderBy('sum_quantity','DESC');
        }else{
            $items->orderBy('sum_cost','DESC');
        }
        $items = $items->get();
        foreach ($items as $key => $item) {
            $item->key = ++$key;
            $item->ave_sum_cost = $item->sum_cost / $item->sum_quantity;
        }
        return [
            'data' => $items,
            'start_day' => $start_day->format("F d, Y"),
            'end_day' => $end_day->format("F d, Y"),
        ];
    }
}
