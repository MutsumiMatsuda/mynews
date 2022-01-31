<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \App\Validators\ValidatorEx;

class ValidatorExServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
      \Validator::resolver(function ($translator, $data, $rules, $messages, $attr) {
          return new ValidatorEx($translator, $data, $rules, $messages, $attr);
      });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
