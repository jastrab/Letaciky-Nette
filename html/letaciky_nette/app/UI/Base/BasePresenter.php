<?php

declare(strict_types=1);

namespace App\UI\Base;

use App\Model\LeafletFacade;
use App\Model\OpenHoursFacade;
use App\Model\ShopFacade;
use App\Model\ShopTypesFacade;
use App\UI\Accessory\WebParams;
use App\UI\Menu\MenuHeadComponent;
use App\UI\Menu\MenuIconsComponent;
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
    #[Inject]
    public MenuHeadComponent $menu_head_component;
    #[Inject]
    public MenuIconsComponent $menu_icons_component;
    public WebParams $web_params;


    public function __construct()
    {
    }

    protected function beforeRender()
    {
        parent::beforeRender();

        $shops = $this->shop_facade->getShops();

        $this->web_params = new WebParams($this->getHttpRequest()->getUrl());

        $this->template->stat_shop = count($shops);
        $this->template->stat_leaflet = $this->leaflet_facade->getLeafletCount();
        $this->template->stat_pages = $this->leaflet_facade->getLeafletPagesCount();

        $this->template->webOpenHours = $this->web_params->getWebOpenHours();
        $this->template->webLeaflet = $this->web_params->getWebLeaflet();
        $this->template->webProducts = $this->web_params->getWebProducts();

    }

    protected function createComponentMenu(): MenuHeadComponent
    {
        $this->menu_icons_component->setWebParams($this->getHttpRequest()->getUrl());
        return $this->menu_head_component;
    }

    protected function createComponentMenuIcons(): MenuIconsComponent
    {
          $this->menu_icons_component->setWebParams($this->getHttpRequest()->getUrl());
          return $this->menu_icons_component;
    }


}
