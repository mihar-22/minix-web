
# Minix

Minix aims to allow users to automatically track all their transactions on multiple cryptocurrencies. Just like banking applications today, it will show different accounts/wallets and their respective worth, income, spending and fees. In most cases to gain an accurate picture of all the users transactions, the application must connect with multiple cryptocurrency exchanges. This will enable tracking of withdrawals, deposits, buys, sells and fees. However, currently there are many inconsistencies between different exchange API's. Thus, Minix will also provide it's own API for making requests to exchanges, mapping the responses to a specific format and returning it to the requestor.

## Quickstart

This repository is built with [Laravel](https://laravel.com/). To get started first check out the [Laravel Installation](https://laravel.com/docs/5.6/installation) guide. Don't forget to create a **.env** file after cloning the repository and include your [Mailtrap](https://mailtrap.io/) credentials.

From the command line, clone the repository and cd into it

    git clone git@github.com:mihar-22/minix-web.git Minix && cd $_

Install [Composer](https://getcomposer.org/) on your machine and run

	composer install

Serve the project with [Valet](https://laravel.com/docs/5.6/valet), [Homestead](https://laravel.com/docs/5.6/homestead) or run

	php artisan serve
	
[Laravel IDE Helper](https://github.com/barryvdh/laravel-ide-helper/) helps your IDE provide better autocompletion (Eg: [Facades](https://laravel.com/docs/5.6/facades/)), just run

    php artisan ide-helper:generate
    
## Modules

The project breaks down different features into modules. Each module includes only the code required for that specific feature to function correctly. This allows us to organize the code better for scale and to keep relevant parts together. However, there is some boilerplate to create each module which is currently not automated. Please follow the guide below to create a new module. 

**Replace [Module] in the code snippets below with the actual module name.**

### Setup

Create the [Service Provider](https://laravel.com/docs/5.6/providers/) file

    touch app/Modules/[Module]/src/Providers/[Module]ServiceProvider.php
    
Next, use the following template for the file
    
    namespace Minix\[Module]\Providers;

    use Illuminate\Support\ServiceProvider;
    use Minix\Modules\ModuleBooter;
    
    class [Module]ServiceProvider extends ServiceProvider {
        use ModuleBooter;
        
        public function boot()
        {
            $this->bootModlule();
        }
    }

Register the Service Provider by adding the following to config/app.php

    Minix\[Module]\Providers\[Module]ServiceProvider::class,
    
Finally, autoload the module with PSR-4 by adding the following to composer.json

    "Minix\\[Module]\\": "app/Modules/[Module]/src"
    
### Database

All [Factories](https://laravel.com/docs/5.6/database-testing#writing-factories/), [Migrations](https://laravel.com/docs/5.6/migrations/) and [Seeds](https://laravel.com/docs/5.6/seeding/) are added to
    
    app/Modules/[Module]/database/factories
    app/Modules/[Module]/database/migrations
    app/Modules/[Module]/database/seeds
    
If there are any seeders, make sure to autoload them by adding the following to composer.json

    "app/Modules/[Module]/database/seeds",
    
If you'd like to run the seeder with [Artisan](https://laravel.com/docs/5.6/artisan/), call it in 

    database/seeds/DatabaseSeeder.php

### Testing

All tests are added to

    app/Modules/[Module]/tests
    
If there are any tests, add the test suite to phpunit.xml

    <testsuite name="[Module]">
        <directory suffix="Test.php">./app/Modules/[Module]/tests</directory>
    </testsuite>
    
Run tests with

    vendor/bin/phpunit --testsuite=[Module]
