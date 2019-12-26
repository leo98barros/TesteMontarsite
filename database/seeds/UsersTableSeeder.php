<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('users')->insert([
            'name' => 'Leonardo Sobral',
            'updated_at' => $now 
        ]);
        DB::table('users')->insert([
            'name' => 'Mário Amato',
            'updated_at' => $now 
        ]);
        DB::table('users')->insert([
            'name' => 'Fabrício Melgaço',
            'updated_at' => $now 
        ]);
        DB::table('users')->insert([
            'name' => 'Lucia Carmem',
            'updated_at' => $now 
        ]);
        DB::table('users')->insert([
            'name' => 'Heleonora Sato',
            'updated_at' => $now 
        ]);
        DB::table('users')->insert([
            'name' => 'Pillar Silva',
            'updated_at' => $now 
        ]);
        DB::table('users')->insert([
            'name' => 'Moira Neves',
            'updated_at' => $now 
        ]);
        DB::table('users')->insert([
            'name' => 'Montar Site',
            'updated_at' => $now 
        ]);
    }
}
