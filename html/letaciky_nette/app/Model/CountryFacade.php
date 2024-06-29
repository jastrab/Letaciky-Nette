<?php

declare(strict_types=1);

namespace App\Model;

use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;

final class CountryFacade
{
    public function __construct(
        private Explorer $explorer,
    )
    {}

    public function getCountryName($name): ActiveRow
    {
        return $this->explorer->table('country')
            ->where('name', $name)
            ->fetch();
    }

}