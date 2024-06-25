<?php
namespace App\UI\Leaflet;

use App\UI\Base\BasePresenter;

final class LeafletPresenter extends BasePresenter
{
    public function __construct(
    ) {
    }

    public function renderShow(string $name_shop): void
    {
        $shop = $this->shop_facade->getShopInfoName($name_shop);
        $leaflets = $this->leaflet_facade->getLeafletShop($shop->id);
        $leaflets_old = $this->leaflet_facade->getLeafletShopOld($shop->id);

        $this->template->shop = $shop;
        $this->template->leaflets = $leaflets;
        $this->template->leaflets_old = $leaflets_old;

        $url_image = 'https://letaciky.sk/images/sk/' . $shop->name;

        $this->template->url_image = $url_image;



    }
}