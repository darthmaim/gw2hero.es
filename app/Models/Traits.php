<?php

namespace GW2Heroes\Models;

use HTML;
use Illuminate\Database\Query\Builder;
use Illuminate\View\Expression;

/**
 * GW2Heroes\Models\Traits
 *
 * @property integer $id
 * @property integer $specialization_id
 * @property integer $tier
 * @property string $slot
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
 * @method static Builder|Traits whereId($value)
 * @method static Builder|Traits whereSpecializationId($value)
 * @method static Builder|Traits whereTier($value)
 * @method static Builder|Traits whereSlot($value)
 * @method static Builder|Traits whereNameDe($value)
 * @method static Builder|Traits whereNameEn($value)
 * @method static Builder|Traits whereNameEs($value)
 * @method static Builder|Traits whereNameFr($value)
 * @method static Builder|Traits whereDataDe($value)
 * @method static Builder|Traits whereDataEn($value)
 * @method static Builder|Traits whereDataEs($value)
 * @method static Builder|Traits whereDataFr($value)
 * @method static Builder|Traits whereCreatedAt($value)
 * @method static Builder|Traits whereUpdatedAt($value)
 * @method static Builder|Traits whereStringContains($column, $value, $boolean = 'and')
 * @method static Builder|Traits orWhereStringContains($column, $value)
 * @method static Builder|Traits random($amount = 1)
 */
class Traits extends Model {
    protected $table = 'traits';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'specialization',
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

    public function specialization() {
        return $this->belongsTo(Specialization::class);
    }

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

        return new Expression(
            HTML::image($this->getIconUrl(32), null, $attributes)
        );
    }
}
