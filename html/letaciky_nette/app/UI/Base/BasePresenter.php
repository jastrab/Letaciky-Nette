<?php

declare(strict_types=1);

namespace App\UI\Base;

use App\Model\LeafletFacade;
use App\Model\OpenHoursFacade;
use App\Model\ShopFacade;
use App\Model\ShopTypesFacade;
use Nette\Application\UI\Presenter;
use Nette\DI\Attributes\Inject;

abstract class BasePresenter extends Presenter
{
    #[Inject]
    public ShopTypesFacade $shop_type_facade;
    #[Inject]
    public ShopFacade $shop_facade;
    #[Inject]
    public LeafletFacade $leaflet_facade;
     #[Inject]
    public OpenHoursFacade $open_hours_facade;

    protected function beforeRender()
    {
        parent::beforeRender();

        $shop_types = $this->shop_type_facade->getShopTypes();
        $shops = $this->shop_facade->getShops();

        $stat_leaflet = $this->leaflet_facade->getLeafletCount();
        $stat_pages = $this->leaflet_facade->getLeafletPagesCount();



        $open_hours_counts = $this->open_hours_facade->getOpenHoursInShopCount();

        $leaflet_counts = $this->leaflet_facade->getLeafletInShopCount();

        $this->template->leaflet_counts = $leaflet_counts;
        $this->template->open_hours_counts = $open_hours_counts;


        $this->template->shop_types = $shop_types;
        $this->template->shops = $shops;

        $this->template->stat_shop = count($shops);
        $this->template->stat_leaflet = $stat_leaflet;
        $this->template->stat_pages = $stat_pages;

        $this->template->shop_web = False;
        $this->template->oh_url = False;

        $this->template->is_flayer = True;
        $this->template->oh_exists = False;
        $this->template->web = False;

        $url = $this->getHttpRequest()->getUrl();

        /**
         *
         * Rozdelenie webu na casti:
         *  - letaky
         *  - otvaracie hodiny
         *  - produkty
         *
         **/
        $webOpenHours = False;
        $webLeaflet = False;
        $webProducts = False;
        if (str_contains($url->path, '/otvorene') || str_contains($url->path, '/open'))
        {
            $webOpenHours = True;
        }
        else if (str_contains($url->path, '/produkt') || str_contains($url->path, '/product'))
        {
            $webProducts = True;
        }
        else
        {
            $webLeaflet = True;
        }

//        bdump($url);
        $this->template->webOpenHours = $webOpenHours;
        $this->template->webLeaflet = $webLeaflet;
        $this->template->webProducts = $webProducts;

//        bdump($webOpenHours);
//        bdump($webLeaflet);
//        bdump($webProducts);


    }

}
