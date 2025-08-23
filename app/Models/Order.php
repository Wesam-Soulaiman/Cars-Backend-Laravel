<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['category_service_id', 'service_id', 'service_type_id', 'store_id', 'count_days', 'price', 'count_product', 'start_time', 'end_time', 'active'];

    protected $appends = ['real_active'];

    public function getRealActiveAttribute()
    {
        return $this->start_time <= now()
            && $this->end_time >= now()
            && $this->active == 1;
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function scopeActive($query)
    {
        return $query->where('start_time', '<=', now())
            ->where('end_time', '>=', now())
            ->where('active', '=', 1);

    }

    public function scopeInActive($query)
    {
        return $query->where(function ($q) {
            $q->where('start_time', '>', now())
                ->orWhere('end_time', '<', now())
                ->orWhere('active', 0);
        });
    }
}
