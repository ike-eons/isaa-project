<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\QualityAssurance;

class QualityAssuranceTableSeeder extends Seeder
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

       public static function setQualityAssurance($studentid)
  {
    DB::table('qualityassurances')->insert([
        'student_id' => $studentid,
    ]);
  }
}
