<?php

declare(strict_types=1);

namespace App\Model;

use Nette;

final class ShopTypesFacade
{
    public function __construct(
        private Nette\Database\Explorer $database,
    ) {
    }

    /**
     * Vrati vsetky typy obchodov
     *
     * @return array
     */
    public function getShopTypes(): array
    {
        return $this->database
            ->table('shop_typ')
            ->fetchAll();
    }
}
