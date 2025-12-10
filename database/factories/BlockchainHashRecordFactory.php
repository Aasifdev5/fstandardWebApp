<?php

namespace Database\Factories;

use App\Models\BlockchainHashRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlockchainHashRecordFactory extends Factory
{
    protected $model = BlockchainHashRecord::class;

    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::inRandomOrder()->first()->id ?? 1,
            'for_date' => $this->faker->dateTimeBetween('-90 days'),
            'chain' => $this->faker->randomElement(['polygon-mumbai', 'hyperledger-india', 'bsc-testnet', 'polygon']),
            'tx_hash' => '0x' . $this->faker->sha256,
            'behaviour_metrics_hash' => $this->faker->sha256,
            'meta' => [
                'broker' => $this->faker->randomElement(['Zerodha', 'Upstox', 'Groww', 'Angel One', 'Dhan']),
                'exchange' => $this->faker->randomElement(['NSE', 'BSE']),
                'segment' => $this->faker->randomElement(['Equity', 'F&O', 'Currency']),
                'nse_order_id' => 'NSE' . $this->faker->numberBetween(100000, 999999),
            ],
        ];
    }
}
