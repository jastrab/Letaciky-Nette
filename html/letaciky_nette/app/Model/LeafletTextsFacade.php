<?php
namespace App\Model;

use Nette\Database\Explorer;

final class LeafletTextsFacade
{
    public function __construct(
        private Explorer $database,
    ) {
    }

    /**
     * Vrati pocet najdenych vyrazov v letakoch
     *
     * @param string|null $name
     * @return int
     */
    public function getLeafletTextCount(?string $name): int
    {
        return  $this->database
                ->table('leaflet_texts')
                ->where('text LIKE ?', '%' . $name . '%')
                ->count();
    }

    /**
     * Vrati texty letaku na zaklade hladaneho vyrazu
     * - kazda strana ma svoj text
     *
     * @param string|null $name
     * @return array
     */
   public function getLeafletText(?string $name): array
    {
          return $this->database->table('leaflet_texts')
                ->where('text LIKE ?', '%' . $name . '%')
                ->order('createDate DESC')
                ->fetchAll();
    }

}


