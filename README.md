<p align="center"><a href="https://eforge.it/" target="_blank"><img src="https://eforge.it/img/LOGO.png" width="400"></a></p>

<!-- <p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p> -->

## About GoNativeFlow
intelligent system for managing flows for generating contacts.

## Tecnology Laravel
- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.
## Configuration
Instructions to access and work with GoNativeFlow code and fully enjoy its features.

1)
Download your local development, I use laragon https://laragon.org/ but you can use XAMPP, WAMPP or whatever you prefer.

2)
Open your editor and clone the project.

2.1) From the terminal execute the migration

3)
Enter the .env file and modify the data to access the migrated database on phpMyAdmin
<img src = "/themes/img/ immagine.png">

4)
Enter on phpMyAdmin and in the user table register a new user and in the "user_role" field enter "admin" (now this user will be the only one who can use the dashboard).

4.1) Open the browser, enter the url http: //gonativeflow.test/ in the bar, register a new user who will become your admin to access the dashboard.

4.1.2) log into phpMyAdmin and change the "user_role" field of the previously registered user from "user" to "admin".

5)
Now log in with your admin account and "le jeu est fait".
## License

-----