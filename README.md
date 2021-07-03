# Zadanie rekrutacyjne

Get project from gitgub
```shell
git clone https://github.com/asmtechpl/zadanie-rekrutacyjne.git
```
# Requirements

- PHP 7.4.16

# Installation

## Go to project directory
```shell
cd zadanie-rekrutacyjne
```
## install dependencies composer
```shell
composer install
```

## install dependencies node
```shell
npm install
```

## copy .env.example and save as .env
```shell
cp .env.example .env
```

## open file .env and pass login details on database and save changes

```env
DB_DATABASE=database_name
DB_USERNAME=database_user
DB_PASSWORD=database_password
```

## generate key for app
```shell
php artisan key:generate
```

## migrate database
```shell
php artisan migrate
```

## build frontend dev version
```shell
npm run dev
```
## build frontend production version
```shell
npm run prod
```

## get data from API
### using command 
```shell
php artisan api:get
```

### or using schedule task
#### This command you should add to your cron Task on server
```shell 
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```
