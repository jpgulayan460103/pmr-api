<?php

namespace App\Transformers;

use App\Models\SupplierContact;
use League\Fractal\TransformerAbstract;
use App\Transformers\SupplierTransformer;

class SupplierContactTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        // 'supplier'
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        'supplier'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(SupplierContact $table)
    {
        return [
            'id' => $table->id,
            'key' => $table->id,
            'name' => $table->name,
            'display_log' => $table->name,
            'email_address' => $table->email_address,
            'contact_number' => $table->contact_number ,
            'supplier_id' => $table->supplier_id,
        ];
    }

    public function includeSupplier(SupplierContact $table)
    {
        if ($table->supplier) {
            return $this->item($table->supplier, new SupplierTransformer);
        }
    }
}
