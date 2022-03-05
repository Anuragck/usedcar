<?php

namespace Database\Seeders;

use App\Models\ExpenseCategory;
use Illuminate\Database\Seeder;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExpenseCategory::create([
            'user_id' => 1,
            'name' => 'PETROL EXPENSES',
        ]);

        ExpenseCategory::create([
            'user_id' => 1,
            'name' => 'WASHING',
        ]);
        ExpenseCategory::create([
            'user_id' => 1,
            'name' => 'MAINTENANCE',
        ]);
        ExpenseCategory::create([
            'user_id' => 1,
            'name' => 'TRAVEL',
        ]);

    }
}
