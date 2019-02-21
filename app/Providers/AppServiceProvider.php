<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(get_setting('app_debug') == 'false')
        {
            \Config::set('app.debug', false );    
        }
        else
        {
            \Config::set('app.debug', true );    
        }

        \Config::set('mail.driver', get_setting('mail_driver'));
        \Config::set('mail.host', get_setting('mail_host'));
        \Config::set('mail.port', get_setting('mail_port'));
        \Config::set('mail.from', ['address' => get_setting('mail_address'), 'name' => get_setting('mail_name') ]);
        \Config::set('mail.username', get_setting('mail_username'));
        \Config::set('mail.password', get_setting('mail_password'));
        \Config::set('mail.encryption', get_setting('mail_encryption'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path('Helper/AsiaHelper.php');
        require_once app_path('Helper/EmporeHelper.php');
        require_once app_path('Helper/GeneralHelper.php');
        require_once app_path('Helper/ApprovalHelper.php');
        require_once app_path('Helper/StructureHelper.php');
    }
}
