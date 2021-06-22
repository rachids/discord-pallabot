<?php


namespace App\Helper\Parser;

use DOMDocument;
use DOMNodeList;

class AbstractParser
{
    protected DOMDocument $dom;
    protected DOMNodeList $data;

    public function __construct(DOMDocument $dom, string $html)
    {
        $this->dom = $dom;
        $this->dom->loadHTML($html, LIBXML_NOERROR);

        $this->data = $this->dom->getElementsByTagName('td');
    }

    protected function getTextFromNode(int $item): string
    {
        return $this->data->item($item)->textContent;
    }

}
