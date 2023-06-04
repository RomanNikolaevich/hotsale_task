### ABOUT THE PROJECT
1. Technologies used: 
    - PHP, JavaScript, jQuery

2. Libraries used:
    - "twig/twig": Template engine for PHP.
    - "symfony/security-csrf": CSRF protection for Symfony.
    - "monolog/monolog": Logging library for PHP.
    - "symfony/var-dumper": Debugging and variable dumping component for Symfony. 

### Test task for Backend programmer
1. Create a page with a form.  
    The form should contain the following fields:  
    * first name
    * surname
    * email
    * password
    * password repeat
2. Implement sending data from the form using AJAX.
3. Implement AJAX request processing in php.
    During processing it is necessary:  
    3.1 validate:
        * email contains @.
        * passwords are the same  
       Optionally, these validations can also be duplicated on the client (js).  
    
    
    3.2 Create an array of existing users (you don't need to get it from any database). The array should contain the fields email, id, name, password.  
    3.3 Check whether there is an element in this array with a user's email.  
    3.4 The result of the check should be logged to a file in any format.  
    3.5 Write data from the form to the array with existing users.  
    If the verification is successful, the form should be hidden and the user should receive a notification of successful registration.  If the check fails, the user should see an error above the form.

4. Create a public repository on github and upload the entire task code there. Log files should not be included in the repository.  
As a result, pass a link to this repository.  
You can use any javascript libraries.  
To style the page, use getbootstrap.com  


### Launch of the project

```php
docker-compose up --build -d
```

Installing dependencies:
```php
docker-compose exec -w /var/www/ app sh -c "composer install"
```

Stops and removes containers:
```php
docker-compose down
```
