<?php

namespace Database\Seeders;

use App\Models\Library;
use Illuminate\Database\Seeder;

class AccountCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $account_classifications = [
            "Capital Outlay",
            "Inventory Held for Consumption",
            "Inventory Held for Distribution",
            "Property Plant and Equipment",
            "Repair and Maintenance",
            "Semi-expandable",
            "Services",
        ];

        foreach ($account_classifications as $account_classifications) {
            $lib = Library::create(['name' => $account_classifications, 'library_type' => 'account_classification']);
            echo $lib->library_type.": ".$lib->name."\n";
        }
    }
}
