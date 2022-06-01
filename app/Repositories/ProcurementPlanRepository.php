<?php

namespace App\Repositories;

use App\Models\ProcurementPlan;
use App\Models\ProcurementPlanItem;
use App\Repositories\Interfaces\ProcurementPlanRepositoryInterface;
use App\Repositories\HasCrud;

class ProcurementPlanRepository implements ProcurementPlanRepositoryInterface
{
    use HasCrud;

    public function __construct(ProcurementPlan $procurementPlan = null)
    {
        if(!($procurementPlan instanceof ProcurementPlan)){
            $procurementPlan = new ProcurementPlan;
        }
        $this->model($procurementPlan);
        $this->perPage(200);
    }

    public function addItems()
    {
        $total_cost = 0;
        $new_items = array();
        if(request()->has('items') && request('items') != array()){
            foreach (request('items') as $key => $item) {
                $total_quantity = $this->sumAllMon($item);
                $item['total_price'] = $item['price'] * $total_quantity;
                $total_cost += $item['total_price'];
                $item['total_quantity'] = $total_quantity;
                $new_items[$key] = new ProcurementPlanItem($item);
            }
        }
        return [
            'items' => $new_items,
            'total_cost' => $total_cost,
        ];
    }

    public function sumAllMon($items)
    {
        $total = 0;
        $total += $items['mon1'];
        $total += $items['mon2'];
        $total += $items['mon3'];
        $total += $items['mon4'];
        $total += $items['mon5'];
        $total += $items['mon6'];
        $total += $items['mon7'];
        $total += $items['mon8'];
        $total += $items['mon9'];
        $total += $items['mon10'];
        $total += $items['mon11'];
        $total += $items['mon12'];
        return $total;
    }
}