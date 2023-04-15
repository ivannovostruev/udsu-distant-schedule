<?php
/**
 * С помощью Небес!
 *
 * @copyright   2022 Novostruev Ivan emsitef@gmail.com
 */

namespace App\DataImporters;

interface DataImporter
{
    public function import(array $data): void;

    public function getErrors(): array;
}
