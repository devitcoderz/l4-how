<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string("banner_img")->nullable();
            $table->string("background_img")->nullable();
            $table->string("logo")->nullable();

            $table->string("code")->nullable();
            
            $table->string("instagram_link")->nullable();
            $table->string("discord_link")->nullable();
            $table->string("youtube_link")->nullable();
            $table->string("kick_link")->nullable();

            $table->string("bcgame_link")->nullable();

            $table->string("shadow_color")->nullable();
            $table->string("countdown_color")->nullable();
            
            $table->string("table_title_color")->nullable();
            $table->string("table_border_color")->nullable();
            $table->string("table_prizes_color")->nullable();
            $table->string("table_text_color")->nullable();


            $table->string("text_color")->nullable();

            $table->string("button_text_color")->nullable();
            $table->string("button_background_color")->nullable();
            $table->string("button_background_hover_color")->nullable();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
