<?php
namespace App\UI\LeafletDetail;

use App\UI\Base\BasePresenter;

final class LeafletDetailPresenter extends BasePresenter
{
    public function __construct(
    ) {
    }

    public function renderShow(string $shop, string $slug): void
    {
        $leaflet = $this->leaflet_facade->getLeafletDetailName($slug);
        if(!$leaflet){
            $this->error('Stranka nenajdena :/');
        }

        $shop = $this->shop_facade->getShopInfoId($leaflet->id_shop);

        // pouzitie existujucich liniek... (do buducna spracovanie z disku)
        $url = 'https://letaciky.sk/images/sk/' . $shop->name . '/' . $leaflet->title;

        $this->template->leaflet = $leaflet;
        $this->template->shop = $shop;
        $this->template->url_image = $url;

    }
}