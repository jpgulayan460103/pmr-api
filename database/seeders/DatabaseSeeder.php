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
        activity()->disableLogging();
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UnitOfMeasureSeeder::class);
        $this->call(ItemCategorySeeder::class);
        $this->call(ItemTypeSeeder::class);
        $this->call(ItemSeeder::class);
        // $this->call(UserSeeder::class);
        $this->call(DivisionSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(TechnicalWorkingGroupSeeder::class);
        $this->call(AccountCategorySeeder::class);
        $this->call(AccountSeeder::class);
        $this->call(ProcurementTypeSeeder::class);
        $this->call(ModeOfProcurementClassificationSeeder::class);
        $this->call(ModeOfProcurementSeeder::class);
        $this->call(PositionSeeder::class);
        $this->call(AreaOfAssignmentSeeder::class);
        $this->call(EmploymentStatusSeeder::class);
        $this->call(UserOfficeSampleSeeder::class);
        $this->call(UserOfficeSeeder::class);
        $this->call(UacsCodeSeeder::class);
        activity()->enableLogging();
        // $this->call(FakerDataSeeders::class);
    }
}
