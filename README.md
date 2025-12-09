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

php artisan optimize
php artisan l5-swagger:generate

php artisan infyom:api --fromTable --table=categories



php artisan infyom:scaffold SubCategories --fromTable --table=subcategories

php artisan infyom:scaffold Categories --fromTable --table=categories

php artisan infyom:scaffold Users --fromTable --table=users

php artisan infyom:scaffold Products --fromTable --table=products

php artisan infyom:scaffold Orders --fromTable --table=orders

php artisan infyom:scaffold Midtrans --fromTable --table=midtrans

php artisan infyom:scaffold Auths --fromTable --table=auths

php artisan infyom:api SubCategories --fromTable --table=subcategories
php artisan infyom:api Categories --fromTable --table=categories
php artisan infyom:api Users --fromTable --table=users
php artisan infyom:api Products --fromTable --table=products
php artisan infyom:api Orders --fromTable --table=orders
php artisan infyom:api Midtrans --fromTable --table=midtrans
php artisan infyom:api Auths --fromTable --table=auths


php artisan infyom:api_scaffold SubCategories --fromTable --table=subcategories
php artisan infyom:api_scaffold Categories --fromTable --table=categories
php artisan infyom:api_scaffold Users --fromTable --table=users
php artisan infyom:api_scaffold Products --fromTable --table=products
php artisan infyom:api_scaffold Orders --fromTable --table=orders
php artisan infyom:api_scaffold Midtrans --fromTable --table=midtrans
php artisan infyom:api_scaffold Auths --fromTable --table=auths

php artisan infyom:api_scaffold Payments --fromTable --table=payments
php artisan infyom:api_scaffold Order_Items --fromTable --table=order_items
