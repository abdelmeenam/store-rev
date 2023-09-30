<?php

return [
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'route' => 'dashboard.home',
        'title' => 'Dashboard',
        'active' => 'dashboard.home'
    ],
    [
        'icon' => 'fas fa-tags nav-icon',
        'route' => 'dashboard.categories.index',
        'title' => 'Categories',
        'badge' => 'Categories',
        'active' => 'dashboard.categories.*',
    ]
];
