<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['A', 'B', 'C'];

        foreach ($names as $name) {
            Group::factory()->create([
                'name' => $name,
            ]);
        }
    }
}
