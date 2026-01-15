<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Instrument;
use App\Models\PatternDefinition;
use App\Models\PatternExecution;
use App\Models\PatternState;
use App\Models\MarketSetting;

class RunMarketPatterns extends Command
{
    protected $signature = 'market:run-patterns';
    protected $description = 'Run pattern generation engine';

    public function handle()
    {
        $this->info('📈 Pattern Engine STARTED');

        while (true) {

            $config = MarketSetting::getSimulationConfig();
            $tickSpeed = (int) ($config['update_speed_ms'] ?? 2000);

            $definitions = PatternDefinition::all();
            $instruments = Instrument::where('is_active', true)->get();

            foreach ($instruments as $instrument) {
                foreach ($definitions as $definition) {

                    // 🔒 SAFE RANDOM GENERATION
                    if (rand(1, 100) > 97) {

                        $strength = rand(40, 90) / 100;

                        $execution = PatternExecution::create([
                            'instrument_id'         => $instrument->id,
                            'pattern_definition_id' => $definition->id,
                            'timeframe'             => '15m',
                            'strength'              => $strength,
                            'generated_by'          => 'SYSTEM',
                            'starts_at'             => now(),
                        ]);

                        // ───── SNAPSHOT STATE ─────
                        PatternState::updateOrCreate(
                            ['instrument_id' => $instrument->id],
                            [
                                'pattern'     => $definition->pattern_id,
                                'strength'    => $strength,
                                'detected_at' => now(),
                            ]
                        );
                    }
                }
            }

            usleep($tickSpeed * 1000);
        }
    }
}
