<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Shield Resource Config
    |--------------------------------------------------------------------------
    */
    'shield_resource' => [
        'should_register_navigation' => true, // <- Aquí decides si aparece en el panel
        'slug' => 'shield/roles',
        'navigation_sort' => -1,
        'navigation_badge' => true,
        'navigation_group' => true,
        'sub_navigation_position' => null,
        'is_globally_searchable' => false,
        'show_model_path' => true,
        'is_scoped_to_tenant' => true,
        'cluster' => null,
    ],

    /*
    |--------------------------------------------------------------------------
    | Tenant Model (multi-tenancy)
    |--------------------------------------------------------------------------
    */
    'tenant_model' => null,

    /*
    |--------------------------------------------------------------------------
    | Auth Provider Model
    |--------------------------------------------------------------------------
    */
    'auth_provider_model' => [
        'fqcn' => 'App\\Models\\User',
    ],

    /*
    |--------------------------------------------------------------------------
    | Super Admin Role
    |--------------------------------------------------------------------------
    */
    'super_admin' => [
        'enabled' => true,
        'name' => 'super_admin',
        'define_via_gate' => false,
        'intercept_gate' => 'before', // after
    ],

    /*
    |--------------------------------------------------------------------------
    | Panel User Role
    |--------------------------------------------------------------------------
    */
    'panel_user' => [
        'enabled' => true,
        'name' => 'panel_user',
    ],

    /*
    |--------------------------------------------------------------------------
    | Permission Prefixes
    |--------------------------------------------------------------------------
    */
    'permission_prefixes' => [
        'resource' => [
            'view',
            'view_any',
            'create',
            'update',
            'restore',
            'restore_any',
            'replicate',
            'reorder',
            'delete',
            'delete_any',
            'force_delete',
            'force_delete_any',
        ],
        'page' => 'page',
        'widget' => 'widget',
    ],

    /*
    |--------------------------------------------------------------------------
    | Entities (habilitar permisos para)
    |--------------------------------------------------------------------------
    */
    'entities' => [
        'pages' => true,
        'widgets' => true,
        'resources' => true,
        'custom_permissions' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Generator
    |--------------------------------------------------------------------------
    */
    'generator' => [
        'option' => 'policies_and_permissions',
        'policy_directory' => 'Policies',
        'policy_namespace' => 'Policies',
    ],

    /*
    |--------------------------------------------------------------------------
    | Exclude
    |--------------------------------------------------------------------------
    */
    'exclude' => [
        'enabled' => true,

        'pages' => [
            'Dashboard',
        ],

        'widgets' => [
            'AccountWidget',
            'FilamentInfoWidget',
        ],

        'resources' => [
            //App\Filament\Resources\UserResource::class,
            //App\Filament\Resources\FormularioInscripcionResource::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Discovery
    |--------------------------------------------------------------------------
    */
    'discovery' => [
        'discover_all_resources' => true,
        'discover_all_widgets' => true,
        'discover_all_pages' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Register Role Policy
    |--------------------------------------------------------------------------
    */
    'register_role_policy' => [
        'enabled' => true, // <- ESTA es la línea clave que a veces falta
    ],
];
