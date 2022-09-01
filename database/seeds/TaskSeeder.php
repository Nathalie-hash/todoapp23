<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // paire done , impaire pending
        for($i =0 ; $i< 10; $i++){
            $status = $i%2 != 0 ? "pending" : "done"; 
            DB::table('tasks')->insert([
                'title' => "Task number $i",
                'status' => $status,
                'created_at' => date('Y-m-d'),
                'updated_at' => null
            ]);
        }
    }
}
