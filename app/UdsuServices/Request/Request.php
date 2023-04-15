<?php
/**
 * С помощью Небес!
 *
 * @copyright   2021 Ivan Novostruev emsitef@gmail.com
 */

namespace App\UdsuServices\Request;

use ErrorException;

interface Request
{
    /**
     * @param array $params
     * @return Request
     * @throws ErrorException
     */
    public function execute(array $params = []): self;

    /**
     * @return string
     */
    public function getResult(): string;
}
