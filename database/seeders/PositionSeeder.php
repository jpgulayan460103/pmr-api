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
            "Accountant III",
            "Administrative Aide I",
            "Administrative Aide III (Laundry Worker II)",
            "Administrative Aide IV",
            "Administrative Aide IV (Driver)",
            "Administrative Aide VI",
            "Administrative Assistant I",
            "Administrative Assistant II",
            "Administrative Assistant III",
            "Administrative Assistant III (Bookkeeper)",
            "Administrative Officer I",
            "Administrative Officer II",
            "Administrative Officer III",
            "Administrative Officer IV",
            "Administrative Officer V",
            "Area Coordinator",
            "Attorney III",
            "Attorney IV",
            "Budget Assistant",
            "Cash Clerk",
            "Chief Administrative Officer",
            "Community Development Assistant II",
            "Community Development Officer II",
            "Community Development Officer III",
            "Community Development Officer IV",
            "Community Development Officer V",
            "Community Empowerment Facilitator",
            "Community Facilitator",
            "Community Facilitator Aide",
            "Computer Maintenance Technologist I",
            "Computer Maintenance Technologist II",
            "Cook II",
            "Deputy Regional Project Manager (DRPM)",
            "Encoder",
            "Engineer II",
            "Engineer III",
            "Executive Assistant",
            "Financial Analyst I",
            "Financial Analyst II",
            "Financial Analyst III",
            "Houseparent I",
            "Houseparent II",
            "Houseparent III",
            "Information Officer II",
            "Information Systems Analyst III",
            "Information Technology Officer I",
            "Information Technology Officer II",
            "Legal Assistant II",
            "Management and Audit Analyst II",
            "Manpower Development Officer I",
            "Manpower Development Officer II",
            "Medical Officer IV",
            "Monitoring & Evaluation Officer II",
            "Monitoring & Evaluation Officer III",
            "Municipal Monitor",
            "Notifier",
            "Nurse I",
            "Nurse II",
            "Nutritionist Dietitian I",
            "Nutritionist Dietitian II",
            "Nutritionist Dietitian III",
            "Physical Therapist II",
            "Planning Officer I",
            "Planning Officer II",
            "Planning Officer III",
            "Planning Officer IV",
            "Procurement Officer",
            "Project Development Officer I",
            "Project Development Officer II",
            "Project Development Officer III",
            "Project Development Officer IV",
            "Project Development Officer V",
            "Project Evaluation Officer III",
            "Project Evaluation Officer IV",
            "Psychologist I",
            "Social Marketing Officer",
            "Social Welfare Aide",
            "Social Welfare Assistant",
            "Social Welfare Officer I",
            "Social Welfare Officer II",
            "Social Welfare Officer III",
            "Social Welfare Officer IV",
            "Social Welfare Officer V",
            "Statistician Aide",
            "Statistician II",
            "Supervising Administrative Officer",
            "Teacher (ECCD)",
            "Technical Facilitator",
            "Training Assistant",
            "Training Specialist I",
            "Training Specialist II",
            "Training Specialist III",
            "Training Specialist IV",
            "Utility Worker",
            "Utility Worker II",
            "Validator",
        ];

        foreach ($categories as $category) {
            $lib = Library::create(['name' => $category, 'library_type' => 'user_position']);
            echo $lib->library_type.": ".$lib->name."\n";
        }
    }
}
