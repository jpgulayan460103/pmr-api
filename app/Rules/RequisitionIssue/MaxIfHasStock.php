<?php

namespace App\Rules\RequisitionIssue;

use App\Repositories\ProcurementManagementRepository;
use Illuminate\Contracts\Validation\Rule;

class MaxIfHasStock implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $type;
    public $quantity;
    public function __construct($type, $quantity = "request_quantity")
    {
        $this->type = $type;
        $this->quantity = $quantity;
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
        $has_stock_attribute = implode(".",[
            $exploded[0],
            $exploded[1],
            "has_stock"
        ]);
        if($this->type == "ppmp"){
            $procurement_plan_item_id_attribute = implode(".",[
                $exploded[0],
                $exploded[1],
                "procurement_plan_item_id"
            ]);
            $procurement_plan_item = (new ProcurementManagementRepository())->getItem(request($procurement_plan_item_id_attribute));
            return request($has_stock_attribute) == 1 && $value <= $procurement_plan_item->total_quantity;
        }

        $quantity_attribute = implode(".",[
            $exploded[0],
            $exploded[1],
            $this->quantity
        ]);

        return request($has_stock_attribute) == 1 && $value <= request($quantity_attribute);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if($this->type == "ppmp"){
            return 'Check PPMP';
        }
        return 'Invalid Quantity';
    }
}
