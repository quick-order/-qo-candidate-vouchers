<?php

namespace App\Models;

use App\Traits\ValidateTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Product
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $price_each
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product wherePriceEach($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Product withoutTrashed()
 */
class Product extends Model
{
    use ValidateTrait;

    protected $visible = [
        'id',
        'price_each',
        'description',
        'updated',
        'created'
    ];

    protected $fillable = [
        'price_each',
        'description'
    ];

    public static function createRules() {
        return [
            'price_each'    => 'int',
            'description'   => 'string|nullable',
        ];
    }

    public static function updateRules() {
        return [
            'price_each'    => 'int',
            'description'   => 'string|nullable',
        ];
    }
}
