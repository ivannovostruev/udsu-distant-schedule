<?php

namespace App\Utilities;

use Illuminate\Http\Request;

class SortLink
{
    protected int $currentOrder;

    protected Request $request;

    /**
     * @param Request $request
     * @param int $currentOrder
     */
    public function __construct(Request $request, int $currentOrder)
    {
        $this->request = $request;
        $this->currentOrder = $currentOrder;
    }

    /**
     * @param string $title
     * @param array $orders
     * @return string
     */
    public function get(string $title, array $orders): string
    {
        $link = '<a href="';
        $link .= $this->getUrl();
        $this->attachQueryString($link, $orders);
        $link .= '">';
        $link .= $title;
        $link .= '</a>';
        return $link;
    }

    /**
     * @return string
     */
    private function getUrl(): string
    {
        return $this->request->url();
    }

    /**
     * @param string $link
     * @param array $orders
     */
    private function attachQueryString(string &$link, array $orders)
    {
        if (!empty($orders) && count($orders) === 2) {
            $link .= '?';
            $link .= $this->getQueryStringFromArray(
                $this->getQueryWithOrder($orders)
            );
        }
    }

    /**
     * @param array $orders
     * @return int[]
     */
    private function getQueryWithOrder(array $orders): array
    {
        $query = ['order' => $this->defineOrder($orders)];
        $query += array_filter($this->request->query());
        return $query;
    }

    /**
     * @param array $orders
     * @return int
     */
    private function defineOrder(array $orders): int
    {
        $current = $this->currentOrder;
        $orderOne = $orders[0];
        $orderTwo = $orders[1];

        return match ($current) {
            $orderOne => $orderTwo,
            default   => $orderOne,
        };
    }

    /**
     * @param array $query
     * @return string
     */
    private function getQueryStringFromArray(array $query): string
    {
        $queryString = '';
        $ampersand = false;

        foreach ($query as $param => $value) {
            if ($ampersand) {
                $queryString .= '&';
            }
            $queryString .= $param . '=' . $value;
            $ampersand = true;
        }
        return $queryString;
    }
}
