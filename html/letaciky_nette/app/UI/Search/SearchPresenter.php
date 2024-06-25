<?php

declare(strict_types = 1);

namespace App\UI\Search;

use App\Model\LeafletFacade;
use App\Model\LeafletTextsFacade;
use App\Model\ShopFacade;
use App\Model\ShopTypesFacade;
use Nette\Application\UI\Presenter;

final class SearchPresenter extends Presenter
{
    public function __construct(
        private ShopFacade $shop_facade,
        private LeafletFacade $leaflet_facade,
        private ShopTypesFacade $shop_type_facade,
        private LeafletTextsFacade $leaflet_texts_facade,
    )
    {

    }

     public function renderSearch(): void
    {
        $key_search = $this->getHttpRequest()->getPost('query');

        $data_shops = [];
        $count_products = 0;
//        Pokial je malo znakov ani nehladaj
        if (strlen($key_search) > 1)
        {
            $data_shops = $this->shop_facade->getShopsSearch($key_search);

            if (strlen($key_search) > 2)
            {
                $count_products = $this->leaflet_texts_facade->getLeafletTextCount($key_search);
            }
        }

        $this->template->key_search = $key_search;
        $this->template->count_products = $count_products;
        $this->template->data_shops = $data_shops;
        $this->template->url_search_products = '';

    }

}