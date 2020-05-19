<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    protected $categories = [
        [
            'id'            =>  1,
            'name'   =>  'Diaries',
            'description' => 'Diary product including liquid and powdered milk'
        ],
        [
            'id'            =>  2,
            'name'   =>  'Beverages',
            'description' => 'Beverages includes Tin,Sachet and other cocoa products '
        ],
        [
            'id'            =>  3,
            'name'   =>  'Cereals',
            'description' => 'Cereal products includes wheat,rice,millet and the likes'
        ],
        [
            'id'            =>  4,
            'name'   =>  'Spices',
            'description' => 'Aromatics used to season or flavour food'
        ],
        [
            'id'            =>  5,
            'name'   =>  'Toffee',
            'description' => 'Sweets and candy'
        ],


    ];
    
    
    public function run()
    {
         foreach ($this->categories as $index => $category)
        {
            $result = Category::create($category);
            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }
        $this->command->info('Inserted '.count($this->categories). ' records');
    }
}
