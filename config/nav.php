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
    ],
    [
        'icon' => 'fas fa-users nav-icon',
        'route' => 'dashboard.products.index',
        'title' => 'Products',
        'badge' => 'products',
         'active' => 'dashboard.products.*',
    ],
    [
        'icon' => 'fas fa-users nav-icon',
        'route' => 'dashboard.users.index',
        'title' => 'Users',
        'badge' => 'Users',
         'active' => 'dashboard.users.*',
    ],

    [
        'icon' => 'fas fa-sign-out-alt nav-icon',
        'route' => 'logout',
        'title' => 'Logout',
        'active' => 'logout',
    ],

];
