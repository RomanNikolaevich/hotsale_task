### ABOUT THE PROJECT
* Technologies used: 
    - PHP, JavaScript, jQuery

* Libraries used:
    - "twig/twig": Template engine for PHP.
    - "symfony/security-csrf": CSRF protection for Symfony.
    - "monolog/monolog": Logging library for PHP.
    - "symfony/var-dumper": Debugging and variable dumping component for Symfony.- 


### Launch of the project

```php
docker-compose up --build -d
```

Installing dependencies:
```php
docker-compose exec -w /var/www/ app sh -c "composer install"
```
