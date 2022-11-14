<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <72 ; $i++) { 
           Permission::create([
                'user_id' => 1,
                'page_id' => $i,
                'status' => 1
           ]);
        }
        
    }
}
