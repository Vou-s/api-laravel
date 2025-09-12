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


# PowerShell Script: generate-entities.ps1

# User
php artisan make:model User -mcr

# Product
php artisan make:model Product -mcr

# Order
php artisan make:model Order -mcr

# OrderItem
php artisan make:model OrderItem -mcr

# Payment
php artisan make:model Payment -mcr


php artisan make:factory UserFactory --model=User



php artisan infyom:scaffold Post --fromTable --tableName=posts
