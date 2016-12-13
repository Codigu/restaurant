<?php

namespace Copya\Http\Controllers\Admin;

use Illuminate\Routing\Controller ;
use Copya\Lib\RouteGenerator;

class BaseController extends Controller
{
    protected $sidenav;

    public function __construct(RouteGenerator $routeGenerator)
    {
        /*$routes = $routeGenerator->getRoutes();

        $navigation = [];

        foreach($routes as $route){
            $uri = explode('/', $route['uri']);
            $navigation[$uri[1]][] = array(
                'nav_name' => $route['name'],
                'nav_item' => $route['uri'],
            );
        }

        $this->sidenav = $navigation;*/

        /** TODO::improve implementation
         * all admin routes should return to /admin
         */


    }

    public function getSideNav()
    {
        return $this->sidenav;
    }
}
