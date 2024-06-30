<?php

declare(strict_types=1);

namespace App\UI\Accessory;


use Nette\Http\UrlScript;

/**
 *
 * Rozdelenie webu na casti:
 *  - letaky
 *  - otvaracie hodiny
 *  - produkty
 *
 **/
class WebParams
{
    public function __construct(
        private UrlScript $url = new UrlScript(),
        private bool $web_open_hours = False,
        private bool $web_products = False,
        private bool $web_leaflet = False,
    )
    {
        $this->setParams();
    }

    public function setParams()
    {
        $url = $this->url;

        if (str_contains($url->path, '/otvorene') || str_contains($url->path, '/open'))
        {
            $this->web_open_hours = True;
        }
        else if (str_contains($url->path, '/produkt') || str_contains($url->path, '/product'))
        {
            $this->web_products = True;
        }
        else
        {
            $this->web_leaflet = True;
        }
    }


    public function getWebOpenHours(): bool
    {
        return $this->web_open_hours;
    }

    public function getWebProducts(): bool
    {
        return $this->web_products;
    }

    public function getWebLeaflet(): bool
    {
        return $this->web_leaflet;
    }

}
