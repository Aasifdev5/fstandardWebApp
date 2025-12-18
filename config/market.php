<?php

return [
    'volatility_by_class' => [
        'low'       => 0.08,
        'medium'    => 0.16,
        'high'      => 0.28,
        'very_high' => 0.45,
    ],
    'time_of_day_multipliers' => [
        'morning_open'   => 1.6, // 09:15–09:45
        'late_morning'   => 1.2, // 09:45–11:30
        'mid_day'        => 0.8, // 11:30–13:30
        'afternoon'      => 1.0, // 13:30–14:45
        'closing_hour'   => 1.5, // 14:45–15:30
        'evening_commod' => 1.3, // 18:00–23:30 (commodities)
    ],
    'regimes' => [
        'normal' => [
            'drift'                 => 0.00,
            'volatility_multiplier' => 1.0,
        ],
        'trend_up' => [
            'drift'                 => 0.06,
            'volatility_multiplier' => 1.2,
        ],
        'trend_down' => [
            'drift'                 => -0.06,
            'volatility_multiplier' => 1.2,
        ],
        'high_volatility' => [
            'drift'                 => 0.00,
            'volatility_multiplier' => 1.8,
        ],
        'crash' => [
            'drift'                 => -0.25,
            'volatility_multiplier' => 3.0,
        ],
    ],
    'risk_free_rate' => 0.06, // 6% per year for futures
    'base_option_volatility' => [
        'index'     => 0.16,
        'stock'     => 0.22,
        'commodity' => 0.28,
    ],
    'option_smile_strength' => 0.10,
    'news' => [
        'impact_by_sensitivity' => [
            'low'       => ['vol_multiplier' => 1.5, 'drift_boost' => 0.02],
            'medium'    => ['vol_multiplier' => 2.0, 'drift_boost' => 0.05],
            'high'      => ['vol_multiplier' => 3.0, 'drift_boost' => 0.10],
            'very_high' => ['vol_multiplier' => 4.0, 'drift_boost' => 0.15],
        ],
    ],
];
