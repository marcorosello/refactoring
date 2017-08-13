# refactoring

## Set up

 ```
  composer install
  run database.sql
 ```

## Tools

phpstan (static analysis)
```
vendor/bin/phpstan analyse src --level 7
```
phpunit
```
vendor/bin/phpunit -c phpunit.xml tests/
```

## Exercise

```
bin/console --env="dev" products:import products.csv

```