<?php

use Illuminate\Database\Seeder;
use App\Models\Customer;
use Faker\Factory;

class CustomersTableSeeder extends Seeder
{
    protected $customers = [
    
        [
            'id'                =>  1,
            'firstname'      => 'Unknown',
            'lastname'           => 'Unknown',
            'phone'             => '0000000000',
            'shop_name'             => 'Unkown',
            'shop_address'             => 'Unknown'
        ],
        [
            'id'                =>  2,
            'firstname'      => 'Glady',
            'lastname'           => 'Obour',
            'phone'             => '0206332734',
            'shop_name'             => 'Mama Stone\'s Shop',
            'shop_address'             => 'Central Market, Kejetia-Kumasi'
        ],
        [
            'id'                =>  3,
            'firstname'      => 'Ernest',
            'lastname'           => 'Yeboah',
            'phone'             => '0550900305',
            'shop_name'             => 'Godsway Supermarket',
            'shop_address'             => 'Santasi, Adum-Kumasi'
        ]
        
    ];
    public function run()
    {
         foreach ($this->customers as $index => $customer)
        {
            $result = Customer::create($customer);
            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }
        $this->command->info('Inserted '.count($this->customers). ' records');
    } 
    
}
