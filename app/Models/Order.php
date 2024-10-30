<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    # статусы заказа
    const STATUS_CREATED = 'created';
    const STATUS_OPEN = 'open';
    const STATUS_STOPPED = 'stopped';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_CONFIRMATION = 'confirmation';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

    public static function getStatuses()
    {
        return [
            self::STATUS_CREATED => 'Создан',
            self::STATUS_OPEN => 'Открыт',
            self::STATUS_STOPPED => 'Остановлен',
            self::STATUS_IN_PROGRESS => 'В работе',
            self::STATUS_CONFIRMATION => 'На утверждении',
            self::STATUS_COMPLETED => 'Завершён',
            self::STATUS_CANCELLED => 'Отменён',
        ];
    }

    public static function getStatusCommands()
    {
        return [
            self::STATUS_CREATED => 'Создан',
            self::STATUS_OPEN => 'Опубликовать',
            self::STATUS_STOPPED => 'Снять с публикации',
            self::STATUS_IN_PROGRESS => 'Взять в работу',
            self::STATUS_CONFIRMATION => 'Отправить на утверждение',
            self::STATUS_COMPLETED => 'Завершить',
            self::STATUS_CANCELLED => 'Отменить',
        ];
    }

    public function getStatusLabel()
    {
        return self::getStatuses()[$this->status];
    }

    protected $fillable = ['user_id', 'sum', 'date_to', 'description', 'title', 'executor_id', 'status'];

    protected $casts = ['date_to' => 'datetime'];

    public function responses(){
        return $this->hasMany(Response::class);
    }

    public function files(){
        return $this->morphMany(File::class, 'entity');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function customer(){
        return $this->belongsTo(CustomerProfile::class, 'user_id', 'user_id');
    }

    public function fulfillment(){
        return $this->hasOne(OrderFulfillment::class);
    }

    public function executor(){
        return $this->belongsTo(ExecutorProfile::class, 'executor_id', 'user_id');
    }

}
