<?php

namespace App\Repositories;

use App\Models\ActivityLog;
use App\Models\ActivityLogBatch;
use App\Repositories\Interfaces\ActivityLogBatchRepositoryInterface;
use App\Repositories\HasCrud;
use Spatie\Activitylog\Facades\LogBatch;

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
        $this->create([
            'batch_uuid' => $uuid,
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

}