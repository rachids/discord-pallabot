<?php


namespace App\Services;

use App\Helper\Parser\AbstractParser;
use App\Helper\Parser\PalladiumParser;
use Illuminate\Support\Facades\Http;

/**
 * Class EmpireService
 * @package App\Services
 *
 * Cette classe récupère toutes les informations utiles concernant un empire de Kraland.org.
 * Par défaut, la Palladium-Corporation.
 */
class EmpireService
{
    const AVAILABLE_EMPIRES = ['rk', 'eb', 'pc', 'ts', 'pv', 'ke', 'cl', 'rr', 'pi', 'all'];

    const REPUBLIK_KRALAND = '4_2_1';
    const EMPIRE_BRUN = '4_2_2';
    const PALLADIUM_CORP = '4_2_3';
    const THEOCRATIE_SEELIENNE = '4_2_4';
    const PARADIGME_VERT = '4_2_5';
    const KHANAT_ELMERIEN = '4_2_6';
    const CONFEDERATION_LIBRE = '4_2_7';
    const ROYAUME_RUTHVENIE = '4_2_8';
    const PROVINCES_INDEPENDANTES = '4_2_9';
    const ALL_EMPIRES = '4_2';

    const URL = 'http://www.kraland.org/main.php?p=%s';

    private $currentEmpire = self::PALLADIUM_CORP;

    public function getActionsPC(): string
    {
        if( $this->currentEmpire != self::PALLADIUM_CORP) {
            return "Erreur, pas le bon empire";
        }

        $value = $this->getParser()->getActionsPC();

        return "`Actions PC:` **{$value}**";
    }

    public function getIndiceEconomique(): string
    {
        return $this->getParser()->getIndiceEconomique();
    }

    private function getParser(): AbstractParser
    {
        $url = sprintf(self::URL, $this->currentEmpire);
        $html = Http::get($url)->body();

        return new PalladiumParser(new \DOMDocument(), $html);
    }
}
