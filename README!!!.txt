composer , laravel, nodejs,npm run dev,build
composer require spatie/laravel-permission

php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

1-migrate
2-
php artisan db:seed --class=RolesPermsSeeder
3-
php artisan db:seed --class=RolesSeeder

=======
composer require barryvdh/laravel-dompdf:^3.0
composer require phpoffice/phpspreadsheet:^1.29.4
composer require maatwebsite/excel:^3.1.61
=======

Cairo Font install ...

   composer require barryvdh/laravel-dompdf
   composer require maatwebsite/excel