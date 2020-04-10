<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddDataProductBrandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_brand', function ($table) {
            $table->integer("sort_order")->nullable()->change();
        });

        DB::table("product_brand")->insert([
            [
                "code" => "BRUKER",
                "name" => "Bruker",
                "description" => "Bruker",
                "sort_order" => null
            ],
            [
                "code" => "PERKIN_ELMER",
                "name" => "Perkin Elmer",
                "description" => "Perkin Elmer",
                "sort_order" => null
            ],
            [
                "code" => "BELLINGHAM_STANLEY",
                "name" => "Bellingham + Stanley",
                "description" => "Bellingham + Stanley",
                "sort_order" => null
            ],
            [
                "code" => "EBRO",
                "name" => "Ebro",
                "description" => "Ebro",
                "sort_order" => null
            ],
            [
                "code" => "PRIMELAB",
                "name" => "PrimeLab",
                "description" => "PrimeLab",
                "sort_order" => null
            ],
            [
                "code" => "PICKERING_LABORATORIES",
                "name" => "Pickering Laboratories",
                "description" => "Pickering Laboratories",
                "sort_order" => null
            ],
            [
                "code" => "OTHERS",
                "name" => "Others",
                "description" => "Others",
                "sort_order" => null
            ]
        ]);
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
