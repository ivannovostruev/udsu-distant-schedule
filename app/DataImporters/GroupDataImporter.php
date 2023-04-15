<?php
/**
 * С помощью Небес!
 *
 * @copyright   2022 Novostruev Ivan emsitef@gmail.com
 */

namespace App\DataImporters;

use App\Models\Schedule\Group;
use App\Novostruev\DataChecker;

class GroupDataImporter extends BaseDataImporter
{
    /**
     * @param array $row
     */
    protected function checkData(array $row): void
    {
        $name = $row['A'] ?? null;

        if ($errorMessage = DataChecker::checkName($name)) {
            $this->addError($errorMessage);
        }
    }

    /**
     * @param array $data
     */
    protected function execute(array $data): void
    {
        foreach ($data as $modelData) {
            $name = $modelData['A'];

            $group = Group::where('name', $name)->first();
            if ($group) {
                continue;
            }
            Group::create(['name' => $name]);
        }
    }
}
