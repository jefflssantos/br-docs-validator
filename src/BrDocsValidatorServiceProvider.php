<?php

namespace Jefflssantos\BrDocsValidator;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class BrDocsValidatorServiceProvider extends ServiceProvider
{
    /**
    * Bootstrap services.
    *
    * @return void
    */
    public function boot()
    {
        Validator::extend('cpf_or_cnpj', function($attribute, $value, $parameters, $validator) {
            return (new BrDocsValidator($value))->validateCpfOrCnpj();
        });

        Validator::extend('cpf', function($attribute, $value, $parameters, $validator) {
            return (new BrDocsValidator($value))->validateCpf();
        });

        Validator::extend('cnpj', function($attribute, $value, $parameters, $validator) {
            return (new BrDocsValidator($value))->validateCnpj();
        });
    }
}
