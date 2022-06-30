<?php

namespace App\Transformers;

use App\Models\NoStockCertificateItem;
use League\Fractal\TransformerAbstract;

class NoStockCertificateItemTransformer extends TransformerAbstract
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
        'no_stock_certificate'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(NoStockCertificateItem $table)
    {
        return [
            'id' => $table->id,
            'key' => $table->id,
            'no_stock_certificate_id' => $table->no_stock_certificate_id,
            'description' => $table->description,
            'unit_of_measure' => $table->unit_of_measure,
            'quantity' => $table->quantity,
        ];
    }

    public function includeNoStockCertificate(NoStockCertificateItem $table)
    {
        if ($table->no_stock_certificate) {
            return $this->item($table->no_stock_certificate, new NoStockCertificateTransformer);
        }
    }
}
