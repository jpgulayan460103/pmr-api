<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Transformers\LibraryTransformer;
use App\Models\Item;

class ItemTransformer extends TransformerAbstract
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
        'unit_of_measure',
        'item_category',
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Item $table)
    {
        return [
            'value' => $table->item_name,
            'item_name' => $table->item_name,
            'item_code' => $table->item_code,
            'id' => $table->id,
            'key' => $table->id,
            // 'item_category_id' => $table->item_category_id,
            // 'unit_of_measure_id' => $table->unit_of_measure_id,
        ];
    }

    public function includeUnitOfMeasure(Item $table)
    {
        if ($table->unit_of_measure) {
            return $this->item($table->unit_of_measure, new LibraryTransformer);
        }
    }

    public function includeItemCategory(Item $table)
    {
        if ($table->item_category) {
            return $this->item($table->item_category, new LibraryTransformer);
        }
    }
}
