<?php


namespace App\Helper\Parser;


class PalladiumParser extends AbstractParser
{
    /**
     * Index: numéro séquentiel du "td" comportant l'information
     * Value: information qualifiée pour l'empire en cours.
     */
    const ACTIONS_PC = 31;
    const INDICE_ECO = 3;

    public function getActionsPC(): string
    {

        return $this->getTextFromNode(self::ACTIONS_PC);
    }

    public function getIndiceEconomique(): string
    {
        $indice = $this->getTextFromNode(self::INDICE_ECO);

        $emoji = match (1) {
            preg_match('#\+\d+#', $indice) => ':arrow_upper_right:',
            preg_match('#\+0#', $indice) => ':arrow_right:',
            preg_match('#-\d+#', $indice) => ':arrow_lower_right:',
        };

        dump($emoji);

        return $indice . $emoji;
    }
}
