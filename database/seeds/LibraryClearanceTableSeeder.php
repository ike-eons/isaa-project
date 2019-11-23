<?php

use Illuminate\Database\Seeder;
use App\Models\LibraryClearance;
use Illuminate\Support\Facades\DB;

class LibraryClearanceTableSeeder extends Seeder
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

     public static function setLibraryClearance($studentid)
  {
    DB::table('libraryclearances')->insert([
        'student_id' => $studentid,
    ]);
  }
}
