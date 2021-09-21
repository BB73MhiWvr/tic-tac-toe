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
---
```http request
HTTP/1.0 200 OK
Content-Type:  application/json
```
```json
{
"board":
  [
    [" "," "," "],
    [" "," "," "],
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
```
---
```http request
HTTP/1.0 500 Internal Server Error
Content-Type:  application/json
```
##### POST /:piece
```http request
POST http://localhost:8080/x
Content-Type: application/x-www-form-urlencoded
x=1&y=1
```
---
```http request
HTTP/1.0 200 OK
Content-Type:  application/json
```
```json
{
"board":
  [
    [" "," "," "],
    [" ","x"," "],
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
```
---
```http request
HTTP/1.0 404 Not Found
Content-Type:  application/json
```
---
```http request
HTTP/1.0 406 Not Acceptable
Content-Type:  application/json
```
---
```http request
HTTP/1.0 409 Conflict
Content-Type:  application/json
```
---
```http request
HTTP/1.0 500 Internal Server Error
Content-Type:  application/json
```
##### DELETE /
```http request
DELETE http://localhost:8080/
```
---
```http request
HTTP/1.0 200 OK
Content-Type:  application/json
```
```json
{
"board":
  [
    [" "," "," "],
    [" "," "," "],
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
```
---
```http request
HTTP/1.0 500 Internal Server Error
Content-Type:  application/json
```
##### POST /restart
```http request
POST http://localhost:8080/restart
```
---
```http request
HTTP/1.0 200 OK
Content-Type:  application/json
```
```json
{
"board":
  [
    [" "," "," "],
    [" "," "," "],
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
```
---
```http request
HTTP/1.0 500 Internal Server Error
Content-Type:  application/json
```
##### GET /any-path
```http request
GET http://localhost:8080/any-path
```
---
```http request
HTTP/1.0 404 Not Found
Content-Type:  application/json
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

### Author's notices

- Code has been developing for one sunday and two working days only (trip scheduled)
- If there was more time Cypress scenarios for requests would be implemented
- Considering mad development time I'm generally satisfied code
- The project was separated into two parts: `TicTacToe` library with whole logic and `Api` for handling HTTP requests
- There is extremely high code coverage with unit tests, every logic has written tests for it
- Psalm analysis is set to be run in the most strict mode on both directories: `src` and `tests`
- The only rule Psalm's rules exception `PropertyNotSetInConstructor` applies to PHPUnit `TestCase` class
- PHPStan analysis is set to be run in the most strict mode on both directories: `src` and `tests`
- In `tests\Scenarios` directory functional like tests are written as scenarios
- `Symfony`, `Laravel`, `Lumen` and `Slim` frameworks were considered to use, none of them was used
- All of considered frameworks offer much more functionalities than necessary what would make project larger and less readable
- An extremely simple `bramus/router` package was used to spare time for writing own one
- `symfony/cache` was chosen to provide storage for game state what is necessary in REST architecture
- `symfony/http-foundation` was used for single method usage `JsonResponse`
- Board size can be changed easily without impact on game logic
- Logic rules as Specification pattern ought to be changed without problem
- Decorator pattern allows changing output format without sweating
- I am not quite satisfied with `PlayerService` logic, but writing `Iterable` `Collection` of players could result with
offering game to more than two players
- Chain of responsibility pattern makes handling and modifying game logic is piece of cake
- `GameConfiguration` allows to change players symbols
- In case of questions and remarks please contact me
