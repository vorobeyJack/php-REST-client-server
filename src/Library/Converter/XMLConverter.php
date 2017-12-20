<?php
declare(strict_types=1);

namespace App\Library\Converter;

use SimpleXMLIterator;
use SimpleXMLElement;

class XMLConverter implements \ConverterInterface
{
    /**
     * @param \SimpleXMLIterator $xml
     *
     * @return array
     */
    public function xmlToArray(SimpleXMLIterator $xml): array
    {
        $a = [];
        for ($xml->rewind(); $xml->valid(); $xml->next()) {
            if (!array_key_exists($xml->key(), $a)) {
                $a[$xml->key()] = [];
            }
            if ($xml->hasChildren()) {
                $a[$xml->key()][] = $this->xmlToArray($xml->current());
            } else {
                $a[$xml->key()]          = (array)$xml->current()->attributes();
                $a[$xml->key()]['value'] = strval($xml->current());
            }
        }

        return $a;
    }

    /**
     * @param array $arr
     *
     * @return mixed
     */
    public function arrayToXML(array $arr)
    {
        $xml = new SimpleXMLElement(
            '<?xml version="1.0" standalone="yes"?><root></root>');
        $this->phpToXml($arr, $xml);

        return $xml->asXML();
    }

    public function phpToXML($value, &$xml)
    {
        // TODO: Implement phpToXML() method.
    }
}