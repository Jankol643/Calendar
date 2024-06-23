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
        $routes = Route::getRoutes()->getRoutesByName();
        $menuArray = self::excludeMenuItems($routes);
        Log::debug("Cleaned array: " . print_r($menuArray, true));
        foreach ($menuArray as $routeName => $routeUrl) {
            $pos = StringHelper::getNthOccurrence($routeUrl, '/', 3);
            $routeUrl = substr($routeUrl, $pos, strlen($routeUrl) - $pos);
            // Count the number of slashes in the route URL to determine the nesting level
            $numSlashes = substr_count($routeUrl, '/') - 2; // Subtract 2 to account for the http part

            $menu = [
                'route' => $routeName,
                'url' => $routeUrl,
                'num_slashes' => $numSlashes,
            ];

            // Add the menu item to the appropriate parent menu item
            if ($numSlashes > 0) {
                $parentMenu = &$menuArray;

                for ($i = 1; $i < $numSlashes; $i++) {
                    if (!isset($parentMenu['children'])) {
                        $parentMenu['children'] = [];
                    }
                    $parentMenu = &$parentMenu['children'];
                }

                $parentMenu[] = $menu;
            } else {
                $menuArray[] = $menu;
            }
        }
        Log::debug("Nested menu array: " . print_r($menuArray, true));
        return $menuArray;
    }

    /**
     * Excludes menu items based on certain conditions.
     *
     * @param $routes The array of routes to be filtered.
     * @return array The filtered array of routes.
     */
    private static function excludeMenuItems($routes): array {
        $excludedCharacters = ['_', '.', '{', '}'];
        $excludedRoutes = ['admin', 'api', 'login', 'logout'];
        $filteredMenuArray = [];

        foreach ($routes as $routeName => $route) {
            $randomString = StringHelper::generateRandomString(10);
            $routeUrl = route($routeName, [$randomString]);
            // Check if the route name starts with an excluded character or is in the excluded routes list
            if (!StringHelper::checkStringCharacters($routeName, $excludedCharacters) && !StringHelper::checkStringCharacters($routeUrl, $excludedCharacters) && !in_array($routeName, $excludedRoutes)) {
                $routeUrl = str_replace($randomString, '', $routeUrl); // Remove the random string from route URL
                $filteredMenuArray[$routeName] = $routeUrl;
            }
        }
        return $filteredMenuArray;
    }
}
