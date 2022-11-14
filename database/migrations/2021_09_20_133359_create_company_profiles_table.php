<?php

use App\Models\CompanyProfile;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateCompanyProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('company_name', 50);
            $table->string('slogan')->nullable();
            $table->string('phone_1', 11);
            $table->string('phone_2', 11)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('address');
            $table->text('news_headline')->nullable();
            $table->string('logo')->nullable();

            $table->string('office_time')->nullable();
            $table->string('free_shipping')->nullable();
            $table->string('cashback')->nullable();
            // about 
            $table->text('about_title', 100)->nullable();
            $table->text('about_description')->nullable();
            $table->text('about_image')->nullable();
            // social link
            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            // welcome note
            $table->string('welcome_title', 100)->nullable();
            $table->text('welcome_note')->nullable();
            $table->text('welcome_image')->nullable();
            // mission and vision
            $table->string('mission_vision_title', 100)->nullable();
            $table->text('mission_vision')->nullable();
            //trams and condition 
            $table->string('trams_condition_title', 100)->nullable();
            $table->text('trams_condition')->nullable();

            // FAQ
            $table->string('faq_title', 200)->nullable();
            $table->text('faq_details')->nullable();

            // refound policy
            $table->string('refund_title', 100)->nullable();
            $table->text('refund_details')->nullable();

            $table->string('updated_by', 3)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

          // create a default user
          $user = new CompanyProfile();
          $user->company_name = 'Link Up Technology';
          $user->email = 'john@gmail.com';
          $user->phone_1 = 'admin';
          $user->address = 'admin';
          $user->about_title = 'about_title';
          $user->about_description = 'about_description';
          $user->welcome_title = 'welcome_title';
          $user->welcome_note = 'welcome_note';
          $user->welcome_image = 'welcome_image';
          $user->mission_vision_title = 'mission_vision_title';
          $user->mission_vision = 'mission_vision';
          $user->faq_title = 'faq_title';
          $user->faq_details = 'faq_details';
          $user->refund_title = 'refund_title';
          $user->refund_details = 'refund_details';
          $user->save();
        

    }

    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_profiles');
    }
}
