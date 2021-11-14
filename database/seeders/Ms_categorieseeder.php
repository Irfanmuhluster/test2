<?php

namespace Database\Seeders;

use App\Models\Ms_category;
use Illuminate\Database\Seeder;

class Ms_categorieseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $items =
        [
            [
                'name' => 'Incame',
            ],
            [
                'name' => 'Expense',
            ],
        ];

        Ms_category::insert($items);
    }
}
