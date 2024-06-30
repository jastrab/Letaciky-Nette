<?php
namespace App\UI\Menu;

use App\Model\LeafletFacade;
use App\Model\OpenHoursFacade;
use App\Model\ShopFacade;
use App\Model\ShopTypesFacade;
use App\UI\Accessory\WebParams;
use Nette\Application\UI\Control;
use Nette\DI\Attributes\Inject;
use Nette\Http\UrlScript;

final class MenuIconsComponent extends Control
{
    public function __construct(
        private ShopFacade $shop_facade,
        private ShopTypesFacade $shop_type_facade,
        private LeafletFacade $leaflet_facade,
        private OpenHoursFacade $open_hours_facade,
        private WebParams $web_params,
    )
    {

    }

    public function setWebParams(UrlScript $url): void
    {
        $this->web_params = new WebParams($url);
    }

     public function render()
    {
        $this->template->shop_types = $this->shop_type_facade->getShopTypes();
        $this->template->shops = $this->shop_facade->getShops();
        $this->template->leaflet_counts = $this->leaflet_facade->getLeafletInShopCount();
        $this->template->open_hours_counts = $this->open_hours_facade->getOpenHoursInShopCount();

        $this->template->webOpenHours = $this->web_params->getWebOpenHours();
        $this->template->webLeaflet = $this->web_params->getWebLeaflet();
        $this->template->webProducts = $this->web_params->getWebProducts();

        $this->template->setFile(__DIR__ . '/menuIcons.latte');
        $this->template->render();
    }
}