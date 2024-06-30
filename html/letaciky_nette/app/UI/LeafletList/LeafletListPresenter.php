<?php
namespace App\UI\LeafletList;

use App\Model\LeafletTextsFacade;
use App\UI\Base\BasePresenter;

final class LeafletListPresenter extends BasePresenter
{
    public function renderShow(string $name, ?int $limit=Null): void
    {
        $url_image = 'https://letaciky.sk/images/sk';

        if ($name == 'novinky' || $name == 'nove')
        {
            $limit = $limit ? $limit : 50;
            $leaflets = $this->leaflet_facade->getLeafletShopNews($limit);
            $this->template->title = 'Najnovšie pridané letáky';
            $this->template->create = True;
        }
        else if ($name == 'konciace' || $name == 'stare' || $name == 'starinky' )
        {
            $limit = $limit ? $limit : 100;
            $leaflets = $this->leaflet_facade->getLeafletShopLastDay($limit);
            $this->template->title = 'Letáky, ktoré sa dnes končia';
            $this->template->create = False;
        }
        else {
            $this->redirect('Home:default');
        }

        $this->template->leaflets = $leaflets;

        $this->template->url_image = $url_image;


    }
}