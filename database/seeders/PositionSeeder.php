<?php

namespace Database\Seeders;

use App\Models\Library;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
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
                'name' => "Accountant I",
                'title' => "Acct I",
            ],
            [
                'name' => "Accountant II",
                'title' => "Acct II",
            ],
            [
                'name' => "Accountant III",
                'title' => "Acct III",
            ],
            [
                'name' => "Administrative Aide I",
                'title' => "Administrative Aide I",
            ],
            [
                'name' => "Administrative Aide II",
                'title' => "Administrative Aide II",
            ],
            [
                'name' => "Administrative Aide III",
                'title' => "Administrative Aide III",
            ],
            [
                'name' => "Administrative Aide IV",
                'title' => "Administrative Aide IV",
            ],
            [
                'name' => "Administrative Aide VI",
                'title' => "Administrative Aide VI",
            ],
            [
                'name' => "Administrative Assistant I",
                'title' => "AA I",
            ],
            [
                'name' => "Administrative Assistant II",
                'title' => "AA II",
            ],
            [
                'name' => "Administrative Assistant III",
                'title' => "AA III",
            ],
            [
                'name' => "Administrative Officer I",
                'title' => "AO I",
            ],
            [
                'name' => "Administrative Officer II",
                'title' => "AO II",
            ],
            [
                'name' => "Administrative Officer III",
                'title' => "AO III",
            ],
            [
                'name' => "Administrative Officer IV",
                'title' => "AO IV",
            ],
            [
                'name' => "Administrative Officer V",
                'title' => "AO V",
            ],
            [
                'name' => "Area Coordinator",
                'title' => "AC",
            ],
            [
                'name' => "Attorney I",
                'title' => "Attorney I",
            ],
            [
                'name' => "Attorney II",
                'title' => "Attorney II",
            ],
            [
                'name' => "Attorney III",
                'title' => "Attorney III",
            ],
            [
                'name' => "Attorney IV",
                'title' => "Attorney IV",
            ],
            [
                'name' => "Bookkeeper",
                'title' => "Bookkeeper",
            ],
            [
                'name' => "Budget Assistant",
                'title' => "Budget Assistant",
            ],
            [
                'name' => "Cash Clerk I",
                'title' => "CC I",
            ],
            [
                'name' => "Cash Clerk II",
                'title' => "CC II",
            ],
            [
                'name' => "Cash Clerk III",
                'title' => "CC III",
            ],
            [
                'name' => "Chief Administrative Officer",
                'title' => "CAO",
            ],
            [
                'name' => "Community Development Assistant I",
                'title' => "CDA I",
            ],
            [
                'name' => "Community Development Assistant II",
                'title' => "CDA II",
            ],
            [
                'name' => "Community Development Officer I",
                'title' => "CDO I",
            ],
            [
                'name' => "Community Development Officer II",
                'title' => "CDO II",
            ],
            [
                'name' => "Community Development Officer III",
                'title' => "CDO III",
            ],
            [
                'name' => "Community Development Officer IV",
                'title' => "CDO IV",
            ],
            [
                'name' => "Community Development Officer V",
                'title' => "CDO V",
            ],
            [
                'name' => "Community Empowerment Facilitator",
                'title' => "CEF",
            ],
            [
                'name' => "Community Facilitator",
                'title' => "CF",
            ],
            [
                'name' => "Community Facilitator Aide",
                'title' => "CFA",
            ],
            [
                'name' => "Computer Maintenance Technologist I",
                'title' => "CMT I",
            ],
            [
                'name' => "Computer Maintenance Technologist II",
                'title' => "CMT II",
            ],
            [
                'name' => "Computer Maintenance Technologist III",
                'title' => "CMT III",
            ],
            [
                'name' => "Cook I",
                'title' => "Cook I",
            ],
            [
                'name' => "Cook II",
                'title' => "Cook II",
            ],
            [
                'name' => "Deputy Regional Project Manager",
                'title' => "DRPM",
            ],
            [
                'name' => "Director I",
                'title' => "Director I",
            ],
            [
                'name' => "Director II",
                'title' => "Director II",
            ],
            [
                'name' => "Director III",
                'title' => "Director III",
            ],
            [
                'name' => "Director IV",
                'title' => "Director IV",
            ],
            [
                'name' => "Director V",
                'title' => "Director V",
            ],
            [
                'name' => "Director VI",
                'title' => "Director VI",
            ],
            [
                'name' => "Encoder",
                'title' => "Encoder",
            ],
            [
                'name' => "Engineer II",
                'title' => "Engineer II",
            ],
            [
                'name' => "Engineer III",
                'title' => "Engineer III",
            ],
            [
                'name' => "Executive Assistant",
                'title' => "EA",
            ],
            [
                'name' => "Financial Analyst I",
                'title' => "FA I",
            ],
            [
                'name' => "Financial Analyst II",
                'title' => "FA II",
            ],
            [
                'name' => "Financial Analyst III",
                'title' => "FA III",
            ],
            [
                'name' => "Houseparent I",
                'title' => "Houseparent I",
            ],
            [
                'name' => "Houseparent II",
                'title' => "Houseparent II",
            ],
            [
                'name' => "Houseparent III",
                'title' => "Houseparent III",
            ],
            [
                'name' => "Information Officer I",
                'title' => "IO I",
            ],
            [
                'name' => "Information Officer II",
                'title' => "IO II",
            ],
            [
                'name' => "Information Systems Analyst I",
                'title' => "ISA I",
            ],
            [
                'name' => "Information Systems Analyst II",
                'title' => "ISA II",
            ],
            [
                'name' => "Information Systems Analyst III",
                'title' => "ISA III",
            ],
            [
                'name' => "Information Technology Officer I",
                'title' => "ITO I",
            ],
            [
                'name' => "Information Technology Officer II",
                'title' => "ITO II",
            ],
            [
                'name' => "Laundry Worker I",
                'title' => "Laundry Worker I",
            ],
            [
                'name' => "Laundry Worker II",
                'title' => "Laundry Worker II",
            ],
            [
                'name' => "Legal Assistant I",
                'title' => "LA I",
            ],
            [
                'name' => "Legal Assistant II",
                'title' => "LA II",
            ],
            [
                'name' => "Management and Audit Analyst I",
                'title' => "MAA I",
            ],
            [
                'name' => "Management and Audit Analyst II",
                'title' => "MAA II",
            ],
            [
                'name' => "Management and Audit Analyst III",
                'title' => "MAA III",
            ],
            [
                'name' => "Manpower Development Officer I",
                'title' => "MDO I",
            ],
            [
                'name' => "Manpower Development Officer II",
                'title' => "MDO II",
            ],
            [
                'name' => "Medical Officer I",
                'title' => "MO I",
            ],
            [
                'name' => "Medical Officer II",
                'title' => "MO II",
            ],
            [
                'name' => "Medical Officer III",
                'title' => "MO III",
            ],
            [
                'name' => "Medical Officer IV",
                'title' => "MO IV",
            ],
            [
                'name' => "Monitoring & Evaluation Officer II",
                'title' => "MEO II",
            ],
            [
                'name' => "Monitoring & Evaluation Officer III",
                'title' => "MEO III",
            ],
            [
                'name' => "Municipal Monitor",
                'title' => "Municipal Monitor",
            ],
            [
                'name' => "Notifier",
                'title' => "Notifier",
            ],
            [
                'name' => "Nurse I",
                'title' => "Nurse I",
            ],
            [
                'name' => "Nurse II",
                'title' => "Nurse II",
            ],
            [
                'name' => "Nutritionist Dietitian I",
                'title' => "ND I",
            ],
            [
                'name' => "Nutritionist Dietitian II",
                'title' => "ND II",
            ],
            [
                'name' => "Nutritionist Dietitian III",
                'title' => "ND III",
            ],
            [
                'name' => "Physical Therapist II",
                'title' => "PT II",
            ],
            [
                'name' => "Planning Officer I",
                'title' => "PO I",
            ],
            [
                'name' => "Planning Officer II",
                'title' => "PO II",
            ],
            [
                'name' => "Planning Officer III",
                'title' => "PO III",
            ],
            [
                'name' => "Planning Officer IV",
                'title' => "PO IV",
            ],
            [
                'name' => "Procurement Officer",
                'title' => "PO",
            ],
            [
                'name' => "Project Development Officer I",
                'title' => "PDO I",
            ],
            [
                'name' => "Project Development Officer II",
                'title' => "PDO II",
            ],
            [
                'name' => "Project Development Officer III",
                'title' => "PDO III",
            ],
            [
                'name' => "Project Development Officer IV",
                'title' => "PDO IV",
            ],
            [
                'name' => "Project Development Officer V",
                'title' => "PDO V",
            ],
            [
                'name' => "Project Evaluation Officer I",
                'title' => "PEO I",
            ],
            [
                'name' => "Project Evaluation Officer II",
                'title' => "PEO II",
            ],
            [
                'name' => "Project Evaluation Officer III",
                'title' => "PEO III",
            ],
            [
                'name' => "Project Evaluation Officer IV",
                'title' => "PEO IV",
            ],
            [
                'name' => "Psychologist I",
                'title' => "Psychologist I",
            ],
            [
                'name' => "Social Marketing Officer",
                'title' => "SMO",
            ],
            [
                'name' => "Social Welfare Aide",
                'title' => "SWA",
            ],
            [
                'name' => "Social Welfare Assistant",
                'title' => "SWA",
            ],
            [
                'name' => "Social Welfare Officer I",
                'title' => "SWO I",
            ],
            [
                'name' => "Social Welfare Officer II",
                'title' => "SWO II",
            ],
            [
                'name' => "Social Welfare Officer III",
                'title' => "SWO III",
            ],
            [
                'name' => "Social Welfare Officer IV",
                'title' => "SWO IV",
            ],
            [
                'name' => "Social Welfare Officer V",
                'title' => "SWO V",
            ],
            [
                'name' => "Statistician Aide",
                'title' => "Statistician Aide",
            ],
            [
                'name' => "Statistician I",
                'title' => "Stat I",
            ],
            [
                'name' => "Statistician II",
                'title' => "Stat II",
            ],
            [
                'name' => "Supervising Administrative Officer",
                'title' => "SAO",
            ],
            [
                'name' => "Teacher (ECCD)",
                'title' => "Teacher (ECCD)",
            ],
            [
                'name' => "Technical Facilitator",
                'title' => "TF",
            ],
            [
                'name' => "Training Assistant",
                'title' => "TA",
            ],
            [
                'name' => "Training Specialist I",
                'title' => "TS I",
            ],
            [
                'name' => "Training Specialist II",
                'title' => "TS II",
            ],
            [
                'name' => "Training Specialist III",
                'title' => "TS III",
            ],
            [
                'name' => "Training Specialist IV",
                'title' => "TS IV",
            ],
            [
                'name' => "Utility Worker I",
                'title' => "Utility Worker I",
            ],
            [
                'name' => "Utility Worker II",
                'title' => "Utility Worker II",
            ],
            [
                'name' => "Validator",
                'title' => "Validator",
            ],

        ];

        foreach ($categories as $category) {
            $lib = Library::create(['name' => $category['name'], 'library_type' => 'user_position', 'title' => $category['title'],]);
            echo $lib->library_type.": ".$lib->name." ".$lib->title."\n";
        }
    }
}
