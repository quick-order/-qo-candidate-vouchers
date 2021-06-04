<?php

namespace App\Models;

use App\Traits\ValidateTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Voucher
 *
 * @property-read \App\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Voucher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Voucher newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Voucher onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Voucher query()
 * @method static \Illuminate\Database\Query\Builder|\App\Voucher withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Voucher withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property int $amount_original
 * @property int $amount_remaining
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Voucher whereAmountOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Voucher whereAmountRemaining($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Voucher whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Voucher whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Voucher whereUpdatedAt($value)
 */
class Voucher extends Model
{
    use ValidateTrait;

    /**
     * TODO talk: Voucher should reflect the database table and therefore I won't versioning Models
     */
    protected $visible = [
        'id',
        'order_id',
        'amount_original',
        'amount_remaining',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'order_id',
        'amount_original',
        'amount_remaining'
    ];

    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @param int $orderId
     */
    public function setOrderId(int $orderId): void
    {
        $this->order_id = $orderId;
    }

    /**
     * @return string[]
     */
    public static function createRules(): array
    {
        return [
            // TODO talk: On purpose its integer ? I know from other solutions the comma is removed on purpose :)
            'amount_original'   => 'required|integer|min:0',
            'amount_remaining'  => 'required|integer|min:0',
        ];
    }

    /**
     * @return string[]
     */
    public static function updateRules(): array
    {
        return [
            'amount_original'   => 'required|integer|min:0',
            'amount_remaining'  => 'required|integer|min:0',
        ];
    }
}
