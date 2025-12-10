<?php

namespace Database\Factories;

use App\Models\HedgingMonitor;
use Illuminate\Database\Eloquent\Factories\Factory;

class HedgingMonitorFactory extends Factory
{
    protected $model = HedgingMonitor::class;

    public function definition(): array
    {
        return [
            'user_a' => \App\Models\User::inRandomOrder()->first()->id,
            'user_b' => \App\Models\User::where('id', '!=', \App\Models\User::inRandomOrder()->first()->id)->first()->id ?? 1,
            'triggers' => ['same_ip_different_broker' => true, 'mirror_trades' => true],
            'hedging_score' => $this->faker->randomFloat(4, 0.76, 0.98),
            'action' => $this->faker->randomElement(['none', 'alert', 'fail']),
            'evidence' => json_encode([
                'ip' => $this->faker->ipv4,
                'brokers' => $this->faker->randomElements(['Zerodha', 'Upstox', 'Angel One'], 2),
            ]),
        ];
    }
}
