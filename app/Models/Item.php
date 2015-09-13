<?php

namespace GW2Heroes\Models;

use Illuminate\Database\Query\Builder;

/**
 * GW2Heroes\Models\Item
 *
 * @property integer $id
 * @property string $name_de
 * @property string $name_en
 * @property string $name_es
 * @property string $name_fr
 * @property string $data_de
 * @property string $data_en
 * @property string $data_es
 * @property string $data_fr
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static Builder|Item whereId($value)
 * @method static Builder|Item whereNameDe($value)
 * @method static Builder|Item whereNameEn($value)
 * @method static Builder|Item whereNameEs($value)
 * @method static Builder|Item whereNameFr($value)
 * @method static Builder|Item whereDataDe($value)
 * @method static Builder|Item whereDataEn($value)
 * @method static Builder|Item whereDataEs($value)
 * @method static Builder|Item whereDataFr($value)
 * @method static Builder|Item whereCreatedAt($value)
 * @method static Builder|Item whereUpdatedAt($value)
 * @method static Builder|Item whereStringContains($column, $value, $boolean = 'and')
 * @method static Builder|Item orWhereStringContains($column, $value)
 * @method static Builder|Item random($amount = 1)
 */
class Item extends Model {
    protected $table = 'items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_de', 'name_en', 'name_es', 'name_fr',
        'data_de', 'data_en', 'data_es', 'data_fr'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'data_de' => 'object',
        'data_en' => 'object',
        'data_es' => 'object',
        'data_fr' => 'object'
    ];
}
