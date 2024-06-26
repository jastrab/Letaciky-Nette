<?php

declare(strict_types=1);

namespace App\Model;

use Nette;

final class ShopFacade
{
    public function __construct(
        private Nette\Database\Explorer $database,
    ) {
    }

    /**
     * Vrati info obchodu na zaklade id
     *
     * @param $id
     * @return Nette\Database\Table\ActiveRow
     */
    public function getShopInfoId($id): Nette\Database\Table\ActiveRow
    {
        return $this->database
            ->table('shop')
            ->get($id);
    }

    /**
     * Vrati info obchodu na zaklade name
     *
     * @param string $name
     * @return Nette\Database\Table\ActiveRow
     */
    public function getShopInfoName(string $name): ?Nette\Database\Table\ActiveRow
    {
//        return $this->database
//            ->table('shop')
//            ->where('name', $name)
//            ->limit(1)
//            ->fetch();
         $shop = $this->database
            ->table('shop')
            ->where('name', $name)
            ->limit(1);

         return !is_null($shop) ? $shop->fetch() : null;
    }

    /**
     * Vrati vsetky obchody
     *
     * @return array
     */
    public function getShops(): array
    {
        return $this->database
            ->table('shop')
            ->fetchAll();
    }

    /**
     * Vrati hladane obchody
     *
     * @param string|null $name
     * @return array
     */
    public function getShopsSearch(?string $name): array
    {
        return $this->database
            ->table('shop')
            ->where('name LIKE ?', '%' . $name . '%')
            ->fetchAll();
    }
}
