<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_details', function (Blueprint $table) {
            $table->increments('id',11);
            $table->integer('account_id')->unsigned()->nullable();
            //$table->foreign('account_id')->references('id')->on('account_types');
            $table->string('full_name', 70)->nullable();
            $table->string('gender', 70)->nullable();
            $table->string('doctorqualification',70)->nullable();
            $table->string('slefemp_emplaye',70)->nullable();
            $table->string('orgnization_name', 70)->nullable();
            $table->string('state_city', 70)->nullable();
            $table->string('landmark_pincode',70)->nullable();
            $table->string('avl_days',70)->nullable();
            $table->string('from_time', 70)->nullable();
            $table->string('to_time', 70)->nullable();
            $table->string('consul_fee_from',70)->nullable();
            $table->string('consul_fee_to',70)->nullable();
            $table->string('instagram_url', 70)->nullable();
            $table->string('youth_profile_url', 70)->nullable();
            $table->string('twiter_profile_url',70)->nullable();
            $table->string('doctorachievement_file',70)->nullable();
            $table->string('designation', 70)->nullable();
            $table->string('department', 70)->nullable();
            $table->string('total_experience',70)->nullable();
            $table->text('location')->nullable();
            $table->string('mobile', 70)->nullable();
            $table->string('email', 70)->nullable();
            $table->string('website_url',70)->nullable();
            $table->string('social_media_link',70)->nullable();
            $table->text('description')->nullable();
            $table->string('comments', 70)->nullable();
            $table->string('star_ratings',70)->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('etablished_year', 70)->nullable();
            $table->string('type_hospital', 70)->nullable();
            $table->string('specialized',70)->nullable();
            $table->string('telephone',70)->nullable();
            $table->string('achievement_award')->nullable();
            $table->enum('multi_specialist',['0','1'])->nullable();
            $table->text('available_test')->nullable();
            $table->string('course_offered')->nullable();
            $table->timestamp('last_date_of_apply')->nullable()->default(null);
            $table->string('total_vacancy', 70)->nullable();
            $table->timestamp('exam_date')->nullable()->default(null);
            $table->string('references_site',70)->nullable();
            $table->string('references_hos_doc',70)->nullable();
            $table->string('doc_profile')->nullable();
            $table->text('prime_contain')->nullable();
            $table->string('sec_contain')->nullable();
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
        Schema::dropIfExists('customer_details');
    }
}
