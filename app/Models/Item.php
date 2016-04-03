<?php

namespace GW2Heroes\Models;

use HTML;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\HtmlString;

/**
 * GW2Heroes\Models\Item
 *
 * @property integer $id
 * @property string $name_de
 * @property string $name_en
 * @property string $name_es
 * @property string $name_fr
 * @property mixed $data_de
 * @property mixed $data_en
 * @property mixed $data_es
 * @property mixed $data_fr
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
 * @mixin \Eloquent
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

    /**
     * Gets the url to the icon on the cdn.
     *
     * @param int $size Minimum size of the icon
     * @return string
     */
    public function getIconUrl( $size = 64 ) {
        $size = intval( $size );
        if( !in_array( $size, array( 16, 32, 64 ) ) ) {
            if( $size <= 16 ) {
                $size = 16;
            } elseif( $size <= 32 ) {
                $size = 32;
            } else {
                $size = 64;
            }
        }

        preg_match('/\/(?<signature>[^\/]*)\/(?<file_id>[^\/]*)\.png$/', $this->data_en->icon, $icon);
        $signature = $icon['signature'];
        $file_id = $icon['file_id'];

        return 'https://darthmaim-cdn.de/gw2treasures/icons/' . $signature . '/' . $file_id . '-' . $size . 'px.png';
    }

    public function getIcon( $size = 32 ) {
        $attributes = [
            'width' => $size,
            'height' => $size,
            'crossorigin' => 'anonymous'
        ];

        if( $size <= 32 ) {
            $attributes['srcset'] = $this->getIconUrl( $size * 2 ).' 2x';
        }

        return new HtmlString(
            HTML::image($this->getIconUrl(32), null, $attributes)
        );
    }
}
