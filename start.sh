unameOut="$(uname -s)"
case "${unameOut}" in
    Linux*)     machine=Linux;;
    Darwin*)    machine=Mac;;
    *)          machine="UNKNOWN:${unameOut}"
esac

if [ "$machine" == "Mac" ]; then
    /Applications/xampp/xamppfiles/bin/mysql -uroot -e "CREATE DATABASE IF NOT EXISTS languageCourses;"  # Mac
elif [ "$machine" == "Linux" ]; then
    /opt/lampp/bin/mysql -uroot -e "CREATE DATABASE IF NOT EXISTS languageCourses;" # Linux
else
    echo ${machine}
    (exit 0)
fi

if [ $? -eq 1 ]; then
   echo "Nie udalo sie utworzyc bazy danych."
   exit
fi

php -r "copy('.env.example', '.env');"

composer install

# composer update

php artisan key:generate

php artisan storage:link

# php artisan migrate

# php artisan db:seed

php artisan migrate:fresh --seed

composer require --dev barryvdh/laravel-ide-helper

php artisan ide-helper:generate

php artisan serve

code .
