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
                "title" => "RSCWC",
                "division" => "Office of the Regional Director",
            ],
            [
                "section" => "Legal Unit",
                "title" => "LU",
                "division" => "Office of the Regional Director",
            ],
            [
                "section" => "Internal Audit Unit",
                "title" => "IAU",
                "division" => "Office of the Regional Director",
            ],
            [
                "section" => "Social Marketing Unit",
                "title" => "SMU",
                "division" => "Office of the Regional Director",
            ],
            [
                "section" => "Regional Juvenile Justice and Welfare Council",
                "title" => "RJJWC",
                "division" => "Office of the Regional Director",
            ],
            [
                "section" => "Office of the Assistant Regional Director for Operations",
                "title" => "OARDO",
                "division" => "Office of the Regional Director",
            ],
            [
                "section" => "Office of the Assistant Regional Director for Administration",
                "title" => "OARDA",
                "division" => "Office of the Regional Director",
            ],
            [
                "section" => "Office of the Regional Director",
                "title" => "ORD",
                "division" => "Office of the Regional Director",
            ],
            [
                "section" => "Secretary of the Director",
                "title" => "SD",
                "division" => "Office of the Regional Director",
            ],
            [
                "section" => "Sustainable Livelihood Program Management Office",
                "title" => "SLPMO",
                "division" => "Promotive Services Division",
            ],
            [
                "section" => "KALAHI CIDSS Program Management Office",
                "title" => "KALAHI CIDSS",
                "division" => "Promotive Services Division",
            ],
            [
                "section" => "Enhanced Partnership Against Hunger and Poverty Program Management Office",
                "title" => "EPHAP",
                "division" => "Promotive Services Division",
            ],
            [
                "section" => "Disaster Response and Rehabilitation Section",
                "title" => "DRRS",
                "division" => "Disaster Response Management Division",
            ],
            [
                "section" => "Regional Resource Operations Section",
                "title" => "RROS",
                "division" => "Disaster Response Management Division",
            ],
            [
                "section" => "Disaster Response Information Management Section",
                "title" => "DRIMS",
                "division" => "Disaster Response Management Division",
            ],
            [
                "section" => "Social Technology Unit",
                "title" => "STU",
                "division" => "Protective Services Division",
            ],
            [
                "section" => "Crisis Intervention Section",
                "title" => "CIS",
                "division" => "Protective Services Division",
            ],
            [
                "section" => "Capability Building Section",
                "title" => "CBS",
                "division" => "Protective Services Division",
            ],
            [
                "section" => "Technical Assistance and Resource Augmentation",
                "title" => "TARA",
                "division" => "Protective Services Division",
            ],
            [
                "section" => "Community-Based Services Section",
                "title" => "CBSS",
                "division" => "Protective Services Division",
            ],
            [
                "section" => "Social Pension Program Management Office",
                "title" => "SPPMO",
                "division" => "Protective Services Division",
            ],
            [
                "section" => "Supplimentary Feeding Program Management Office",
                "title" => "SFPMO",
                "division" => "Protective Services Division",
            ],
            [
                "section" => "Adoption Resource and Referral Section",
                "title" => "ARRS",
                "division" => "Protective Services Division",
            ],
            [
                "section" => "Center Based Services",
                "title" => "CBS",
                "division" => "Protective Services Division",
            ],
            [
                "section" => "Home for the Aged",
                "title" => "HA",
                "division" => "Protective Services Division",
            ],
            [
                "section" => "Regional Rehabilitation Center for Youth",
                "title" => "RRCY",
                "division" => "Protective Services Division",
            ],
            [
                "section" => "Center for Children with Special Needs",
                "title" => "CCSN",
                "division" => "Protective Services Division",
            ],
            [
                "section" => "Reception and Study Center for Children",
                "title" => "RSCC",
                "division" => "Protective Services Division",
            ],
            [
                "section" => "Home for Girls and Women",
                "title" => "HGW",
                "division" => "Protective Services Division",
            ],
            [
                "section" => "Pantawid Pamilyang Pilipino Program Management Division",
                "title" => "PPPPMD",
                "division" => "Pantawid Pamilyang Pilipino Program Management",
            ],
            [
                "section" => "Pantawid Pamilyang Pilipino Progam - City/Municipal Operations Office",
                "title" => "PPPPCMOO",
                "division" => "Pantawid Pamilyang Pilipino Program Management",
            ],
            [
                "section" => "Pantawid Pamilyang Pilipino Program - Provincial Operations Office",
                "title" => "PPPPPOO",
                "division" => "Pantawid Pamilyang Pilipino Program Management",
            ],
            [
                "section" => "Pantawid Pamilyang Pilipino Progam - Regional Management Office",
                "title" => "PPPPRMO",
                "division" => "Pantawid Pamilyang Pilipino Program Management",
            ],
            [
                "section" => "Provincial Social Welfare and Development Office",
                "title" => "PSWADO",
                "division" => "Pantawid Pamilyang Pilipino Program Management",
            ],
            [
                "section" => "Policy Development and Planning Section",
                "title" => "PDPS",
                "division" => "Policy and Plans Division",
            ],
            [
                "section" => "Anti-Red Tape Unit",
                "title" => "ARTU",
                "division" => "Policy and Plans Division",
            ],
            [
                "section" => "Standards Section",
                "title" => "SS",
                "division" => "Policy and Plans Division",
            ],
            [
                "section" => "Information and Communications Technology Management Section",
                "title" => "ICTMS",
                "division" => "Policy and Plans Division",
            ],
            [
                "section" => "National Households Targeting System Program Management Office",
                "title" => "NHTSPMO",
                "division" => "Policy and Plans Division",
            ],
            [
                "section" => "Unconditional Cash Transfer Program Management Office",
                "title" => "UCTPMO",
                "division" => "Policy and Plans Division",
            ],
            [
                "section" => "Property Supply and Asset Management Section",
                "title" => "PSAMS",
                "division" => "Administrative Division",
            ],
            [
                "section" => "Procurement Section",
                "title" => "PS",
                "division" => "Administrative Division",
            ],
            [
                "section" => "Records and Archives Management Section",
                "title" => "RAMS",
                "division" => "Administrative Division",
            ],
            [
                "section" => "General Services Section",
                "title" => "GSS",
                "division" => "Administrative Division",
            ],
            [
                "section" => "Bids and Awards Committee Secretariat",
                "title" => "BACS",
                "division" => "Administrative Division",
            ],
            [
                "section" => "Human Resource Planning and Performance Management Section",
                "title" => "HRPPMS",
                "division" => "Human Resource Management and Development Division",
            ],
            [
                "section" => "Personnel Administration Section",
                "title" => "PAS",
                "division" => "Human Resource Management and Development Division",
            ],
            [
                "section" => "Learning Development Section",
                "title" => "LDS",
                "division" => "Human Resource Management and Development Division",
            ],
            [
                "section" => "Welfare Section",
                "title" => "WS",
                "division" => "Human Resource Management and Development Division",
            ],
            [
                "section" => "Accounting Section",
                "title" => "AS",
                "division" => "Financial Management Division",
            ],
            [
                "section" => "Budget Section",
                "title" => "BS",
                "division" => "Financial Management Division",
            ],
            [
                "section" => "Cash Section",
                "title" => "CS",
                "division" => "Financial Management Division",
            ],
            [
                "section" => "HRMDD",
                "title" => "",
                "division" => "Resource Management",
            ],
            [
                "section" => "PPD",
                "title" => "",
                "division" => "Resource Management",
            ],
            [
                "section" => "PROTECTIVE SERVICE",
                "title" => "",
                "division" => "Resource Management",
            ],
            [
                "section" => "ADMINISTRATIVE DIVISION",
                "title" => "",
                "division" => "Resource Management",
            ],
            [
                "section" => "FINANCE DIVISION",
                "title" => "",
                "division" => "Resource Management",
            ],
            [
                "section" => "PROMOTIVE DIVISION",
                "title" => "",
                "division" => "Resource Management",
            ],
            [
                "section" => "DRMD",
                "title" => "",
                "division" => "Resource Management",
            ],
            [
                "section" => "Office of The Division Chief",
                "title" => "",
                "division" => "Resource Management",
            ],

        ];

        foreach ($categories as $category) {
            $parent_lib = Library::where('type','user_division')->where('name', $category['division'])->first();
            $lib = Library::create(['name' => $category['section'], 'title' => $category['title'], 'type' => 'user_section', 'parent_id' => $parent_lib->id]);
            echo $lib->type.": ".$lib->name."\n";
        }
    }
}
