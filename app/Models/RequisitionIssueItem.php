<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\RequisitionIssue;
use App\Models\Item;

class RequisitionIssueItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'requisition_issue_id',
        'item_id',
        'request_quantity',
        'issue_quantity',
        'has_stock',
    ];

    public function requisition_issue()
    {
        return $this->belongsTo(RequisitionIssue::class);
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

}
