# ZadanieTreningowe

Projekt zajmuje się importem danych z xls, zapisem w bazie oraz mailowym poinformowanie użytkowanika o zainstaniałej akcji.
W celach ćwiczeniawych zastosowałem podejście DDD aby pokazać przedwszytkim metodykę mojej pracy a nie jedynie uzyskać rozwiązanie problemu.

Testy zostaną wprowadzone w kolejnej wersji.

# Preinstallation

Clone and Setup [ZadanieTreningowe](https://github.com/kamildziemba/ZadanieTreningowe) repository.

## Dependencies

Install: 

[Docker CE](#Install-Docker-Ubuntu)

[Docker Compose](#Install-Docker-Compose)

# Installation

## Preparing the required files

Run the following commands to prepare the database volume:

## Run

Execute following in bash:

```shell
docker-compose build
docker-compose up
```

## Prepare db and fix permissions

Execute following in bash:

```shell
# enter the container
docker-compose exec sf4_php bash

#install dependencies
composer install

# fix permissions (USE ONLY ON DEV ENVIRONMENT)
chmod -R 777 var/log
chmod -R 777 var/cache

# create and update database schema, load fixtures
bin/console d:s:u --force
```

## Preparing import file

To import file copy it to:
var/imports/

Then use command:
bin/console app:import-excel filename.xlsx

```

## Voilla

The app should now run on `http://localhost`