<?php
/**
 * С помощью Небес!
 *
 * @copyright   2021 Ivan Novostruev emsitef@gmail.com
 */

namespace App\UdsuServices\DataDecoder;

interface DataDecoder
{
    /**
     * @param $data
     * @return mixed
     */
    public function decode($data);
}
