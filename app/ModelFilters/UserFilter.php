<?php

namespace App\ModelFilters;

use Carbon\Carbon;
use EloquentFilter\ModelFilter;

class UserFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * @param $status
     * @return $this|UserFilter App\ModelFilters\UserFilter.where
     */
    public function status($status): UserFilter|static
    {
        return $status === 'all' ? $this : $this->where('status', $status);
    }

    public function created($created)
    {
        return $created ? $this->whereDate('created_at', $created) : $this;
    }
}
