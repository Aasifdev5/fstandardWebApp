<?php

return [
    // Reference: PDF Page 1 & 4 [cite: 22-28, 107-111]
    'base_rupee_per_point' => 75,
    'reference_price'      => 24000,
    'reference_account'    => 1000000,

    // Reference: PDF Page 2 [cite: 36-53]
    'lot_multipliers' => [
        'micro'    => 0.60,
        'mini'     => 0.75,
        'standard' => 1.00,
        'large'    => 1.25,
        'mega'     => 1.50,
    ],

    // Reference: PDF Page 3 [cite: 57-93]
    'instrument_multipliers' => [
        'FSI-NF50-F'     => 1.00,
        'FSI-BN-F'       => 1.35,
        'FSI-SENSEX-F'   => 1.15,
        'FSI-FN-F'       => 0.80,
        'FSI-MIDCP-F'    => 0.70,
        'FSI-RIL-F'      => 0.35,
        'FSI-HDFB-F'     => 0.30,
        'FSI-ICBK-F'     => 0.28,
        'FSI-INFY-F'     => 0.26,
        'FSI-TCS-F'      => 0.24,
        'FSI-SBIN-F'     => 0.22,
        'FSI-ADAN-F'     => 0.45,
        'FSI-TATA-MTR-F' => 0.40,
        'FSI-JSW-F'      => 0.38,
        'FSI-LT-F'       => 0.36,
    ],
];
