symfony-boilerplate
===================

Sensible defaults for a symfony web project.

Includes:
  - sass and js bundling with gulp
  - browser reloading with browserSync
  - sass-mq and susy
  - KnpMenuBundle
  - FOSUserBundle
  - EasyAdminBundle
  - DoctrineMigrationsBundle

### Getting started
- clone this repo, run `composer install` and `npm install`
- add your database credentials to `app/config/parameters.yml`
- run `./console doctrine:database:create` and `./console doctrine:schema:update --force`
- You can then start the built in php webserver using `./console server:run`
- To compile frontend assets and launch browserSync run `gulp` from the docroot.