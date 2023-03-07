<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Introduction

This is a Laravel application that allows users to login either using the form or by social login and will be redirected to a dashboard. This application was built using (the latest version at the time of writing this) Laravel v10.2.0.

## Requirements
- PHP version 8.1 or higher
- Composer Installed.


## Default Login Details

- Email: alvin@example.com
- Password: password.

## Functionalities

- Users can log in either using the form or by social login.
- Users will be redirected to a dashboard upon successful login.
- The dashboard will greet the user apropriately depending on time of day. 
- The user would also be shown which way the used to login. For example, if use logs in via Google, it will show them on dashboard that they logged in using Google

### Installation

- Clone the repository
- Run `composer install` to install dependencies
- Create a copy of the `.env.example` file and rename it to `.env`
- Generate an application key using the command `php artisan key:generate`
- Set up your database connection in the `.env` file
- Run the database migrations using the command `php artisan migrate`
- (Optional) Seed the database with test data using the command `php artisan db:seed`
- Start the application using the command `php artisan serve`
- Add the respective client IDs, secret keys and URIs for the social logins (Google, Facebook and Twitter)
- Locate their (Google, Facebook and Twitter) API portals, create accounts and obtain these details, and input the details in the `.env` file.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
