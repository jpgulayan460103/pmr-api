<?php

namespace App\Transformers;

use App\Models\SupplierCategory;
use League\Fractal\TransformerAbstract;
use App\Transformers\SupplierTransformer;
use App\Transformers\LibraryTransformer;

class SupplierCategoryTransformer extends TransformerAbstract
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
        'supplier',
        'category'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(SupplierCategory $supplierCategory)
    {
        return [
            'id' => $supplierCategory->id,
            'key' => $supplierCategory->id,
            'supplier_id' => $supplierCategory->supplier_id,
            'category_id' => $supplierCategory->category_id,
        ];
    }

    public function includeSupplier(SupplierCategory $table)
    {
        if ($table->supplier) {
            return $this->item($table->supplier, new SupplierTransformer);
        }
    }
    
    public function includeCategory(SupplierCategory $table)
    {
        if ($table->category) {
            return $this->item($table->category, new LibraryTransformer);
        }
    }
}
