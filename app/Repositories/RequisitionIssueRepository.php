<?php

namespace App\Repositories;

use App\Models\RequisitionIssue;
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
}