<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable()->default(null);
            $table->string('site_email')->nullable()->default(null);
            $table->string('footer_text')->nullable()->default(null);
            $table->string('site_phone')->nullable()->default(null);
            $table->string('site_address')->nullable()->default(null);
            $table->string('site_logo')->nullable()->default(null);
            $table->string('site_favicon')->nullable()->default(null);
            $table->string('site_copyright')->nullable()->default(null);
            $table->string('site_title')->nullable()->default(null);
            $table->string('site_description')->nullable()->default(null);
            $table->string('site_keywords')->nullable()->default(null);
            $table->string('site_facebook')->nullable()->default(null);
            $table->string('site_twitter')->nullable()->default(null);
            $table->string('site_instagram')->nullable()->default(null);
            $table->string('site_linkedin')->nullable()->default(null);
            $table->string('site_github')->nullable()->default(null);
            $table->string('site_skype')->nullable()->default(null);
            $table->string('sidebar_collapse')->default(false);
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
        Schema::dropIfExists('settings');
    }
}
