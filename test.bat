@ECHO OFF
php artisan migrate:refresh --seed --env=testing
php artisan passport:install --env=testing
php artisan test --filter PurchaseRequestTest
php artisan test --filter SupplierTest
php artisan test --filter QuotationTest
php artisan test --filter FormUploadTest
PAUSE 