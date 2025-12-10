<?php

namespace Database\Factories;

use App\Models\DelayedFeedAssignment;
use Illuminate\Database\Eloquent\Factories\Factory;

class DelayedFeedAssignmentFactory extends Factory
{
    protected $model = DelayedFeedAssignment::class;

    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::inRandomOrder()->first()->id ?? 1,
            'delay_seconds' => $this->faker->randomElement([30, 60, 90, 120, 180, 300]),
            'reason' => $this->faker->randomElement([
                'NSE feed delay during market open',
                'Broker API rate limit (Zerodha)',
                'F&O expiry congestion',
                'SEBI surveillance trigger',
                'High volatility – Budget Day',
                'Multiple broker logins detected',
            ]),
            'assigned_at' => now()->subHours($this->faker->numberBetween(1, 72)),
            'active' => $this->faker->boolean(70),
        ];
    }
}
