<?php

namespace App\Transformers;

use App\Models\QuotationItem;
use League\Fractal\TransformerAbstract;
use App\Transformers\QuotationTransformer;
use App\Transformers\PurchaseRequestItemTransformer;

class QuotationItemTransformer extends TransformerAbstract
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
        'quotation',
        'purchase_request_item',
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(QuotationItem $table)
    {
        return [
            'id' => $table->id,
            'key' => $table->id,
            'quotation_id' => $table->quotation_id,
            'purchase_request_item_id' => $table->purchase_request_item_id,
            'suppliers_specifications' => $table->suppliers_specifications,
            'quantity' => $table->quantity,
            'unit_cost' => $table->unit_cost,
            'total_unit_cost' => $table->total_unit_cost,
        ];
    }

    public function includeQuotation(QuotationItem $table)
    {
        if ($table->quotation) {
            return $this->item($table->quotation, new QuotationTransformer);
        }
    }
    public function includeSupplier(QuotationItem $table)
    {
        if ($table->purchase_request_item) {
            return $this->item($table->purchase_request_item, new PurchaseRequestItemTransformer);
        }
    }
}
