<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
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
	class Order extends \Eloquent {}
}

namespace App{
/**
 * App\OrderLine
 *
 * @property-read \App\Order $order
 * @property-read \App\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderLine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderLine newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\OrderLine onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderLine query()
 * @method static \Illuminate\Database\Query\Builder|\App\OrderLine withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\OrderLine withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $description
 * @property int $product_id
 * @property int $amount_each
 * @property int $amount_total
 * @property int $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderLine whereAmountEach($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderLine whereAmountTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderLine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderLine whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderLine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderLine whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderLine whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderLine whereUpdatedAt($value)
 * @property int $order_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderLine whereOrderId($value)
 */
	class OrderLine extends \Eloquent {}
}

namespace App{
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
	class Product extends \Eloquent {}
}

namespace App{
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
	class Voucher extends \Eloquent {}
}

