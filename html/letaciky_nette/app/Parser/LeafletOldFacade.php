<?php
namespace App\Parser;

use App\Model\LeafletFacade;
use App\Model\ShopFacade;
use Nette\Utils\FileSystem;
use Nette\Utils\Json;
use Nette\Database\Explorer;
final class ParserLeafletOldFacade
{
    public function __construct(
        private Explorer $explorer,
        private ShopFacade $shopFacade,
        private LeafletFacade $leafletFacade,
    ) {
    }

    // Problem zo stahovanim
    // fopen(/var/www/html/letaciky_nette/data/data_sk.json): Failed to open stream: Permission denied search► skip error►
    // treba nastavit prava
    // $sudo chmod 777 -R data/
    // ?? $sudo chown www-data:www-data data/ -R
    public function download(string $url)
    {
        $ch = curl_init($url);
        $dir = '/var/www/html/letaciky_nette/data/';

        $file_name = basename($url);
        $save_file_loc = $dir . $file_name;

        $fp = fopen($save_file_loc, 'wb');

        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        curl_exec($ch);

        curl_close($ch);

        fclose($fp);
    }

    /**
     * Funkcia na aktualizovanie DB letakov z json suboru
     * Docasne riesenie pre nedoriesenu DB na backende
     *
     * 1. Stiahne sa aktualny subor json s datami
     * 2. Nacitaju sa data z jsonu
     * 3. Nacitaju sa title letakov z DB
     * 4. Nahraju sa do DB data, ktore este nie su v DB na zaklade title
     *
     * @return int
     * @throws \Nette\Utils\JsonException
     */
    public function GoParser()
    {
        $file = "../data/data_sk.json";

        $url = 'https://letaciky.sk/json/data_sk.json';
        $this->download($url);

        $res = FileSystem::read($file, 'r');

        /**
         * Nacitanie json dat do Array
         * treba "true" pre navrat pola
         */
        $datas = Json::decode($res, true);

        $explorer = $this->explorer;
        $titles = $this->leafletFacade->getLeafletTitles();

        $sum_insert = 0;
        foreach ($datas as $lang => $data_lang) {
            $data2 = [];
            foreach ($data_lang as $name => $data) {
                $shop = $this->shopFacade->getShopInfoName($name);
                $data = $data['data'];

                if (empty($data)) {
                    continue;
                }

                $data_new = [];
                foreach ($data as $data_item) {
                    if (in_array($data_item['title'], $titles)) {
                        continue;
                    }

                    $data_item['id_shop'] = $shop->id;
                    if (!array_key_exists('sub_title', $data_item)) {
                        $data_item['sub_title'] = Null;
                    }
                    $data_new[] = $data_item;
                }

                if (!empty($data_new))
                {
                    $sum_insert += count($data_new);
                    $explorer->table('leaflet')->insert($data_new);
                }
            }
        }

        return $sum_insert;
    }


}