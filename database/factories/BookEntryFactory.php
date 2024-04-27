<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Account;
use App\Models\BookEntry;

class BookEntryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BookEntry::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->dateTime(),
            'debit' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'credit' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'account_id' => Account::factory(),
            'status' => $this->faker->word(),
        ];
    }
}
