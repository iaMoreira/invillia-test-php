<?php

namespace App\Providers;

use App\Http\Resources\AddressResource;
use App\Http\Resources\ItemResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\PersonResource;
use App\Http\Resources\PhoneResource;
use App\Http\Resources\UserResource;
use App\Models\Address;
use App\Models\Item;
use App\Models\Order;
use App\Models\Person;
use App\Models\Phone;
use App\Models\User;
use App\Services\AddressService;
use App\Services\ItemService;
use App\Services\OrderService;
use App\Services\PersonService;
use App\Services\PhoneService;
use App\Services\RegisterService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PersonResource::class, function() {
            return new PersonResource(new Person());
        });
        
        $this->app->bind(PersonService::class, function () {
            return new PersonService(new Person());
        });

        $this->app->bind(OrderResource::class, function() {
            return new OrderResource(new Order());
        });
        
        $this->app->bind(OrderService::class, function () {
            return new OrderService(new Order());
        });

        $this->app->bind(PhoneResource::class, function() {
            return new PhoneResource(new Phone());
        });
        
        $this->app->bind(PhoneService::class, function () {
            return new PhoneService(new Phone());
        });

        $this->app->bind(ItemResource::class, function() {
            return new ItemResource(new Item());
        });
        
        $this->app->bind(ItemService::class, function () {
            return new ItemService(new Item());
        });

        $this->app->bind(AddressResource::class, function() {
            return new AddressResource(new Address());
        });
        
        $this->app->bind(AddressService::class, function () {
            return new AddressService(new Address());
        });

        $this->app->bind(UserService::class, function () {
            return new UserService(new User());
        });

        $this->app->bind(RegisterService::class, function () {
            return new RegisterService(new UserService(new User()));
        });

        $this->app->bind(UserResource::class, function() {
            return new UserResource(new User());
        });
    
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
