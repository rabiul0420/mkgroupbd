<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Validator::extend('max_after_decimal', function ($attribute, $value, $parameters, $validator) {
            $maxValueAfterDecimal = (int) $parameters[0];

            if (preg_match('/\.\d{1,2}$/', $value, $matches)) {
                $decimalValue = (int) ltrim($matches[0], '.');
                return $decimalValue <= $maxValueAfterDecimal;
            }

            return true; // No decimal part or within limit
        });
        Validator::extend('max_decimal_length', function ($attribute, $value, $parameters, $validator) {
            $maxDecimalLength = (int) $parameters[0];

            if (preg_match('/\.\d+$/', $value, $matches)) {
                $decimalPart = ltrim($matches[0], '.');
                return strlen($decimalPart) <= $maxDecimalLength;
            }

            return true; // No decimal part or within limit
        });
    }
}
