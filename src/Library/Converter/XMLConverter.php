<?php
declare(strict_types=1);

namespace App\Library\Converter;

use SimpleXMLIterator;

class XMLConverter implements \ConverterInterface
{

    public function xmlToArray(SimpleXMLIterator $iterator): array
    {
        // TODO: Implement xmlToArray() method.
    }

    public function arrayToXML(array $arr)
    {
        // TODO: Implement arrayToXML() method.
    }

    public function phpToXML($value, &$xml)
    {
        // TODO: Implement phpToXML() method.
    }
}