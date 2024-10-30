<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderFulfillment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'order_id', 'end_date', 'status'];

    # статусы выполнения
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_CONFIRMATION = 'confirmation';
    const STATUS_COMPLETED = 'completed';
    const STATUS_DENIED = 'denied';
    const STATUS_CANCELLED = 'cancelled';

    public static function getStatuses()
    {
        return [
            self::STATUS_IN_PROGRESS => 'В работе',
            self::STATUS_CONFIRMATION => 'На утверждении',
            self::STATUS_COMPLETED => 'Завершён',
            self::STATUS_DENIED => 'Отклонён',
            self::STATUS_CANCELLED => 'Отменён',
        ];
    }

    public function files(){
        return $this->morphMany(File::class, 'entity');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
