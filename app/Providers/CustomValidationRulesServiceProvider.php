<?php

namespace App\Providers;

use App\Http\Helpers\EstafetaShipmentsHelper as Shipment;

use Validator;

use App\Models\Products\Product;
use App\Models\Skus\Sku;
use App\User;
use App\Models\Shop\Bag;
use App\Models\Events\Event;
use App\Models\Shop\BagUser;

use Hash;

use DB;

use Illuminate\Support\ServiceProvider;

class CustomValidationRulesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
