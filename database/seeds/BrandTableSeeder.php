<?php

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandTableSeeder extends Seeder
{
    protected $brands = [
        [
            "id"            =>  1,
            "name"  =>  "Nestlé",
        ],
        [
            "id"            =>  2,
            "name"  =>  "Promasidor",
        ]
        
    ];
    
    
    public function run()
    {
         foreach ($this->brands as $index => $brand)
        {
            $result = Brand::create($brand);
            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }
        $this->command->info('Inserted '.count($this->brands). ' records');
    }
}
