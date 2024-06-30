<?php
namespace App\UI\Menu;

use App\Model\ShopFacade;
use App\Model\ShopTypesFacade;
use App\UI\Accessory\WebParams;
use Nette\Application\UI\Control;
use Nette\Http\UrlScript;

final class MenuHeadComponent extends Control
{
    public function __construct(
        private ShopFacade $shop_facade,
        private ShopTypesFacade $shop_type_facade,
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

        $this->template->webOpenHours = $this->web_params->getWebOpenHours();
        $this->template->webLeaflet = $this->web_params->getWebLeaflet();
        $this->template->webProducts = $this->web_params->getWebProducts();

        $this->template->setFile(__DIR__ . '/menuHead.latte');
        $this->template->render();
    }
}