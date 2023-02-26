# Basic-Movie-Website

## Introduction
This is a PHP web project which uses MySQL as a database. This website takes you through a mock process of purchasing movie tickets online. It also has functionality for admin controls such as adding a movie and setting up it's showtimes and etc. to be put into the database which will effect the client side.

This project provides some default database entries for testing in files init.sql and movidedb.sql that you can run as a sql script to
initialize the database. The init.sql files puts in some base users that store a hashed password, to login as any of the test users the password is test. All sql statements use prepare statements to guard against sql injection attacks.

Since this project uses composer to work with .env files. To set up .env files go <a href="https://getcomposer.org/download/">here</a> and download composer.

## Steps to run as developer
1. First, make sure you have XAMPP or install both PHP and Apache so you can run .php files.
2. Make sure you have MySQL.
3. Clone this repository (Should probably clone it in htdocs of XAMPP or Apache).
4. Open terminal, navigate to the project folder that you have cloned.
5. run the command: composer require vlucas/phpdotenv
6. Open project in an editor.
7. Go to the file called .env.example and follow those instructions.
8. Go to http://127.0.0.1/name_of_project_folder/login.php in your browser.
9. That's it! Now that you're running the application, any change you run in code will reflect on your browser after a hard reload.
