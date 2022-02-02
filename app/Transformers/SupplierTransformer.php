<?php

namespace App\Transformers;

use App\Models\Supplier;
use League\Fractal\TransformerAbstract;
use App\Transformers\SupplierContactTransformer;
use App\Transformers\QuotationTransformer;

class SupplierTransformer extends TransformerAbstract
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
        'contacts'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Supplier $table)
    {
        return [
            'id' => $table->id,
            'key' => $table->id,
            'name' => $table->name,
            'address' => $table->address,
        ];
    }

    public function includeContacts(Supplier $table)
    {
        if ($table->contacts) {
            return $this->collection($table->contacts, new SupplierContactTransformer);
        }
    }
    public function includeQuotations(Supplier $table)
    {
        if ($table->quotations) {
            return $this->collection($table->quotations, new QuotationTransformer);
        }
    }
}
