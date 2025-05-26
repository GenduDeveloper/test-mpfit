<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 *
 * @property int $id
 * @property string $customer_name
 * @property string $customer_surname
 * @property string $customer_patronymic
 * @property string $created_at
 * @property string $status
 * @property string|null $comment
 * @property int $product_id
 * @property int $product_quantity
 * @property string $total_price
 * @property-read \App\Models\Product $product
 * @method static \Database\Factories\OrderFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerPatronymic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereProductQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTotalPrice($value)
 * @mixin \Eloquent
 */
class Order extends Model
{
    use HasFactory;

    const PER_PAGE = 15;

    protected $table = 'orders';

    public $timestamps = false;

    protected $fillable = [
        'customer_name',
        'customer_surname',
        'customer_patronymic',
        'created_at',
        'status',
        'comment',
        'product_id',
        'product_quantity',
        'total_price'
    ];

    protected $casts = [
        'created_at'  => 'datetime:Y-m-d H:i:s',
        'status'      => OrderStatusEnum::class,
        'total_price' => 'decimal:2'
    ];

    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => mb_ucfirst($this->customer_name)
                . ' ' . mb_ucfirst($this->customer_surname)
                . ' ' . mb_ucfirst($this->customer_patronymic)
        );
    }

    public function customerName(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => mb_strtolower($value)
        );
    }

    public function customerSurname(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => mb_strtolower($value)
        );
    }

    public function customerPatronymic(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => mb_strtolower($value)
        );
    }

    public function comment(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => mb_strtolower($value)
        );
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
