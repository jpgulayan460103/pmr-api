<?php

namespace App\Transformers;

use App\Models\Quotation;
use League\Fractal\TransformerAbstract;
use App\Transformers\PurchaseRequestTransformer;
use App\Transformers\SupplierTransformer;
use App\Transformers\SupplierContactTransformer;
use App\Transformers\UserTransformer;
use App\Transformers\QuotationItemTransformer;

class QuotationTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        'purchase_request',
        'supplier',
        'supplier_contact',
        'prepared_by',
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Quotation $table)
    {
        return [
            'id' => $table->id,
            'key' => $table->id,
            'rfq_number' => $table->rfq_number,
            'rfq_date' => $table->rfq_date,
            'rfq_uuid' => $table->rfq_uuid,
            'purchase_request_id' => $table->purchase_request_id,
            'supplier_id' => $table->supplier_id,
            'supplier_contact_id' => $table->supplier_contact_id,
            'prepared_by_id' => $table->prepared_by_id,
            'total_amount' => $table->total_amount,
        ];
    }

    public function includeItems(Quotation $table)
    {
        if ($table->items) {
            return $this->collection($table->items, new QuotationItemTransformer);
        }
    }

    public function includePurchaseRequest(Quotation $table)
    {
        if ($table->purchase_request) {
            return $this->item($table->purchase_request, new PurchaseRequestTransformer);
        }
    }
    public function includeSupplier(Quotation $table)
    {
        if ($table->supplier) {
            return $this->item($table->supplier, new SupplierTransformer);
        }
    }
    public function includeSupplierContact(Quotation $table)
    {
        if ($table->supplier_contact) {
            return $this->item($table->supplier_contact, new SupplierContactTransformer);
        }
    }
    public function includePreparedBy(Quotation $table)
    {
        if ($table->prepared_by) {
            return $this->item($table->prepared_by, new UserTransformer);
        }
    }
}
