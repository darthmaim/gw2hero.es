<?php

namespace GW2Heroes\Models;

use HTML;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;

/**
 * GW2Heroes\Models\Specialization
 *
 * @property-read Collection|Traits[] $traits
 * @property integer $id
 * @property string $profession
 * @property boolean $elite
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
 * @method static Builder|Specialization whereId($value)
 * @method static Builder|Specialization whereProfession($value)
 * @method static Builder|Specialization whereElite($value)
 * @method static Builder|Specialization whereNameDe($value)
 * @method static Builder|Specialization whereNameEn($value)
 * @method static Builder|Specialization whereNameEs($value)
 * @method static Builder|Specialization whereNameFr($value)
 * @method static Builder|Specialization whereDataDe($value)
 * @method static Builder|Specialization whereDataEn($value)
 * @method static Builder|Specialization whereDataEs($value)
 * @method static Builder|Specialization whereDataFr($value)
 * @method static Builder|Specialization whereCreatedAt($value)
 * @method static Builder|Specialization whereUpdatedAt($value)
 * @method static Builder|Specialization whereStringContains($column, $value, $boolean = 'and')
 * @method static Builder|Specialization orWhereStringContains($column, $value)
 * @method static Builder|Specialization random($amount = 1)
 * @mixin \Eloquent
 */
class Specialization extends Model {
    protected $table = 'specializations';

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

    public function traits() {
        return $this->hasMany(Traits::class)->orderBy('tier', 'asc');
    }

    public function getBackgroundUrl() {
        preg_match('/\/(?<signature>[^\/]*)\/(?<file_id>[^\/]*)\.png$/', $this->data_en->background, $icon);
        $signature = $icon['signature'];
        $file_id = $icon['file_id'];

        return 'https://darthmaim-cdn.de/gw2/specializations/'.$signature.'/'.$file_id.'.png';
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

        return new HtmlString(
            HTML::image($this->getIconUrl(32), null, $attributes)
        );
    }
}
