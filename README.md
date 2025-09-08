php artisan tinker
DB::connection()->getPdo();

php artisan migrate --force


php artisan optimize
php artisan l5-swagger:generate

php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Generate model Order dengan migration, controller, dan seeder
php artisan make:model Order -mcr
php artisan make:seeder OrderSeeder

# Generate model OrderItem dengan migration, controller, dan seeder
php artisan make:model OrderItem -mcr
php artisan make:seeder OrderItemSeeder

# Generate model Payment dengan migration, controller, dan seeder
php artisan make:model Payment -mcr
php artisan make:seeder PaymentSeeder

php artisan make:factory UserFactory --model=User



php artisan infyom:scaffold Post --fromTable --tableName=posts
