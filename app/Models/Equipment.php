<?php

namespace GW2Heroes\Models;

use Illuminate\Database\Query\Builder;

/**
 * GW2Heroes\Models\Equipment
 *
 * @property-read Character $character
 * @property-read Item $item
 * @property integer $id
 * @property integer $character_id
 * @property string $slot
 * @property integer $item_id
 * @property mixed $data
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static Builder|Equipment whereId($value)
 * @method static Builder|Equipment whereCharacterId($value)
 * @method static Builder|Equipment whereSlot($value)
 * @method static Builder|Equipment whereItemId($value)
 * @method static Builder|Equipment whereData($value)
 * @method static Builder|Equipment whereCreatedAt($value)
 * @method static Builder|Equipment whereUpdatedAt($value)
 * @method static Builder|Equipment whereStringContains($column, $value, $boolean = 'and')
 * @method static Builder|Equipment orWhereStringContains($column, $value)
 * @method static Builder|Equipment random($amount = 1)
 */
class Equipment extends Model {
    protected $table = 'equipment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'character_id', 'slot', 'item_id', 'data'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [ 'data' => 'object' ];

    public function character() {
        return $this->belongsTo(Character::class);
    }

    public function item() {
        return $this->belongsTo(Item::class);
    }
}
