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
        'icon' => 'fas fa-shopping-cart nav-icon',
        'route' => 'dashboard.products.index',
        'title' => 'Products',
        'badge' => 'products',
        'active' => 'dashboard.products.*'
    ],
    [
        'icon' => 'fas fa-store-alt nav-icon ',
        'route' => 'dashboard.stores.index',
        'title' => 'Stores',
        'badge' => 'stores',
        'active' => 'dashboard.stores.*',
    ],

    [
        'icon' => 'fas fa-users nav-icon',
        'route' => 'dashboard.vendors.index',
        'title' => 'Vendors',
        'badge' => 'vendors',
        'active' => 'dashboard.vendors.*',
    ],

    [
        'icon' => 'fas fa-user-alt nav-icon',
        'route' => 'dashboard.users.index',
        'title' => 'Users',
        'badge' => 'users',
        'active' => 'dashboard.users.*',
    ],
    [
        'icon' => 'fas fa-money-check-alt nav-icon',
        'route' => 'dashboard.users.index',
        'title' => 'Orders',
        'badge' => 'orders',
        'active' => 'dashboard.users.*',
    ],

    [
        'icon' => 'fas fa-sign-out-alt nav-icon',
        'route' => 'logout',
        'title' => 'Logout',
        'active' => 'logout',
    ],


];
