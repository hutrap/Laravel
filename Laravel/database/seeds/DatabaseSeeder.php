<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('CommentTableSeeder');
        $this->command->info('Comment table seeded.');
        $this->call('TmpTableSeeder');
        $this->command->info('Tmp table seeded.');
        $this->call('RotaSlotStaffTableSeeder');
        $this->command->info('RotaSlotStaff table seeded.');
        Model::reguard();
    }
}
