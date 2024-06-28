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

    public function getOpenHoursIndexName(string $name): ?Nette\Database\Table\ActiveRow
    {
        return $this->database
            ->table('open_hours_shop_index')
            ->where('name', $name)
            ->limit(1)
            ->fetch();
    }


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

    public function getOpenHoursDetail(string $slug): Nette\Database\Table\ActiveRow
    {
        return $this->database
            ->table('open_hours_shop')
            ->where('slug', $slug)
            ->fetch();
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
