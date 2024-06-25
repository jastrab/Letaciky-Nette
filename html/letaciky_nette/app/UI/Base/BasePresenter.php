<?php

declare(strict_types=1);

namespace App\UI\Base;

use App\Model\LeafletFacade;
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

    protected function beforeRender()
    {
        parent::beforeRender();

        $shop_types = $this->shop_type_facade->getShopTypes();
        $shops = $this->shop_facade->getShops();

        $stat_leaflet = $this->leaflet_facade->getLeafletCount();
        $stat_pages = $this->leaflet_facade->getLeafletPagesCount();

        $this->template->shop_types = $shop_types;
        $this->template->shops = $shops;

        $this->template->stat_shop = count($shops);
        $this->template->stat_leaflet = $stat_leaflet;
        $this->template->stat_pages = $stat_pages;

    }

}
