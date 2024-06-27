<?php

declare(strict_types=1);

namespace App\Model;

use Nette;

final class OpenHoursFacade
{
    public function __construct(
        private Nette\Database\Explorer $database,
    ) {
    }

    public function getOpenHoursIndex(): array
    {
        return $this->database
            ->table('open_hours_shop_index')
            ->fetchAll();
    }

    public function getOpenHoursIndexName(string $name): Nette\Database\Table\ActiveRow
    {
        return $this->database
            ->table('open_hours_shop_index')
            ->where('name', $name)
            ->limit(1)
            ->fetch();
    }

//    public function getOpenHoursShop(int $id_oh_shop_index): array
//    {
//        return $this->database
//            ->table('open_hours_shop')
//            ->where('id_oh_shop_index', $id_oh_shop_index)
//            ->fetchAll();
//    }

    public function getOpenHoursShop(string $name): array
    {
        return $this->database
            ->table('open_hours_shop')
            ->where('id_open_hours_shop_index',
                $this->database
                    ->table('open_hours_shop_index')
                    ->where('name', $name))
            ->fetchAll();
    }

//    public function getOpenHoursDetail(string $slug): Nette\Database\Table\Selection
    public function getOpenHoursDetail(string $slug): Nette\Database\Table\ActiveRow
//    public function getOpenHoursDetail(string $slug): array
    {
        return $this->database
            ->table('open_hours_shop')
            ->where('slug', $slug)
//            ->joinWhere('open_hours_days', 'open_hours_days.id', 'open_hours_shop.id_oh_days')
            ->fetch();
//            ->limit(1)
//            ->fetchAll();
//
//        $open_hours_shop = $this->database
//            ->table('open_hours_shop')
//            ->where('slug', $slug)
//            ->limit(1)
//            ->fetch();
//
//        $open_hours_shop->ref('open_hours_days', 'id_oh_days');
//        return $open_hours_shop;
    }

      public function getOpenHoursInShopCount(): array
    {
        return  $this->database
                ->table('open_hours_shop')
                ->select('id_open_hours_shop_index, count(id_open_hours_shop_index) AS ecount, open_hours_shop_index.name')
                ->group('id_open_hours_shop_index')
                ->fetchPairs('name', 'ecount');
    }
}
