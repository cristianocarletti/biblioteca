<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## 1 - Update the database data in your .env file, for example:

DB_CONNECTION=mysql<BR>
DB_HOST=127.0.0.1<BR>
DB_PORT=3306<BR>
DB_DATABASE=biblioteca<BR>
DB_USERNAME=root<BR>
DB_PASSWORD=root<BR>

## 2 - RUN:
1 - composer install<BR>
2 - php artisan migrate:refresh --seed<BR>
3 - php artisan jwt:secret<BR>
4 - php artisan serve --port=80 (you can choose the port or not pass the port parameter then it will run on the default port)<BR>

## 3 - ACESSANDO OS ENDPOINTS:
1 - COM EXCEÇÃO DOS ENDPOINTS REGISTRAR E AUTENTICAR, TODOS OS OUTROS EXIGEM O TOKEN!
SENDO ASSIM É PRECISO AUTENTICAR:
http://127.0.0.1/api/autenticar
BODY:
{
"email": "super@usuario.com",
"password": "12345678"
}
RETURN TOKEN EXEMPLO:
"auth": {
"token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1dGVudGljYXIiLCJpYXQiOjE3MjIyNTc4MDUsImV4cCI6MTcyMjI2MTQwNSwibmJmIjoxNzIyMjU3ODA1LCJqdGkiOiJuVlVIQ01qd2dJMTdqS0c5Iiwic3ViIjoiMSIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.68tx2XjesmXoy19lrQ-RjKR9KZof9Rt0DC1gametV6k",
"type": "bearer"
}
2 - POSTERIORMENTE SEMPRE ENVIAR O BEARER TOKEN NO CABEÇALHO DOS ENDPOINTS

## 4 - DOCUMENTATION
to see the documentation of api run:<BR>
http://127.0.0.1/docs<BR>


## 5 - TESTS
to run tests:<BR>
php artisan tests<BR>

## 6 - INSOMNIA FILE TO IMPORT:
Insomnia_2024-07-30.json<BR>

