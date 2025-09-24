php artisan tinker
DB::connection()->getPdo();

php artisan migrate --force


php artisan optimize
php artisan l5-swagger:generate

php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

php artisan route:list

php artisan make:model Category -m
php artisan make:model Product -m
php artisan make:model Order -m
php artisan make:model OrderItem -m
php artisan make:model Payment -m
php artisan make:controller Api/AuthController
php artisan make:controller Api/CategoryController --api
php artisan make:controller Api/ProductController --api
php artisan make:controller Api/OrderController
php artisan make:controller Api/PaymentController


php artisan make:factory UserFactory --model=User



php artisan infyom:scaffold Post --fromTable --tableName=posts
