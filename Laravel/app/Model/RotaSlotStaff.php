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

    public static function getReport(){
        $prev_stuff_id = false;
        $report_data = array();
        $per_day = array();
        $data =   \DB::table('rota_slot_staffs')
            ->orderBy('staff_id')
            ->orderBy('day_number')
            ->orderBy('start_time')
            ->orderBy('end_time')
            ->whereNotNull('staff_id')
            ->get();

        foreach($data as $row)
        {
            if($prev_stuff_id != $row->staff_id){
                $prev_stuff_id = $row->staff_id;
            }

            $report_data[$row->staff_id]['days'][$row->day_number]= array('slot_type'=>$row->slot_type,
                                                                          'start_time'=>$row->start_time,
                                                                          'end_time'=>$row->end_time);

            if(!isset($report_data[$row->staff_id]['total_hours'])){
                $report_data[$row->staff_id]['total_hours'] = 0;
            }
            $report_data[$row->staff_id]['total_hours'] += $row->work_hours;
            if(!isset($per_day[$row->day_number])){
                $per_day[$row->day_number]= 0;
            }

            $per_day[$row->day_number] += $row->work_hours;

            if($row->slot_type == 'shift'){
                $start_time_array = explode(':',$row->start_time);
                $end_time_array = explode(':',$row->end_time);
                if($end_time_array[0] < $start_time_array[0] ){
                    $end_time_array[0] = $end_time_array[0] +24;
                }

                $start_time = $start_time_array[0]*60+ $start_time_array[1];
                $end_time = $end_time_array[0]*60+ $end_time_array[1];

                $working_hours[$row->day_number][$row->staff_id] = array('start_time'=>$start_time, 'end_time' =>$end_time);
            }
        }

        ksort($report_data);
        $final_data['main'] =  $report_data;
        $final_data['per_day'] = $per_day;
        $final_data['work_alone'] = self::getWorkAlone($working_hours);

        return $final_data;
    }

    private static function tickToTime($time_tick){

        $hours =  floor($time_tick/60);
        $minutes = $time_tick - floor($time_tick/60)*60;
        if($hours > 24){
            $hours = $hours-24;
        }
        return str_pad($hours, 2, "0", STR_PAD_LEFT).":". str_pad($minutes, 2, "0", STR_PAD_LEFT).':00';
    }

    private static function getWorkAlone($working_hours){

        $start_time = 11*60;
        $end_time = (24+3)*60;

        for($w_day = 0; $w_day<=6; $w_day++ ){
            $work_alone_array = array();
            for($i = $start_time; $i <= $end_time; $i++ ){
                foreach($working_hours[$w_day] as $staff_id => $hours){
                    if($hours['start_time'] <= $i && $hours['end_time'] >= $i){
                        $work_alone_array[$i][] = $staff_id;
                    }
                }
                foreach($work_alone_array as $key=>$val){
                    if(count($val)>1){
                        unset($work_alone_array[$key]);
                    }
                }
            }
            $current = 0;
            foreach($work_alone_array as $time_tick => $staff){
                if($staff[0] != $current){
                    $work_alone_staff[$w_day][$staff[0]]['start_time'] = $time_tick;
                    if($current != 0){
                        $work_alone_staff[$w_day][$current]['end_time'] = $time_tick;
                    }
                    $current = $staff[0];
                }
            }
            if(isset($work_alone_staff[$w_day]) &&count($work_alone_staff[$w_day]) > 0){
                $work_alone_staff[$w_day][$current]['end_time'] = $time_tick;
            }

        }
        foreach( $work_alone_staff as $day => $staff){
            foreach ($staff as $staff_id=>$time){
                if(!isset($result[$staff_id]['total'])){
                    $result[$staff_id]['total'] = $time['end_time']-$time['start_time'];
                }
                else{
                    $result[$staff_id]['total'] += $time['end_time']-$time['start_time'];

                }
                $result[$staff_id][$day]['start_time'] =  self::tickToTime($time['start_time']);
                $result[$staff_id][$day]['end_time'] =  self::tickToTime($time['end_time']);
            }
        }

        return $result;
    }
}
