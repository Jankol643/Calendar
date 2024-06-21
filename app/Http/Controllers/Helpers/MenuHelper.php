<?php

namespace App\Http\Controllers\Helpers;

use Illuminate\Support\Facades\Route;
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

        foreach ($routes as $routeName => $route) {
            $routeUrl = route($routeName);
            Log::debug("Route: $routeName, URL: $routeUrl");
            // Count the number of slashes in the route URL to determine the nesting level
            $numSlashes = substr_count($routeUrl, '/');

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

        return $menuArray;
    }

    /**
     * Excludes menu items based on certain conditions.
     *
     * @param array $routes The array of routes to be filtered.
     * @return array The filtered array of routes.
     */
    private static function excludeMenuItems($routes) {
        $excludedCharacters = ['_', '.'];
        $excludedRoutes = ['admin', 'api', 'login', 'logout'];
        $filteredMenuArray = [];

        Log::debug("Route array: " . print_r($routes, true));

        foreach ($routes as $menuItem) {
            // Check if the route name starts with an excluded character or is in the excluded routes list
            if (!in_array(substr($menuItem['route'], 0, 1), $excludedCharacters) && !in_array($menuItem['route'], $excludedRoutes)) {
                $filteredMenuArray[] = $menuItem;
                if (isset($menuItem['children'])) {
                    $filteredMenuArray = array_merge($filteredMenuArray, self::excludeMenuItems($menuItem['children']));
                }
            }
        }
        return $filteredMenuArray;
    }
}
