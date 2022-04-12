<?php

namespace Database\Seeders;

use App\Models\Library;
use Illuminate\Database\Seeder;

class UacsCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $uacs_codes = [
            [
                "title" => "Cash - Collecting Officers",
                "name" => "10101010-00",
            ],
            [
                "title" => "Petty Cash",
                "name" => "10101020-00",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Bangko Sentral ng Pilipinas",
                "name" => "10102010-00",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Allied Bank",
                "name" => "10102020-01",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Amanah Bank",
                "name" => "10102020-02",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Asia United Bank Corporation",
                "name" => "10102020-03",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Australia and New Zealand Bank",
                "name" => "10102020-04",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Banco de Oro (BDO)",
                "name" => "10102020-05",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Bangkok Bank",
                "name" => "10102020-06",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Bangkok Bank Public Company Limited",
                "name" => "10102020-07",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Bank of China",
                "name" => "10102020-08",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Bank of Commerce",
                "name" => "10102020-09",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Bank of the Philippine Islands (BPI)",
                "name" => "10102020-10",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Bank of Tokyo",
                "name" => "10102020-11",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - China Banking Corporation",
                "name" => "10102020-12",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Chinatrust Commercial Bank",
                "name" => "10102020-13",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Citibank",
                "name" => "10102020-14",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Deutsche Bank AG",
                "name" => "10102020-15",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Development Bank of the Philippines (DBP)",
                "name" => "10102020-16",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - East-West Banking Corporation",
                "name" => "10102020-17",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Equitable PCI Bank",
                "name" => "10102020-18",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - First Consolidated Bank (FCB)",
                "name" => "10102020-19",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Fuji-Mizuho Bank",
                "name" => "10102020-20",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Hong Kong and Shanghai Banking Corp",
                "name" => "10102020-21",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - International Commercial Bank of China",
                "name" => "10102020-22",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - International Exchange Bank",
                "name" => "10102020-23",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Land Bank of the Philippines (LBP)",
                "name" => "10102020-24",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Maybank Philippines",
                "name" => "10102020-25",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Metropolitan and Trust Co",
                "name" => "10102020-26",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Philippine Bank of Communication",
                "name" => "10102020-27",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Philippine Business Bank",
                "name" => "10102020-28",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Philippine National Bank (PNB)",
                "name" => "10102020-29",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Philippine Postal Savings Bank (PPSB)",
                "name" => "10102020-30",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Philippine Trust Company",
                "name" => "10102020-31",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Philippine Veterans Bank (PVB)",
                "name" => "10102020-32",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Rizal Commercial Banking Corp (RCBC)",
                "name" => "10102020-33",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Robinsons Bank",
                "name" => "10102020-34",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Security Bank",
                "name" => "10102020-35",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Standard Chartered Bank",
                "name" => "10102020-36",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Sterling Bank of Asia",
                "name" => "10102020-37",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - Union Bank of the Philippines",
                "name" => "10102020-38",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Current Account - United Coconut Planters Bank (UCPB)",
                "name" => "10102020-39",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Savings Accounts - Land Bank of the Philippines (LBP)",
                "name" => "10102030-01",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Savings Accounts - Development Bank of the Philippines (DBP)",
                "name" => "10102030-02",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Savings Accounts - Philippine Veterans Bank (PVB)",
                "name" => "10102030-03",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Savings Accounts - Philippine National Bank (PNB)",
                "name" => "10102030-04",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Savings Accounts - Philippine Amanah Bank (PAB)",
                "name" => "10102030-05",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Savings Accounts - Philippine Post Savings Bank (PPSB)",
                "name" => "10102030-06",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Savings Accounts - United Coconut Planters Bank (UCPB)",
                "name" => "10102030-07",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Time Deposits - Land Bank of the Philippines (LBP)",
                "name" => "10102040-01",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Time Deposits - Development Bank of the Philippines (DBP)",
                "name" => "10102040-02",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Time Deposits - Philippine Veterans Bank (PVB)",
                "name" => "10102040-03",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Time Deposits - Philippine National Bank (PNB)",
                "name" => "10102040-04",
            ],
            [
                "title" => "Cash in Bank - Local Currency, Time Deposits - United Coconut Planters Bank (UCPB)",
                "name" => "10102040-05",
            ],
            [
                "title" => "Cash in Bank - Foreign Currency, Bangko Sentral ng Pilipinas",
                "name" => "10103010-00",
            ],
            [
                "title" => "Cash in Bank - Foreign Currency, Current Account",
                "name" => "10103020-00",
            ],
            [
                "title" => "Cash in Bank - Foreign Currency, Current Account - Foreign Banks",
                "name" => "10103020-01",
            ],
            [
                "title" => "Cash in Bank - Foreign Currency, Savings Account - Land Bank of the Philippines (LBP)",
                "name" => "10103030-01",
            ],
            [
                "title" => "Cash in Bank - Foreign Currency, Savings Account - Development Bank of the Philippines (DBP)",
                "name" => "10103030-02",
            ],
            [
                "title" => "Cash in Bank - Foreign Currency, Savings Account - Philippine National Bank (PNB)",
                "name" => "10103030-03",
            ],
            [
                "title" => "Cash in Bank - Foreign Currency, Savings Account - United Coconut Planters Bank (UCPB)",
                "name" => "10103030-04",
            ],
            [
                "title" => "Cash in Bank - Foreign Currency, Savings Account - Foreign Banks",
                "name" => "10103030-05",
            ],
            [
                "title" => "Cash in Bank - Foreign Currency, Time Deposits - Land Bank of the Philippines (LBP)",
                "name" => "10103040-01",
            ],
            [
                "title" => "Cash in Bank - Foreign Currency, Time Deposits - Development Bank of the Philippines (DBP)",
                "name" => "10103040-02",
            ],
            [
                "title" => "Cash in Bank - Foreign Currency, Time Deposits - Philippine National Bank (PNB)",
                "name" => "10103040-03",
            ],
            [
                "title" => "Cash in Bank - Foreign Currency, Time Deposits - United Coconut Planters Bank (UCPB)",
                "name" => "10103040-04",
            ],
            [
                "title" => "Cash - Treasury/Agency Deposit, Regular",
                "name" => "10104010-00",
            ],
            [
                "title" => "Cash - Treasury/Agency Deposit, Special Account",
                "name" => "10104020-00",
            ],
            [
                "title" => "Cash - Treasury/Agency Deposit, Trust",
                "name" => "10104030-00",
            ],
            [
                "title" => "Cash - Modified Disbursement System (MDS), Regular",
                "name" => "10104040-00",
            ],
            [
                "title" => "Cash - Modified Disbursement System (MDS), Special Account",
                "name" => "10104050-00",
            ],
            [
                "title" => "Cash - Modified Disbursement System (MDS), Trust",
                "name" => "10104060-00",
            ],
            [
                "title" => "Cash - Tax Remittance Advice",
                "name" => "10104070-00",
            ],
            [
                "title" => "Cash - Constructive Income Remittance",
                "name" => "10104080-00",
            ],
            [
                "title" => "Treasury Bills",
                "name" => "10105010-00",
            ],
            [
                "title" => "Financial Assets Held for Trading",
                "name" => "10201010-00",
            ],
            [
                "title" => "Financial Assets Designated at Fair Value Through Surplus or Deficit",
                "name" => "10201020-00",
            ],
            [
                "title" => "Derivative Financial Assets Held for Trading",
                "name" => "10201030-00",
            ],
            [
                "title" => "Derivative Financial Assets Designated at Fair Value Through Surplus or Deficit",
                "name" => "10201040-00",
            ],
            [
                "title" => "Investments in Treasury Bills - Local",
                "name" => "10202010-00",
            ],
            [
                "title" => "Allowance for Impairment - Investments in Treasury Bills - Local",
                "name" => "10202011-00",
            ],
            [
                "title" => "Investments in Treasury Bills - Foreign",
                "name" => "10202020-00",
            ],
            [
                "title" => "Allowance for Impairment - Investments in Treasury Bills - Foreign",
                "name" => "10202021-00",
            ],
            [
                "title" => "Investments in Treasury Bonds - Local",
                "name" => "10202030-00",
            ],
            [
                "title" => "Allowance for Impairment - Investments in Treasury Bonds - Local",
                "name" => "10202031-00",
            ],
            [
                "title" => "Investments in Treasury Bonds - Foreign",
                "name" => "10202040-00",
            ],
            [
                "title" => "Allowance for Impairment - Investments in Treasury Bonds - Foreign",
                "name" => "10202041-00",
            ],
            [
                "title" => "Investments in Stocks",
                "name" => "10203010-00",
            ],
            [
                "title" => "Investments in Bonds",
                "name" => "10203020-00",
            ],
            [
                "title" => "Other Investments",
                "name" => "10203990-00",
            ],
            [
                "title" => "Investments in GOCCs",
                "name" => "10204010-00",
            ],
            [
                "title" => "Allowance for Impairment - Investments in GOCCs",
                "name" => "10204011-00",
            ],
            [
                "title" => "Investments in Joint Venture",
                "name" => "10205010-00",
            ],
            [
                "title" => "Allowance for Impairment - Investments in Joint Venture",
                "name" => "10205011-00",
            ],
            [
                "title" => "Investments in Associates",
                "name" => "10206010-00",
            ],
            [
                "title" => "Allowance for Impairment - Investments in Associates",
                "name" => "10206011-00",
            ],
            [
                "title" => "Sinking Fund",
                "name" => "10207010-00",
            ],
            [
                "title" => "Accounts Receivable",
                "name" => "10301010-00",
            ],
            [
                "title" => "Allowance for Impairment - Accounts Receivable",
                "name" => "10301011-00",
            ],
            [
                "title" => "Notes Receivable",
                "name" => "10301020-00",
            ],
            [
                "title" => "Allowance for Impairment - Notes Receivable",
                "name" => "10301021-00",
            ],
            [
                "title" => "Loans Receivable - Government-Owned and/or Controlled Corporations",
                "name" => "10301030-00",
            ],
            [
                "title" => "Allowance for Impairment - Loans Receivable - Government-Owned and/or Controlled Corporations",
                "name" => "10301031-00",
            ],
            [
                "title" => "Loans Receivable - Local Government Units",
                "name" => "10301040-00",
            ],
            [
                "title" => "Allowance for Impairment - Loans Receivable - Local Government Units",
                "name" => "10301041-00",
            ],
            [
                "title" => "Interests Receivable",
                "name" => "10301050-00",
            ],
            [
                "title" => "Allowance for Impairment - Interests Receivable",
                "name" => "10301051-00",
            ],
            [
                "title" => "Dividends Receivable",
                "name" => "10301060-00",
            ],
            [
                "title" => "Loans Receivable - Others",
                "name" => "10301990-00",
            ],
            [
                "title" => "Allowance for Impairment - Loans Receivable - Others",
                "name" => "10301991-00",
            ],
            [
                "title" => "Operating Lease Receivable",
                "name" => "10302010-00",
            ],
            [
                "title" => "Allowance for Impairment - Operating Lease Receivable",
                "name" => "10302011-00",
            ],
            [
                "title" => "Finance Lease Receivable",
                "name" => "10302020-00",
            ],
            [
                "title" => "Allowance for Impairment - Finance Lease Receivable",
                "name" => "10302021-00",
            ],
            [
                "title" => "Due from National Government Agencies",
                "name" => "10303010-00",
            ],
            [
                "title" => "Due from Government-Owned and/or Controlled Corporations",
                "name" => "10303020-00",
            ],
            [
                "title" => "Due from Local Government Units",
                "name" => "10303030-00",
            ],
            [
                "title" => "Due from Joint Venture",
                "name" => "10303040-00",
            ],
            [
                "title" => "Due from Central Office",
                "name" => "10304010-00",
            ],
            [
                "title" => "Due from Bureaus",
                "name" => "10304020-00",
            ],
            [
                "title" => "Due from Regional Offices",
                "name" => "10304030-00",
            ],
            [
                "title" => "Due from Operating Units",
                "name" => "10304040-00",
            ],
            [
                "title" => "Receivables - Disallowances/Charges",
                "name" => "10305010-00",
            ],
            [
                "title" => "Due from Officers and Employees",
                "name" => "10305020-00",
            ],
            [
                "title" => "Due from Non-Government Organizations/People's Organizations",
                "name" => "10305030-00",
            ],
            [
                "title" => "Other Receivables",
                "name" => "10305990-00",
            ],
            [
                "title" => "Allowance for Impairment - Other Receivables",
                "name" => "10305991-00",
            ],
            [
                "title" => "Supplies and Materials",
                "name" => "10401010-01",
            ],
            [
                "title" => "Drugs and Medicines",
                "name" => "10401010-02",
            ],
            [
                "title" => "Agricultural Produce",
                "name" => "10401010-03",
            ],
            [
                "title" => "Ammunitions",
                "name" => "10401010-04",
            ],
            [
                "title" => "Property and Equipment",
                "name" => "10401010-05",
            ],
            [
                "title" => "Others",
                "name" => "10401010-99",
            ],
            [
                "title" => "Food Supplies for Distribution",
                "name" => "10402010-00",
            ],
            [
                "title" => "Welfare Goods for Distribution",
                "name" => "10402020-00",
            ],
            [
                "title" => "Drugs and Medicines for Distribution",
                "name" => "10402030-00",
            ],
            [
                "title" => "Medical, Dental and Laboratory Supplies for Distribution",
                "name" => "10402040-00",
            ],
            [
                "title" => "Agricultural and Marine Supplies for Distribution",
                "name" => "10402050-00",
            ],
            [
                "title" => "Agricultural Produce for Distribution",
                "name" => "10402060-00",
            ],
            [
                "title" => "Textbooks and Instructional Materials for Distribution",
                "name" => "10402070-00",
            ],
            [
                "title" => "Construction Materials for Distribution",
                "name" => "10402080-00",
            ],
            [
                "title" => "Property and Equipment for Distribution",
                "name" => "10402090-00",
            ],
            [
                "title" => "Other Supplies and Materials for Distribution",
                "name" => "10402990-00",
            ],
            [
                "title" => "Raw Materials Inventory",
                "name" => "10403010-00",
            ],
            [
                "title" => "Work-In-Process Inventory",
                "name" => "10403020-00",
            ],
            [
                "title" => "Finished Goods Inventory",
                "name" => "10403030-00",
            ],
            [
                "title" => "Office Supplies Inventory",
                "name" => "10404010-00",
            ],
            [
                "title" => "Accountable Forms, Plates and Stickers Inventory",
                "name" => "10404020-00",
            ],
            [
                "title" => "Non-Accountable Forms Inventory",
                "name" => "10404030-00",
            ],
            [
                "title" => "Animal/Zoological Supplies Inventory",
                "name" => "10404040-00",
            ],
            [
                "title" => "Food Supplies Inventory",
                "name" => "10404050-00",
            ],
            [
                "title" => "Drugs and Medicines Inventory",
                "name" => "10404060-00",
            ],
            [
                "title" => "Medical, Dental and Laboratory Supplies Inventory",
                "name" => "10404070-00",
            ],
            [
                "title" => "Fuel, Oil and Lubricants Inventory",
                "name" => "10404080-00",
            ],
            [
                "title" => "Agricultural and Marine Supplies Inventory",
                "name" => "10404090-00",
            ],
            [
                "title" => "Textbooks and Instructional Materials Inventory",
                "name" => "10404100-00",
            ],
            [
                "title" => "Military, Police and Traffic Supplies Inventory",
                "name" => "10404110-00",
            ],
            [
                "title" => "Chemical and Filtering Supplies Inventory",
                "name" => "10404120-00",
            ],
            [
                "title" => "Construction Materials Inventory",
                "name" => "10404130-00",
            ],
            [
                "title" => "Other Supplies and Materials Inventory",
                "name" => "10404990-00",
            ],
            [
                "title" => "Investment Property, Land",
                "name" => "10501010-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Investment Property, Land",
                "name" => "10501011-00",
            ],
            [
                "title" => "Investment Property, Buildings",
                "name" => "10501020-00",
            ],
            [
                "title" => "Accumulated Depreciation - Investment Property, Buildings",
                "name" => "10501021-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Investment Property, Buildings",
                "name" => "10501022-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Land",
                "name" => "10601011-00",
            ],
            [
                "title" => "Land Improvements - Aquaculture Structures",
                "name" => "10602010-00",
            ],
            [
                "title" => "Accumulated Depreciation - Land Improvements - Aquaculture Structures",
                "name" => "10602011-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Land Improvements - Aquaculture Structures",
                "name" => "10602012-00",
            ],
            [
                "title" => "Land Improvements, Reforestation Projects",
                "name" => "10602020-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Land Improvements, Reforestation Projects",
                "name" => "10602021-00",
            ],
            [
                "title" => "Other Land Improvements",
                "name" => "10602990-00",
            ],
            [
                "title" => "Accumulated Depreciation - Other Land Improvements",
                "name" => "10602991-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Other Land Improvements",
                "name" => "10602992-00",
            ],
            [
                "title" => "Road Networks",
                "name" => "10603010-00",
            ],
            [
                "title" => "Accumulated Depreciation - Road Networks",
                "name" => "10603011-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Road Networks",
                "name" => "10603012-00",
            ],
            [
                "title" => "Flood Control Systems",
                "name" => "10603020-00",
            ],
            [
                "title" => "Accumulated Depreciation - Flood Control Systems",
                "name" => "10603021-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Flood Control Systems",
                "name" => "10603022-00",
            ],
            [
                "title" => "Sewer Systems",
                "name" => "10603030-00",
            ],
            [
                "title" => "Accumulated Depreciation - Sewer Systems",
                "name" => "10603031-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Sewer Systems",
                "name" => "10603032-00",
            ],
            [
                "title" => "Water Supply Systems",
                "name" => "10603040-00",
            ],
            [
                "title" => "Accumulated Depreciation - Water Supply Systems",
                "name" => "10603041-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Water Supply Systems",
                "name" => "10603042-00",
            ],
            [
                "title" => "Power Supply Systems",
                "name" => "10603050-00",
            ],
            [
                "title" => "Accumulated Depreciation - Power Supply Systems",
                "name" => "10603051-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Power Supply Systems",
                "name" => "10603052-00",
            ],
            [
                "title" => "Communication Networks",
                "name" => "10603060-00",
            ],
            [
                "title" => "Accumulated Depreciation - Communication Networks",
                "name" => "10603061-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Communication Networks",
                "name" => "10603062-00",
            ],
            [
                "title" => "Seaport Systems",
                "name" => "10603070-00",
            ],
            [
                "title" => "Accumulated Depreciation - Seaport Systems",
                "name" => "10603071-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Seaport Systems",
                "name" => "10603072-00",
            ],
            [
                "title" => "Airport Systems",
                "name" => "10603080-00",
            ],
            [
                "title" => "Accumulated Depreciation - Airport Systems",
                "name" => "10603081-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Airport Systems",
                "name" => "10603082-00",
            ],
            [
                "title" => "Parks, Plazas and Monuments",
                "name" => "10603090-00",
            ],
            [
                "title" => "Accumulated Depreciation - Parks, Plazas and Monuments",
                "name" => "10603091-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Parks, Plazas and Monuments",
                "name" => "10603092-00",
            ],
            [
                "title" => "Other Infrastructure Assets",
                "name" => "10603990-00",
            ],
            [
                "title" => "Accumulated Depreciation - Other Infrastructure Assets",
                "name" => "10603991-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Other Infrastructure Assets",
                "name" => "10603992-00",
            ],
            [
                "title" => "Buildings",
                "name" => "10604010-00",
            ],
            [
                "title" => "Accumulated Depreciation - Buildings",
                "name" => "10604011-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Buildings",
                "name" => "10604012-00",
            ],
            [
                "title" => "School Buildings",
                "name" => "10604020-00",
            ],
            [
                "title" => "Accumulated Depreciation - School Buildings",
                "name" => "10604021-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - School Buildings",
                "name" => "10604022-00",
            ],
            [
                "title" => "Hospitals and Health Centers",
                "name" => "10604030-00",
            ],
            [
                "title" => "Accumulated Depreciation - Hospitals and Health Centers",
                "name" => "10604031-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Hospitals and Health Centers",
                "name" => "10604032-00",
            ],
            [
                "title" => "Markets",
                "name" => "10604040-00",
            ],
            [
                "title" => "Accumulated Depreciation - Markets",
                "name" => "10604041-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Markets",
                "name" => "10604042-00",
            ],
            [
                "title" => "Slaughterhouses",
                "name" => "10604050-00",
            ],
            [
                "title" => "Accumulated Depreciation - Slaughterhouses",
                "name" => "10604051-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Slaughterhouses",
                "name" => "10604052-00",
            ],
            [
                "title" => "Hostels and Dormitories",
                "name" => "10604060-00",
            ],
            [
                "title" => "Accumulated Depreciation - Hostels and Dormitories",
                "name" => "10604061-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Hostels and Dormitories",
                "name" => "10604062-00",
            ],
            [
                "title" => "Other Structures",
                "name" => "10604990-00",
            ],
            [
                "title" => "Accumulated Depreciation - Other Structures",
                "name" => "10604991-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Other Structures",
                "name" => "10604992-00",
            ],
            [
                "title" => "Machinery",
                "name" => "10605010-00",
            ],
            [
                "title" => "Accumulated Depreciation - Machinery",
                "name" => "10605011-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Machinery",
                "name" => "10605012-00",
            ],
            [
                "title" => "Office Equipment",
                "name" => "10605020-00",
            ],
            [
                "title" => "Accumulated Depreciation - Office Equipment",
                "name" => "10605021-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Office Equipment",
                "name" => "10605022-00",
            ],
            [
                "title" => "Information and Communication Technology Equipment",
                "name" => "10605030-00",
            ],
            [
                "title" => "Accumulated Depreciation - Information and Communication Technology Equipment",
                "name" => "10605031-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Information and Communication Technology Equipment",
                "name" => "10605032-00",
            ],
            [
                "title" => "Agricultural and Forestry Equipment",
                "name" => "10605040-00",
            ],
            [
                "title" => "Accumulated Depreciation - Agricultural and Forestry Equipment",
                "name" => "10605041-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Agricultural and Forestry Equipment",
                "name" => "10605042-00",
            ],
            [
                "title" => "Marine and Fishery Equipment",
                "name" => "10605050-00",
            ],
            [
                "title" => "Accumulated Depreciation - Marine and Fishery Equipment",
                "name" => "10605051-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Marine and Fishery Equipment",
                "name" => "10605052-00",
            ],
            [
                "title" => "Airport Equipment",
                "name" => "10605060-00",
            ],
            [
                "title" => "Accumulated Depreciation - Airport Equipment",
                "name" => "10605061-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Airport Equipment",
                "name" => "10605062-00",
            ],
            [
                "title" => "Communication Equipment",
                "name" => "10605070-00",
            ],
            [
                "title" => "Accumulated Depreciation - Communication Equipment",
                "name" => "10605071-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Communication Equipment",
                "name" => "10605072-00",
            ],
            [
                "title" => "Construction and Heavy Equipment",
                "name" => "10605080-00",
            ],
            [
                "title" => "Accumulated Depreciation - Construction and Heavy Equipment",
                "name" => "10605081-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Construction and Heavy Equipment",
                "name" => "10605082-00",
            ],
            [
                "title" => "Firefighting Equipment and Accessories",
                "name" => "10605090-01",
            ],
            [
                "title" => "Flood and Rescue Equipment",
                "name" => "10605090-02",
            ],
            [
                "title" => "Earthquake Rescue Equipment",
                "name" => "10605090-03",
            ],
            [
                "title" => "Volcanic Eruption Rescue Equipment",
                "name" => "10605090-04",
            ],
            [
                "title" => "Landslide Rescue Equipment",
                "name" => "10605090-05",
            ],
            [
                "title" => "Accumulated Depreciation - Disaster Response and Rescue Equipment",
                "name" => "10605091-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Disaster Response and Rescue Equipment",
                "name" => "10605092-00",
            ],
            [
                "title" => "Military, Police and Security Equipment",
                "name" => "10605100-00",
            ],
            [
                "title" => "Accumulated Depreciation - Military, Police and Security Equipment",
                "name" => "10605101-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Military, Police and Security Equipment",
                "name" => "10605102-00",
            ],
            [
                "title" => "Medical Equipment",
                "name" => "10605110-00",
            ],
            [
                "title" => "Accumulated Depreciation - Medical Equipment",
                "name" => "10605111-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Medical Equipment",
                "name" => "10605112-00",
            ],
            [
                "title" => "Printing Equipment",
                "name" => "10605120-00",
            ],
            [
                "title" => "Accumulated Depreciation - Printing Equipment",
                "name" => "10605121-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Printing Equipment",
                "name" => "10605122-00",
            ],
            [
                "title" => "Sports Equipment",
                "name" => "10605130-00",
            ],
            [
                "title" => "Accumulated Depreciation - Sports Equipment",
                "name" => "10605131-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Sports Equipment",
                "name" => "10605132-00",
            ],
            [
                "title" => "Technical and Scientific Equipment",
                "name" => "10605140-00",
            ],
            [
                "title" => "Accumulated Depreciation - Technical and Scientific Equipment",
                "name" => "10605141-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Technical and Scientific Equipment",
                "name" => "10605142-00",
            ],
            [
                "title" => "Other Machinery and Equipment",
                "name" => "10605990-00",
            ],
            [
                "title" => "Accumulated Depreciation - Other Machinery and Equipment",
                "name" => "10605991-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Other Machinery and Equipment",
                "name" => "10605992-00",
            ],
            [
                "title" => "Motor Vehicles",
                "name" => "10606010-00",
            ],
            [
                "title" => "Accumulated Depreciation - Motor Vehicles",
                "name" => "10606011-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Motor Vehicles",
                "name" => "10606012-00",
            ],
            [
                "title" => "Trains",
                "name" => "10606020-00",
            ],
            [
                "title" => "Accumulated Depreciation - Trains",
                "name" => "10606021-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Trains",
                "name" => "10606022-00",
            ],
            [
                "title" => "Aircrafts and Aircrafts Ground Equipment",
                "name" => "10606030-00",
            ],
            [
                "title" => "Accumulated Depreciation - Aircrafts and Aircrafts Ground Equipment",
                "name" => "10606031-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Aircrafts and Aircrafts Ground Equipment",
                "name" => "10606032-00",
            ],
            [
                "title" => "Watercrafts",
                "name" => "10606040-00",
            ],
            [
                "title" => "Accumulated Depreciation - Watercrafts",
                "name" => "10606041-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Watercrafts",
                "name" => "10606042-00",
            ],
            [
                "title" => "Other Transportation Equipment",
                "name" => "10606990-00",
            ],
            [
                "title" => "Accumulated Depreciation - Other Transportation Equipment",
                "name" => "10606991-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Other Transportation Equipment",
                "name" => "10606992-00",
            ],
            [
                "title" => "Furniture and Fixtures",
                "name" => "10607010-00",
            ],
            [
                "title" => "Accumulated Depreciation - Furniture and Fixtures",
                "name" => "10607011-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Furniture and Fixtures",
                "name" => "10607012-00",
            ],
            [
                "title" => "Books",
                "name" => "10607020-00",
            ],
            [
                "title" => "Accumulated Depreciation - Books",
                "name" => "10607021-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Books",
                "name" => "10607022-00",
            ],
            [
                "title" => "Leased Assets, Land",
                "name" => "10608010-00",
            ],
            [
                "title" => "Leased Assets, Buildings and Other Structures",
                "name" => "10608020-00",
            ],
            [
                "title" => "Accumulated Depreciation - Leased Assets, Buildings and Other Structures",
                "name" => "10608021-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Leased Assets, Buildings and Other Structures",
                "name" => "10608022-00",
            ],
            [
                "title" => "Leased Assets, Machinery and Equipment",
                "name" => "10608030-00",
            ],
            [
                "title" => "Accumulated Depreciation - Leased Assets, Machinery and Equipment",
                "name" => "10608031-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Leased Assets, Machinery and Equipment",
                "name" => "10608032-00",
            ],
            [
                "title" => "Leased Assets, Transportation Equipment",
                "name" => "10608040-00",
            ],
            [
                "title" => "Accumulated Depreciation - Leased Assets, Transportation Equipment",
                "name" => "10608041-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Leased Assets, Transportation Equipment",
                "name" => "10608042-00",
            ],
            [
                "title" => "Other Leased Assets",
                "name" => "10608990-00",
            ],
            [
                "title" => "Accumulated Depreciation - Other Leased Assets",
                "name" => "10608991-00",
            ],
            [
                "title" => "Accumulated Impairment Losses -Other Leased Assets",
                "name" => "10608992-00",
            ],
            [
                "title" => "Leased Assets Improvements, Land",
                "name" => "10609010-00",
            ],
            [
                "title" => "Accumulated Depreciation - Leased Assets Improvements, Land",
                "name" => "10609011-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Leased Assets Improvements, Land",
                "name" => "10609012-00",
            ],
            [
                "title" => "Leased Assets Improvements, Buildings",
                "name" => "10609020-00",
            ],
            [
                "title" => "Accumulated Depreciation - Leased Assets Improvements, Buildings",
                "name" => "10609021-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Leased Assets Improvements, Buildings",
                "name" => "10609022-00",
            ],
            [
                "title" => "Other Leased Assets Improvements",
                "name" => "10609990-00",
            ],
            [
                "title" => "Accumulated Depreciation - Other Leased Assets Improvements",
                "name" => "10609991-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Other Leased Assets Improvements",
                "name" => "10609992-00",
            ],
            [
                "title" => "Construction in Progress - Land Improvements",
                "name" => "10610010-00",
            ],
            [
                "title" => "Construction in Progress - Infrastructure Assets",
                "name" => "10610020-00",
            ],
            [
                "title" => "Construction in Progress - Buildings and Other Structures",
                "name" => "10610030-00",
            ],
            [
                "title" => "Construction in Progress - Leased Assets",
                "name" => "10610040-00",
            ],
            [
                "title" => "Construction in Progress - Leased Assets Improvements",
                "name" => "10610050-00",
            ],
            [
                "title" => "Historical Buildings",
                "name" => "10611010-00",
            ],
            [
                "title" => "Accumulated Depreciation - Historical Buildings",
                "name" => "10611011-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Historical Buildings",
                "name" => "10611012-00",
            ],
            [
                "title" => "Works of Arts and Archeological Specimens",
                "name" => "10611020-00",
            ],
            [
                "title" => "Accumulated Depreciation - Works of Arts and Archeological Specimens",
                "name" => "10611021-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Works of Arts and Archeological Specimens",
                "name" => "10611022-00",
            ],
            [
                "title" => "Other Heritage Assets",
                "name" => "10611990-00",
            ],
            [
                "title" => "Accumulated Depreciation - Other Heritage Assets",
                "name" => "10611991-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Other Heritage Assets",
                "name" => "10611992-00",
            ],
            [
                "title" => "Service Concession- Road Networks",
                "name" => "10612010-00",
            ],
            [
                "title" => "Accumulated Depreciation - Service Concession- Road Networks",
                "name" => "10612011-00",
            ],
            [
                "title" => "Accumulated Impairment Losses -Service Concession - Road Networks",
                "name" => "10612012-00",
            ],
            [
                "title" => "Service Concession - Flood Control Systems",
                "name" => "10612020-00",
            ],
            [
                "title" => "Accumulated Depreciation - Service Concession - Flood Control Systems",
                "name" => "10612021-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Service Concession - Flood Control Systems",
                "name" => "10612022-00",
            ],
            [
                "title" => "Service Concession - Sewer Systems",
                "name" => "10612030-00",
            ],
            [
                "title" => "Accumulated Depreciation - Service Concession - Sewer Systems",
                "name" => "10612031-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Service Concession - Sewer Systems",
                "name" => "10612032-00",
            ],
            [
                "title" => "Service Concession - Water Supply Systems",
                "name" => "10612040-00",
            ],
            [
                "title" => "Accumulated Depreciation - Service Concession - Water Supply Systems",
                "name" => "10612041-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Service Concession - Water Supply Systems",
                "name" => "10612042-00",
            ],
            [
                "title" => "Service Concession - Power Supply Systems",
                "name" => "10612050-00",
            ],
            [
                "title" => "Accumulated Depreciation - Service Concession - Power Supply Systems",
                "name" => "10612051-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Service Concession - Power Supply Systems",
                "name" => "10612052-00",
            ],
            [
                "title" => "Service Concession - Communication Networks",
                "name" => "10612060-00",
            ],
            [
                "title" => "Accumulated Depreciation - Service Concession - Communication Networks",
                "name" => "10612061-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Service Concession - Communication Networks",
                "name" => "10612062-00",
            ],
            [
                "title" => "Service Concession - Seaport Systems",
                "name" => "10612070-00",
            ],
            [
                "title" => "Accumulated Depreciation - Service Concession - Seaport Systems",
                "name" => "10612071-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Service Concession - Seaport Systems",
                "name" => "10612072-00",
            ],
            [
                "title" => "Service Concession - Airport Systems",
                "name" => "10612080-00",
            ],
            [
                "title" => "Accumulated Depreciation - Service Concession - Airport Systems",
                "name" => "10612081-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Service Concession - Airport Systems",
                "name" => "10612082-00",
            ],
            [
                "title" => "Service Concession - Parks, Plazas and Monuments",
                "name" => "10612090-00",
            ],
            [
                "title" => "Accumulated Depreciation - Service Concession - Parks, Plazas and Monuments",
                "name" => "10612091-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Service Concession - Parks, Plazas and Monuments",
                "name" => "10612092-00",
            ],
            [
                "title" => "Other Service Concession Assets",
                "name" => "10612990-00",
            ],
            [
                "title" => "Accumulated Depreciation - Other Service Concession Assets",
                "name" => "10612991-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Other Service Concession Assets",
                "name" => "10612992-00",
            ],
            [
                "title" => "Work/Zoo Animals",
                "name" => "10699010-00",
            ],
            [
                "title" => "Accumulated Depreciation - Work/Zoo Animals",
                "name" => "10699011-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Work/Zoo Animals",
                "name" => "10699012-00",
            ],
            [
                "title" => "Other Property, Plant and Equipment",
                "name" => "10699990-00",
            ],
            [
                "title" => "Accumulated Depreciation - Other Property, Plant and Equipment",
                "name" => "10699991-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Other Property, Plant and Equipment",
                "name" => "10699992-00",
            ],
            [
                "title" => "Breeding Stocks",
                "name" => "10701010-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Breeding Stocks",
                "name" => "10701011-00",
            ],
            [
                "title" => "Livestock",
                "name" => "10701020-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Livestock",
                "name" => "10701021-00",
            ],
            [
                "title" => "Trees, Plants and Crops",
                "name" => "10701030-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Trees, Plants and Crops",
                "name" => "10701031-00",
            ],
            [
                "title" => "Aquaculture",
                "name" => "10701040-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Aquaculture",
                "name" => "10701041-00",
            ],
            [
                "title" => "Other Bearer Biological Assets",
                "name" => "10701990-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Other Bearer Biological Assets",
                "name" => "10701991-00",
            ],
            [
                "title" => "Livestock Held for Consumption/Sale/Distribution",
                "name" => "10702010-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Livestock Held for Consumption/Sale/Distribution",
                "name" => "10702011-00",
            ],
            [
                "title" => "Trees, Plants and Crops Held for Consumption/Sale/Distribution",
                "name" => "10702020-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Trees, Plants and Crops Held for Consumption/Sale/ Distribution",
                "name" => "10702021-00",
            ],
            [
                "title" => "Agricultural Produce Held for for Consumption/Sale/Distribution",
                "name" => "10702030-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Agricultural Produce Held for Consumption/Sale/Distribution",
                "name" => "10702031-00",
            ],
            [
                "title" => "Aquaculture",
                "name" => "10702040-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Aquaculture",
                "name" => "10702041-00",
            ],
            [
                "title" => "Other Consumable Biological Assets",
                "name" => "10702990-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Other Consumable Biological Assets",
                "name" => "10702991-00",
            ],
            [
                "title" => "Patents/Copyrights",
                "name" => "10801010-00",
            ],
            [
                "title" => "Accumulated Amortization - Patents/Copyrights",
                "name" => "10801011-00",
            ],
            [
                "title" => "Computer Software",
                "name" => "10801020-00",
            ],
            [
                "title" => "Accumulated Amortization - Computer Software",
                "name" => "10801021-00",
            ],
            [
                "title" => "Other Intangible Assets",
                "name" => "10801990-00",
            ],
            [
                "title" => "Accumulated Amortization - Other Intangible Assets",
                "name" => "10801991-00",
            ],
            [
                "title" => "Advances for Operation Expenses",
                "name" => "19901010-00",
            ],
            [
                "title" => "Advances for Payroll",
                "name" => "19901020-00",
            ],
            [
                "title" => "Advances for Special Disbursing Officer",
                "name" => "19901030-00",
            ],
            [
                "title" => "Advances to Officers and Employees",
                "name" => "19901040-00",
            ],
            [
                "title" => "Advances to Contractors",
                "name" => "19902010-00",
            ],
            [
                "title" => "Prepaid Rent",
                "name" => "19902020-00",
            ],
            [
                "title" => "Prepaid Registration",
                "name" => "19902030-00",
            ],
            [
                "title" => "Prepaid Interest",
                "name" => "19902040-00",
            ],
            [
                "title" => "Prepaid Insurance",
                "name" => "19902050-00",
            ],
            [
                "title" => "Other Prepayments",
                "name" => "19902990-00",
            ],
            [
                "title" => "Deposits on Letter of Credit",
                "name" => "19903010-00",
            ],
            [
                "title" => "Guaranty Deposits",
                "name" => "19903020-00",
            ],
            [
                "title" => "Other Deposits",
                "name" => "19903990-00",
            ],
            [
                "title" => "Acquired Assets",
                "name" => "19999010-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Acquired Assets",
                "name" => "19999011-00",
            ],
            [
                "title" => "Foreclosed Property/Assets",
                "name" => "19999020-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Foreclosed Property/Assets",
                "name" => "19999021-00",
            ],
            [
                "title" => "Forfeited Property/Assets",
                "name" => "19999030-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Forfeited Property/Assets",
                "name" => "19999031-00",
            ],
            [
                "title" => "Confiscated Property/Assets",
                "name" => "19999040-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Confiscated Property/Assets",
                "name" => "19999041-00",
            ],
            [
                "title" => "Abandoned Property/Assets",
                "name" => "19999050-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Abandoned Property/Assets",
                "name" => "19999051-00",
            ],
            [
                "title" => "Other Assets",
                "name" => "19999990-00",
            ],
            [
                "title" => "Accumulated Impairment Losses - Other Assets",
                "name" => "19999991-00",
            ],
            [
                "title" => "Accounts Payable",
                "name" => "20101010-00",
            ],
            [
                "title" => "Due to Officers and Employees",
                "name" => "20101020-00",
            ],
            [
                "title" => "Internal Revenue Allotment Payable",
                "name" => "20101030-00",
            ],
            [
                "title" => "Notes Payable",
                "name" => "20101040-00",
            ],
            [
                "title" => "Interest Payable",
                "name" => "20101050-00",
            ],
            [
                "title" => "Operating Lease Payable",
                "name" => "20101060-00",
            ],
            [
                "title" => "Finance Lease Payable",
                "name" => "20101070-00",
            ],
            [
                "title" => "Awards and Rewards Payable",
                "name" => "20101080-00",
            ],
            [
                "title" => "Service Concession Arrangements Payable",
                "name" => "20101090-00",
            ],
            [
                "title" => "Treasury Bills Payable",
                "name" => "20102010-00",
            ],
            [
                "title" => "Bonds Payable - Domestic",
                "name" => "20102020-00",
            ],
            [
                "title" => "Discount on Bonds Payable - Domestic",
                "name" => "20102021-00",
            ],
            [
                "title" => "Premium on Bonds Payable - Domestic",
                "name" => "20102022-00",
            ],
            [
                "title" => "Bonds Payable - Foreign",
                "name" => "20102030-00",
            ],
            [
                "title" => "Discount on Bonds Payable - Foreign",
                "name" => "20102031-00",
            ],
            [
                "title" => "Premium on Bonds Payable - Foreign",
                "name" => "20102032-00",
            ],
            [
                "title" => "Loans Payable - Domestic",
                "name" => "20102040-00",
            ],
            [
                "title" => "Loans Payable - Foreign",
                "name" => "20102050-00",
            ],
            [
                "title" => "Due to BIR",
                "name" => "20201010-00",
            ],
            [
                "title" => "Life and Retirement Premium",
                "name" => "20201020-01",
            ],
            [
                "title" => "ECC",
                "name" => "20201020-02",
            ],
            [
                "title" => "Salary Loan",
                "name" => "20201020-03",
            ],
            [
                "title" => "Policy Loan",
                "name" => "20201020-04",
            ],
            [
                "title" => "Pag-IBIG Premium",
                "name" => "20201030-01",
            ],
            [
                "title" => "Pag-IBIG Multi-Purpose Loan",
                "name" => "20201030-02",
            ],
            [
                "title" => "Pag-IBIG Housing Loan",
                "name" => "20201030-03",
            ],
            [
                "title" => "Due to PhilHealth",
                "name" => "20201040-00",
            ],
            [
                "title" => "Due to NGAs",
                "name" => "20201050-00",
            ],
            [
                "title" => "Due to GOCCs",
                "name" => "20201060-00",
            ],
            [
                "title" => "Due to LGUs",
                "name" => "20201070-00",
            ],
            [
                "title" => "Due to Joint Venture",
                "name" => "20201080-00",
            ],
            [
                "title" => "Due to Central Office",
                "name" => "20301010-00",
            ],
            [
                "title" => "Due to Bureaus",
                "name" => "20301020-00",
            ],
            [
                "title" => "Due to Regional Offices",
                "name" => "20301030-00",
            ],
            [
                "title" => "Due to Operating Units",
                "name" => "20301040-00",
            ],
            [
                "title" => "Due to Other Funds",
                "name" => "20301050-00",
            ],
            [
                "title" => "Trust Liabilities",
                "name" => "20401010-00",
            ],
            [
                "title" => "Trust Liabilities - Disaster Risk Reduction and Management Fund",
                "name" => "20401020-00",
            ],
            [
                "title" => "Bail Bonds Payable",
                "name" => "20401030-00",
            ],
            [
                "title" => "Guaranty/Security Deposits Payable",
                "name" => "20401040-00",
            ],
            [
                "title" => "Customers' Deposits Payable",
                "name" => "20401050-00",
            ],
            [
                "title" => "Deferred Finance Lease Revenue",
                "name" => "20501010-00",
            ],
            [
                "title" => "Deferred Service Concession Revenue",
                "name" => "20501020-00",
            ],
            [
                "title" => "Other Deferred Credits",
                "name" => "20501990-00",
            ],
            [
                "title" => "Unearned Revenue - Investment Property",
                "name" => "20502010-00",
            ],
            [
                "title" => "Other Unearned Revenue",
                "name" => "20502990-00",
            ],
            [
                "title" => "Pension Benefits Payable",
                "name" => "20601010-00",
            ],
            [
                "title" => "Leave Benefits Payable",
                "name" => "20601020-00",
            ],
            [
                "title" => "Retirement Gratuity Payable",
                "name" => "20601030-00",
            ],
            [
                "title" => "Other Provisions",
                "name" => "20601990-00",
            ],
            [
                "title" => "Other Payables",
                "name" => "29999990-00",
            ],
            [
                "title" => "Government Equity",
                "name" => "30101010-00",
            ],
            [
                "title" => "Contributed Capital",
                "name" => "30101030-00",
            ],
            [
                "title" => "Revaluation Surplus",
                "name" => "30201010-00",
            ],
            [
                "title" => "Income and Expense Summary",
                "name" => "30301010-00",
            ],
            [
                "title" => "Equity in Joint Venture",
                "name" => "30401010-00",
            ],
            [
                "title" => "Income Tax - Individuals",
                "name" => "40101010-01",
            ],
            [
                "title" => "Income Tax - Partnership",
                "name" => "40101010-02",
            ],
            [
                "title" => "Income Tax - Corporations",
                "name" => "40101010-03",
            ],
            [
                "title" => "Professional Tax",
                "name" => "40101020-00",
            ],
            [
                "title" => "Travel Tax",
                "name" => "40101030-00",
            ],
            [
                "title" => "Immigration Tax",
                "name" => "40101040-00",
            ],
            [
                "title" => "Estate Tax",
                "name" => "40102010-00",
            ],
            [
                "title" => "Donors Tax",
                "name" => "40102020-00",
            ],
            [
                "title" => "Capital Gains Tax - Individuals",
                "name" => "40102030-01",
            ],
            [
                "title" => "Capital Gains Tax - Corporations and Other Enterprises",
                "name" => "40102030-02",
            ],
            [
                "title" => "Live Animals, Animals Products",
                "name" => "40103010-01",
            ],
            [
                "title" => "Vegetable Products",
                "name" => "40103010-02",
            ],
            [
                "title" => "Animal or Vegetable Fats and Oils and their Cleavage Products; Prepared Edible Fats; Animal or Vegetable Waxes",
                "name" => "40103010-03",
            ],
            [
                "title" => "Prepared Foodstuffs; Beverages, Spirits and Vinegar; Tobacco and Manufactured Tobacco Substitutes",
                "name" => "40103010-04",
            ],
            [
                "title" => "Mineral Products",
                "name" => "40103010-05",
            ],
            [
                "title" => "Products of the Chemical or Allied Industries",
                "name" => "40103010-06",
            ],
            [
                "title" => "Plastics and Articles Thereof; Rubber and Articles Thereof",
                "name" => "40103010-07",
            ],
            [
                "title" => "Raw Hides and Skins, Leather, Furskins and Articles Thereof; Saddlery and Harness; Travel Goods, Handbags and Similar Containers; Articles of Animal Gut (Other than Silk-Worm Gut)",
                "name" => "40103010-08",
            ],
            [
                "title" => "Wood and Articles of Wood; Wood Charcoal; Cork and Articles of Cork; Manufactures of Straw, or of Esparto or of other Plaiting Materials; Basketware and Wickerwork",
                "name" => "40103010-09",
            ],
            [
                "title" => "Pulp of Wood or of other Fibrous Cellulosic Material; Recovered (Waste and Scrap) Paper or Paperboard; Paper and Paperboard and Articles Thereof",
                "name" => "40103010-10",
            ],
            [
                "title" => "Textiles and Textile Articles",
                "name" => "40103010-11",
            ],
            [
                "title" => "Footwear, Headgear, Umbrellas, Sun Umbrellas, Walking-Sticks, Seat-Sticks, Whips, Riding-Crops and Parts Thereof; Prepared Feathers and Articles made Therewith, Artificial Flowers; Articles of Huamn Hair",
                "name" => "40103010-12",
            ],
            [
                "title" => "Articles of Stone, Plaster, Cement, Asbestos, Mica or Similar Materials; Ceramic Products; Glass and Glassware",
                "name" => "40103010-13",
            ],
            [
                "title" => "Natural or Cultured Pearls, Precious or Semi-Precious Stones, Precious Metals, Metals Clad with Precious Metal, and Articles Thereof; Imitation Jewellery; Coin",
                "name" => "40103010-14",
            ],
            [
                "title" => "Base Metals and Articles of Base Metal",
                "name" => "40103010-15",
            ],
            [
                "title" => "Machinery and Mechanical Appliances; Electrical Equipment; Parts Thereof; Sound Recorders and Reproducers, Television Image and Sound Recorders and Reproducers, and Parts and Accesories of Such Articles",
                "name" => "40103010-16",
            ],
            [
                "title" => "Vehicles, Aircraft, Vessels And Associated Transport Equipment",
                "name" => "40103010-17",
            ],
            [
                "title" => "Optical, Photographic, Cinematographic, Measuring, Checking, Precision, Medical or Surgical Instruments and Apparatus; Clocks and Watches; Musical Instruments; Parts and Accessories Thereof",
                "name" => "40103010-18",
            ],
            [
                "title" => "Arms and Ammunition; Parts and Accessories Thereof",
                "name" => "40103010-19",
            ],
            [
                "title" => "Miscellaneous Manufactured Articles",
                "name" => "40103010-20",
            ],
            [
                "title" => "Works of Arts, Collectors' Pieces And Antiques",
                "name" => "40103010-21",
            ],
            [
                "title" => "Other Import Duties",
                "name" => "40103010-99",
            ],
            [
                "title" => "Excise - Tobacco Products",
                "name" => "40103020-01",
            ],
            [
                "title" => "Excise - Alcoholic Beverages",
                "name" => "40103020-02",
            ],
            [
                "title" => "Excise - Mining - Non-Metallic Products",
                "name" => "40103020-03",
            ],
            [
                "title" => "Excise - Mining - Metallic Products",
                "name" => "40103020-04",
            ],
            [
                "title" => "Excise - Petroleum Products",
                "name" => "40103020-05",
            ],
            [
                "title" => "Excise - Motor Vehicles",
                "name" => "40103020-06",
            ],
            [
                "title" => "Excise - Mineral Products",
                "name" => "40103020-07",
            ],
            [
                "title" => "Excise - Others",
                "name" => "40103020-99",
            ],
            [
                "title" => "Value Added Tax",
                "name" => "40103030-01",
            ],
            [
                "title" => "Expanded Value Added Tax",
                "name" => "40103030-02",
            ],
            [
                "title" => "Percentage Tax",
                "name" => "40103030-03",
            ],
            [
                "title" => "Tax on Sand, Gravel and Other Quarry products",
                "name" => "40103040-00",
            ],
            [
                "title" => "Tax on Delivery Vans and Trucks",
                "name" => "40103050-00",
            ],
            [
                "title" => "Tax on Forest Products",
                "name" => "40103060-00",
            ],
            [
                "title" => "Documentary Stamp Tax",
                "name" => "40104010-00",
            ],
            [
                "title" => "Motor Vehicles Users' Charge (MVUC) - Proper",
                "name" => "40104020-01",
            ],
            [
                "title" => "Motor Vehicles Users' Charge (MVUC) - Fines and Penalties",
                "name" => "40104020-02",
            ],
            [
                "title" => "Axle Overloading",
                "name" => "40104020-03",
            ],
            [
                "title" => "Other Taxes",
                "name" => "40104990-00",
            ],
            [
                "title" => "Other Taxes - Business",
                "name" => "40104990-01",
            ],
            [
                "title" => "Other Taxes - Other than Business",
                "name" => "40104990-02",
            ],
            [
                "title" => "Tax Revenue - Fines and Penalties - Taxes on Individual and Corporation",
                "name" => "40105010-00",
            ],
            [
                "title" => "Tax Revenue - Fines and Penalties - Property Taxes",
                "name" => "40105020-00",
            ],
            [
                "title" => "Tax Revenue - Fines and Penalties - Taxes on Goods and Services",
                "name" => "40105030-00",
            ],
            [
                "title" => "Tax Revenue - Fines and Penalties - Other Taxes",
                "name" => "40105040-00",
            ],
            [
                "title" => "Permit Fees Import",
                "name" => "40201010-01",
            ],
            [
                "title" => "Permit Fees Export",
                "name" => "40201010-02",
            ],
            [
                "title" => "Other Permit Fees",
                "name" => "40201010-99",
            ],
            [
                "title" => "Registration Fees",
                "name" => "40201020-00",
            ],
            [
                "title" => "Regular Plates",
                "name" => "40201030-01",
            ],
            [
                "title" => "Optional Motor Vehicle Special Plate",
                "name" => "40201030-02",
            ],
            [
                "title" => "Vanity Licensed Plates",
                "name" => "40201030-03",
            ],
            [
                "title" => "Validating Tags/Stickers",
                "name" => "40201030-04",
            ],
            [
                "title" => "Clearance Fees",
                "name" => "40201040-01",
            ],
            [
                "title" => "Certification Fees",
                "name" => "40201040-02",
            ],
            [
                "title" => "Endorsement Fees",
                "name" => "40201040-03",
            ],
            [
                "title" => "Identification of Specimens",
                "name" => "40201040-04",
            ],
            [
                "title" => "Franchising Fees",
                "name" => "40201050-00",
            ],
            [
                "title" => "Licensing Fees",
                "name" => "40201060-00",
            ],
            [
                "title" => "Supervision and Regulation Enforcement Fees",
                "name" => "40201070-00",
            ],
            [
                "title" => "Spectrum Usage Fees",
                "name" => "40201080-00",
            ],
            [
                "title" => "Legal Fees",
                "name" => "40201090-00",
            ],
            [
                "title" => "Inspection Fees",
                "name" => "40201100-00",
            ],
            [
                "title" => "Accreditation Fees",
                "name" => "40201110-01",
            ],
            [
                "title" => "Weights and Measures Fees",
                "name" => "40201110-02",
            ],
            [
                "title" => "Other Verification and Authentication Fees",
                "name" => "40201110-99",
            ],
            [
                "title" => "Passport Fees",
                "name" => "40201120-01",
            ],
            [
                "title" => "Visa Fees",
                "name" => "40201120-02",
            ],
            [
                "title" => "Analysis Fees",
                "name" => "40201130-01",
            ],
            [
                "title" => "Appeal Fees",
                "name" => "40201130-02",
            ],
            [
                "title" => "Application Fees",
                "name" => "40201130-03",
            ],
            [
                "title" => "Assessment Fees",
                "name" => "40201130-04",
            ],
            [
                "title" => "Execution Fees",
                "name" => "40201130-05",
            ],
            [
                "title" => "Express Lane or Special Lane Fees",
                "name" => "40201130-06",
            ],
            [
                "title" => "Filing Fees",
                "name" => "40201130-07",
            ],
            [
                "title" => "Identity Card Fees",
                "name" => "40201130-08",
            ],
            [
                "title" => "Import Processing Fees",
                "name" => "40201130-09",
            ],
            [
                "title" => "Oathtaking Fees",
                "name" => "40201130-10",
            ],
            [
                "title" => "Review Fees",
                "name" => "40201130-11",
            ],
            [
                "title" => "Testing Fees",
                "name" => "40201130-12",
            ],
            [
                "title" => "Other Processing Fees",
                "name" => "40201130-99",
            ],
            [
                "title" => "Fines and Penalties - Service Income",
                "name" => "40201140-00",
            ],
            [
                "title" => "Amendment Fees",
                "name" => "40201990-01",
            ],
            [
                "title" => "Calibration Fees",
                "name" => "40201990-02",
            ],
            [
                "title" => "Escheat Fees of Unclaimed Balances",
                "name" => "40201990-03",
            ],
            [
                "title" => "Service Fees on Relent Loan",
                "name" => "40201990-04",
            ],
            [
                "title" => "Technology Development Transfer and Commercialization",
                "name" => "40201990-05",
            ],
            [
                "title" => "Other Geological and Energy Data",
                "name" => "40201990-06",
            ],
            [
                "title" => "Other Service Income",
                "name" => "40201990-99",
            ],
            [
                "title" => "Tuition Fees",
                "name" => "40202010-01",
            ],
            [
                "title" => "Income Collected from Students",
                "name" => "40202010-02",
            ],
            [
                "title" => "Income from Other Sources",
                "name" => "40202010-03",
            ],
            [
                "title" => "Other School Fees",
                "name" => "40202010-99",
            ],
            [
                "title" => "Affiliation Fees",
                "name" => "40202020-00",
            ],
            [
                "title" => "Examination Fees",
                "name" => "40202030-00",
            ],
            [
                "title" => "Seminar/Training Fees",
                "name" => "40202040-00",
            ],
            [
                "title" => "Rent/Lease Income",
                "name" => "40202050-00",
            ],
            [
                "title" => "Communication Network Fees",
                "name" => "40202060-00",
            ],
            [
                "title" => "Transportation System Fees",
                "name" => "40202070-00",
            ],
            [
                "title" => "Road Network Fees",
                "name" => "40202080-00",
            ],
            [
                "title" => "Waterworks System Fees",
                "name" => "40202090-00",
            ],
            [
                "title" => "Power Supply System Fees",
                "name" => "40202100-00",
            ],
            [
                "title" => "Seaport System Fees",
                "name" => "40202110-00",
            ],
            [
                "title" => "Landing and Parking Fees",
                "name" => "40202120-00",
            ],
            [
                "title" => "Income from Hostels/Dormitories and other Like facilities",
                "name" => "40202130-00",
            ],
            [
                "title" => "Slaughterhouse Operation",
                "name" => "40202140-00",
            ],
            [
                "title" => "Income from Printing and Publication",
                "name" => "40202150-00",
            ],
            [
                "title" => "Book Sales",
                "name" => "40202160-01",
            ],
            [
                "title" => "Consultancy Fees",
                "name" => "40202160-02",
            ],
            [
                "title" => "Entrance Fees",
                "name" => "40202160-03",
            ],
            [
                "title" => "Film Showing Fees",
                "name" => "40202160-04",
            ],
            [
                "title" => "Sales of Accountable Forms",
                "name" => "40202160-05",
            ],
            [
                "title" => "Sale of Animals, Meat and Dairy",
                "name" => "40202160-06",
            ],
            [
                "title" => "Sale of Technology thru Payback",
                "name" => "40202160-07",
            ],
            [
                "title" => "Sale of Training Manuals",
                "name" => "40202160-08",
            ],
            [
                "title" => "Other Sales",
                "name" => "40202160-99",
            ],
            [
                "title" => "Sales Discounts",
                "name" => "40202161-00",
            ],
            [
                "title" => "Drugs and Medicines",
                "name" => "40202170-01",
            ],
            [
                "title" => "Medical Supplies",
                "name" => "40202170-02",
            ],
            [
                "title" => "Medical Fees - Operating Room",
                "name" => "40202170-03",
            ],
            [
                "title" => "Medical Fees - Radiology",
                "name" => "40202170-04",
            ],
            [
                "title" => "Medical Fees - Laboratory",
                "name" => "40202170-05",
            ],
            [
                "title" => "Medical Fees - Hemodialysis",
                "name" => "40202170-06",
            ],
            [
                "title" => "Medical Fees - Cardio-Vascular Services",
                "name" => "40202170-07",
            ],
            [
                "title" => "Medical Fees - Nuclear Medicine Services",
                "name" => "40202170-08",
            ],
            [
                "title" => "Medical Fees - Physical Medicine & Rehabilitation Services",
                "name" => "40202170-09",
            ],
            [
                "title" => "Medical Fees - Pulmonary Services",
                "name" => "40202170-10",
            ],
            [
                "title" => "Medical Fees - Neurology Services",
                "name" => "40202170-11",
            ],
            [
                "title" => "Other Fees",
                "name" => "40202170-99",
            ],
            [
                "title" => "Guarantee Income",
                "name" => "40202180-00",
            ],
            [
                "title" => "Fidelity Insurance Premiums",
                "name" => "40202190-00",
            ],
            [
                "title" => "Dividend Income",
                "name" => "40202200-00",
            ],
            [
                "title" => "Interest on NG Deposits",
                "name" => "40202210-01",
            ],
            [
                "title" => "Interest on Advances to GOCCs",
                "name" => "40202210-02",
            ],
            [
                "title" => "Others",
                "name" => "40202210-99",
            ],
            [
                "title" => "Share in the profit of Joint Venture",
                "name" => "40202220-00",
            ],
            [
                "title" => "Fines and Penalties - Business Income",
                "name" => "40202230-00",
            ],
            [
                "title" => "Service Concession Revenue",
                "name" => "40202240-00",
            ],
            [
                "title" => "Income from Compromise Agreement",
                "name" => "40202990-01",
            ],
            [
                "title" => "Pasture Income",
                "name" => "40202990-02",
            ],
            [
                "title" => "Warehousing Fees",
                "name" => "40202990-03",
            ],
            [
                "title" => "Other Business Income",
                "name" => "40202990-99",
            ],
            [
                "title" => "Subsidy from National Government",
                "name" => "40301010-00",
            ],
            [
                "title" => "Subsidy from other National Government Agencies",
                "name" => "40301020-00",
            ],
            [
                "title" => "Assistance from Local Government Units",
                "name" => "40301030-00",
            ],
            [
                "title" => "Assistance from Government-Owned and/or Controlled Corporations",
                "name" => "40301040-00",
            ],
            [
                "title" => "Subsidy from Other Funds",
                "name" => "40301050-00",
            ],
            [
                "title" => "Share from National Wealth",
                "name" => "40401010-00",
            ],
            [
                "title" => "Tobacco Excise Tax (Virginia) per R.A. 7171",
                "name" => "40401010-01",
            ],
            [
                "title" => "Tobacco Excise Tax (Burley and Native) per R.A. 8240",
                "name" => "40401010-02",
            ],
            [
                "title" => "Mining Taxes per R.A. 7160",
                "name" => "40401010-03",
            ],
            [
                "title" => "Royalties per R.A.7160",
                "name" => "40401010-04",
            ],
            [
                "title" => "Forestry Charges per R.A.7160",
                "name" => "40401010-05",
            ],
            [
                "title" => "Fishery Charges per R.A.7160",
                "name" => "40401010-06",
            ],
            [
                "title" => "Renewable Energy charges per R.A.9513",
                "name" => "40401010-07",
            ],
            [
                "title" => "Income Tax Collections in ECO ZONES per R.A. 7922 and R.A. 8748",
                "name" => "40401010-08",
            ],
            [
                "title" => "Value Added Tax per R.A. 7643",
                "name" => "40401010-09",
            ],
            [
                "title" => "Value Added Tax in lieu of Franchise Tax per R.A. 7953 and R.A. 8407",
                "name" => "40401010-10",
            ],
            [
                "title" => "Share from PAGCOR/PCSO",
                "name" => "40401020-00",
            ],
            [
                "title" => "Share from Earnings of GOCCs",
                "name" => "40401030-00",
            ],
            [
                "title" => "Income from Grants and Donations in Cash",
                "name" => "40402010-00",
            ],
            [
                "title" => "Income from Grants and Donations in Kind",
                "name" => "40402020-00",
            ],
            [
                "title" => "Gain in Foreign Exchange (FOREX)",
                "name" => "40501010-00",
            ],
            [
                "title" => "Gain on Sale of Investments",
                "name" => "40501020-00",
            ],
            [
                "title" => "Gain on Sale of Investment Property",
                "name" => "40501030-00",
            ],
            [
                "title" => "Gain on Sale of Property, Plant and Equipment",
                "name" => "40501040-00",
            ],
            [
                "title" => "Gain on Initial Recognition of Biological Assets",
                "name" => "40501050-00",
            ],
            [
                "title" => "Gain on Sale of Biological Assets",
                "name" => "40501060-00",
            ],
            [
                "title" => "Gain from Changes in Fair Value Less Cost to Sell of Biological Assets Due to Physical Change",
                "name" => "40501070-00",
            ],
            [
                "title" => "Gain from Changes in Fair Value Less Cost to Sell of Biological Assets Due to Price Change",
                "name" => "40501080-00",
            ],
            [
                "title" => "Gain on Sale of Agricultural Produce",
                "name" => "40501090-00",
            ],
            [
                "title" => "Gain on Sale of Intagible Assets",
                "name" => "40501100-00",
            ],
            [
                "title" => "Other Gains",
                "name" => "40501990-00",
            ],
            [
                "title" => "Sale of Garnished/Confiscated/Abandoned/Seized Goods and Properties",
                "name" => "40601010-00",
            ],
            [
                "title" => "Sale of Unserviceable Property",
                "name" => "40601020-00",
            ],
            [
                "title" => "Reversal of Impairment Loss",
                "name" => "40602010-00",
            ],
            [
                "title" => "Proceeds from Insurance/Indemnities",
                "name" => "40609010-00",
            ],
            [
                "title" => "Miscellaneous Income",
                "name" => "40609990-00",
            ],
            [
                "title" => "Basic Salary - Civilian",
                "name" => "50101010-01",
            ],
            [
                "title" => "Base Pay - Military/Uniformed Personnel (MUP)",
                "name" => "50101010-02",
            ],
            [
                "title" => "Salaries and Wages - Casual/Contractual",
                "name" => "50101020-00",
            ],
            [
                "title" => "Salaries and Wages - Substitute Teachers",
                "name" => "50101030-00",
            ],
            [
                "title" => "PERA - Civilian",
                "name" => "50102010-01",
            ],
            [
                "title" => "PERA - Military/Uniformed Personnel (MUP)",
                "name" => "50102010-02",
            ],
            [
                "title" => "Representation Allowance (RA)",
                "name" => "50102020-00",
            ],
            [
                "title" => "Transportation Allowance (TA)",
                "name" => "50102030-01",
            ],
            [
                "title" => "RATA of Sectoral/Alternate Sectoral Representatives",
                "name" => "50102030-02",
            ],
            [
                "title" => "Clothing/Uniform Allowance - Civilian",
                "name" => "50102040-01",
            ],
            [
                "title" => "Shoe Allowance - Civilian",
                "name" => "50102040-02",
            ],
            [
                "title" => "Clothing/Uniform Allowance - Military/Uniformed Personnel (MUP)",
                "name" => "50102040-03",
            ],
            [
                "title" => "Clothing/Uniform Allowance - Initial - Military/Uniformed Personnel",
                "name" => "50102040-04",
            ],
            [
                "title" => "Clothing/Uniform Allowance - Special - Military/Uniformed Personnel (MUP)",
                "name" => "50102040-05",
            ],
            [
                "title" => "Clothing/Uniform Allowance - Cold Weather - Military/Uniformed Personnel (MUP)",
                "name" => "50102040-06",
            ],
            [
                "title" => "Clothing/Uniform Allowance - Reenlistment - Military/Uniformed Personnel (MUP)",
                "name" => "50102040-07",
            ],
            [
                "title" => "Clothing/Uniform Allowance - Winter - Military/Uniformed Personnel (MUP)",
                "name" => "50102040-08",
            ],
            [
                "title" => "Clothing/Uniform Allowance - Combat - Military/Uniformed Personnel (MUP)",
                "name" => "50102040-09",
            ],
            [
                "title" => "Clothing/Uniform Allowance - Maintenance Cold Weather - Military/Uniformed Personnel (MUP)",
                "name" => "50102040-10",
            ],
            [
                "title" => "Clothing/Uniform Allowance - Replacement - Military/Uniformed Personnel (MUP)",
                "name" => "50102040-11",
            ],
            [
                "title" => "Subsistence Allowance - Military/Uniformed Personnel (MUP)",
                "name" => "50102050-01",
            ],
            [
                "title" => "Subsistence Allowance - Magna Carta Benefits for Science and Technology under R.A. 8439",
                "name" => "50102050-02",
            ],
            [
                "title" => "Subsistence Allowance - Magna Carta for Public Health Workers under R.A. 7305",
                "name" => "50102050-03",
            ],
            [
                "title" => "Subsistence Allowance - Magna Carta for Public Social Workers under R.A. 9432",
                "name" => "50102050-04",
            ],
            [
                "title" => "Laundry Allowance - Civilian",
                "name" => "50102060-01",
            ],
            [
                "title" => "Laundry Allowance - Military/Uniformed Personnel (MUP)",
                "name" => "50102060-02",
            ],
            [
                "title" => "Laundry Allowance - Magna Carta Benefits for Science and Technology under R.A. 8439",
                "name" => "50102060-03",
            ],
            [
                "title" => "Laundry Allowance - Magna Carta Benefits for Public Health Workers under R.A. 7305",
                "name" => "50102060-04",
            ],
            [
                "title" => "Laundry Allowance - Magna Carta Benefits for Public Social Workers under R.A. 9432",
                "name" => "50102060-05",
            ],
            [
                "title" => "Quarters Allowance - Civilian",
                "name" => "50102070-01",
            ],
            [
                "title" => "Quarters Allowance - Military/Uniformed Personnel (MUP)",
                "name" => "50102070-02",
            ],
            [
                "title" => "Quarters Allowance - Magna Carta Benefits for Science and Technology under R.A. 8439",
                "name" => "50102070-03",
            ],
            [
                "title" => "Quarters Allowance - Magna Carta Benefits for Public Health Workers under R.A. 7305",
                "name" => "50102070-04",
            ],
            [
                "title" => "Quarters Allowance - Magna Carta Benefits for Public Social Workers under R.A. 9432",
                "name" => "50102070-05",
            ],
            [
                "title" => "Productivity Incentive Allowance - Civilian",
                "name" => "50102080-01",
            ],
            [
                "title" => "Productivity Incentive Allowance - Military/Uniformed Personnel (MUP)",
                "name" => "50102080-02",
            ],
            [
                "title" => "Overseas Allowance - Civilian",
                "name" => "50102090-01",
            ],
            [
                "title" => "Overseas Allowance - Military/Uniformed Personnel (MUP)",
                "name" => "50102090-02",
            ],
            [
                "title" => "Honoraria - Civilian",
                "name" => "50102100-01",
            ],
            [
                "title" => "Honoraria - Military/Uniformed Personnel (MUP)",
                "name" => "50102100-02",
            ],
            [
                "title" => "Honoraria - Magna Carta Benefits for Science and Technology under R.A. 8439",
                "name" => "50102100-03",
            ],
            [
                "title" => "Honoraria - Magna Carta Benefits for Public Health Social Workers under R.A.7305",
                "name" => "50102100-04",
            ],
            [
                "title" => "Honoraria - Magna Carta Benefits for Public Social Workers under R.A. 9432",
                "name" => "50102100-05",
            ],
            [
                "title" => "Hazard Pay",
                "name" => "50102110-01",
            ],
            [
                "title" => "Hazard Duty Pay - Civilian",
                "name" => "50102110-02",
            ],
            [
                "title" => "Hazard Duty Pay - Military/Uniformed Personnel (MUP)",
                "name" => "50102110-03",
            ],
            [
                "title" => "HP - Magna Carta Benefits for Science and Technology under R.A. 8439",
                "name" => "50102110-04",
            ],
            [
                "title" => "HP - Magna Carta Benefits for Public Health Workers under R.A. 7305",
                "name" => "50102110-05",
            ],
            [
                "title" => "HP - Magna Carta Benefits for Public Social Workers under R.A. 9432",
                "name" => "50102110-06",
            ],
            [
                "title" => "Radiation Hazard Pay not exceeding 15% of Basic Salary",
                "name" => "50102110-07",
            ],
            [
                "title" => "High Risk Duty Pay - Military/Uniformed Personnel (MUP)",
                "name" => "50102110-08",
            ],
            [
                "title" => "Hazardous Duty Pay - Military/Uniformed Personnel (MUP)",
                "name" => "50102110-09",
            ],
            [
                "title" => "Longevity Pay - Civilian",
                "name" => "50102120-01",
            ],
            [
                "title" => "Longevity Pay - Military/Uniformed Personnel (MUP)",
                "name" => "50102120-02",
            ],
            [
                "title" => "Longevity Pay - Magna Carta Benefits for Science and Technology under R.A. 8439",
                "name" => "50102120-03",
            ],
            [
                "title" => "Longevity Pay - Magna Carta Benefits fo Public Health Workers under R.A. 7305",
                "name" => "50102120-04",
            ],
            [
                "title" => "Longevity Pay - Magna Carta Benefits for Public Social Workers under R.A. 9432",
                "name" => "50102120-05",
            ],
            [
                "title" => "Overtime Pay",
                "name" => "50102130-01",
            ],
            [
                "title" => "Night-shift Differential Pay",
                "name" => "50102130-02",
            ],
            [
                "title" => "Bonus - Civilian",
                "name" => "50102140-01",
            ],
            [
                "title" => "Bonus - Military/Uniformed Personnel (MUP)",
                "name" => "50102140-02",
            ],
            [
                "title" => "Cash Gift - Civilian",
                "name" => "50102150-01",
            ],
            [
                "title" => "Cash Gift - Military/Uniformed Personnel (MUP)",
                "name" => "50102150-02",
            ],
            [
                "title" => "Mid-Year Bonus - Civilian",
                "name" => "50102160-01",
            ],
            [
                "title" => "Mid-Year Bonus - Military/Uniformed Personnel",
                "name" => "50102160-02",
            ],
            [
                "title" => "Per Diems - Civilian",
                "name" => "50102990-01",
            ],
            [
                "title" => "Allowance of PAO Lawyers and Employees Assigned in Night Courts - Civilian",
                "name" => "50102990-02",
            ],
            [
                "title" => "Allowance of Attorney's de Officio - Civilian",
                "name" => "50102990-03",
            ],
            [
                "title" => "Special Hardship Allowance - Civilian",
                "name" => "50102990-04",
            ],
            [
                "title" => "Private Messenger Fee - Civilian",
                "name" => "50102990-05",
            ],
            [
                "title" => "Inquest Allowance - Civilian",
                "name" => "50102990-06",
            ],
            [
                "title" => "Special Duty Allowance - Civilian",
                "name" => "50102990-07",
            ],
            [
                "title" => "Special Duty Allowance - Military/Uniformed Personnel (MUP)",
                "name" => "50102990-08",
            ],
            [
                "title" => "Special Allowance for Judges and Justices - Civilian",
                "name" => "50102990-09",
            ],
            [
                "title" => "Special Allowance for the Members of the Prosecution Service",
                "name" => "50102990-10",
            ],
            [
                "title" => "Collective Negotiation Agreement Incentive - Civilian",
                "name" => "50102990-11",
            ],
            [
                "title" => "Productivity Enhancement Incentive - Civilian",
                "name" => "50102990-12",
            ],
            [
                "title" => "Productivity Enhancement Incentive - Military/Uniformed Personnel (MUP)",
                "name" => "50102990-13",
            ],
            [
                "title" => "Performance Based Bonus - Civilian",
                "name" => "50102990-14",
            ],
            [
                "title" => "Performance Based Bonus - Military/Uniformed Personnel (MUP)",
                "name" => "50102990-15",
            ],
            [
                "title" => "Flying Pay - Duty Based Allowance - Military/Uniformed Personnel ( DBA-MUP )",
                "name" => "50102990-16",
            ],
            [
                "title" => "Special Group Term Insurance - Duty Based Allowance - Military/Uniformed Personnel ( DBA-MUP )",
                "name" => "50102990-17",
            ],
            [
                "title" => "Sea Duty Pay - Duty Based Allowance - Military/Uniformed Personnel ( DBA-MUP )",
                "name" => "50102990-18",
            ],
            [
                "title" => "Combat Incentive Pay - Duty Based Allowance - Military/Uniformed Personnel ( DBA-MUP )",
                "name" => "50102990-19",
            ],
            [
                "title" => "Reenlistment Pay - Duty Based Allowance - Military/Uniformed Personnel ( DBA-MUP )",
                "name" => "50102990-20",
            ],
            [
                "title" => "Other Subsistence Allowance - Duty Based Allowance - Military/Uniformed Personnel ( DBA-MUP )",
                "name" => "50102990-21",
            ],
            [
                "title" => "Training Subsistence Allowance - Duty Based Allowance - Military/Uniformed Personnel ( DBA-MUP )",
                "name" => "50102990-22",
            ],
            [
                "title" => "Civil Disturbance Control Subsistence Allowance - Duty Based Allowance - Military/Uniformed Personnel ( DBA-MUP )",
                "name" => "50102990-23",
            ],
            [
                "title" => "Subsistence of Detainees - Duty Based Allowance - Military/Uniformed Personnel ( DBA-MUP )",
                "name" => "50102990-24",
            ],
            [
                "title" => "Hardship Allowance - Duty Based Allowance - Military/Uniformed Personnel ( DBA-MUP )",
                "name" => "50102990-25",
            ],
            [
                "title" => "Combat Duty Pay - Duty Based Allowance - Military/Uniformed Personnel ( DBA-MUP )",
                "name" => "50102990-26",
            ],
            [
                "title" => "Incentive Pay - Duty Based Allowance - Military/Uniformed Personnel ( DBA-MUP )",
                "name" => "50102990-27",
            ],
            [
                "title" => "Instructor's Duty Pay - Duty Based Allowance - Military/Uniformed Personnel ( DBA-MUP )",
                "name" => "50102990-28",
            ],
            [
                "title" => "Reservist's Pay - Duty Based Allowance - Military/Uniformed Personnel ( DBA-MUP )",
                "name" => "50102990-29",
            ],
            [
                "title" => "Medal of Valor Award - Duty Based Allowance - Military/Uniformed Personnel ( DBA-MUP )",
                "name" => "50102990-30",
            ],
            [
                "title" => "Hospitalization Expenses - Duty Based Allowance - Military/Uniformed Personnel ( DBA-MUP )",
                "name" => "50102990-31",
            ],
            [
                "title" => "Specialist's Pay - Duty Based Allowance - Military/Uniformed Personnel ( DBA-MUP )",
                "name" => "50102990-32",
            ],
            [
                "title" => "Parachutist Pay - Duty Based Allowance - Military/Uniformed Personnel ( DBA-MUP )",
                "name" => "50102990-33",
            ],
            [
                "title" => "Provisional Allowance - Military/Uniformed Personnel",
                "name" => "50102990-34",
            ],
            [
                "title" => "Officers' Allowance - Military/Uniformed Personnel",
                "name" => "50102990-35",
            ],
            [
                "title" => "Mid-Year Bonus - Civilian",
                "name" => "50102990-36",
            ],
            [
                "title" => "Mid-Year Bonus - Military / Uniformed Personnel",
                "name" => "50102990-37",
            ],
            [
                "title" => "Anniversary Bonus - Civilian",
                "name" => "50102990-38",
            ],
            [
                "title" => "Anniversary Bonus - Military/Uniformed Personnel",
                "name" => "50102990-39",
            ],
            [
                "title" => "Special Counsel Allowance",
                "name" => "50102990-40",
            ],
            [
                "title" => "Retirement and Life Insurance Premiums",
                "name" => "50103010-00",
            ],
            [
                "title" => "Pag-IBIG - Civilian",
                "name" => "50103020-01",
            ],
            [
                "title" => "Pag-IBIG - Military/Uniformed Personnel (MUP)",
                "name" => "50103020-02",
            ],
            [
                "title" => "PhilHealth - Civilian",
                "name" => "50103030-01",
            ],
            [
                "title" => "PhilHealth - Military/Uniformed Personnel (MUP)",
                "name" => "50103030-02",
            ],
            [
                "title" => "ECIP - Civilian",
                "name" => "50103040-01",
            ],
            [
                "title" => "ECIP - Military/Uniformed Personnel (MUP)",
                "name" => "50103040-02",
            ],
            [
                "title" => "Provident/Welfare Fund Contributions",
                "name" => "50103050-00",
            ],
            [
                "title" => "Pension Benefits - Civilian",
                "name" => "50104010-01",
            ],
            [
                "title" => "Pension Benefits - Military/Uniformed Personnel (MUP)",
                "name" => "50104010-02",
            ],
            [
                "title" => "Pension Benefits - Veterans",
                "name" => "50104010-03",
            ],
            [
                "title" => "Retirement Gratuity - Civilian",
                "name" => "50104020-01",
            ],
            [
                "title" => "Retirement Gratuity - Military/Uniformed Personnel (MUP)",
                "name" => "50104020-02",
            ],
            [
                "title" => "Terminal Leave Benefits - Civilian",
                "name" => "50104030-01",
            ],
            [
                "title" => "Terminal Leave Benefits - Military/Uniformed Personnel (MUP)",
                "name" => "50104030-02",
            ],
            [
                "title" => "Lump-sum for Creation of New Positions - Civilian",
                "name" => "50104990-01",
            ],
            [
                "title" => "Lump-sum for Creation of New Position - Military/Uniformed Personnel (MUP)",
                "name" => "50104990-02",
            ],
            [
                "title" => "Lump-sum for Reclassification of Positions",
                "name" => "50104990-03",
            ],
            [
                "title" => "Lump-sum for Equivalent-Record Form",
                "name" => "50104990-04",
            ],
            [
                "title" => "Lump-sum for Master Teachers",
                "name" => "50104990-05",
            ],
            [
                "title" => "Lump-sum for Compensation Adjustment",
                "name" => "50104990-06",
            ],
            [
                "title" => "Lump-sum for Filling of Positions - Civilian",
                "name" => "50104990-07",
            ],
            [
                "title" => "Lump-sum for NBC No. 308",
                "name" => "50104990-08",
            ],
            [
                "title" => "Lump-sum for Personnel Services",
                "name" => "50104990-09",
            ],
            [
                "title" => "Lump-sum for Step Increments - Length of Service",
                "name" => "50104990-10",
            ],
            [
                "title" => "Lump-sum for Step Increments - Meritorious Performance",
                "name" => "50104990-11",
            ],
            [
                "title" => "Other Lump-sum",
                "name" => "50104990-12",
            ],
            [
                "title" => "Police Benefits (NAPOLCOM)",
                "name" => "50104990-13",
            ],
            [
                "title" => "Lump-sum for Filling of Positions - Military/Uniformed Personnel (MUP)",
                "name" => "50104990-14",
            ],
            [
                "title" => "Loyalty Award - Civilian",
                "name" => "50104990-15",
            ],
            [
                "title" => "Other Personnel Benefits",
                "name" => "50104990-99",
            ],
            [
                "title" => "Traveling Expenses - Local",
                "name" => "50201010-00",
            ],
            [
                "title" => "Traveling Expenses - Foreign",
                "name" => "50201020-00",
            ],
            [
                "title" => "ICT Training Expenses",
                "name" => "50202010-01",
            ],
            [
                "title" => "Training Expenses",
                "name" => "50202010-02",
            ],
            [
                "title" => "Scholarship Grants/Expenses",
                "name" => "50202020-00",
            ],
            [
                "title" => "ICT Office Supplies",
                "name" => "50203010-01",
            ],
            [
                "title" => "Office Supplies Expenses",
                "name" => "50203010-02",
            ],
            [
                "title" => "Accountable Forms Expenses",
                "name" => "50203020-00",
            ],
            [
                "title" => "Non-Accountable Forms Expenses",
                "name" => "50203030-00",
            ],
            [
                "title" => "Animal/Zoological Supplies Expenses",
                "name" => "50203040-00",
            ],
            [
                "title" => "Food Supplies Expenses",
                "name" => "50203050-00",
            ],
            [
                "title" => "Welfare Goods Expenses",
                "name" => "50203060-00",
            ],
            [
                "title" => "Drugs and Medicines Expenses",
                "name" => "50203070-00",
            ],
            [
                "title" => "Medical, Dental and Laboratory Supplies Expenses",
                "name" => "50203080-00",
            ],
            [
                "title" => "Fuel, Oil and Lubricants Expenses",
                "name" => "50203090-00",
            ],
            [
                "title" => "Agricultural and Marine Supplies Expenses",
                "name" => "50203100-00",
            ],
            [
                "title" => "Textbooks and Instructional Materials Expenses",
                "name" => "50203110-01",
            ],
            [
                "title" => "Chalk Allowance",
                "name" => "50203110-02",
            ],
            [
                "title" => "Military, Police and Traffic Supplies Expenses",
                "name" => "50203120-00",
            ],
            [
                "title" => "Chemical and Filtering Supplies Expenses",
                "name" => "50203130-00",
            ],
            [
                "title" => "Semi-Expendable Machinery and Equipment Expenses",
                "name" => "50203130-00",
            ],
            [
                "title" => "Machinery",
                "name" => "50203210-01",
            ],
            [
                "title" => "Office Equipment",
                "name" => "50203210-02",
            ],
            [
                "title" => "Information and Communications Technology Equipment",
                "name" => "50203210-03",
            ],
            [
                "title" => "Agricultural and Forestry Equipment",
                "name" => "50203210-04",
            ],
            [
                "title" => "Marine and Fishery Equipment",
                "name" => "50203210-05",
            ],
            [
                "title" => "Airport Equipment",
                "name" => "50203210-06",
            ],
            [
                "title" => "Communications Equipment",
                "name" => "50203210-07",
            ],
            [
                "title" => "Disaster Response and Rescue Equipment",
                "name" => "50203210-08",
            ],
            [
                "title" => "Military Police and Security Equipment",
                "name" => "50203210-09",
            ],
            [
                "title" => "Medical Equipment",
                "name" => "50203210-10",
            ],
            [
                "title" => "Printing Equipment",
                "name" => "50203210-11",
            ],
            [
                "title" => "Sports Equipment",
                "name" => "50203210-12",
            ],
            [
                "title" => "Technical and Scientific Equipment",
                "name" => "50203210-13",
            ],
            [
                "title" => "Other Machinery and Equipment",
                "name" => "50203210-99",
            ],
            [
                "title" => "Semi-Expendable Furniture, Fixtures and Books Expenses",
                "name" => "50203220-00",
            ],
            [
                "title" => "Furniture and Fixtures",
                "name" => "50203220-01",
            ],
            [
                "title" => "Books",
                "name" => "50203220-02",
            ],
            [
                "title" => "Other Supplies and Materials Expenses",
                "name" => "50203990-00",
            ],
            [
                "title" => "Water Expenses",
                "name" => "50204010-00",
            ],
            [
                "title" => "Electricity Expenses",
                "name" => "50204020-00",
            ],
            [
                "title" => "Gas/Heating Expenses",
                "name" => "50204030-00",
            ],
            [
                "title" => "Other Utility Expenses",
                "name" => "50204990-00",
            ],
            [
                "title" => "Postage and Courier Services",
                "name" => "50205010-00",
            ],
            [
                "title" => "Mobile",
                "name" => "50205020-01",
            ],
            [
                "title" => "Landline",
                "name" => "50205020-02",
            ],
            [
                "title" => "Internet Subscription Expenses",
                "name" => "50205030-00",
            ],
            [
                "title" => "Cable, Satellite, Telegraph and Radio Expenses",
                "name" => "50205040-00",
            ],
            [
                "title" => "Awards/Rewards Expenses",
                "name" => "50206010-01",
            ],
            [
                "title" => "Rewards and Incentives",
                "name" => "50206010-02",
            ],
            [
                "title" => "Prizes",
                "name" => "50206020-00",
            ],
            [
                "title" => "Survey Expenses",
                "name" => "50207010-00",
            ],
            [
                "title" => "ICT Research, Exploration and Development Expenses",
                "name" => "50207020-01",
            ],
            [
                "title" => "Research, Exploration and Development Expenses",
                "name" => "50207020-02",
            ],
            [
                "title" => "Demolition and Relocation Expenses",
                "name" => "50208010-00",
            ],
            [
                "title" => "Desilting and Dredging Expenses",
                "name" => "50208020-00",
            ],
            [
                "title" => "ICT Generation, Transmission and Distribution Expenses",
                "name" => "50209010-01",
            ],
            [
                "title" => "Generation, Transmission and Distribution Expenses",
                "name" => "50209010-02",
            ],
            [
                "title" => "Confidential Expenses",
                "name" => "50210010-00",
            ],
            [
                "title" => "Intelligence Expenses",
                "name" => "50210020-00",
            ],
            [
                "title" => "Extraordinary and Miscellaneous Expenses",
                "name" => "50210030-00",
            ],
            [
                "title" => "Legal Services",
                "name" => "50211010-00",
            ],
            [
                "title" => "Auditing Services",
                "name" => "50211020-00",
            ],
            [
                "title" => "ICT Consultancy Services",
                "name" => "50211030-01",
            ],
            [
                "title" => "Consultancy Services",
                "name" => "50211030-02",
            ],
            [
                "title" => "Other Professional Services",
                "name" => "50211990-00",
            ],
            [
                "title" => "Environment/Sanitary Services",
                "name" => "50212010-00",
            ],
            [
                "title" => "Janitorial Services",
                "name" => "50212020-00",
            ],
            [
                "title" => "Security Services",
                "name" => "50212030-00",
            ],
            [
                "title" => "Other General Services - ICT Services",
                "name" => "50212990-01",
            ],
            [
                "title" => "Other General Services",
                "name" => "50212990-99",
            ],
            [
                "title" => "Repairs and Maintenance - Investment Property",
                "name" => "50213010-00",
            ],
            [
                "title" => "Aquaculture Structures",
                "name" => "50213020-01",
            ],
            [
                "title" => "Reforestation Projects",
                "name" => "50213020-02",
            ],
            [
                "title" => "Other Land Improvements",
                "name" => "50213020-99",
            ],
            [
                "title" => "Road Networks",
                "name" => "50213030-01",
            ],
            [
                "title" => "Flood Control Systems",
                "name" => "50213030-02",
            ],
            [
                "title" => "Sewer Systems",
                "name" => "50213030-03",
            ],
            [
                "title" => "Water Supply Systems",
                "name" => "50213030-04",
            ],
            [
                "title" => "Power Supply Systems",
                "name" => "50213030-05",
            ],
            [
                "title" => "Communication Networks",
                "name" => "50213030-06",
            ],
            [
                "title" => "Seaport Systems",
                "name" => "50213030-07",
            ],
            [
                "title" => "Airport Systems",
                "name" => "50213030-08",
            ],
            [
                "title" => "Parks, Plazas, and Monuments",
                "name" => "50213030-09",
            ],
            [
                "title" => "Other Infrastructure Assets",
                "name" => "50213030-99",
            ],
            [
                "title" => "Buildings",
                "name" => "50213040-01",
            ],
            [
                "title" => "School Buildings",
                "name" => "50213040-02",
            ],
            [
                "title" => "Hospitals and Health Centers",
                "name" => "50213040-03",
            ],
            [
                "title" => "Markets",
                "name" => "50213040-04",
            ],
            [
                "title" => "Slaughterhouses",
                "name" => "50213040-05",
            ],
            [
                "title" => "Hotels and Dormitories",
                "name" => "50213040-06",
            ],
            [
                "title" => "Other Structures",
                "name" => "50213040-99",
            ],
            [
                "title" => "Machinery",
                "name" => "50213050-01",
            ],
            [
                "title" => "Office Equipment",
                "name" => "50213050-02",
            ],
            [
                "title" => "Information and Communication Technology Equipment",
                "name" => "50213050-03",
            ],
            [
                "title" => "Agricultural and Forestry Equipment",
                "name" => "50213050-04",
            ],
            [
                "title" => "Marine and Fishery Equipment",
                "name" => "50213050-05",
            ],
            [
                "title" => "Airport Equipment",
                "name" => "50213050-06",
            ],
            [
                "title" => "Communication Equipment",
                "name" => "50213050-07",
            ],
            [
                "title" => "Construction and Heavy Equipment",
                "name" => "50213050-08",
            ],
            [
                "title" => "Disaster Response and Rescue Equipment",
                "name" => "50213050-09",
            ],
            [
                "title" => "Military, Police and Security Equipment",
                "name" => "50213050-10",
            ],
            [
                "title" => "Medical Equipment",
                "name" => "50213050-11",
            ],
            [
                "title" => "Printing Equipment",
                "name" => "50213050-12",
            ],
            [
                "title" => "Sports Equipment",
                "name" => "50213050-13",
            ],
            [
                "title" => "Technical and Scientific Equipment",
                "name" => "50213050-14",
            ],
            [
                "title" => "Other Machinery and Equipment",
                "name" => "50213050-99",
            ],
            [
                "title" => "Motor Vehicles",
                "name" => "50213060-01",
            ],
            [
                "title" => "Trains",
                "name" => "50213060-02",
            ],
            [
                "title" => "Aircrafts and Aircrafts Ground Equipment",
                "name" => "50213060-03",
            ],
            [
                "title" => "Watercrafts",
                "name" => "50213060-04",
            ],
            [
                "title" => "Other Transportation Equipment",
                "name" => "50213060-99",
            ],
            [
                "title" => "Repairs and Maintenance - Furniture and Fixtures",
                "name" => "50213070-00",
            ],
            [
                "title" => "Repairs and Maintenance - Leased Assets",
                "name" => "50213080-00",
            ],
            [
                "title" => "Buildings and Other Structures",
                "name" => "50213080-01",
            ],
            [
                "title" => "Machinery and Equipment",
                "name" => "50213080-02",
            ],
            [
                "title" => "Transportation Equipment",
                "name" => "50213080-03",
            ],
            [
                "title" => "ICT Machinery and Equipment",
                "name" => "50213080-04",
            ],
            [
                "title" => "Other Leased Assets",
                "name" => "50213080-99",
            ],
            [
                "title" => "Land",
                "name" => "50213090-01",
            ],
            [
                "title" => "Buildings",
                "name" => "50213090-02",
            ],
            [
                "title" => "Other Leased Assets Improvements",
                "name" => "50213090-99",
            ],
            [
                "title" => "Historical Buildings",
                "name" => "50213100-01",
            ],
            [
                "title" => "Works of Arts and Archeological Specimens",
                "name" => "50213100-02",
            ],
            [
                "title" => "Other Heritage Assets",
                "name" => "50213100-99",
            ],
            [
                "title" => "Repairs and Maintenance - Semi-Expendable Machinery and Equipment",
                "name" => "50213210-00",
            ],
            [
                "title" => "Machinery",
                "name" => "50213210-01",
            ],
            [
                "title" => "Office Equipment",
                "name" => "50213210-02",
            ],
            [
                "title" => "Information and Communications Technology Equipment",
                "name" => "50213210-03",
            ],
            [
                "title" => "Agricultural and Forestry Equipment",
                "name" => "50213210-04",
            ],
            [
                "title" => "Marine and Fishery Equipment",
                "name" => "50213210-05",
            ],
            [
                "title" => "Communications Equipment",
                "name" => "50213210-07",
            ],
            [
                "title" => "Disaster Response and Rescue Equipment",
                "name" => "50213210-08",
            ],
            [
                "title" => "Military Police and Security Equipment",
                "name" => "50213210-09",
            ],
            [
                "title" => "Medical Equipment",
                "name" => "50213210-10",
            ],
            [
                "title" => "Printing Equipment",
                "name" => "50213210-11",
            ],
            [
                "title" => "Sports Equipment",
                "name" => "50213210-12",
            ],
            [
                "title" => "Technical and Scientific Equipment",
                "name" => "50213210-13",
            ],
            [
                "title" => "Other Machinery and Equipment",
                "name" => "50213210-99",
            ],
            [
                "title" => "Repairs and Maintenance - Semi-Expendable Furniture, Fixtures and Books",
                "name" => "50213220-00",
            ],
            [
                "title" => "Furniture and Fixtures",
                "name" => "50213220-01",
            ],
            [
                "title" => "Books",
                "name" => "50213220-02",
            ],
            [
                "title" => "Work/Zoo Animals",
                "name" => "50213990-01",
            ],
            [
                "title" => "Other Property, Plant and Equipment",
                "name" => "50213990-99",
            ],
            [
                "title" => "Subsidy to NGAs",
                "name" => "50214010-00",
            ],
            [
                "title" => "Financial Assistance to NGAs",
                "name" => "50214020-00",
            ],
            [
                "title" => "Financial Assistance to Local Government Units",
                "name" => "50214030-00",
            ],
            [
                "title" => "Tobacco Excise Tax (Virginia) per R.A. 7171",
                "name" => "50214030-01",
            ],
            [
                "title" => "Tobacco Excise Tax (Burley and Native) per R.A. 8240 / 10351",
                "name" => "50214030-02",
            ],
            [
                "title" => "Mining Taxes per R.A. 7160",
                "name" => "50214030-03",
            ],
            [
                "title" => "Royalties per R.A. 7160",
                "name" => "50214030-04",
            ],
            [
                "title" => "Forestry Charges per R.A. 7160",
                "name" => "50214030-05",
            ],
            [
                "title" => "Fishery Charges per R.A. 7160",
                "name" => "50214030-06",
            ],
            [
                "title" => "Renewable Energy charges per R.A. 9513",
                "name" => "50214030-07",
            ],
            [
                "title" => "Income Tax Collections in ECO ZONES per R.A. 7922 and R.A. 8748",
                "name" => "50214030-08",
            ],
            [
                "title" => "Value Added Tax per R.A. 7643",
                "name" => "50214030-09",
            ],
            [
                "title" => "Value Added Tax in lieu of Franchise Tax per R.A. 7953 and R.A. 8407",
                "name" => "50214030-10",
            ],
            [
                "title" => "Subsidy Support to Operations of GOCCs",
                "name" => "50214040-01",
            ],
            [
                "title" => "Road Networks",
                "name" => "50214040-02",
            ],
            [
                "title" => "Flood Control Systems",
                "name" => "50214040-03",
            ],
            [
                "title" => "Sewer Systems",
                "name" => "50214040-04",
            ],
            [
                "title" => "Water Supply Systems",
                "name" => "50214040-05",
            ],
            [
                "title" => "Power Supply Systems",
                "name" => "50214040-06",
            ],
            [
                "title" => "Communication Networks",
                "name" => "50214040-07",
            ],
            [
                "title" => "Seaport Systems",
                "name" => "50214040-08",
            ],
            [
                "title" => "Airport Systems",
                "name" => "50214040-09",
            ],
            [
                "title" => "Parks, Plazas and Monuments",
                "name" => "50214040-10",
            ],
            [
                "title" => "Irrigation Systems",
                "name" => "50214040-11",
            ],
            [
                "title" => "Railway Systems",
                "name" => "50214040-12",
            ],
            [
                "title" => "Housing and Community Facilities",
                "name" => "50214040-13",
            ],
            [
                "title" => "Other Infrastructure Assets",
                "name" => "50214040-99",
            ],
            [
                "title" => "Financial Assistance to NGOs/POs",
                "name" => "50214050-00",
            ],
            [
                "title" => "Internal Revenue Allotment",
                "name" => "50214060-00",
            ],
            [
                "title" => "Subsidy to Regional Offices/Staff Bureaus",
                "name" => "50214070-00",
            ],
            [
                "title" => "Subsidy to Operating Units",
                "name" => "50214080-00",
            ],
            [
                "title" => "Subsidy to Other Funds",
                "name" => "50214090-00",
            ],
            [
                "title" => "Subsidies - Others",
                "name" => "50214990-00",
            ],
            [
                "title" => "Taxes, Duties and Licenses",
                "name" => "50215010-01",
            ],
            [
                "title" => "Tax Refund",
                "name" => "50215010-02",
            ],
            [
                "title" => "Fidelity Bond Premiums",
                "name" => "50215020-00",
            ],
            [
                "title" => "Insurance Expenses",
                "name" => "50215030-00",
            ],
            [
                "title" => "Labor and Wages",
                "name" => "50216010-00",
            ],
            [
                "title" => "Advertising Expenses",
                "name" => "50299010-00",
            ],
            [
                "title" => "Printing and Publication Expenses",
                "name" => "50299020-00",
            ],
            [
                "title" => "Representation Expenses",
                "name" => "50299030-00",
            ],
            [
                "title" => "Transportation and Delivery Expenses",
                "name" => "50299040-00",
            ],
            [
                "title" => "Rents - Building and Structures",
                "name" => "50299050-01",
            ],
            [
                "title" => "Rents - Land",
                "name" => "50299050-02",
            ],
            [
                "title" => "Rents - Motor Vehicles",
                "name" => "50299050-03",
            ],
            [
                "title" => "Rents - Equipment",
                "name" => "50299050-04",
            ],
            [
                "title" => "Rents - Living Quarters",
                "name" => "50299050-05",
            ],
            [
                "title" => "Operating Lease",
                "name" => "50299050-06",
            ],
            [
                "title" => "Financial Lease",
                "name" => "50299050-07",
            ],
            [
                "title" => "Rents - ICT Machinery and Equipment",
                "name" => "50299050-08",
            ],
            [
                "title" => "Membership Dues and Contributions to Organizations",
                "name" => "50299060-00",
            ],
            [
                "title" => "ICT Software Subscription",
                "name" => "50299070-01",
            ],
            [
                "title" => "Data Center Service",
                "name" => "50299070-02",
            ],
            [
                "title" => "Cloud Computing Service",
                "name" => "50299070-03",
            ],
            [
                "title" => "Library and Other Reading Materials Subscription Expenses",
                "name" => "50299070-04",
            ],
            [
                "title" => "Other Subscription Expenses",
                "name" => "50299070-99",
            ],
            [
                "title" => "Donations",
                "name" => "50299080-00",
            ],
            [
                "title" => "Litigation/Acquired Assets Expenses",
                "name" => "50299090-00",
            ],
            [
                "title" => "Bank Transaction Fee",
                "name" => "50299220-00",
            ],
            [
                "title" => "Other Maintenance and Operating Expenses",
                "name" => "50299990-00",
            ],
            [
                "title" => "Website Maintenance",
                "name" => "50299990-01",
            ],
            [
                "title" => "Other Maintenance and Operating Expenses",
                "name" => "50299990-99",
            ],
            [
                "title" => "Management Supervision/Trusteeship Fees",
                "name" => "50301010-00",
            ],
            [
                "title" => "Interest Paid to Non Residents",
                "name" => "50301020-01",
            ],
            [
                "title" => "Interest Paid to Residents other than General Government",
                "name" => "50301020-02",
            ],
            [
                "title" => "Interest Paid to other General Government Units",
                "name" => "50301020-03",
            ],
            [
                "title" => "Interest Expense - Others",
                "name" => "50301020-04",
            ],
            [
                "title" => "Guarantee Fees",
                "name" => "50301030-00",
            ],
            [
                "title" => "Bank Charges",
                "name" => "50301040-00",
            ],
            [
                "title" => "Commitment Fees",
                "name" => "50301050-00",
            ],
            [
                "title" => "Other Financial Charges",
                "name" => "50301990-00",
            ],
            [
                "title" => "Direct Labor",
                "name" => "50401010-00",
            ],
            [
                "title" => "Manufacturing Overhead",
                "name" => "50401020-00",
            ],
            [
                "title" => "Cost of Sales",
                "name" => "50402010-00",
            ],
            [
                "title" => "Depreciation - Investment Property",
                "name" => "50501010-00",
            ],
            [
                "title" => "Aquaculture Structures",
                "name" => "50501020-01",
            ],
            [
                "title" => "Reforestation Projects",
                "name" => "50501020-02",
            ],
            [
                "title" => "Other Land Improvements",
                "name" => "50501020-99",
            ],
            [
                "title" => "Road Networks",
                "name" => "50501030-01",
            ],
            [
                "title" => "Flood Control Systems",
                "name" => "50501030-02",
            ],
            [
                "title" => "Sewer System",
                "name" => "50501030-03",
            ],
            [
                "title" => "Water Supply Systems",
                "name" => "50501030-04",
            ],
            [
                "title" => "Power Supply Systems",
                "name" => "50501030-05",
            ],
            [
                "title" => "Communication Networks",
                "name" => "50501030-06",
            ],
            [
                "title" => "Seaport Systems",
                "name" => "50501030-07",
            ],
            [
                "title" => "Airport Systems",
                "name" => "50501030-08",
            ],
            [
                "title" => "Parks, Plazas and Monuments",
                "name" => "50501030-09",
            ],
            [
                "title" => "Other Infrastructure Assets",
                "name" => "50501030-99",
            ],
            [
                "title" => "Buildings",
                "name" => "50501040-01",
            ],
            [
                "title" => "School Buildings",
                "name" => "50501040-02",
            ],
            [
                "title" => "Hospitals and Health Centers",
                "name" => "50501040-03",
            ],
            [
                "title" => "Markets",
                "name" => "50501040-04",
            ],
            [
                "title" => "Slaughterhouses",
                "name" => "50501040-05",
            ],
            [
                "title" => "Hostels and Dormitories",
                "name" => "50501040-06",
            ],
            [
                "title" => "Other Structures",
                "name" => "50501040-99",
            ],
            [
                "title" => "Machinery",
                "name" => "50501050-01",
            ],
            [
                "title" => "Office Equipment",
                "name" => "50501050-02",
            ],
            [
                "title" => "ICT Equipment",
                "name" => "50501050-03",
            ],
            [
                "title" => "Agricultural and Forestry Equipment",
                "name" => "50501050-04",
            ],
            [
                "title" => "Marine and Fishery Equipment",
                "name" => "50501050-05",
            ],
            [
                "title" => "Airport Equipment",
                "name" => "50501050-06",
            ],
            [
                "title" => "Communication Equipment",
                "name" => "50501050-07",
            ],
            [
                "title" => "Construction and Heavy Equipment",
                "name" => "50501050-08",
            ],
            [
                "title" => "Disaster Response and Rescue Equipment",
                "name" => "50501050-09",
            ],
            [
                "title" => "Military, Police and Security Equipment",
                "name" => "50501050-10",
            ],
            [
                "title" => "Medical Equipment",
                "name" => "50501050-11",
            ],
            [
                "title" => "Printing Equipment",
                "name" => "50501050-12",
            ],
            [
                "title" => "Sports Equipment",
                "name" => "50501050-13",
            ],
            [
                "title" => "Technical and Scientific Equipment",
                "name" => "50501050-14",
            ],
            [
                "title" => "Other Machinery and Equipment",
                "name" => "50501050-99",
            ],
            [
                "title" => "Motor Vehicles",
                "name" => "50501060-01",
            ],
            [
                "title" => "Trains",
                "name" => "50501060-02",
            ],
            [
                "title" => "Aircrafts and Aircrafts Ground Equipment",
                "name" => "50501060-03",
            ],
            [
                "title" => "Watercrafts",
                "name" => "50501060-04",
            ],
            [
                "title" => "Other Transportation Equipment",
                "name" => "50501060-99",
            ],
            [
                "title" => "Furniture and Fixtures",
                "name" => "50501070-01",
            ],
            [
                "title" => "Books",
                "name" => "50501070-02",
            ],
            [
                "title" => "Buildings and Other Structures",
                "name" => "50501080-01",
            ],
            [
                "title" => "Machinery and Equipment",
                "name" => "50501080-02",
            ],
            [
                "title" => "Transportation Equipment",
                "name" => "50501080-03",
            ],
            [
                "title" => "Other Leased Asets",
                "name" => "50501080-99",
            ],
            [
                "title" => "Land",
                "name" => "50501090-01",
            ],
            [
                "title" => "Buildings",
                "name" => "50501090-02",
            ],
            [
                "title" => "Other Leased Assets Improvements",
                "name" => "50501090-99",
            ],
            [
                "title" => "Historical Buildings",
                "name" => "50501100-01",
            ],
            [
                "title" => "Works of Arts and Archeological Specimens",
                "name" => "50501100-02",
            ],
            [
                "title" => "Other Heritage Assets",
                "name" => "50501100-99",
            ],
            [
                "title" => "Depreciation - Service Concession Asset",
                "name" => "50501110-00",
            ],
            [
                "title" => "Work/Zoo Animals",
                "name" => "50501990-01",
            ],
            [
                "title" => "Other Property, Plant and Equipment",
                "name" => "50501990-99",
            ],
            [
                "title" => "Patents/Copyrights",
                "name" => "50502010-01",
            ],
            [
                "title" => "Computer Software",
                "name" => "50502010-02",
            ],
            [
                "title" => "Other Intangible Assets",
                "name" => "50502010-99",
            ],
            [
                "title" => "Impairment Loss - Financial Assets Held to Maturity",
                "name" => "50503010-00",
            ],
            [
                "title" => "Impairment Loss - Loans and Receivables",
                "name" => "50503020-00",
            ],
            [
                "title" => "Impairment Loss - Other Assets",
                "name" => "50503020-00",
            ],
            [
                "title" => "Impairment Loss - Lease Receivables",
                "name" => "50503030-00",
            ],
            [
                "title" => "Impairment Loss - Investments in GOCCs",
                "name" => "50503040-00",
            ],
            [
                "title" => "Impairment Loss - Investments in Joint Venture",
                "name" => "50503050-00",
            ],
            [
                "title" => "Impairment Loss - Other Receivables",
                "name" => "50503060-00",
            ],
            [
                "title" => "Impairment Loss - Inventories",
                "name" => "50503070-00",
            ],
            [
                "title" => "Impairment Loss - Investment Property",
                "name" => "50503080-00",
            ],
            [
                "title" => "Impairment Loss - Property, Plant and Equipment",
                "name" => "50503090-00",
            ],
            [
                "title" => "Impairment Loss - Biological Assets",
                "name" => "50503100-00",
            ],
            [
                "title" => "Impairment Loss - Intangible Assets",
                "name" => "50503110-00",
            ],
            [
                "title" => "Impairment Loss - Investments in Associates",
                "name" => "50503120-00",
            ],
            [
                "title" => "Loss on Foreign Exchange(FOREX)",
                "name" => "50504010-00",
            ],
            [
                "title" => "Loss on Sale of Investments",
                "name" => "50504020-00",
            ],
            [
                "title" => "Loss on Sale of Investment Property",
                "name" => "50504030-00",
            ],
            [
                "title" => "Loss on Sale of Property, Plant and Equipment",
                "name" => "50504040-00",
            ],
            [
                "title" => "Loss on Sale of Biological Assets",
                "name" => "50504050-00",
            ],
            [
                "title" => "Loss on Sale of Agricultural Produce",
                "name" => "50504060-00",
            ],
            [
                "title" => "Loss on Sale of Intangible Assets",
                "name" => "50504070-00",
            ],
            [
                "title" => "Loss on Sale of Assets",
                "name" => "50504080-00",
            ],
            [
                "title" => "Loss of Assets",
                "name" => "50504090-00",
            ],
            [
                "title" => "Loss of Guaranty",
                "name" => "50504100-00",
            ],
            [
                "title" => "Loss on Initial Recognition of Biological Assets",
                "name" => "50504110-00",
            ],
            [
                "title" => "Other Losses",
                "name" => "50504990-00",
            ],
            [
                "title" => "Investment in Government-Owned and/or Controlled Corporations",
                "name" => "50601010-01",
            ],
            [
                "title" => "Road Networks",
                "name" => "50601010-02",
            ],
            [
                "title" => "Flood Control Systems",
                "name" => "50601010-03",
            ],
            [
                "title" => "Sewer Systems",
                "name" => "50601010-04",
            ],
            [
                "title" => "Water Supply Systems",
                "name" => "50601010-05",
            ],
            [
                "title" => "Power Supply Systems",
                "name" => "50601010-06",
            ],
            [
                "title" => "Communication Networks",
                "name" => "50601010-07",
            ],
            [
                "title" => "Seaport Systems",
                "name" => "50601010-08",
            ],
            [
                "title" => "Airport Systems",
                "name" => "50601010-09",
            ],
            [
                "title" => "Parks, Plazas and Monuments",
                "name" => "50601010-10",
            ],
            [
                "title" => "Railway Systems",
                "name" => "50601010-11",
            ],
            [
                "title" => "Housing and Community Facilities",
                "name" => "50601010-12",
            ],
            [
                "title" => "Other Infrastructure Assets",
                "name" => "50601010-99",
            ],
            [
                "title" => "Investment in Associates",
                "name" => "50601020-00",
            ],
            [
                "title" => "Loans Outlay - Government-Owned and/or Controlled Corporations",
                "name" => "50602010-00",
            ],
            [
                "title" => "Loans Outlay - Local Government Units",
                "name" => "50602020-00",
            ],
            [
                "title" => "Loans Outlay - Others",
                "name" => "50602990-00",
            ],
            [
                "title" => "Investment Property - Land",
                "name" => "50603010-01",
            ],
            [
                "title" => "Investment Property - Buildings",
                "name" => "50603010-02",
            ],
            [
                "title" => "Land",
                "name" => "50604010-01",
            ],
            [
                "title" => "Aquaculture Structures",
                "name" => "50604020-01",
            ],
            [
                "title" => "Reforestation Projects",
                "name" => "50604020-02",
            ],
            [
                "title" => "Other Land Improvements",
                "name" => "50604020-99",
            ],
            [
                "title" => "Road Networks",
                "name" => "50604030-01",
            ],
            [
                "title" => "Flood Control Systems",
                "name" => "50604030-02",
            ],
            [
                "title" => "Sewer Systems",
                "name" => "50604030-03",
            ],
            [
                "title" => "Water Supply Systems",
                "name" => "50604030-04",
            ],
            [
                "title" => "Power Supply Systems",
                "name" => "50604030-05",
            ],
            [
                "title" => "Communication Networks",
                "name" => "50604030-06",
            ],
            [
                "title" => "Seaport Systems",
                "name" => "50604030-07",
            ],
            [
                "title" => "Airport Systems",
                "name" => "50604030-08",
            ],
            [
                "title" => "Parks, Plazas and Monuments",
                "name" => "50604030-09",
            ],
            [
                "title" => "Railway Systems",
                "name" => "50604030-10",
            ],
            [
                "title" => "Right-of-Way",
                "name" => "50604030-11",
            ],
            [
                "title" => "Other Infrastructure Assets",
                "name" => "50604030-99",
            ],
            [
                "title" => "Buildings",
                "name" => "50604040-01",
            ],
            [
                "title" => "School Buildings",
                "name" => "50604040-02",
            ],
            [
                "title" => "Hospitals and Health Centers",
                "name" => "50604040-03",
            ],
            [
                "title" => "Markets",
                "name" => "50604040-04",
            ],
            [
                "title" => "Slaughterhouses",
                "name" => "50604040-05",
            ],
            [
                "title" => "Hostels and Dormitories",
                "name" => "50604040-06",
            ],
            [
                "title" => "Ground Water Monitoring Stations",
                "name" => "50604040-07",
            ],
            [
                "title" => "Other Structures",
                "name" => "50604040-99",
            ],
            [
                "title" => "Machinery",
                "name" => "50604050-01",
            ],
            [
                "title" => "Office Equipment",
                "name" => "50604050-02",
            ],
            [
                "title" => "Information and Communication Technology Equipment",
                "name" => "50604050-03",
            ],
            [
                "title" => "Agricultural and Forestry Equipment",
                "name" => "50604050-04",
            ],
            [
                "title" => "Marine and Fishery Equipment",
                "name" => "50604050-05",
            ],
            [
                "title" => "Airport Equipment",
                "name" => "50604050-06",
            ],
            [
                "title" => "Communication Equipment",
                "name" => "50604050-07",
            ],
            [
                "title" => "Construction and Heavy Equipment",
                "name" => "50604050-08",
            ],
            [
                "title" => "Disaster Response and Rescue Equipment",
                "name" => "50604050-09",
            ],
            [
                "title" => "Military, Police and Security Equipment",
                "name" => "50604050-10",
            ],
            [
                "title" => "Medical Equipment",
                "name" => "50604050-11",
            ],
            [
                "title" => "Printing Equipment",
                "name" => "50604050-12",
            ],
            [
                "title" => "Sports Equipment",
                "name" => "50604050-13",
            ],
            [
                "title" => "Technical and Scientific Equipment",
                "name" => "50604050-14",
            ],
            [
                "title" => "ICT Software",
                "name" => "50604050-15",
            ],
            [
                "title" => "Other Machinery and Equipment",
                "name" => "50604050-99",
            ],
            [
                "title" => "Motor Vehicles",
                "name" => "50604060-01",
            ],
            [
                "title" => "Trains",
                "name" => "50604060-02",
            ],
            [
                "title" => "Aircrafts and Aircrafts Ground Equipment",
                "name" => "50604060-03",
            ],
            [
                "title" => "Watercrafts",
                "name" => "50604060-04",
            ],
            [
                "title" => "Other Transportation Equipment",
                "name" => "50604060-99",
            ],
            [
                "title" => "Furniture and Fixtures",
                "name" => "50604070-01",
            ],
            [
                "title" => "Books",
                "name" => "50604070-02",
            ],
            [
                "title" => "Historical Buildings",
                "name" => "50604080-01",
            ],
            [
                "title" => "Works of Arts and Archeological Specimens",
                "name" => "50604080-02",
            ],
            [
                "title" => "Other Heritage Assets",
                "name" => "50604080-99",
            ],
            [
                "title" => "Work/Zoo Animals",
                "name" => "50604090-01",
            ],
            [
                "title" => "Other Property, Plant and Equipment",
                "name" => "50604090-99",
            ],
            [
                "title" => "Other Leased Assets Improvements",
                "name" => "50604100-99",
            ],
            [
                "title" => "Breeding Stocks",
                "name" => "50605010-01",
            ],
            [
                "title" => "Livestock",
                "name" => "50605010-02",
            ],
            [
                "title" => "Trees, Plants and Crops",
                "name" => "50605010-03",
            ],
            [
                "title" => "Aquaculture",
                "name" => "50605010-04",
            ],
            [
                "title" => "Other Bearer Biological Assets",
                "name" => "50605010-99",
            ],
            [
                "title" => "Patents/Copyrights",
                "name" => "50606010-00",
            ],
            [
                "title" => "Computer Software",
                "name" => "50606020-00",
            ],
            [
                "title" => "Other Intangible Assets",
                "name" => "50606990-00",
            ],
        ];

        foreach ($uacs_codes as $uacs_code) {
            $lib = Library::create(['name' => $uacs_code['name'], 'title' => $uacs_code['title'], 'library_type' => 'uacs_code']);
            echo $lib->library_type.": ".$lib->name."\n";
        }
    }
}
