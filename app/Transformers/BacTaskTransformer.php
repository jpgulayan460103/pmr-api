<?php

namespace App\Transformers;

use App\Models\BacTask;
use League\Fractal\TransformerAbstract;
use App\Transformers\PurchaseRequestTransformer;

class BacTaskTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'purchase_request'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(BacTask $bacTask)
    {
        return [
            'id' => $bacTask->id,
            'key' => $bacTask->id,
            'purchase_request_id' => $bacTask->purchase_request_id,
            'bac_task_uuid' => $bacTask->bac_task_uuid,
            'preproc_conference' => $bacTask->preproc_conference,
            'post_of_ib' => $bacTask->post_of_ib,
            'prebid_conf' => $bacTask->prebid_conf,
            'eligibility_check' => $bacTask->eligibility_check,
            'open_of_bids' => $bacTask->open_of_bids,
            'bid_evaluation' => $bacTask->bid_evaluation,
            'post_qual' => $bacTask->post_qual,
            'notice_of_award' => $bacTask->notice_of_award,
            'contract_signing' => $bacTask->contract_signing,
            'notice_to_proceed' => $bacTask->notice_to_proceed,
            'estimated_ldd' => $bacTask->estimated_ldd,
            'abstract_of_qoutations' => $bacTask->abstract_of_qoutations,
        ];
    }

    public function includePurchaseRequest(BacTask $table)
    {
        if ($table->purchase_request) {
            return $this->item($table->purchase_request, new PurchaseRequestTransformer);
        }
    }
}
