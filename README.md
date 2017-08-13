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
- Test the command below
- Refactor it to follow best practices and clean architecture
- Add at least 2 unit tests

# References

- Code smells presentation
https://docs.google.com/presentation/d/14Jp_w4k9Ud2B2eONI1UGtXMqc96_qfGUNgisEmV7HTU/edit?usp=sharing
- Refactoring presentation
https://docs.google.com/presentation/d/1yaDxvvjSzvWx-qwR2c1ulDNdIYv14vuEtKrPL9ckEmY/edit?usp=sharing