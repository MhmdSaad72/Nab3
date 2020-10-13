<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('memberNumber')->nullable();
            $table->string('companyName')->nullable();
            $table->string('telephone')->nullable();
            $table->string('telephone2')->nullable();
            $table->string('telephone3')->nullable();
            $table->string('fax')->nullable();
            $table->string('zip')->nullable();
            $table->string('postBox')->nullable();
            $table->string('city')->nullable();
            $table->string('location')->nullable();
            $table->string('street')->nullable();
            $table->string('url')->nullable();
            $table->string('career')->nullable();
            $table->string('email')->nullable();
            $table->string('logo_path')->nullable();
            $table->text('bio')->nullable();
            $table->integer('pageView')->nullable();
            $table->string('fb')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->string('insta')->nullable();
            $table->boolean('status')->nullable();
            $table->boolean('featured')->nullable();
            $table->boolean('approved')->nullable();

            $table->integer('country_id')->unsigned()->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');

            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->integer('degree_id')->unsigned()->nullable();
            $table->foreign('degree_id')->references('id')->on('degrees')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('companies');
    }
}
