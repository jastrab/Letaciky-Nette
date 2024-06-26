<?php
namespace App\UI\OpenHoursDetail;

use App\Model\OpenHoursFacade;
use App\UI\Base\BasePresenter;

final class OpenHoursDetailPresenter extends BasePresenter
{
    public function __construct(
        private OpenHoursFacade $open_hours_facade,
    ) {
    }

    public function renderShow(string $name, string $slug): void
    {
        bdump($slug);
        $open_hours_shop = $this->open_hours_facade->getOpenHoursDetail($slug);
        $open_hours_shop_index = $this->open_hours_facade->getOpenHoursIndexName($name);

        $shop = $this->shop_facade->getShopInfoName($name);

        bdump($open_hours_shop);
//        bdump($open_hours_shop->open_hours_shop_index);
        bdump($open_hours_shop_index);
        bdump($shop);
        bdump($open_hours_shop->open_hours_days);

        $this->template->oh_shop = $open_hours_shop;
        $this->template->oh_shop_index = $open_hours_shop_index;
        $this->template->shop = $shop;

    }

}