<?php
/**
 * С помощью Небес!
 *
 * @copyright   2021 Ivan Novostruev emsitef@gmail.com
 */

namespace App\UdsuServices\DataDecoder;

use Exception;
use SimpleXMLElement;

class XmlDataDecoder implements DataDecoder
{
    /**
     * @param $data
     * @return SimpleXMLElement
     * @throws Exception
     */
    public function decode($data): SimpleXMLElement
    {
        return new SimpleXMLElement($data);
    }
}
