<?php

declare(strict_types=1);

namespace App\Core;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;

        $router->addRoute('/hladat', 'Search:search');
        $router->addRoute('/search', 'Search:search');

        $router->addRoute('/produkt/<name>', 'LeafletSearch:show');

        $router->addRoute('/letak/<shop>/<slug>', 'LeafletDetail:show');

        $router->addRoute('/letak/<name_shop>', 'Leaflet:show');
        $router->addRoute('/leaflet/<name_shop>', 'Leaflet:show');

		$router->addRoute('<presenter>/<action>[/<id>]', 'Home:default');

        return $router;
	}
}
