<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class AlterOrdersWithManyVouchers
 */
class AlterOrdersWithManyVouchers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('vouchers', 'order_id')) {
            Schema::table('vouchers', function (Blueprint $table) {
                $table->integer('order_id')->unsigned()->nullable()->after('id');
            });

            DB::statement("
				UPDATE vouchers v
				  INNER JOIN orders o ON o.voucher_id = v.id
				SET
				  v.order_id = o.id,
				  v.updated_at = UTC_TIMESTAMP()
	        ");

            Schema::table('vouchers', function (Blueprint $table) {
                $table->foreign('order_id')->references('id')->on('orders');
            });
        }

        /**
         * TODO for next release when app and third party is using voucher bulk inserts feature:
         * Old column voucher_id is obsolete. Drop column in the future when all data is verified
         *
         * if (Schema::hasColumn('voucher_id', 'orders')) {
         *     Schema::table('orders', function (Blueprint $table) {
         *         $table->dropColumn('voucher_id');
         *     });
         *     // TODO: DB: Consider deleting vouchers which hasnt any relation to orders table so the FK constraint is valid
         *     // TODO: DB: Afterwards change order_id column to be a required column and not nullable anymore
         *     // TODO: Models: Update models with new changes and remove the old voucher_id
         * }
         */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
