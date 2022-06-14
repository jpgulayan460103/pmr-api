<?php

namespace App\Repositories;

use App\Models\RequisitionIssue;
use App\Models\RequisitionIssueItem;
use App\Repositories\Interfaces\RequisitionIssueRepositoryInterface;
use App\Repositories\HasCrud;

class RequisitionIssueRepository implements RequisitionIssueRepositoryInterface
{
    use HasCrud;
    public function __construct(RequisitionIssue $RequisitionIssue = null)
    {
        if(!($RequisitionIssue instanceof RequisitionIssue)){
            $RequisitionIssue = new RequisitionIssue;
        }
        $this->model($RequisitionIssue);
        $this->perPage(200);
    }

    public function addItems()
    {
        $new_items = array();
        if(request()->has('itemsA') && request('itemsA') != array()){
            foreach (request('itemsA') as $key => $item) {
                $new_items[$key] = new RequisitionIssueItem($item);
            }
        }
        return [
            'items' => $new_items,
        ];
    }
}