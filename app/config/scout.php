<?php

return [
    'driver' => 'elastic',
    
    'elastic' => [
        'hosts' => [
            'http://elasticsearch:9200'  // ← ПРЯМОЙ ХАРДКОД
        ],
        'ssl_verification' => false,
    ],
    
    'chunk' => [
        'searchable' => 500,
        'unsearchable' => 500,
    ],
];
