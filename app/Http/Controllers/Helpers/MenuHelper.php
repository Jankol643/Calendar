<?php

namespace App\Http\Controllers\Helpers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Helpers\ArrayHelper;
use App\Http\Controllers\Helpers\StringHelper;
use Illuminate\Support\Facades\Log;

class MenuHelper {
    /**
     * Generates a nested menu array based on the registered routes.
     *
     * @return array The nested menu array.
     */
    public static function generateNestedMenuArray() {
        $menuArray = [];
        $excludedCharacters = ['_', '.', '{', '}'];
        $excludedRoutes = ['admin', 'api', 'login', 'logout'];

        $routes = Route::getRoutes()->getRoutesByName();

        foreach ($routes as $routeName => $route) {
            $randomString = StringHelper::generateRandomString(10);
            $routeUrl = route($routeName, [$randomString]);

            if (
                StringHelper::checkStringCharacters($routeName, $excludedCharacters)
                || StringHelper::checkStringCharacters($routeUrl, $excludedCharacters)
                || in_array($routeName, $excludedRoutes)
            ) {
                continue;
            }
            $routeUrl = str_replace($randomString, '', $routeUrl); // Remove the random string from the route URL
            $routeUrl = rtrim($routeUrl, '?'); // Remove any trailing '?' from the route URL
            $numSlashes = substr_count($routeUrl, '/') - 2;
            if ($numSlashes == 1) {
                $menuArray[$routeName] = $routeUrl;
                continue;
            }

            $pos = StringHelper::getNthOccurrence($routeUrl, '/', 3);
            $routeUrl = substr($routeUrl, $pos, strlen($routeUrl) - $pos);

            $parentMenu = &$menuArray;
            for ($i = 1; $i < $numSlashes; $i++) {
                if (!isset($parentMenu['children'])) {
                    $parentMenu['children'] = [];
                }
                $parentMenu = &$parentMenu['children'];
            }
            $parentMenu[$routeName] = $routeUrl;
        }
        return $menuArray;
    }
}
