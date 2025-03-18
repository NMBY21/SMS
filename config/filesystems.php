<?php

return [
    'title' => 'School Management System',
    'path' => 'admin',
    'middleware' => ['web', 'auth'],
    'auth' => [
        'guard' => 'web',
        'provider' => 'users',
    ],
    'resources' => [
        'grades' => [
            'label' => 'Grades',
            'icon' => 'heroicon-o-collection',
        ],
        'students' => [
            'label' => 'Students',
            'icon' => 'heroicon-o-user-group',
        ],
        'teachers' => [
            'label' => 'Teachers',
            'icon' => 'heroicon-o-user',
        ],
        'subjects' => [
            'label' => 'Subjects',
            'icon' => 'heroicon-o-book-open',
        ],
    ],
    'dark_mode' => false,
    'notification' => [
        'enabled' => true,
    ],
];