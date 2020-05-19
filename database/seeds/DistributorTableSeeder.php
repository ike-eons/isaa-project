<?php

use Illuminate\Database\Seeder;
use App\Models\Distributor;

class DistributorTableSeeder extends Seeder
{
    protected $distributors = [
    
        [
            'id'                =>  1,
            'company_name'      => 'M.OSEI AKOTO ENTERPRISE',
            'address'           => 'AMPABAME, AKWIMA-KWAWONMA',
            'phone'             => '0000000000',
            'email'             => 'test@test.com'
        ],
        
    ];

    public function run()
    {
        foreach ($this->distributors as $index => $distributor)
        {
            $result = Distributor::create($distributor);
            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }
        $this->command->info('Inserted '.count($this->distributors). ' records');
    }
}
