<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL', null),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => 'en_US',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,
        /*
         * Package Service Providers...
         */
        Yajra\DataTables\DataTablesServiceProvider::class,
        Intervention\Image\ImageServiceProvider::class,
        Barryvdh\DomPDF\ServiceProvider::class,
        App\Providers\ModServiceProvider::class,
        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [

        'App' => Illuminate\Support\Facades\App::class,
        'Arr' => Illuminate\Support\Arr::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,
        'Auth' => Illuminate\Support\Facades\Auth::class,
        'Blade' => Illuminate\Support\Facades\Blade::class,
        'Broadcast' => Illuminate\Support\Facades\Broadcast::class,
        'Bus' => Illuminate\Support\Facades\Bus::class,
        'Cache' => Illuminate\Support\Facades\Cache::class,
        'Config' => Illuminate\Support\Facades\Config::class,
        'Cookie' => Illuminate\Support\Facades\Cookie::class,
        'Crypt' => Illuminate\Support\Facades\Crypt::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'Eloquent' => Illuminate\Database\Eloquent\Model::class,
        'Event' => Illuminate\Support\Facades\Event::class,
        'File' => Illuminate\Support\Facades\File::class,
        'Gate' => Illuminate\Support\Facades\Gate::class,
        'Hash' => Illuminate\Support\Facades\Hash::class,
        'Lang' => Illuminate\Support\Facades\Lang::class,
        'Log' => Illuminate\Support\Facades\Log::class,
        'Mail' => Illuminate\Support\Facades\Mail::class,
        'Notification' => Illuminate\Support\Facades\Notification::class,
        'Password' => Illuminate\Support\Facades\Password::class,
        'DataTables' => Yajra\DataTables\Facades\DataTables::class,
        'Queue' => Illuminate\Support\Facades\Queue::class,
        'Redirect' => Illuminate\Support\Facades\Redirect::class,
        'Redis' => Illuminate\Support\Facades\Redis::class,
        'Request' => Illuminate\Support\Facades\Request::class,
        'Response' => Illuminate\Support\Facades\Response::class,
        'Route' => Illuminate\Support\Facades\Route::class,
        'Schema' => Illuminate\Support\Facades\Schema::class,
        'Session' => Illuminate\Support\Facades\Session::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
        'Str' => Illuminate\Support\Str::class,
        'Image' => Intervention\Image\Facades\Image::class,
        'URL' => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View' => Illuminate\Support\Facades\View::class,
        'PDF' => Barryvdh\DomPDF\Facade::class,
        'Mod' => App\Helpers\Mod::class,
        'Specialization' => App\Specialization::class,
    ],
    'api_url' => 'http://dms_test',
    'features' => [
        [
            'name' => 'Order Management',
            'slug' => 'order_management',
            'icon' => 'mdi-view-dashboard',
            'child' => [
                [
                    'name' => 'Sales Order',
                    'slug' => 'sales_order',
                    'table' => 'so_header',
                    'table_detail' => 'so_lines',
                    'index' => [
                        'column' => ['creation_date', 'so_number', 'id_customer', 'grand_total', 'status'],
                        'filter' => [
                            [
                                'column' => 'creation_date'
                            ],
                            [
                                'column' => 'id_customer'
                            ],
                            [
                                'column' => 'status'
                            ]
                        ]
                    ]
                ],
                [
                    'name' => 'Shipping',
                    'slug' => 'shipping',
                    'table' => 'ship_deliveries',
                    'table_detail' => 'so_lines',
                    'table_detail_references' => 'id_so_header',
                    'index' => [
                        'column' => ['creation_date', 'id_so_header','id_so_header.id_customer', 'status'],
                        'filter' => [
                            [
                                'column' => 'creation_date'
                            ],
                            [
                                'column' => 'id_so_header.id_customer'
                            ],
                            [
                                'column' => 'status',
                                'value' => [
                                    [
                                        'id' => 'draft',
                                        'name' => 'Draft'
                                    ],
                                    [
                                        'id' => 'disetujui',
                                        'name' => 'Disetujui'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            
        ],
        [
            'name' => 'Receivable',
            'slug' => 'receivable',
            'icon' => 'mdi-view-dashboard',
            'child' => [
                [
                    'name' => 'Master Customers',
                    'slug' => 'master_customer',
                    'table' => 'customer_header',
                    'table_detail' => 'customer_line',
                    'index' => [
                        'column' => ['customer_code', 'customer_name','inactive_date'],
                        'filter' => [
                            [
                                'column' => 'inactive_date'
                            ],
                        ]
                    ]
                ],
                [
                    'name' => 'Master Bank',
                    'slug' => 'master_bank',
                    'table' => 'bank_header',
                    'table_detail' => 'bank_line',
                    'index' => [
                        'column' => ['bank_number', 'bank_code','bank_name', "inactive_date"],
                        'filter' => [
                            [
                                'column' => 'inactive_date',
                            ],
                        ]
                    ]
                ],
                [
                    'name' => 'Sales Invoice',
                    'slug' => 'sales_invoice',
                    'table' => 'sales_invoice_header',
                    'table_detail' => 'sales_invoice_line',
                    'index' => [
                        'column' => ['creation_date', 'invoice_number','id_customer', "status"],
                        'filter' => [
                            [
                                'column' => 'creation_date',
                            ],
                            [
                                'column' => 'id_customer',
                            ],
                            [
                                'column' => 'status',
                                'value' => [
                                    [
                                        'id' => 'draft',
                                        'name' => 'Draft'
                                    ],
                                    [
                                        'id' => 'disetujui',
                                        'name' => 'Disetujui'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    'name' => 'Cash Receipt',
                    'slug' => 'cash_receipt',
                    'table' => 'cash_receipt_header',
                    'table_detail' => 'cash_receipt_line',
                    'index' => [
                        'column' => ['creation_date', 'receipt_number','id_customer', 'receipt_method', "status"],
                        'filter' => [
                            [
                                'column' => 'creation_date',
                            ],
                            [
                                'column' => 'id_customer',
                            ],
                            [
                                'column' => 'receipt_method',
                                'value' => [
                                    [
                                        'id' => 'cek',
                                        'name' => 'Cek'
                                    ],
                                    [
                                        'id' => 'b/g',
                                        'name' => 'B/G'
                                    ],
                                    [
                                        'id' => 't/t',
                                        'name' => 'T/T'
                                    ],
                                ]
                            ],
                            [
                                'column' => 'status',
                                'value' => [
                                    [
                                        'id' => 'draft',
                                        'name' => 'Draft'
                                    ],
                                    [
                                        'id' => 'disetujui',
                                        'name' => 'Disetujui'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
            ],
            
        ],
        [
            'name' => 'Purchasing',
            'slug' => 'purchasing',
            'icon' => 'mdi-view-dashboard',
            'child' => [
                [
                    'name' => 'Purchase Order',
                    'slug' => 'purchase_order',
                    'table' => 'po_header',
                    'table_detail' => 'po_line',
                    'index' => [
                        'column' => ['creation_date', 'po_number','id_supplier', 'grand_total', "status"],
                        'filter' => [
                            [
                                'column' => 'creation_date',
                            ],
                            [
                                'column' => 'id_supplier',
                            ],
                            [
                                'column' => 'status',
                                'value' => [
                                    [
                                        'id' => 'draft',
                                        'name' => 'Draft'
                                    ],
                                    [
                                        'id' => 'disetujui',
                                        'name' => 'Disetujui'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    'name' => 'Receive',
                    'slug' => 'receive',
                    'table' => 'rcv_header',
                    'table_detail' => 'rcv_line',
                    'index' => [
                        'column' => ['creation_date', 'rcv_date','id_supplier', "description"],
                        'filter' => [
                            [
                                'column' => 'creation_date',
                            ],
                            [
                                'column' => 'id_supplier',
                            ]
                        ]
                    ]
                ],
                [
                    'name' => 'Return Receive',
                    'slug' => 'return_receive',
                    'table' => 'rcv_header',
                    'table_detail' => 'rcv_line',
                    'index' => [
                        'column' => ['creation_date', 'rcv_date','id_supplier', "description"],
                        'filter' => [
                            [
                                'column' => 'creation_date',
                            ],
                            [
                                'column' => 'id_supplier',
                            ]
                        ]
                    ]
                ]
            ]
        ],
        [
            'name' => 'Payable',
            'slug' => 'payable',
            'icon' => 'mdi-view-dashboard',
            'child' => [
                [
                    'name' => 'Master Suppliers',
                    'slug' => 'master_suppliers',
                    'table' => 'supplier_header',
                    'table_detail' => 'supplier_line',
                    'index' => [
                        'column' => ['supplier_code', 'supplier_name','payment_terms', "inactive_date"],
                        'filter' => [
                            [
                                'column' => 'inactive_date',
                            ]
                        ]
                    ]
                ],
                [
                    'name' => 'Payment Term',
                    'slug' => 'payment_term',
                    'table' => 'payment_term_header',
                    'table_detail' => 'payment_term_line',
                    'index' => [
                        'column' => ['description', 'type','efective_date_from', "efective_date_to"],
                        'filter' => [
                            [
                                'column' => 'efective_date_from',
                            ],
                            [
                                'column' => 'efective_date_to',
                            ]
                        ]
                    ]
                ],
                [
                    'name' => 'Purchase Invoice',
                    'slug' => 'purchase_invoice',
                    'table' => 'purchase_invoice_header',
                    'table_detail' => 'purchase_invoice_line',
                    'index' => [
                        'column' => ['creation_date', 'invoice_number','id_customer', "status"],
                        'filter' => [
                            [
                                'column' => 'creation_date',
                            ],
                            [
                                'column' => 'id_customer'
                            ]
                        ]
                    ]
                ],
                [
                    'name' => 'Payment',
                    'slug' => 'payment',
                    'table' => 'payment_header',
                    'table_detail' => 'payment_line',
                    'index' => [
                        'column' => ['creation_date', 'payment_number','id_supplier', 'grand_total', "status"],
                        'filter' => [
                            [
                                'column' => 'creation_date',
                            ],
                            [
                                'column' => 'id_supplier',
                            ]
                        ]
                    ]
                ],
            ]
        ],
        [
            'name' => 'Inventory',
            'slug' => 'inventory',
            'icon' => 'mdi-view-dashboard',
            'child' => [
                [
                    'name' => 'Master Item',
                    'slug' => 'master_item',
                    'table' => 'master_item',
                    'index' => [
                        'column' => ['item_code', 'item_description','category', "status"],
                        'filter' => [
                            [
                                'column' => 'inactive_date',
                            ]
                        ]
                    ]
                ],
                [
                    'name' => 'Master Warehouse',
                    'slug' => 'master_warehouse',
                    'table' => 'warehouse_header',
                    'table_detail' => 'warehouse_line',
                    'index' => [
                        'column' => ['location_code', 'description', "status"]
                    ]
                ],
                [
                    'name' => 'Stock Onhand',
                    'slug' => 'stock_onhand',
                    'table' => 'master_item',
                    'table_detail' => 'item_stock_onhand',
                    'index' => [
                        'column' => ['id_item', 'id_warehouse','primary_quantity', "primary_uom"],
                        'filter' => [
                            [
                                'column' => 'id_warehouse',
                            ]
                        ]
                    ]
                ],
                [
                    'name' => 'Material Transactions',
                    'slug' => 'material_transactions',
                    'table' => 'master_item',
                    'table_detail' => 'material_transaction',
                    'index' => [
                        'column' => ['transaction_date', 'id_item','transaction_quantity', "primary_quantity"],
                        'filter' => [
                            [
                                'column' => 'transaction_date',
                            ]
                        ]
                    ]
                ],
                [
                    'name' => 'Move Order',
                    'slug' => 'move_order',
                    'table' => 'move_order_header',
                    'table_detail' => 'move_order_line',
                    'index' => [
                        'column' => ['transaction_date', 'mo_number','transaction_type', "status"],
                        'filter' => [
                            [
                                'column' => 'inactive_date',
                            ]
                        ]
                    ]
                ],
                [
                    'name' => 'Move Order Transact',
                    'slug' => 'move_order_transact',
                    'table' => 'move_order_header',
                    'table_detail' => 'move_order_line',
                    'index' => [
                        'column' => ['creation_date', 'invoice_number','id_customer', "status"],
                        'filter' => [
                            [
                                'column' => 'inactive_date',
                            ]
                        ]
                    ]
                ]
            ]
        ],
        [
            'name' => 'Container Yard Management',
            'slug' => 'container_yard_management',
            'icon' => 'mdi-view-dashboard',
            'child' => [
                [
                    'name' => 'Master Location',
                    'slug' => 'master_location',
                    'table' => 'location_header',
                    'table_detail' => 'location_line',
                    'index' => [
                        'column' => ['location_code', 'description','status'],
                    ]
                ],
                [
                    'name' => 'QC Container',
                    'slug' => 'qc_container',
                    'table' => 'qc_header',
                    'table_detail' => 'qc_line',
                    'index' => [
                        'column' => ['creation_date', 'invoice_number','id_customer', "status"],
                        'filter' => [
                            [
                                'column' => 'inactive_date',
                            ]
                        ]
                    ]
                ],
                [
                    'name' => 'Yard Management',
                    'slug' => 'yard_management',
                    'table' => 'container_transaction_header',
                    'table_detail' => 'container_transaction_line',
                    'index' => [
                        'column' => ['qc_date', 'id_so_header','id_customer', "status"],
                        'filter' => [
                            [
                                'column' => 'qc_date',
                            ],
                            [
                                'column' => 'id_customer'
                            ]
                        ]
                    ]
                ]
            ]
        ],
        [
            'name' => 'Manufacturing',
            'slug' => 'manufacturing',
            'icon' => 'mdi-view-dashboard',
            'child' => [
                [
                    'name' => 'Master Routing',
                    'slug' => 'master_routing',
                    'table' => 'routing_header',
                    'table_detail' => 'routing_line',
                    'index' => [
                        'column' => ['creation_date', 'routing_number', 'routing_code','resource_cost', "overhead_cost"],
                        'filter' => [
                            [
                                'column' => 'creation_date',
                            ]
                        ]
                    ]
                ],
                [
                    'name' => 'Discreate Job',
                    'slug' => 'discreate_job',
                    'table' => 'jo_header',
                    'table_detail' => 'jo_lines',
                    'index' => [
                        'column' => ['start_date', 'id_so_header','container_number', "status"],
                        'filter' => [
                            [
                                'column' => 'inactive_date',
                            ]
                        ]
                    ]
                ]
            ]
        ],
        [
            'name' => 'General Ledger',
            'slug' => 'general_ledger',
            'icon' => 'mdi-view-dashboard',
            'child' => [
                [
                    'name' => 'Master Period',
                    'slug' => 'master_period',
                    'table' => 'master_period_header',
                    'table_detail' => 'master_period_header',
                    'index' => [
                        'column' => ['period_set_name', 'description'],
                    ]
                ],
                [
                    'name' => 'Master COA',
                    'slug' => 'master_coa',
                    'table' => 'coa_segment_header',
                    'table_detail' => 'coa_segment_line',
                    'index' => [
                        'column' => ['segment_code', 'description','view_name', "status"]
                    ]
                ],
                [
                    'name' => 'Ledger Setup',
                    'slug' => 'ledger_setup',
                ],
                [
                    'name' => 'Journal Entry',
                    'slug' => 'journal_entry',
                    'table' => 'gl_je_headers',
                    'table_detail' => 'gl_je_lines',
                    'index' => [
                        'column' => ['gl_date', 'journal_number','journal_name', "je_category"],
                        'filter' => [
                            [
                                'column' => 'gl_date'
                            ]
                        ]
                    ]
                ],
                [
                    'name' => 'Closing Journal',
                    'slug' => 'closing_journal'
                ]
            ]
        ],
        [
            'name' => 'Tracing',
            'slug' => 'tracing',
            'icon' => 'mdi-view-dashboard',
            'child' => [
                [
                    'name' => 'BL Tracing',
                    'slug' => 'bl_tracing',
                    'table' => 'cash_receipt_header',
                    'table_detail' => 'cash_receipt_line',
                    'index' => [
                        'column' => ['creation_date', 'invoice_number','id_customer', "status"],
                        'filter' => [
                            [
                                'column' => 'inactive_date',
                            ]
                        ]
                    ]
                ],
                [
                    'name' => 'SO Tracing',
                    'slug' => 'so_tracing',
                ]
            ]
        ],
        [
            'name' => 'Dashboard',
            'slug' => 'dashboard',
            'icon' => 'mdi-view-dashboard',
            'child' => [
                [
                    'name' => 'Dashboard ( Managerial )',
                    'slug' => 'managerial'
                ],
                [
                    'name' => 'Dashboard ( FA )',
                    'slug' => 'fa'
                ],
                [
                    'name' => 'Dashboard ( Admin )',
                    'slug' => 'admin'
                ],
                [
                    'name' => 'Dashboard ( Gate Keeper )',
                    'slug' => 'gate_keeper'
                ],
            ]
        ],

    ]

];
