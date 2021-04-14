# About PHPTest

A very simple applicaton that initally creates user by database seeder. Users can only preview user info along with comments by providing user id as querystring or using a specific route. Any one can add comment of a specific user by providing user id, static password and comment. User can also create a comment by using a console command. The routes with parameters are documented below.

<br/>

# Installation Instruction

PHPTest is very easy to setup. Steps are given below:

```
  1. clone the repository
  2. Run composer install
  3. create a database
  4. copy .env.example to .env
  5. update database name & credentials in .env file
  6. run php artisan migrate
  7. run php artisan db:seed
```

You are done in the easy steps. To run test suit: 
```
php artisan test or vendor/bin/phpunit
```

<br/>

# Routes & Console Commands

## Preview user via querystring

Preview user info along with comments. User id is passed through querysting. User info and comments are displayed into a blade view.

**URL** : `/?id=1`

**Method** : `GET`

**Password Security required** : NO

**Example URL** http://phptest.test/?id=1

<br/>

## Preview user via params

Preview user info along with comments. User id is passed through request parameter. User info and comments are displayed into a blade view.

**URL** : `/users/{id}`

**Method** : `GET`

**Password Security required** : NO

**Example URL** http://phptest.test/users/1

<br/>

## Create a new comment via http request

Create a new comment of an user via http post request. Data can be sent either form request or json request payload. If user is not found or security password is not provided, system will throw an error.

**URL** : `/users/comments/`

**Method** : `POST`

**Password Security required** : Yes

**Data constraints**

Provide user id, password and comment.

```json
{
    "id": "[integer]",
    "password": "[string]",
    "comments": "[text]"
}
```

**Data example** All fields must be sent.

```json
{
    "id": 1,
    "password": "720DF6C2482218518FA20FDC52D4DED7ECC043AB",
    "comments": "Comment one"
}
```

<br/>

## Create a new comment via console command

Create a new comment of an user via console command. User id and comment is sent as command params. No password is needed to create comment via console command. Below replace the USERID & COMMENT with original user id and comment.

**COMMAND** : `php artisan comment:create USERID COMMENT`

**Password Security required** : NO

**Data constraints**

Provide user id and comment.

```json
{
    "id": "[integer]",
    "comments": "[text]"
}
```

**Data example** php artisan comment:create 1 "First Comment"