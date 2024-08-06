<?php

return [
    'max_attempts' => env('RATE_LIMITER_MAX_ATTEMPTS', 5),
    'decay_minutes' => env('RATE_LIMITER_DECAY_MINUTES', 1),
];