## 7 - ROUTE LIST
to see the list of routes run:<BR>
php artisan route:list<BR>
<code>
+--------+----------+----------------------------------+-----------------------------+------------------------------------------------------------+--------------------------------------+
| Domain | Method   | URI                              | Name                        | Action                                                     | Middleware                           |
+--------+----------+----------------------------------+-----------------------------+------------------------------------------------------------+--------------------------------------+
|        | GET|HEAD | /                                |                             | Closure                                                    | web                                  |
|        | POST     | api/autenticar                   | auth.autenticar.autenticar  | App\Http\Controllers\AuthController@autenticar             | api                                  |
|        | POST     | api/registrar                    | user.registrar.store        | App\Http\Controllers\UserController@store                  | api                                  |
|        | POST     | api/tests/autenticar             | test.auth.autenticar        | App\Http\Controllers\AuthController@autenticar             | api                                  |
|        | PUT      | api/tests/autores/atualizar/{id} | test.autores.atualizar      | App\Http\Controllers\AutoresController@update              | api                                  |
|        | POST     | api/tests/autores/criar          | test.autores.criar          | App\Http\Controllers\AutoresController@store               | api                                  |
|        | DELETE   | api/tests/autores/deletar/{id}   | test.autores.deletar        | App\Http\Controllers\AutoresController@destroy             | api                                  |
|        | GET|HEAD | api/tests/autores/listar         | test.autores.listar         | App\Http\Controllers\AutoresController@index               | api                                  |
|        | GET|HEAD | api/tests/emprestimos/listar     | test.emprestimos.listar     | App\Http\Controllers\EmprestimosController@index           | api                                  |
|        | POST     | api/tests/emprestimos/registrar  | test.emprestimos.registrar  | App\Http\Controllers\EmprestimosController@store           | api                                  |
|        | PUT      | api/tests/livros/atualizar/{id}  | test.livros.atualizar       | App\Http\Controllers\LivrosController@update               | api                                  |
|        | POST     | api/tests/livros/criar           | test.livros.criar           | App\Http\Controllers\LivrosController@store                | api                                  |
|        | DELETE   | api/tests/livros/deletar/{id}    | test.livros.deletar         | App\Http\Controllers\LivrosController@destroy              | api                                  |
|        | GET|HEAD | api/tests/livros/listar          | test.livros.listar          | App\Http\Controllers\LivrosController@index                | api                                  |
|        | POST     | api/tests/registrar              | test.user.store             | App\Http\Controllers\UserController@store                  | api                                  |
|        | POST     | api/tests/sair                   | test.sair.logout            | App\Http\Controllers\AuthController@logout                 | api                                  |
|        |          |                                  |                             |                                                            | App\Http\Middleware\Authenticate:api |
|        | PUT      | api/v1/autores/atualizar/{id}    | autores.atualizar.update    | App\Http\Controllers\AutoresController@update              | api                                  |
|        |          |                                  |                             |                                                            | App\Http\Middleware\CheckBearerToken |
|        | POST     | api/v1/autores/criar             | autores.criar.store         | App\Http\Controllers\AutoresController@store               | api                                  |
|        |          |                                  |                             |                                                            | App\Http\Middleware\CheckBearerToken |
|        | DELETE   | api/v1/autores/deletar/{id}      | autores.deletar.destroy     | App\Http\Controllers\AutoresController@destroy             | api                                  |
|        |          |                                  |                             |                                                            | App\Http\Middleware\CheckBearerToken |
|        | GET|HEAD | api/v1/autores/listar            | autores.listar.index        | App\Http\Controllers\AutoresController@index               | api                                  |
|        |          |                                  |                             |                                                            | App\Http\Middleware\CheckBearerToken |
|        | GET|HEAD | api/v1/emprestimos/listar        | emprestimos.listar.index    | App\Http\Controllers\EmprestimosController@index           | api                                  |
|        |          |                                  |                             |                                                            | App\Http\Middleware\CheckBearerToken |
|        | POST     | api/v1/emprestimos/registrar     | emprestimos.registrar.store | App\Http\Controllers\EmprestimosController@store           | api                                  |
|        |          |                                  |                             |                                                            | App\Http\Middleware\CheckBearerToken |
|        | PUT      | api/v1/livros/atualizar/{id}     | livros.atualizar.update     | App\Http\Controllers\LivrosController@update               | api                                  |
|        |          |                                  |                             |                                                            | App\Http\Middleware\CheckBearerToken |
|        | POST     | api/v1/livros/criar              | livros.criar.store          | App\Http\Controllers\LivrosController@store                | api                                  |
|        |          |                                  |                             |                                                            | App\Http\Middleware\CheckBearerToken |
|        | DELETE   | api/v1/livros/deletar/{id}       | livros.deletar.destroy      | App\Http\Controllers\LivrosController@destroy              | api                                  |
|        |          |                                  |                             |                                                            | App\Http\Middleware\CheckBearerToken |
|        | GET|HEAD | api/v1/livros/listar             | livros.listar.index         | App\Http\Controllers\LivrosController@index                | api                                  |
|        |          |                                  |                             |                                                            | App\Http\Middleware\CheckBearerToken |
|        | POST     | api/v1/sair                      | sair.logout                 | App\Http\Controllers\AuthController@logout                 | api                                  |
|        |          |                                  |                             |                                                            | App\Http\Middleware\CheckBearerToken |
|        |          |                                  |                             |                                                            | App\Http\Middleware\Authenticate:api |
|        | GET|HEAD | sanctum/csrf-cookie              |                             | Laravel\Sanctum\Http\Controllers\CsrfCookieController@show | web                                  |
+--------+----------+----------------------------------+-----------------------------+------------------------------------------------------------+--------------------------------------+
</code>