<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UnitOfMeasureSeeder::class);
        $this->call(ItemCategorySeeder::class);
        $this->call(ItemSeeder::class);
        // $this->call(UserSeeder::class);
        $this->call(DivisionSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(TechnicalWorkingGroupSeeder::class);
        $this->call(ProcurementTypeCategorySeeder::class);
        $this->call(ProcurementTypeSeeder::class);
        $this->call(ProcurementModeOfPaymentSeeder::class);
        $this->call(PositionSeeder::class);
        $this->call(AreaOfAssignmentSeeder::class);
        $this->call(EmploymentStatusSeeder::class);
        $this->call(UserOfficeSampleSeeder::class);
        $this->call(UserOfficeSeeder::class);
        // $this->call(FakerDataSeeders::class);
    }
}
