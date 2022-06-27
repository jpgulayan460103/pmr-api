<?php

namespace App\Rules\RequisitionIssue;

use App\Repositories\ItemSupplyRepository;
use Illuminate\Contracts\Validation\Rule;

class MaxInventoryQuantity implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $exploded = explode(".", $attribute);
        $item_supply_id_attribute = implode(".",[
            $exploded[0],
            $exploded[1],
            "item_supply_id"
        ]);

        $item_supply_id = request($item_supply_id_attribute);
        $item_repo = new ItemSupplyRepository(); 
        $item_repo->attach('remaining_quantity');
        $item = $item_repo->getById($item_supply_id);
        // ddh($item->remaining_quantity->quantity);
        return ($item->remaining_quantity->quantity >= $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Check remaining quantity';
    }
}
