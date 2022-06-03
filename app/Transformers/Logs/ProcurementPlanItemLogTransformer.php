<?php

namespace App\Transformers\Logs;

use League\Fractal\TransformerAbstract;
use App\Models\ActivityLog;
use App\Transformers\ProcurementPlanItemTransformer;
use App\Transformers\UserTransformer;
use App\Transformers\ProcurementPlanTransformer;

class ProcurementPlanItemLogTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $labels = [
        "mon1" => "Jan",
        "mon2" => "Feb",
        "mon3" => "Mar",
        "mon4" => "Apr",
        "mon5" => "May",
        "mon6" => "Jun",
        "mon7" => "Jul",
        "mon8" => "Aug",
        "mon9" => "Sept",
        "mon10" => "Oct",
        "mon11" => "Nov",
        "mon12" => "Dec",
        "price" => "Price",
        "item_id" => "item",
        "item.name" => "item Name",
        "total_quantity" => "Total Quantity",
        "total_price" => "Total Price",
        "id" => "id",
    ];
    protected array $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        'user',
        'subject'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ActivityLog $activityLog)
    {
        return [
            'key' => $activityLog->id,
            'id' => $activityLog->id,
            'log_name' => $activityLog->log_name,
            'description' => ucfirst($activityLog->description),
            'subject_type' => $activityLog->subject_type,
            'subject_id' => $activityLog->subject_id,
            'causer_type' => $activityLog->causer_type,
            'causer_id' => $activityLog->causer_id,
            'properties' => $this->addLabels($activityLog->properties),
            'created_at' => $activityLog->created_at->toDateString(),
            'created_at_time' => $activityLog->created_at->toDayDateTimeString(),
        ];
    }

    public function addLabels($properties)
    {
        // return json_decode($properties, true);
        $properties = json_decode($properties, true);
        $properties['changes'] = [];
        if(isset($properties['attributes']) && $properties['attributes'] != array()){
            foreach ($properties['attributes'] as $key => $property) {
                if(isset($this->labels[$key])){
                    $properties['changes'][] = [
                        'label' => $this->labels[$key],
                        'key' => "logger_$key",
                        'old' => isset($properties['old'][$key]) ? $properties['old'][$key] : "",
                        'new' => isset($properties['attributes'][$key]) ? $properties['attributes'][$key] : "",
                    ];
                }
            }
        }
        unset($properties['old']);
        unset($properties['attributes']);
        return $properties['changes'];
    }

    public function includeUser(ActivityLog $table)
    {
        if ($table->user) {
            return $this->item($table->user, new UserTransformer);
        }
    }
    public function includeSubject(ActivityLog $table)
    {
        if ($table->subject) {
            return $this->item($table->subject, new ProcurementPlanItemTransformer);
        }
    }
}
