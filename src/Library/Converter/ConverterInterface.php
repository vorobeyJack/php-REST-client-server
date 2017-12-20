<?php
declare(strict_types=1);

/**
 * Interface ConverterInterface
 */
interface ConverterInterface
{
    public function xmlToArray(SimpleXMLIterator $iterator): array;

    public function arrayToXML(array $arr);

    public function phpToXML($value, &$xml);
}