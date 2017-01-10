<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CopyaRestaurantMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->boolean('smoking');
            $table->timestamps();
        });

        Schema::create('tables', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->integer('area_id')->unsigned();
            $table->integer('capacity');
            $table->timestamps();

            $table->foreign('area_id')
                ->references('id')->on('areas');
        });

        Schema::create('statuses', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create('reservations', function(Blueprint $table){
            $table->increments('id');
            $table->string('customer_name');
            $table->string('email');
            $table->integer('guest_count');
            $table->integer('area_id')->unsigned();
            $table->string('phone');
            $table->boolean('is_agent');
            $table->float('amount');
            $table->float('discount');
            $table->float('deposit');
            $table->integer('status_id')->unsigned();
            $table->text('note');
            $table->timestamps();

            $table->foreign('area_id')
                ->references('id')->on('areas');
            $table->foreign('status_id')
                ->references('id')->on('statuses');
        });

        Schema::create('reservation_table', function(Blueprint $table){
            $table->increments('id');
            $table->integer('reservation_id')->unsigned();
            $table->integer('table_id')->unsigned();
            $table->timestamps();

            $table->foreign('reservation_id')
                ->references('id')->on('reservations');
            $table->foreign('table_id')
                ->references('id')->on('tables');
        });

        Schema::create('orders', function(Blueprint $table){
            $table->increments('id');
            $table->string('customer_name');
            $table->string('phone');
            $table->string('email');
            $table->integer('status_id')->unsigned();
            $table->float('amount');
            $table->float('discount');
            $table->text('note');
            $table->timestamps();
        });

        Schema::create('products', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->float('price');
            $table->float('sale_price');
            $table->integer('category_id')->unsigned();
            $table->string('featured_image');
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')->on('categories');
        });

        Schema::create('cuisines', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->float('price');
            $table->float('sale_price');
            $table->integer('category_id')->unsigned();
            $table->boolean('pre_orderable');
            $table->string('featured_image');
            $table->timestamps();
            $table->foreign('category_id')
                ->references('id')->on('categories');
        });

        Schema::create('cuisine_reservation', function(Blueprint $table){
            $table->increments('id');
            $table->integer('cuisine_id')->unsigned();
            $table->integer('reservation_id')->unsigned();
            $table->float('price');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('cuisine_id')
                ->references('id')->on('cuisines');
            $table->foreign('reservation_id')
                ->references('id')->on('reservations');
        });

        Schema::create('orderables', function(Blueprint $table){
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('orderable_id');
            $table->string('orderable_type');
            $table->float('price');
            $table->integer('quantity');
            $table->timestamps();
        });

        Schema::create('feedbacks', function(Blueprint $table){
            $table->increments('id');
            $table->string('customer_name');
            $table->tinyInteger('rating');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('timelines', function(Blueprint $table){
            $table->increments('id');
            $table->integer('timelineable_id');
            $table->string('timelineable_type');
            $table->integer('status_id')->unsigned();
            $table->timestamps();

            $table->foreign('status_id')
                ->references('id')->on('statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('timelines');
        Schema::drop('feedbacks');
        Schema::drop('orderables');
        Schema::drop('cuisine_reservation');
        Schema::drop('cuisines');
        Schema::drop('products');
        Schema::drop('orders');
        Schema::drop('reservation_table');
        Schema::drop('reservations');
        Schema::drop('statuses');
        Schema::drop('tables');
        Schema::drop('areas');
    }
}
