<?php

use Illuminate\Database\Seeder;
use App\Models\Customer;
use Faker\Factory;

class CustomersTableSeeder extends Seeder
{
    protected $customers = [
    
        [
            'id'                =>  1,
            'firstname'      => 'Ben',
            'lastname'           => 'Yeboah',
            'phone'             => '0550934305',
            'shop_name'             => 'B-Yagola Shop',
            'shop_address'             => 'Sego-Lane, Adum-Kumasi'
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
