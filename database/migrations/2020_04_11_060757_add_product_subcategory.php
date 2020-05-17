<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductSubcategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_sub_category', function (Blueprint $table){
            $table->string("code", 300)->primary();
            $table->timestamps();
            $table->string("name", 300);
            $table->string("description", 1000)->nullable();
            $table->integer("sort_order")->nullable();
        });

        Schema::table('product', function (Blueprint $table) {
            $table->string("product_sub_category_code", 300)->nullable();
            $table->foreign("product_sub_category_code")->references("code")->on("product_sub_category");
            $table->string("display_image_filepath", 1000)->nullable();
            // Alters
            $table->integer("sort_order")->nullable()->change();
            $table->string("description", 5000)->nullable()->change();
            $table->string("external_url", 1500)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_sub_category');
        Schema::table('product', function (Blueprint $table) {
            $table->dropForeign("product_sub_category_code");
            $table->dropIndex("product_sub_category_code");
            $table->dropColumn("product_sub_category_code");
            $table->dropColumn("display_image_filepath");
            $table->dropColumn("external_reference_url");
        });
    }
}
