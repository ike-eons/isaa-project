<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(BrandTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(DistributorTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        // $this->call(InvoiceTableSeeder::class);
        
    }
}
