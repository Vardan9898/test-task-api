## Installation

Clone the repository.

Install all the dependencies using composer

```
composer install
```

Copy the example env file and make the required configuration changes in the .env file

```
cp .env.example .env
```

Generate a new application key

```
php artisan key:generate
```

Set the database connection in .env

Run the database migrations

```
php artisan migrate:fresh --seed
```

Install npm

```
npm i
```