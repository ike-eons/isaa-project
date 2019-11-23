<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Fee;

class FeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    }
    public static function setFee($studentid)
    {
        DB::table('fees')->insert([
            'student_id' => $studentid,
        ]);
    }
}
