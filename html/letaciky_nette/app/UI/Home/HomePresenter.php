<?php

declare(strict_types=1);

namespace App\UI\Home;

use App\UI\Base\BasePresenter;
use Nette;


final class HomePresenter extends BasePresenter
{
    public function __construct(
    ) {
    }

    public function renderDefault(): void
    {

        $leaflets = $this->leaflet_facade->getLeafletShopNews(4);
        $leaflets_old = $this->leaflet_facade->getLeafletShopLastDay(4);

        $this->template->leaflets = $leaflets;
        $this->template->leaflets_old = $leaflets_old;

        $url_image = 'https://letaciky.sk/images/sk/';
        $this->template->url_image = $url_image;


    }

}
