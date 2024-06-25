<?php
namespace App\UI\Menu;

use App\Model\LeafletFacade;
use App\Model\ShopFacade;
use App\Model\ShopTypesFacade;
use Nette\Application\UI\Presenter;

final class MenuPresenter extends Presenter
{
    public function __construct(
        private ShopFacade $shop_facade,
        private LeafletFacade $leaflet_facade,
        private ShopTypesFacade $shop_type_facade,
    ) {
    }

    public function renderMenu(): void
    {
        $shop_types = $this->shop_type_facade->getShopTypes();
        $shops = $this->shop_facade->getShops();

        $this->template->shop_types = $shop_types;
        $this->template->shop = $shops;

        $url = '';
        $this->template->url = $url;

    }

}