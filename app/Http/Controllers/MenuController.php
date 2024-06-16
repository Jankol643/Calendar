<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use stdClass;

class MenuController extends Controller {
    public function handle(Request $request, $next) {
        $layout = new stdClass;
        $routes = $this->getMenuRoutes();
        return $next($request);
    }

    /**
     * @return \Illuminate\Support\Collection<TKey, TValue>
     */
    public function getMenuRoutes() {
        return collect(Route::getRoutes())->map(function ($route) {
            return [
                'name' => $route->getName(),
                'url' => $route->uri(),
            ];
        });
    }
}
