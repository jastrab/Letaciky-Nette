<?php
namespace App\UI\OpenHours;

use App\Model\OpenHoursFacade;
use App\UI\Base\BasePresenter;

final class OpenHoursPresenter extends BasePresenter
{
    public function __construct(
        private OpenHoursFacade $open_hours_facade,
    ) {
    }

    public function renderShow(?string $name): void
    {
        $url_image = 'https://letaciky.sk/images/sk';

        $is_index=True;
        if ($name)
        {
            $is_index=False;
            $open_hours = $this->open_hours_facade->getOpenHoursShop($name);
            $open_hours_shop_index = $this->open_hours_facade->getOpenHoursIndexName($name);

            $this->template->open_hours_shop_index = $open_hours_shop_index;
        }
        else
        {
            $open_hours = $this->open_hours_facade->getOpenHoursIndex();
        }

        $this->template->open_hours = $open_hours;
        $this->template->is_index = $is_index;

    }

}