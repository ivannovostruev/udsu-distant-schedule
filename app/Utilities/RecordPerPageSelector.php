<?php

namespace App\Utilities;

use Illuminate\Http\Request;

/**
 * Выборщик количества записей на страницу
 */
class RecordPerPageSelector
{
    private const OPTIONS = [5, 10, 20, 50, 100, 200, 500, 1000];

    private const DEFAULT_PER_PAGE = 10;

    private const QUERY_STRING_PARAMETER_NAME = 'per_page';

    private int $perPage;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->setPerPage($request);
    }

    /**
     * @param Request $request
     */
    public function setPerPage(Request $request): void
    {
        $this->perPage = (int) $request->query(
            self::QUERY_STRING_PARAMETER_NAME,
            self::DEFAULT_PER_PAGE
        );
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }

    /**
     * @return int[]
     */
    public function getOptions(): array
    {
        return self::OPTIONS;
    }
}
