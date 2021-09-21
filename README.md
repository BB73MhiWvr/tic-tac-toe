# Tic Tac Toe assessment task

### Introduction
Project includes library with 2-players Tic Tac Toe game and API fulfilling requirements
noted in programming skill assessment task which source author is not authorized to publish.

### Usage

#### Requirements
- Docker

#### Installation commands
1. Execute commands in local machine console:
```bash
git clone git@github.com:BB73MhiWvr/tic-tac-toe.git
cd tic-tac-toe
docker build --rm -t tic-tac-toe .
docker run -it --rm -v $(pwd):/var/www/html -p 8080:8080 --name tic-tac-toe tic-tac-toe
```
2. Execute commands in opened Docker container console:
```bash
composer install
```

#### Usage commands
1. Execute commands in local machine console:
```bash
docker run -it --rm -v $(pwd):/var/www/html -p 8080:8080 --name tic-tac-toe tic-tac-toe
```
2. Execute commands in opened Docker container console:
```bash
php -S 0.0.0.0:8080 public/index.php
```
PHP built-in webserver is now working and waiting for requests at address 
[localhost:8080](http://localhost:8080/).

### Available requests

##### GET /
```http request
GET http://localhost:8080/
```
Example responses
```
HTTP/1.0 200 OK
Content-Type:  application/json
{
"board":
  [
    [" "," "," "]
    [" "," "," "]
    [" "," "," "]
  ],
"score":
  {
    "x":0,
    "o":0
  },
  "currentTurn":"x",
  "victory":" "
}

HTTP/1.0 500 Internal Server Error
Content-Type:  application/json
{}
```
##### POST /:piece
```http request
POST http://localhost:8080/x
Content-Type: application/x-www-form-urlencoded
x=1&y=1
```
Example responses
```
HTTP/1.0 200 OK
Content-Type:  application/json
{
"board":
  [
    [" "," "," "]
    [" ","x"," "]
    [" "," "," "]
  ],
"score":
  {
    "x":0,
    "o":0
  },
  "currentTurn":"o",
  "victory":" "
}

HTTP/1.0 404 Not Found
Content-Type:  application/json
{}

HTTP/1.0 406 Not Acceptable
Content-Type:  application/json
{}

HTTP/1.0 409 Conflict
Content-Type:  application/json
{}

HTTP/1.0 500 Internal Server Error
Content-Type:  application/json
{}
```
##### DELETE /
```http request
DELETE http://localhost:8080/
```
Example responses
```
HTTP/1.0 200 OK
Content-Type:  application/json
{
"board":
  [
    [" "," "," "]
    [" "," "," "]
    [" "," "," "]
  ],
"score":
  {
    "x":0,
    "o":0
  },
  "currentTurn":"x",
  "victory":" "
}

HTTP/1.0 500 Internal Server Error
Content-Type:  application/json
{}
```
##### POST /restart
```http request
POST http://localhost:8080/restart
```
Example responses
```
HTTP/1.0 200 OK
Content-Type:  application/json
{
"board":
  [
    [" "," "," "]
    [" "," "," "]
    [" "," "," "]
  ],
"score":
  {
    "x":0,
    "o":0
  },
  "currentTurn":"x",
  "victory":" "
}

HTTP/1.0 500 Internal Server Error
Content-Type:  application/json
{}
```
##### GET /any-path
```http request
GET http://localhost:8080/any-path
```
Example responses
```
HTTP/1.0 404 Not Found
Content-Type:  application/json
{}
```
### Testing

[PHPUnit](https://phpunit.de) testing framework
```bash
docker run -it --rm -v $(pwd):/var/www/html -p 8080:8080 --name tic-tac-toe tic-tac-toe
bin/phpunit
```
[Psalm](https://psalm.dev) static analysis tool
```bash
docker run -it --rm -v $(pwd):/var/www/html -p 8080:8080 --name tic-tac-toe tic-tac-toe
bin/phpunit
```
[PHPStan](https://phpstan.org) static analysis tool
```bash
docker run -it --rm -v $(pwd):/var/www/html -p 8080:8080 --name tic-tac-toe tic-tac-toe
bin/phpstan
```

### Author notices

