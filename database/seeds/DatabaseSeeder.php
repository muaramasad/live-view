<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Eloquent::unguard();
        //call uses table seeder class
  		$this->call('ProvincesTableSeeder');
        //this message shown in your terminal after running db:seed command
        $this->command->info("Provinces table seeded :)");
    }
}
