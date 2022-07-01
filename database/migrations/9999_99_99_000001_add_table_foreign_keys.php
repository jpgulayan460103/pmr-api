<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddTableForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('bac_tasks', function (Blueprint $table) {
            $table->foreign('purchase_request_id')->references('id')->on('purchase_requests');
        });

        Schema::table('form_processes', function (Blueprint $table) {
            $table->foreign('office_id')->references('id')->on('libraries')->onDelete('set null');
            $table->index(['form_processable_id', 'form_processable_type']);
        });

        Schema::table('form_routes', function (Blueprint $table) {
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('forwarded_by_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('processed_by_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('form_process_id')->references('id')->on('form_processes')->onDelete('cascade');
            $table->foreign('origin_office_id')->references('id')->on('libraries')->onDelete('set null');
            $table->foreign('from_office_id')->references('id')->on('libraries')->onDelete('set null');
            $table->foreign('to_office_id')->references('id')->on('libraries')->onDelete('set null');
            $table->index(['form_routable_id', 'form_routable_type']);
        });
        
        Schema::table('form_uploads', function (Blueprint $table) {
            $table->index(['form_uploadable_id', 'form_uploadable_type']);
            $table->index(['form_attachable_id', 'form_attachable_type']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('parent_id')->references('id')->on('form_uploads')->onDelete('cascade');
        });

        Schema::table('items', function (Blueprint $table) {
            $table->foreign('item_type_id')->references('id')->on('libraries')->onDelete('set null');
            $table->foreign('unit_of_measure_id')->references('id')->on('libraries')->onDelete('set null');
            $table->foreign('item_category_cse_id')->references('id')->on('libraries')->onDelete('set null');
        });

        Schema::table('item_supplies', function (Blueprint $table) {
            $table->foreign('item_category_id')->references('id')->on('libraries')->onDelete('set null');
            $table->foreign('unit_of_measure_id')->references('id')->on('libraries')->onDelete('set null');
        });

        Schema::table('item_supply_histories', function (Blueprint $table) {
            $table->foreign('item_supply_id')->references('id')->on('item_supplies')->onDelete('cascade');
            $table->index(['form_sourceable_id', 'form_sourceable_type'], 'item_supply_form_sourceable_id_form_sourceable_type_index');
        });
        Schema::table('no_stock_certificates', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('no_stock_certificate_items', function (Blueprint $table) {
            $table->foreign('no_stock_certificate_id')->references('id')->on('no_stock_certificates')->onDelete('cascade');
        });

        Schema::table('procurement_management', function (Blueprint $table) {
            $table->foreign('end_user_id')->references('id')->on('libraries')->onDelete('cascade');
        });
        Schema::table('procurement_management_items', function (Blueprint $table) {
            $table->foreign('procurement_management_id')->references('id')->on('procurement_management')->onDelete('cascade');
            $table->foreign('procurement_plan_item_id')->references('id')->on('procurement_plan_items')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('set null');
            $table->index(['form_sourceable_id', 'form_sourceable_type'], 'pm_items_form_sourceable_id_form_sourceable_type_index');
        });

        Schema::table('procurement_plans', function (Blueprint $table) {
            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('end_user_id')->references('id')->on('libraries')->onDelete('cascade');
            $table->foreign('procurement_plan_type_id')->references('id')->on('libraries')->onDelete('cascade');
            $table->foreign('certified_by_id')->references('id')->on('libraries')->onDelete('cascade');
            $table->foreign('approved_by_id')->references('id')->on('libraries')->onDelete('cascade');
        });
        Schema::table('procurement_plan_items', function (Blueprint $table) {
            $table->foreign('procurement_plan_id')->references('id')->on('procurement_plans')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('set null');
            $table->foreign('unit_of_measure_id')->references('id')->on('libraries')->onDelete('set null');
            $table->foreign('item_type_id')->references('id')->on('libraries')->onDelete('set null');
        });

        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->foreign('purchase_request_id')->references('id')->on('purchase_requests')->onDelete('cascade');
        });

        Schema::table('purchase_order_deliveries', function (Blueprint $table) {
            $table->foreign('purchase_request_id')->references('id')->on('purchase_requests')->onDelete('cascade');
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders')->onDelete('cascade');
        });

        Schema::table('purchase_requests', function (Blueprint $table) {
            $table->foreign('bac_task_id')->references('id')->on('bac_tasks')->onDelete('set null');
            $table->foreign('requested_by_id')->references('id')->on('libraries')->onDelete('cascade');
            $table->foreign('approved_by_id')->references('id')->on('libraries')->onDelete('cascade');
            $table->foreign('end_user_id')->references('id')->on('libraries')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('libraries')->onDelete('cascade');
            $table->foreign('mode_of_procurement_id')->references('id')->on('libraries')->onDelete('cascade');
            $table->foreign('uacs_code_id')->references('id')->on('libraries')->onDelete('cascade');
            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('set null');
        });

        Schema::table('purchase_request_items', function (Blueprint $table) {
            $table->foreign('item_id')->references('id')->on('items')->onDelete('set null');
            $table->foreign('purchase_request_id')->references('id')->on('purchase_requests')->onDelete('cascade');
            $table->foreign('unit_of_measure_id')->references('id')->on('libraries')->onDelete('set null');
        });

        Schema::table('requisition_issues', function (Blueprint $table) {
            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('end_user_id')->references('id')->on('libraries')->onDelete('cascade');
            $table->foreign('requested_by_id')->references('id')->on('libraries')->onDelete('cascade');
            $table->foreign('approved_by_id')->references('id')->on('libraries')->onDelete('cascade');
        });
        Schema::table('requisition_issue_items', function (Blueprint $table) {
            $table->foreign('requisition_issue_id')->references('id')->on('requisition_issues')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('procurement_plan_item_id')->references('id')->on('procurement_plan_items')->onDelete('cascade');
            $table->foreign('unit_of_measure_id')->references('id')->on('libraries')->onDelete('set null');
        });

        Schema::table('quotations', function (Blueprint $table) {
            $table->foreign('purchase_request_id')->references('id')->on('purchase_requests')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('supplier_contact_id')->references('id')->on('supplier_contacts')->onDelete('cascade');
            $table->foreign('prepared_by_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('quotation_items', function (Blueprint $table) {
            $table->foreign('quotation_id')->references('id')->on('quotations')->onDelete('cascade');
            $table->foreign('purchase_request_item_id')->references('id')->on('purchase_request_items')->onDelete('cascade');
        });

        Schema::table('supplier_categories', function (Blueprint $table) {
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('libraries')->onDelete('cascade');
        });

        Schema::table('supplier_contacts', function (Blueprint $table) {
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });

        Schema::table('user_groups', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('libraries')->onDelete('cascade');
        });

        Schema::table('user_offices', function (Blueprint $table) {
            $table->foreign('office_id')->references('id')->on('libraries')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('user_informations', function (Blueprint $table) {
            $table->foreign('position_id')->references('id')->on('libraries')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('vouchers', function (Blueprint $table) {
            $table->foreign('purchase_request_id')->references('id')->on('purchase_requests')->onDelete('cascade');;
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders')->onDelete('cascade');;
        });

        Schema::table('voucher_audits', function (Blueprint $table) {
            $table->foreign('voucher_id')->references('id')->on('vouchers')->onDelete('cascade');;
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('bac_tasks', function (Blueprint $table) {
            $table->dropForeign(['purchase_request_id']);
        });

        Schema::table('form_processes', function (Blueprint $table) {
            $table->dropForeign(['office_id']);
            $table->dropIndex(['form_processable_id', 'form_processable_type']);
        });

        Schema::table('form_routes', function (Blueprint $table) {
            $table->dropForeign(['processed_by_id']);
            $table->dropForeign(['form_process_id']);
            $table->dropForeign(['origin_office_id']);
            $table->dropForeign(['from_office_id']);
            $table->dropForeign(['to_office_id']);
            $table->dropIndex(['form_routable_id', 'form_routable_type']);
        });
        
        Schema::table('form_uploads', function (Blueprint $table) {
            $table->dropIndex(['form_uploadable_id', 'form_uploadable_type']);
            $table->dropIndex(['form_attachable_id', 'form_attachable_type']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['parent_id']);
        });

        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign(['item_type_id']);
            $table->dropForeign(['unit_of_measure_id']);
            $table->dropForeign(['item_category_cse_id']);
        });

        Schema::table('item_supplies', function (Blueprint $table) {
            $table->dropForeign(['item_category_id']);
            $table->dropForeign(['unit_of_measure_id']);
        });

        Schema::table('item_supply_histories', function (Blueprint $table) {
            $table->dropForeign(['item_supply_id']);
            DB::statement('ALTER TABLE `item_supply_histories` DROP INDEX `item_supply_form_sourceable_id_form_sourceable_type_index`');
        });

        Schema::table('no_stock_certificates', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::table('no_stock_certificate_items', function (Blueprint $table) {
            $table->dropForeign(['no_stock_certificate_id']);
        });
        
        Schema::table('procurement_management', function (Blueprint $table) {
            $table->dropForeign(['end_user_id']);
        });
        Schema::table('procurement_management_items', function (Blueprint $table) {
            $table->dropForeign(['procurement_management_id']);
            $table->dropForeign(['procurement_plan_item_id']);
            $table->dropForeign(['item_id']);
            DB::statement('ALTER TABLE `procurement_management_items` DROP INDEX `pm_items_form_sourceable_id_form_sourceable_type_index`');
        });
        Schema::table('procurement_plans', function (Blueprint $table) {
            $table->dropForeign(['created_by_id']);
            $table->dropForeign(['end_user_id']);
            $table->dropForeign(['procurement_plan_type_id']);
            $table->dropForeign(['certified_by_id']);
            $table->dropForeign(['approved_by_id']);
        });
        Schema::table('procurement_plan_items', function (Blueprint $table) {
            $table->dropForeign(['procurement_plan_id']);
            $table->dropForeign(['item_id']);
            $table->dropForeign(['unit_of_measure_id']);
            $table->dropForeign(['item_type_id']);
        });

        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->dropForeign(['purchase_request_id']);
        });

        Schema::table('purchase_order_deliveries', function (Blueprint $table) {
            $table->dropForeign(['purchase_request_id']);
            $table->dropForeign(['purchase_order_id']);
        });

        Schema::table('purchase_requests', function (Blueprint $table) {
            $table->dropForeign(['bac_task_id']);
            $table->dropForeign(['requested_by_id']);
            $table->dropForeign(['approved_by_id']);
            $table->dropForeign(['end_user_id']);
            $table->dropForeign(['account_id']);
            $table->dropForeign(['mode_of_procurement_id']);
            $table->dropForeign(['uacs_code_id']);
            $table->dropForeign(['created_by_id']);
        });

        Schema::table('purchase_request_items', function (Blueprint $table) {
            $table->dropForeign(['item_id']);
            $table->dropForeign(['purchase_request_id']);
            $table->dropForeign(['unit_of_measure_id']);
        });
        Schema::table('requisition_issues', function (Blueprint $table) {
            $table->dropForeign(['created_by_id']);
            $table->dropForeign(['end_user_id']);
            $table->dropForeign(['requested_by_id']);
            $table->dropForeign(['approved_by_id']);
        });
        Schema::table('requisition_issue_items', function (Blueprint $table) {
            $table->dropForeign(['requisition_issue_id']);
            $table->dropForeign(['item_id']);
            $table->dropForeign(['procurement_plan_item_id']);
            $table->dropForeign(['unit_of_measure_id']);
        });

        Schema::table('quotations', function (Blueprint $table) {
            $table->dropForeign(['purchase_request_id']);
            $table->dropForeign(['supplier_id']);
            $table->dropForeign(['prepared_by_id']);
            $table->dropForeign(['supplier_contact_id']);
        });

        Schema::table('quotation_items', function (Blueprint $table) {
            $table->dropForeign(['quotation_id']);
            $table->dropForeign(['purchase_request_item_id']);
        });

        Schema::table('supplier_categories', function (Blueprint $table) {
            $table->dropForeign(['supplier_id']);
            $table->dropForeign(['category_id']);
        });

        Schema::table('supplier_contacts', function (Blueprint $table) {
            $table->dropForeign(['supplier_id']);
        });

        Schema::table('user_groups', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['group_id']);
        });

        Schema::table('user_offices', function (Blueprint $table) {
            $table->dropForeign(['office_id']);
            $table->dropForeign(['user_id']);
        });
        
        Schema::table('user_informations', function (Blueprint $table) {
            $table->dropForeign(['position_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::table('vouchers', function (Blueprint $table) {
            $table->dropForeign(['purchase_request_id']);
            $table->dropForeign(['purchase_order_id']);
        });

        Schema::table('voucher_audits', function (Blueprint $table) {
            $table->dropForeign(['voucher_id']);
        });
    }
}
