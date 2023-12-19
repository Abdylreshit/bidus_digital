Test Task API
- Requirements before installation:
    - installed and confugured LAMP server

- Installation:
    - composer install
    - [create new database]
    - [create .env config]
    - php artisan migrate
    - php artisan key:generate
    - php artisan l5-swagger:generate
      -> go to the link http://localhost:8000/api/documentation
_________________________________
Good luck 🙂
