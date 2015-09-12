<?php

namespace GW2Heroes\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as EloquentModel;

abstract class Model extends EloquentModel {
    /**
     * @param Builder $query
     * @param $column
     * @param $value
     * @param string $boolean
     * @return static
     */
    public function scopeWhereStringContains( Builder $query, $column, $value, $boolean = 'and') {
        // custom escape character (backslashes get really weird with with quadruple escapes…)
        $e = '=';

        // escape the escape char and wildcards
        $replacements = [
            $e  => $e.$e,
            '%' => $e.'%',
            '_' => $e.'_'
        ];
        $value = '%'.strtr( $value, $replacements ).'%';

        // run the query
        return $query->whereRaw("UPPER(`$column`) LIKE ? ESCAPE '$e'", [$value], $boolean);
    }

    /**
     * @param Builder $query
     * @param $column
     * @param $value
     * @return Model
     */
    public function scopeOrWhereStringContains( Builder $query, $column, $value ) {
        return $this->scopeWhereStringContains( $query, $column, $value, 'or' );
    }
}
