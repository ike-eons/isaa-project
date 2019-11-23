<?php

use Illuminate\Database\Seeder;

use App\Models\ClearanceValidator;

class ClearanceValidatorTableSeeder extends Seeder
{

    public function run()
    {
         ClearanceValidator::create([
            'fee'   => 0.00,
            'library'   => 0,
            'attendance'  => 0.00
        ]);
    }
}
