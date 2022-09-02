<?php

namespace Database\Seeders;

use App\Models\Table;
use Illuminate\Database\Seeder;

class TablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tables = [
            ['number' => 1, 'is_taken' => false],
            ['number' => 2, 'is_taken' => false],
        ];

        Table::query()->upsert($tables, ['number'], ['number', 'is_taken']);
    }
}
