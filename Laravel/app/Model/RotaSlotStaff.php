<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RotaSlotStaff extends Model
{
    protected $fillable = array(
                        "id",
                        "rota_id",
                        "day_number",
                        "staff_id",
                        "slot_type",
                        "start_time",
                        "end_time",
                        "work_hours",
                        "premium_minutes",
                        "role_type_id",
                        "free_minutes",
                        "senior_cashier_minutes",
                        "split_shift_times"
                    );
}
