# upayments


To set up the project, Please follow the following steps.

- First you need to take the clone using the following link.
https://github.com/sachin-hadola/sachin_case_study.git

- rename .env.example file to .env and change the following parameter
APP_URL=http://localhost/upayments - Change the project name according to your name
DB_DATABASE=upayments - Change the database name according to your name

- Run "composer install" command to manage all the dependency

- Run "php artisan passport:install" command to manage passport depencies

- You can run the "php artisan migrate" command to create the table in the database. You need to add category manually if you are using migration command and if you are importing the database which I have provided in the database folder(upayments.sql) then you can check directly as I have already created some categories.

- Finally, You can access the API with the base URL.
http://localhost/upayments/public/api/{API Name from doc}