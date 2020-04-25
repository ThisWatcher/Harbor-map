# harbor-map
Shows locations/weather of various harbors on a map

To run the project
1) create parameters file in config directory with open weather api key
```
// config/parameters.yaml

parameters:
  open_weather_map_api_key: 123456789
```
2) run composer install to symfony dependencies in project directory

```
composer install
```

3) run yarn install to install php and javascript dependencies

```
yarn install
```
4) run yarn to build assets

```
yarn run encore dev & production
```

5) start the server. If you have symfony service just run this command

```
symfony server:start
```

6) to run tests run this command

```
php bin/phpunit
```
