<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() {
        UserRole::create(['name' => 'admin']);
        UserRole::create(['name' => 'user']);
        UserRole::create(['name' => 'hod']);
    }
    
}
