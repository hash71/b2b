<?php

namespace App\Paginators;

use Illuminate\Pagination\LengthAwarePaginator;

class PaginationMerger
{


    private function myCompare($a, $b)
    {
        return strcmp($a->created_at, $b->updated_at);

    }

    /**
     * @param LengthAwarePaginator $collection1
     * @param LengthAwarePaginator $collection2
     * @return LengthAwarePaginator
     */
    public function merge(LengthAwarePaginator $collection1, LengthAwarePaginator $collection2)
    {
        $total = $collection1->total() + $collection2->total();

        $perPage = $collection1->perPage() + $collection2->perPage();

        $items = array_merge($collection1->items(), $collection2->items());

        usort($items, [$this, 'myCompare']);

        dd($items);

        $paginator = new LengthAwarePaginator($items, $total, $perPage);

        return $paginator;
    }


}