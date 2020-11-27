<?php


return [
    'documentation' => [
        'url' => env('DOCUMENTATION_URL', 'http://localhost:8010'),
        'database' => env('DOCUMENTATION_DATABASE', 'cititrust_documentation'),
    ],

    'approval' => [
        'url' => env('APPROVAL_URL', 'http://localhost:8020'),
        'database' => env('APPROVAL_DATABASE', 'cititrust_approval'),
    ],

    'attendance' => [
        'url' => env('ATTENDANCE_URL', 'http://localhost:8030'),
        'database' => env('ATTENDANCE_DATABASE', 'cititrust_attendance')
    ],
];




?>