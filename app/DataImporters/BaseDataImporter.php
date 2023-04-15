<?php

namespace App\DataImporters;

class BaseDataImporter implements DataImporter
{
    /**
     * @var array Переменная для хранения названий ошибок
     */
    protected array $errors = [];

    /**
     * @param array $data
     */
    public function import(array $data): void
    {
        $data = static::removeFirstRow($data);
        $data = static::removeEmptyRows($data);

        if (!$this->preprocess($data)) {
            return;
        }
        $this->execute($data);
    }

    /**
     * Нужно выбрать стратегию проверки!!! Есть много различных стратегий проверки.
     * Пока что мне не ясно, какая самая оптимальная с точки зрения производительности
     * и удобства получения результатов проверки
     *
     * @param array $rows
     * @return bool
     */
    protected function preprocess(array $rows): bool
    {
        $defectiveRows = []; // бракованные ряды

        foreach ($rows as $rowNumber => $row) {
            $key = $rowNumber + 2;

            $this->checkData($row);
        }
        return empty($this->errors);
    }

    /**
     * override if needed
     *
     * @param array $row
     */
    protected function checkData(array $row): void {}

    /**
     * @param string $error
     */
    protected function addError(string $error): void
    {
        $this->errors[] = $error;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Выполняет импорт данных в БД
     *
     * @param array $data
     */
    protected function execute(array $data): void {}

    /**
     * Удаляет первый ряд с названиями столбцов
     *
     * @param array $array
     * @return array
     */
    protected static function removeFirstRow(array $array): array
    {
        return array_slice($array, 1);
    }

    /**
     * Удаляет пустые ряды в массиве
     *
     * @param array $array
     * @return array
     */
    protected static function removeEmptyRows(array $array): array
    {
        foreach ($array as $key => $values) {
            $cnt = 0;
            foreach ($values as $value) {
                if ($value === null) {
                    $cnt++;
                }
            }

            $length = count($values);
            if ($cnt === $length) {
                unset($array[$key]);
            }
        }
        return $array;
    }
}
