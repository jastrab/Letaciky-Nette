<?php
namespace App\Model;

use Nette;
use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;

final class LeafletFacade
{
    public function __construct(
        private Explorer $database,
    ) {
    }

    public function getLeafletDetailId(?int $id): ActiveRow
    {
        return  $this->database
                ->table('leaflet')
                ->get($id);
    }

    /**
     * Vrati konkretny letak na zaklade name
     *
     * @param string|null $name
     * @return ActiveRow
     */
     public function getLeafletDetailName(?string $name): ActiveRow
    {
        return  $this->database
                ->table('leaflet')
                ->where('title', $name)
                ->limit(1)
                ->fetch();
    }

    /**
     * Vrati aktualne letaky obchodu
     *
     * @param int|null $id_shop
     * @return array
     */
    public function getLeafletShop(?int $id_shop): array
    {
        return $this->database
            ->table('leaflet')
            ->where('id_shop', $id_shop)
            ->where('endDate >= ', new \DateTime)
            ->order('startDate DESC')
            ->fetchAll();
    }

    /**
     * Vrati stare (naposledy skoncene) letaky obchodu
     *
     * @param int|null $id_shop
     * @return array
     *
     */
    public function getLeafletShopOld(?int $id_shop): array
    {
        return $this->database
            ->table('leaflet')
            ->where('id_shop', $id_shop)
            ->where('endDate < ', new \DateTime)
            ->order('endDate DESC')
            ->limit(4)
            ->fetchAll();
    }

    /**
     * Vrati novo pridane letaky
     *
     * @param int $limit
     * @return array
     */
    public function getLeafletShopNews(int $limit=4): array
    {
        return $this->database
            ->table('leaflet')
            ->where('endDate >= ', $this->database::literal('DATE(NOW())'))
            ->order('createDate DESC')
            ->limit($limit)
            ->fetchAll();
    }

    /**
     * Vrati dnes konciace letaky
     *
     * @param int $limit
     * @return array
     */
    public function getLeafletShopLastDay(int $limit=4): array
    {
        return $this->database
            ->table('leaflet')
            ->where('endDate = ', $this->database::literal('DATE(NOW())'))
            ->order('startDate DESC')
            ->limit($limit)
            ->fetchAll();
    }

    /**
     * Vrati pocet aktivnych letakov
     *
     * @return int
     */
    public function getLeafletCount(): int
    {
        return  $this->database
                ->table('leaflet')
                ->where('endDate >= ', new \DateTime)
                ->count();

    }

    /**
     * Vrati pocet stran aktivnych letakov
     *
     * @return int
     */
    public function getLeafletPagesCount(): int
    {
        return  $this->database
                ->table('leaflet')
                ->where('endDate >= ', new \DateTime)
                ->sum('pages2');

    }

     /**
     * Vrati pocet aktivnych letakov na obchod
     *
     * @return int
     */
     public function getLeafletInShopCount(): array
    {
        return  $this->database
                ->table('leaflet')
                ->select('id_shop, count(id_shop) AS ecount')
                ->where('endDate >= ', new \DateTime)
                ->group('id_shop')
                ->fetchPairs('id_shop', 'ecount');
    }

    public function getLeafletTitles(): array
    {
        return  $this->database
                ->table('leaflet')
                ->select('title')
                ->fetchPairs(null, 'title');
    }
}


