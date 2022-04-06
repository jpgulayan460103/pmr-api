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

    public function totalPurchaseRequest($type, $freq, $date)
    {
        $first_day_month = Carbon::parse($date)->copy()->startOfMonth();
        $last_day_month = Carbon::parse($date)->copy()->endOfMonth();
        $first_day_year = Carbon::parse($date)->copy()->startOfYear();
        $last_day_year = Carbon::parse($date)->copy()->endOfYear();
        $start_day = "";
        $end_day = "";

        $total = PurchaseRequest::where('status', $type);
        $total->select(
            DB::raw('ROUND(SUM(total_cost), 2) as sum_cost')
        );
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
            
            default:
                # code...
                break;
        }
        $total = $total->first();
        return [
            'total' => $total->sum_cost,
            'start_day' => $start_day->format("F d, Y"),
            'end_day' => $end_day->format("F d, Y"),
        ];
    }

    public function perMonthPurchaseRequest()
    {

        $data = array();
        for ($i = 1; $i <= 12; $i++) {
            $year = Carbon::now()->copy()->format('Y');
            $month = Carbon::create($year, $i, 1, 0, 0, 0);
            $approved_totals = $this->totalPurchaseRequest("approved", 'monthly', $month->toDateString());
            $pending_totals = $this->totalPurchaseRequest("pending", 'monthly', $month->toDateString());
            $data[] = [
                "month_short" => $month->shortMonthName,
                "month_full" => $month->monthName,
                "approved" => $approved_totals['total'] ? $approved_totals['total'] : 0,
                "pending" => $pending_totals['total'] ? $pending_totals['total'] : 0,
            ];
        }
        return [
            "summary" => $data,
            'start_day' => $data[0]['month_full']." 1, $year",
            'end_day' => $data[11]['month_full']." 31, $year",
        ];
    }

    public function procurementTypes($date, $freq)
    {
        $first_day_month = Carbon::parse($date)->copy()->startOfMonth();
        $last_day_month = Carbon::parse($date)->copy()->endOfMonth();
        $first_day_year = Carbon::parse($date)->copy()->startOfYear();
        $last_day_year = Carbon::parse($date)->copy()->endOfYear();

        $types = PurchaseRequest::with('procurement_type.parent')->where('status', "approved");
        $types->select(
            DB::raw('ROUND(SUM(total_cost), 2) as sum_cost'),
            'procurement_type_id'
        );

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
            
            default:
                # code...
                break;
        }
        $types->groupBy('procurement_type_id');
        $types = $types->get();
        $total = $this->totalPurchaseRequest('approved', $freq, $date);
        $total = $total['total'];
        foreach ($types as $key => $type) {
            $type->key = ++$key;
            $type->name = $type->procurement_type->name;
            $type->procurement_type_id = $type->procurement_type->id;
            $type->procurement_type_category = $type->procurement_type->parent->name;
            $type->procurement_type_category_id = $type->procurement_type->parent->id;
            $type->procurement_type_percentage = round((($type->sum_cost / $total) * 100), 2);
            unset($type->procurement_type);
        }
        return [
            'types' => $types,
            'start_day' => $start_day->format("F d, Y"),
            'end_day' => $end_day->format("F d, Y"),
        ];
    }

    public function modeOfProcurements($date, $freq)
    {
        $first_day_month = Carbon::parse($date)->copy()->startOfMonth();
        $last_day_month = Carbon::parse($date)->copy()->endOfMonth();
        $first_day_year = Carbon::parse($date)->copy()->startOfYear();
        $last_day_year = Carbon::parse($date)->copy()->endOfYear();

        $types = PurchaseRequest::with('mode_of_procurement')->where('status', "approved");
        $types->select(
            DB::raw('ROUND(SUM(total_cost), 2) as sum_cost'),
            'mode_of_procurement_id'
        );

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
            
            default:
                # code...
                break;
        }

        $types->groupBy('mode_of_procurement_id');
        $types = $types->get();
        $total = $this->totalPurchaseRequest('approved', $freq, $date);
        $total = $total['total'];
        foreach ($types as $key => $type) {
            $type->key = ++$key;
            $type->mode_of_procurement_id = $type->mode_of_procurement->id;
            $type->name = $type->mode_of_procurement->name;
            $type->mode_of_procurement_percentage = round((($type->sum_cost / $total) * 100), 2);
            unset($type->mode_of_procurement);
        }
        return [
            'types' => $types,
            'start_day' => $start_day->format("F d, Y"),
            'end_day' => $end_day->format("F d, Y"),
        ];
    }

    public function mostRequestedItems($date, $freq, $type)
    {
        $first_day_month = Carbon::parse($date)->copy()->startOfMonth();
        $last_day_month = Carbon::parse($date)->copy()->endOfMonth();
        $first_day_year = Carbon::parse($date)->copy()->startOfYear();
        $last_day_year = Carbon::parse($date)->copy()->endOfYear();
        $start_day = "";
        $end_day = "";

        $items = PurchaseRequest::where('status', "approved");
        $items->leftJoin('purchase_request_items', 'purchase_request_items.purchase_request_id', '=', 'purchase_requests.id');
        $items->select(
            'purchase_request_items.item_name',
            DB::raw('ROUND(SUM(total_unit_cost), 2) as sum_cost'),
            DB::raw('SUM(quantity) as sum_quantity')
        );
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
            
            default:
                # code...
                break;
        }
        $items->limit(10);
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
            'items' => $items,
            'start_day' => $start_day->format("F d, Y"),
            'end_day' => $end_day->format("F d, Y"),
        ];
    }
}
