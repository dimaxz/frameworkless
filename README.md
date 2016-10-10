# Frameworkless
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/dimaxz/frameworkless/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dimaxz/frameworkless/?branch=master)

Каркас приложения с минимальным набором популярных библиотек

## Почему?
Некоторые фрейморки такие как Symfony или Laravel, загоняют разработчиков в жесткие рамки, дают меньше свободы чем хотелось бы. Данный каркас может стать 
отправной точкой для тех кто хочет построить свою архитектуру приложения.

## Что подключаем?
Я провел значительное время, выбирая пакеты, отдавая предпочтение тем, которые используются в существующих больших приложениях или фреймворках. Вот что я выделил:

**[nikic/fast-route](https://github.com/nikic/FastRoute)** Популярная библиотека маршрутизации [Slim](http://www.slimframework.com).  
**[filp/whoops](https://github.com/filp/whoops)** Впечатляюще потрясающий обработчик ошибок.  
**[symfony/http-foundation](https://github.com/symfony/http-foundation)** Обработка запросов и возврата ответа.  
**[league/container](https://github.com/thephpleague/container)** Популярная библиотека для инъекции зависимостей  
**[twig/twig](https://github.com/twigphp/Twig)** Надежный шаблонизатор.  
**[vlucas/phpdotenv](https://github.com/vlucas/phpdotenv)** Используем локальные переменные вне хранилища  
**[propel/propel](https://github.com/propelorm/Propel2)** Propel2 мощная и шустрая ОРМ.  
**[maximebf/debugbar](https://github.com/martynbiz/phpdebugbar)** Панель отладки, интеграция с Propel2.  

## Getting started
I've included a Vagrantfile which should make getting setup extremely simple. I assume [composer](https://getcomposer.org) is installed.

Step 1. Install [Vagrant](https://www.vagrantup.com)    
Step 2. Clone this repository  
Step 3. cd into the repository  
Step 3. ```composer install```  
Step 4. ```cp .env.example .env```  
Step 5. ```vagrant up```


From here, you should be able to browse to http://localhost:8080/. The website is served with NGINX and PHP 7.


## Batteries not included
I've intentionally made this project as simplistic as possible. A lot of things are left up to you to design and implement. On the plus side, you won't have to remove much boilerplate.

Below you will find instructions on how to implement a few things, feel free to contribute more examples :). 


### PDO (database)
Edit ``bootstrap/app.php`` and add the following:
```php
$container->add('PDO')
    ->withArgument(getenv('DB_CONN'))
    ->withArgument(getenv('DB_USER'))
    ->withArgument(getenv('DB_PASS'));
```

You will also need to add some values to your ``.env``
```
# Database access
DB_CONN=mysql:host=127.0.0.1;dbname=frameworkless;charset=utf8
DB_USER=fwl_user
DB_PASS=hopefullysecure
```

Now, from a controller:
```php
    private $pdo;
    
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function get()
    {
        $handle = $this->pdo->prepare('SELECT * FROM `todos`');
        $handle->execute();
        return new JsonResponse($handle->fetchAll(PDO::FETCH_ASSOC));
    }
```


You will also need to add some values to your ``.env``
```
# Database access
DB_CONN=mysql:host=127.0.0.1;dbname=frameworkless;charset=utf8
DB_USER=fwl_user
DB_PASS=hopefullysecure
```


###Propel2 (ORM)

Step 1. $ export `cat .env`     
Step 2. $ propel status     
Step 3. $ propel config:convert   
