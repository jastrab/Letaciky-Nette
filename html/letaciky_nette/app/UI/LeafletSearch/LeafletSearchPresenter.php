<?php
namespace App\UI\LeafletSearch;

use App\Model\LeafletTextsFacade;
use App\UI\Base\BasePresenter;

final class LeafletSearchPresenter extends BasePresenter
{
    public function __construct(
        private LeafletTextsFacade $leaflet_texts_facade,
    ) {
    }

    public function renderShow(string $name): void
    {
        $url_image = 'https://letaciky.sk/images/sk';

        $leaflet_texts = $this->leaflet_texts_facade->getLeafletText($name);

        $this->template->leaflet_texts = $leaflet_texts;
        $this->template->url_image = $url_image;
        $this->template->key_search = $name;
    }
}