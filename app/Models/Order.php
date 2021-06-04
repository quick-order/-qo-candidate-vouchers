<?php

namespace App\Models;

use App\Traits\ValidateTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Order
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\OrderLine[] $lines
 * @property-read int|null $lines_count
 * @property-read \App\Voucher|null $voucher
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Order onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order query()
 * @method static \Illuminate\Database\Query\Builder|\App\Order withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Order withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property int $total
 * @property int $voucher_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereVoucherId($value)
 */
class Order extends Model
{
    use ValidateTrait;

    /**
     * TODO talk: Order should reflect the database table and therefore I won't versioning Models
     *
     * @deprecated voucher_id Only to be used until bulk vouchers feature is launched on the app
     * @var string[]
     */
    protected $visible = [
        'id',
        'voucher_id',
        'total',
        'created_at',
        'updated_at',
    ];

    /**
     * @deprecated voucher_id Only to be used until bulk vouchers feature is launched on the app
     * @var string[]
     */
    protected $fillable = [
        'voucher_id',
        'total'
    ];

    public function calculateTotal() {
        $total = 0;

        if($this->lines && $this->lines->isNotEmpty()) {
            $total += $this->lines->sum(fn (OrderLine $ol) => $ol->amount_total);
        }

        foreach ($this->vouchers as $voucher) {
            $total += $voucher->amount_original;
        }

        $this->total = $total;
    }

    public function lines() {
        return $this->hasMany(OrderLine::class);
    }

    /**
     * @return HasMany
     */
    public function vouchers(): HasMany
    {
        return $this->hasMany(Voucher::class);
    }

    /**
     * @deprecated voucher_id Only to be used until bulk vouchers feature is launched on the app
     * @return BelongsTo
     */
    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class);
    }

    /**
     * @deprecated voucher_id Only to be used until bulk vouchers feature is launched on the app
     * @return string[]
     */
    public static function createRules() {
        return [
            'voucher_id'           => 'int|nullable',
        ];
    }

    /**
     * @deprecated voucher_id Only to be used until bulk vouchers feature is launched on the app
     * @return string[]
     */
    public static function updateRules() {
        return [
            'voucher_id'           => 'int|nullable',
        ];
    }

}
