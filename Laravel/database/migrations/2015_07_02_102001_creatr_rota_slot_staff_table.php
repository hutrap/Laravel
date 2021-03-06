<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatrRotaSlotStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rota_slot_staffs', function(Blueprint $table)
        {

            $table->increments('id');
            $table->integer('rota_id')->unsigned();
            $table->tinyInteger('day_number')->unsigned();
            $table->integer('staff_id')->unsigned()->nullable();
            $table->string('slot_type',20);
            $table->time('start_time')->nullable()->nullable();
            $table->time('end_time')->nullable();
            $table->float('work_hours', 4, 2);
            $table->tinyInteger('premium_minutes')->unsigned()->nullable();
            $table->integer('role_type_id')->nullable();
            $table->tinyInteger('free_minutes')->unsigned()->nullable();
            $table->tinyInteger('other_value')->unsigned()->nullable();
            $table->tinyInteger('senior_cashier_minutes')->unsigned()->nullable();
            $table->string('split_shift_times',11)->nullable();
// TODO have a problem with index. HAve no time to look at this now.
//            $table->unique([`rota_id`,`staff_id`]);
//            $table->unique(`day_number`);
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
        //
    }
}
