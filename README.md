# About

mini ecommerce project for technical test orderonline.id

# Tech Stack

1. laravel 9
2. mongodb new version 2023
3. php 8.2.5
4. redis
5. redis insight for trace keys from redis or check cache define or not
6. composer v 2.4.4

# How To Run

1. clone project
2. install package project laravel if error:

```shell
composer install
```

3. setup env, reference on env.example
4. running key generate

```shell
php artisan key:generate
```

5. running storage link for upload image or file

```shell
php artisan storage:link
```

6. import collection api example running file to postman
7. install redis on your local area
8. install your mongodb in your local area and config extension in your php.ini
9. running server laravel

```shell
php artisan serve
```
