<?php

namespace Database\Seeders;

use App\Models\BlockchainHashRecord;
use App\Models\DelayedFeedAssignment;
use App\Models\HedgingMonitor;
use App\Models\SlippageProfile;
use App\Models\User;
use Illuminate\Database\Seeder;

class RiskComplianceSeeder extends Seeder
{
    public function run()
    {
        // Get only real Indian users who have whatsapp_number (mobile)
        $indianUsers = User::whereNotNull('whatsapp_number')

            ->where('is_active', 1)
            ->inRandomOrder()
            ->limit(100)
            ->get();

        if ($indianUsers->count() < 5) {
            $this->command->error('Not enough Indian users with mobile number! Need at least 5.');
            return;
        }

        $this->command->info("Found {$indianUsers->count()} real Indian traders. Seeding compliance data...");

        // ===================================================================
        // 1. Blockchain Hash Records – Trade proof on Indian blockchain networks
        // ===================================================================
        BlockchainHashRecord::factory(150)->create([
            'user_id' => fn() => $indianUsers->random()->id,
            'for_date' => fn() => fake()->dateTimeBetween('-90 days', 'now'),
            'chain' => fn() => fake()->randomElement([
                'polygon-mumbai', 'hyperledger-india', 'cordapp-india', 'bsc-testnet', 'polygon'
            ]),
            'tx_hash' => fn() => '0x' . fake()->sha256,
            'behaviour_metrics_hash' => fn() => fake()->sha256,
            'meta' => fn() => [
                'broker' => fake()->randomElement(['Zerodha', 'Upstox', 'Angel One', 'Groww', 'Dhan', 'Fyers']),
                'segment' => fake()->randomElement(['Equity Cash', 'F&O', 'Currency', 'Commodity']),
                'nse_order_id' => 'NSE' . fake()->numberBetween(100000, 999999),
                'exchange' => fake()->randomElement(['NSE', 'BSE']),
            ],
        ]);

        // ===================================================================
        // 2. Delayed Feed Assignments – Very common in India
        // ===================================================================
        DelayedFeedAssignment::factory(90)->create([
            'user_id' => fn() => $indianUsers->random()->id,
            'delay_seconds' => fn() => fake()->randomElement([30, 60, 90, 120, 180, 300]),
            'reason' => fn() => fake('en_IN')->randomElement([
                'High volatility – Budget Day 2025',
                'NSE feed delayed during market open (09:15-09:30)',
                'Broker API rate limit exceeded (Zerodha/Upstox)',
                'SEBI surveillance flag triggered',
                'Multiple broker logins detected',
                'Abnormal order frequency (Algo trading)',
                'F&O expiry day congestion',
                'Circuit breaker hit on NIFTY',
            ]),
            'assigned_at' => fn() => now()->subHours(fake()->numberBetween(1, 72)),
            'active' => fn() => fake()->boolean(70),
        ]);

        // ===================================================================
        // 3. Hedging Monitor – Algo traders using 2 accounts
        // ===================================================================
        for ($i = 0; $i < 45; $i++) {
            $userA = $indianUsers->random();
            $userB = $indianUsers->where('id', '!=', $userA->id)->random();

            HedgingMonitor::create([
                'user_a' => $userA->id,
                'user_b' => $userB->id,
                'triggers' => collect([
                    'same_ip_different_broker' => true,
                    'mirror_trades_zerodha_upstox' => fake()->boolean(80),
                    'opposite_positions_same_script' => true,
                    'high_frequency_BANKNIFTY' => fake()->boolean(60),
                    'budget_day_arbitrage' => fake()->boolean(30),
                ])->filter()->keys()->all(),
                'hedging_score' => fake()->randomFloat(4, 0.76, 0.98),
                'action' => fake()->randomElement(['none', 'alert', 'fail']),
                'evidence' => [
                    'ip_address' => fake('en_IN')->ipv4,
                    'city' => fake('en_IN')->city,
                    'brokers' => fake()->randomElements(['Zerodha', 'Upstox', 'Angel One', 'Alice Blue', '5Paisa'], 2),
                    'scripts' => fake()->randomElements(['BANKNIFTY', 'NIFTY', 'RELIANCE', 'TCS', 'HDFCBANK', 'FINNIFTY'], 3),
                    'time_difference_sec' => fake()->numberBetween(1, 25),
                ],
            ]);
        }

        // ===================================================================
        // 4. Slippage Profiles – Per user tolerance (very important in India)
        // ===================================================================
        foreach ($indianUsers as $user) {
            SlippageProfile::create([
                'user_id' => $user->id,
                'min_slippage' => fake()->randomFloat(4, 0.0004, 0.0018),
                'max_slippage' => fake()->randomFloat(4, 0.008, 0.052),
                'symbol_overrides' => collect([
                    'RELIANCE' => ['max' => 0.007],
                    'TCS' => ['max' => 0.006],
                    'HDFCBANK' => ['max' => 0.009],
                    'ADANIENT' => ['max' => 0.038],
                    'YESBANK' => ['max' => 0.078],
                    'SUZLON' => ['max' => 0.095],
                    'JPPOWER' => ['max' => 0.12],
                    'BANKNIFTY' => ['max' => 0.018],
                ])->random(3)->all(),
                'time_overrides' => [
                    '09:15-09:45' => ['max' => 0.048],
                    '15:00-15:30' => ['max' => 0.042],
                    'budget_day' => ['max' => 0.09],
                ],
                'active' => fake()->boolean(88),
            ]);
        }

        $this->command->info('Indian Risk & Compliance data seeded successfully using REAL users!');
        $this->command->info("Total Indian users used: {$indianUsers->count()}");
    }
}
