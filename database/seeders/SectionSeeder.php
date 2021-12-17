<?php

namespace Database\Seeders;

use App\Models\Library;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                "section" => "Regional Sub-Committee for the Welfare of Children",
                "division" => "Office of the Regional Director"
            ],
            [
                "section" => "Legal Unit",
                "division" => "Office of the Regional Director"
            ],
            [
                "section" => "Internal Audit Unit",
                "division" => "Office of the Regional Director"
            ],
            [
                "section" => "Social Marketing Unit",
                "division" => "Office of the Regional Director"
            ],
            [
                "section" => "Regional Juvenile Justice and Welfare Council",
                "division" => "Office of the Regional Director"
            ],
            [
                "section" => "Office of the Assistant Regional Director for Operations",
                "division" => "Office of the Regional Director"
            ],
            [
                "section" => "Office of the Assistant Regional Director for Administration",
                "division" => "Office of the Regional Director"
            ],
            [
                "section" => "Office of the Regional Director",
                "division" => "Office of the Regional Director"
            ],
            [
                "section" => "Secretary of the Director",
                "division" => "Office of the Regional Director"
            ],
            [
                "section" => "Sustainable Livelihood Program Management Office",
                "division" => "Promotive Services Division"
            ],
            [
                "section" => "KALAHI CIDSS Program Management Office",
                "division" => "Promotive Services Division"
            ],
            [
                "section" => "EPHAP",
                "division" => "Promotive Services Division"
            ],
            [
                "section" => "Disaster Response and Rehabilitation Section",
                "division" => "Disaster Response Management Division"
            ],
            [
                "section" => "Regional Resource Operations Section",
                "division" => "Disaster Response Management Division"
            ],
            [
                "section" => "Disaster Response Information Management Section",
                "division" => "Disaster Response Management Division"
            ],
            [
                "section" => "Social Technology Unit",
                "division" => "Protective Services Division"
            ],
            [
                "section" => "Crisis Intervention Section",
                "division" => "Protective Services Division"
            ],
            [
                "section" => "Capability Building Section",
                "division" => "Protective Services Division"
            ],
            [
                "section" => "Technical Assistance and Resource Augmentation",
                "division" => "Protective Services Division"
            ],
            [
                "section" => "Community-Based Services Section",
                "division" => "Protective Services Division"
            ],
            [
                "section" => "Social Pension Program Management Office",
                "division" => "Protective Services Division"
            ],
            [
                "section" => "Supplimentary Feeding Program Management Office",
                "division" => "Protective Services Division"
            ],
            [
                "section" => "Adoption Resource and Referral Section",
                "division" => "Protective Services Division"
            ],
            [
                "section" => "Center Based Services",
                "division" => "Protective Services Division"
            ],
            [
                "section" => "Home for the Aged",
                "division" => "Protective Services Division"
            ],
            [
                "section" => "Regional Rehabilitation Center for Youth",
                "division" => "Protective Services Division"
            ],
            [
                "section" => "Center for Children with Special Needs",
                "division" => "Protective Services Division"
            ],
            [
                "section" => "Reception and Study Center for Children",
                "division" => "Protective Services Division"
            ],
            [
                "section" => "Home for Girls and Women",
                "division" => "Protective Services Division"
            ],
            [
                "section" => "RRCY",
                "division" => "Protective Services Division"
            ],
            [
                "section" => "RSCC",
                "division" => "Protective Services Division"
            ],
            [
                "section" => "HA",
                "division" => "Protective Services Division"
            ],
            [
                "section" => "HGW",
                "division" => "Protective Services Division"
            ],
            [
                "section" => "CCSN",
                "division" => "Protective Services Division"
            ],
            [
                "section" => "Pantawid Pamilyang Pilipino Program Management Division",
                "division" => "Pantawid Pamilyang Pilipino Program Management"
            ],
            [
                "section" => "Pantawid Pamilyang Pilipino Progam - City/Municipal Operations Office",
                "division" => "Pantawid Pamilyang Pilipino Program Management"
            ],
            [
                "section" => "Pantawid Pamilyang Pilipino Program - Provincial Operations Office",
                "division" => "Pantawid Pamilyang Pilipino Program Management"
            ],
            [
                "section" => "Pantawid Pamilyang Pilipino Progam - Regional Management Office",
                "division" => "Pantawid Pamilyang Pilipino Program Management"
            ],
            [
                "section" => "Provincial Social Welfare and Development Office (PSWADO)",
                "division" => "Pantawid Pamilyang Pilipino Program Management"
            ],
            [
                "section" => "Policy Development and Planning Section",
                "division" => "Policy and Plans Division"
            ],
            [
                "section" => "Anti-Red Tape Unit",
                "division" => "Policy and Plans Division"
            ],
            [
                "section" => "Standards Section",
                "division" => "Policy and Plans Division"
            ],
            [
                "section" => "Information and Communications Technology Management Section",
                "division" => "Policy and Plans Division"
            ],
            [
                "section" => "National Households Targeting System Program Management Office",
                "division" => "Policy and Plans Division"
            ],
            [
                "section" => "Unconditional Cash Transfer Program Management Office",
                "division" => "Policy and Plans Division"
            ],
            [
                "section" => "Property Supply and Asset Management Section",
                "division" => "Administrative Division"
            ],
            [
                "section" => "Procurement Section",
                "division" => "Administrative Division"
            ],
            [
                "section" => "Records and Archives Management Section",
                "division" => "Administrative Division"
            ],
            [
                "section" => "General Services Section",
                "division" => "Administrative Division"
            ],
            [
                "section" => "Bids and Awards Committee Secretariat (BAC Sec)",
                "division" => "Administrative Division"
            ],
            [
                "section" => "Human Resource Planning and Performance Management Section",
                "division" => "Human Resource Management and Development Division"
            ],
            [
                "section" => "Personnel Administration Section",
                "division" => "Human Resource Management and Development Division"
            ],
            [
                "section" => "Learning Development Section",
                "division" => "Human Resource Management and Development Division"
            ],
            [
                "section" => "Welfare Section",
                "division" => "Human Resource Management and Development Division"
            ],
            [
                "section" => "Accounting Section",
                "division" => "Financial Management Division"
            ],
            [
                "section" => "Budget Section",
                "division" => "Financial Management Division"
            ],
            [
                "section" => "Cash Section",
                "division" => "Financial Management Division"
            ],
            [
                "section" => "HRMDD",
                "division" => "Resource Management"
            ],
            [
                "section" => "PPD",
                "division" => "Resource Management"
            ],
            [
                "section" => "PROTECTIVE SERVICE",
                "division" => "Resource Management"
            ],
            [
                "section" => "ADMINISTRATIVE DIVISION",
                "division" => "Resource Management"
            ],
            [
                "section" => "FINANCE DIVISION",
                "division" => "Resource Management"
            ],
            [
                "section" => "PROMOTIVE DIVISION",
                "division" => "Resource Management"
            ],
            [
                "section" => "DRMD",
                "division" => "Resource Management"
            ],
            [
                "section" => "Office of The Division Chief",
                "division" => "Resource Management"
            ],
            [
                "section" => "RJJWC",
                "division" => "Regional Juvenile Justice Welfare Council"
            ],

        ];

        foreach ($categories as $category) {
            $parent_lib = Library::where('type','user_division')->where('name', $category['division'])->first();
            $lib = Library::create(['name' => $category['section'], 'type' => 'user_section', 'parent_id' => $parent_lib->id]);
            echo $lib->type.": ".$lib->name."\n";
        }
    }
}
