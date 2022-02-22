<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('name');
			$table->integer('category_id')->unsigned();
			$table->integer('sub_category_id')->unsigned();
			$table->enum('course_type', ['Certified', 'Non-certified']);
			$table->decimal('price', 10, 2);
			$table->text('demo_url')->nullable();
			$table->string('banner_image');
			$table->integer('status')->unsigned();
			$table->uuid('user_id')->nullable();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('courses');
    }
}
