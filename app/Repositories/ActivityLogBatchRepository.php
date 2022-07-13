<?php

namespace App\Repositories;

use App\Models\ActivityLog;
use App\Models\ActivityLogBatch;
use App\Models\RequisitionIssue;
use App\Repositories\Interfaces\ActivityLogBatchRepositoryInterface;
use App\Repositories\HasCrud;
use Illuminate\Support\Facades\Auth;
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
        $this->attach('subject, logs, causer.user_information');
    }

    public function endBatch($form)
    {
        $user = Auth::user();
        $uuid = LogBatch::getUuid();
        $form_type = getModelType(get_class($form));
        $this->create([
            'batch_uuid' => $uuid,
            'form_type' => $form_type,
            'subject_type' => get_class($form),
            'subject_id' => $form->id,
            'causer_id' => $user->id,
            'causer_type' => get_class($user),
        ]);
    }

    public function endCustomBatch($form_type, $user)
    {
        $uuid = LogBatch::getUuid();
        $this->create([
            'batch_uuid' => $uuid,
            'form_type' => $form_type,
            'causer_id' => $user->id,
            'causer_type' => get_class($user),
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

    public function getLogs($id, $type)
    {
        return $this->modelQuery()->where('subject_id', $id)->where('form_type', $type)->orderBy('id','desc')->get();
    }

    public function getAllLogs($user_id = null)
    {
        $results = $this->modelQuery()->orderBy('id','desc');
        if($user_id){
            $results->where('causer_id', $user_id);
        }
        return $results->paginate(20);
    }

}