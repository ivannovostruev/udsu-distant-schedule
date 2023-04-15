<?php
/**
 * С помощью Небес!
 *
 * @copyright   2022 Novostruev Ivan emsitef@gmail.com
 */

namespace App\DataImporters;

use App\Models\Schedule\Teacher;
use App\Novostruev\DataChecker;

class TeacherDataImporter extends BaseDataImporter
{
    /**
     * @param array $row
     */
    protected function checkData(array $row): void
    {
        $fullname   = $row['A'] ?? null;
        $email      = $row['B'] ?? null;

        if ($errorMessage = DataChecker::checkFullname($fullname)) {
            $this->addError($errorMessage);
        }

        if ($errorMessage = DataChecker::checkEmail($email)) {
            $this->addError($errorMessage);
        }
    }

    /**
     * @param array $data
     */
    protected function execute(array $data): void
    {
        foreach ($data as $modelData) {
            $fullName   = $modelData['A'];
            $email      = $modelData['B'];

            if (!empty($email)) {
                $teacher = Teacher::where('email', $email)->first();
                if ($teacher) {
                    continue;
                }
            }
            Teacher::create([
                'full_name' => $fullName,
                'email'     => $email,
            ]);
        }
    }
}
