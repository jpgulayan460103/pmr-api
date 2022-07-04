<?php

namespace App\Repositories;

use App\Models\ActivityLog;
use App\Models\ActivityLogBatch;
use App\Models\RequisitionIssue;
use App\Repositories\Interfaces\ActivityLogBatchRepositoryInterface;
use App\Repositories\HasCrud;
use Spatie\Activitylog\Facades\LogBatch;
use Illuminate\Support\Str;

class ActivityLogBatchRepository implements ActivityLogBatchRepositoryInterface
{
    use HasCrud;

    public function __construct(ActivityLogBatch $supplier = null)
    {
        if(!($supplier instanceof ActivityLogBatch)){
            $supplier = new ActivityLogBatch;
        }
        $this->model($supplier);
        $this->perPage(200);
    }

    public function endBatch($form)
    {
        $uuid = LogBatch::getUuid();
        $class_name =  explode("\\", get_class($form));
        $form_type = Str::snake(last($class_name));
        $this->create([
            'batch_uuid' => $uuid,
            'form_type' => $form_type,
            'subject_type' => get_class($form),
            'subject_id' => $form->id
        ]);
    }

    public function startBatch()
    {
        if(LogBatch::isOpen()) {
            LogBatch::endBatch();
        }
        LogBatch::startBatch();
    }

    public function deleteBatch()
    {
        if(LogBatch::isOpen()) {
            $uuid = LogBatch::getUuid();
            ActivityLog::where('batch_uuid', $uuid)->delete();
            ActivityLogBatch::where('batch_uuid', $uuid)->delete();
            LogBatch::endBatch();
        }
    }

    public function getLogs($id)
    {
        return $this->getRequisitionIssueLogs($id);
    }

    public function getRequisitionIssueLogs($id)
    {
        $requisitionIssue = new RequisitionIssue();
        return $this->modelQuery()->where('subject_id', $id)->where('subject_type', get_class($requisitionIssue))->get();
    }

}