<?php namespace Cribbb\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;

class OauthRoutes
{
    /**
     * Define the routes
     *
     * @param Registrar $router
     * @return void
     */
    public function map(Registrar $router)
    {
        $router->post('auth/access_token', [
            'as'   => 'access_token',
            'uses' => 'OauthController@accessToken'
        ]);
    }
}
