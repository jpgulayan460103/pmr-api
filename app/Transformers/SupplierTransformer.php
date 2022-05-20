<?php

namespace App\Transformers;

use App\Models\Supplier;
use League\Fractal\TransformerAbstract;
use App\Transformers\SupplierContactTransformer;
use App\Transformers\QuotationTransformer;
use App\Transformers\SupplierCategoryTransformer;

class SupplierTransformer extends TransformerAbstract
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
        'contacts',
        'categories',
        'quotations',
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
            'display_log' => $table->name,
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
    public function includeCategories(Supplier $table)
    {
        if ($table->categories) {
            return $this->collection($table->categories, new SupplierCategoryTransformer);
        }
    }
}
