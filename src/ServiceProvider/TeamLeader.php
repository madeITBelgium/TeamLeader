<?php

namespace MadeITBelgium\TeamLeader\ServiceProvider;

use Illuminate\Support\ServiceProvider;

/**
 * TeamLeader Laravel PHP SDK.
 *
 * @version    1.0.0
 *
 * @copyright  Copyright (c) 2018 Made I.T. (https://www.madeit.be)
 * @author     Tjebbe Lievens <tjebbe.lievens@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-3.txt    LGPL
 */
class TeamLeader extends ServiceProvider
{
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/teamleader.php' => config_path('teamleader.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('teamleader', function ($app) {
            $config = $app->make('config')->get('teamleader');

            return new \MadeITBelgium\TeamLeader\TeamLeader($config['api_url'], $config['auth_url'], $config['client_id'], $config['client_secret'], $config['redirect_uri'], $config['client']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['teamleader'];
    }
}
