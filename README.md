<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## API With Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

## Download Project 

````
git clone git@github.com:juniormelo94/api_book_store.git
````
ou
````
git clone https://github.com/juniormelo94/api_book_store.git
````

## Database
### Create a database(mysql) with the following settings:

```` 
Database: book_store
Username: root
Password: root
````

## Require

- PHP 8.0.

## Installation

### Step 1: Rename the .env file

```` 
De: ".env.dev"
Para: ".env"
````
### Step 2: Install dependencies via composer

```` 
composer install
````

### Step 3: Generate database tables

```` 
php artisan migrate
````

### Step 4: Start server

```` 
php artisan serve
````


## Consume API

### Register user

- **POST** [http://127.0.0.1:8000/api/register](http://127.0.0.1:8000/api/register)

Request:
```` 
POST http://127.0.0.1:8000/api/register

{
    "name": "John Doe",
    "email": "john@doe.com",
    "password": "123456",
    "password_confirmation": "123456"
}
````
Response:
```` 
{
  "status": "ok",
  "message": "user record created",
  "token": "1|HJUtjoI6YxSmUfJHVIebFkdouHOIPJvuBXvaVUzd"
}
````

### Login

- **POST** [http://127.0.0.1:8000/api/login](http://127.0.0.1:8000/api/login)

Request:
```` 
http://127.0.0.1:8000/api/login

{
    "email": "john@doe.com",
    "password": "123456"
}
````
Response:
```` 
{
  "status": "ok",
  "token": "1|l1z7epNiQTD5VKU4d35nLl4zlblURwwCzqLPXdt7"
}
````

### Logout

- **POST** [http://127.0.0.1:8000/api/logout](http://127.0.0.1:8000/api/logout)<br>
  Authorization: Bearer + token

Request:
```` 
http://127.0.0.1:8000/api/logout
Authorization: Bearer 1|HJUtjoI6YxSmUfJHVIebFkdouHOIPJvuBXvaVUzd
````
Response:
```` 
{
  "status": "ok",
  "message": "Logged out successfully"
}
````

### All books

- **GET** [http://localhost:8000/api/books](http://localhost:8000/api/books)<br>
  Authorization: Bearer + token

Request:
```` 
http://localhost:8000/api/books
Authorization: Bearer 1|HJUtjoI6YxSmUfJHVIebFkdouHOIPJvuBXvaVUzd
````
Response:
```` 
{
  "status": "ok",
  "data": [
    {
      "id": 1,
      "name": "Livro 1",
      "isbn": 1,
      "value": "1.10"
    },
    {
      "id": 4,
      "name": "Livro 4",
      "isbn": 0,
      "value": "0.00"
    },
    {
      "id": 5,
      "name": "Livro 5",
      "isbn": 5,
      "value": "5.00"
    }
  ]
}
````

### Register book

- **POST** [http://127.0.0.1:8000/api/books](http://127.0.0.1:8000/api/books)<br>
  Authorization: Bearer + token

Request:
```` 
http://127.0.0.1:8000/api/books
Authorization: Bearer 1|HJUtjoI6YxSmUfJHVIebFkdouHOIPJvuBXvaVUzd

{
    "name": "Livro 1",
    "isbn": 205,
    "value": 11.50
}
````
Response:
```` 
{
  "status": "ok",
  "message": "book record created"
}
````

### Book by id

- **GET** [http://127.0.0.1:8000/api/books/{id}](http://127.0.0.1:8000/api/books/{id})<br>
  Authorization: Bearer + token

Request:
```` 
http://127.0.0.1:8000/api/books/1
Authorization: Bearer 1|HJUtjoI6YxSmUfJHVIebFkdouHOIPJvuBXvaVUzd
````
Response:
```` 
{
  "status": "ok",
  "data": {
    "id": 1,
    "name": "Livro 1",
    "isbn": 100,
    "value": 11.10
  }
}
````

### Update book data by id

- **PUT** [http://127.0.0.1:8000/api/books/{id}](http://127.0.0.1:8000/api/books/{id})<br>
  Authorization: Bearer + token

Request:
```` 
http://127.0.0.1:8000/api/books/1
Authorization: Bearer 1|HJUtjoI6YxSmUfJHVIebFkdouHOIPJvuBXvaVUzd

{
    "name": "Livro 2",
    "isbn": 200,
    "value": 2.20
}
````
Response:
```` 
{
  "status": "ok",
  "message": "records updated successfully"
}
````

### Delete book by id

- **DELETE** [http://127.0.0.1:8000/api/books/{id}](http://127.0.0.1:8000/api/books/{id})<br>
  Authorization: Bearer + token

Request:
```` 
http://127.0.0.1:8000/api/books/1
Authorization: Bearer 1|HJUtjoI6YxSmUfJHVIebFkdouHOIPJvuBXvaVUzd
````
Response:
```` 
{
  "status": "ok",
  "message": "successfully deleted records"
}
````