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

        $router->addRoute('/otvorene/<name>/<slug>', 'OpenHoursDetail:show');
        $router->addRoute('/otvorene/<name>', 'OpenHours:show');

        $router->addRoute('/otvorene', 'OpenHours:show');
        $router->addRoute('/open', 'OpenHours:show');

        $router->addRoute('/kontakt', 'Contact:show');


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
