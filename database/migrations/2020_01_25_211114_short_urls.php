<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ShortUrls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('short_urls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('long_url')->collation('utf8_unicode_ci');
            $table->string('short_code',25)->collation('utf8_unicode_ci');
            $table->integer('hits')->default(0);                        
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('short_urls');
    }
}
