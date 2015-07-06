<?php

use Illuminate\Database\Seeder;
use App\Model\RotaSlotStaff;

class RotaSlotStaffTableSeeder extends Seeder {

    public function run()
    {
        DB::table('rota_slot_staffs')->delete();
        $handle = fopen(database_path()."/seeds/RotaSlotData.data", "r");
        $columns = array();
        if ($handle) {
            $counter = 0;
            while (($line = fgets($handle)) !== false) {
                $row = array();
                $line_array = explode(', ',$line);
                if($counter == 0){
                    $columns = $line_array;
                }
                else{
                    foreach($columns as $key=>$val)
                    {
                        if(ltrim(rtrim($line_array[$key])) != 'NULL'){
                            $row[$val] = str_replace("'","",$line_array[$key]);
                        }
                    }
                    RotaSlotStaff::create($row);
                }
                $counter++;
            }
            fclose($handle);
        } else {
            // error opening the file.
        }

    }
}