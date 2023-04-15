<?php
/**
 * С помощью Небес!
 *
 * @copyright   2022 Novostruev Ivan emsitef@gmail.com
 */

namespace App\Novostruev;

use Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelParser
{
    /**
     * @param string $filename
     * @return array
     */
    public static function parse(string $filename): array
    {
        try {
            $spreadsheet = IOFactory::load($filename);
        } catch (Exception $e) {
            @unlink($filename);
            die('Xlsx-файл содержит инъекцию');
        }

        @unlink($filename);

        return $spreadsheet->getActiveSheet()
            ->toArray(null, true, true, true);
    }
}
