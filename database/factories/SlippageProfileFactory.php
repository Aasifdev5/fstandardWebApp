<?php

namespace Database\Factories;

use App\Models\SlippageProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class SlippageProfileFactory extends Factory
{
    protected $model = SlippageProfile::class;

    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::inRandomOrder()->first()->id ?? 1,
            'min_slippage' => $this->faker->randomFloat(4, 0.0004, 0.0018),
            'max_slippage' => $this->faker->randomFloat(4, 0.008, 0.052),
            'symbol_overrides' => [
                'RELIANCE' => ['max' => 0.007],
                'HDFCBANK' => ['max' => 0.009],
                'SUZLON' => ['max' => 0.095],
            ],
            'time_overrides' => [
                '09:15-09:45' => ['max' => 0.048],
                '15:00-15:30' => ['max' => 0.042],
            ],
            'active' => true,
        ];
    }
}
