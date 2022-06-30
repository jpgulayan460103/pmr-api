<?php

namespace App\Transformers;

use App\Models\NoStockCertificate;
use League\Fractal\TransformerAbstract;

class NoStockCertificateTransformer extends TransformerAbstract
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
        'items'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(NoStockCertificate $table)
    {
        return [
            'id' => $table->id,
            'key' => $table->id,
            'uuid' => $table->uuid,
            'cnas_number' => $table->cnas_number,
            'form_number' => $table->cnas_number,
            'cnas_date' => $table->cnas_date,
            'form_number' => $table->cnas_number,
            'file' => route('api.no-stock-certificate.pdf', ['id' => $table->uuid]),
        ];
    }

    public function includeItems(NoStockCertificate $table)
    {
        if ($table->items) {
            return $this->collection($table->items, new NoStockCertificateItemTransformer);
        }
    }
}
