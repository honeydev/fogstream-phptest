<?php

declare(strict_types=1);

namespace News\Helpers;

use \Illuminate\Pagination\LengthAwarePaginator;

class MergePaginationHelper 
{
    public static function merge(LengthAwarePaginator $pagination, array $data): array
    {
        $paginationArray = $pagination->toArray();
        $paginationArray['data'] = $data;
        return $paginationArray;
    }
}
