<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;
class FormMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Form::macro('checkboxes', function ($name, $fields) {
            $response = "<div class=\"form-control\" id=\"".$name."\">";
            $val = 0;
            
            foreach($fields as $key => $field)
            {
                
                $response= $response. '<label>'.Form::checkbox($name.'['.$val.']', $key, true)." ".$field."</label><br>";
                $val++;
            }
            return $response . "</div>";
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
