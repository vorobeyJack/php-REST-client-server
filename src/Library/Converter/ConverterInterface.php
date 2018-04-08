<?php declare(strict_types = 1);

namespace vrba\rest\Library\Converter;

/**
 * Interface ConverterInterface
 *
 * @package vrba\rest\Library\Converter
 */
interface ConverterInterface
{
    /**
     * Convert xml to array.
     *
     * @param \SimpleXMLIterator $iterator
     * @return array
     */
    public function xmlToArray(\SimpleXMLIterator $iterator): array;

    /**
     * Convert array to xml.
     *
     * @param array $arr
     * @return mixed
     */
    public function arrayToXml(array $arr);

    /**
     * Convert php to xml
     *
     * @param $value
     * @param $xml
     * @return mixed
     */
    public function phpToXml($value, &$xml);
}