<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, HasAdvancedFilter, SoftDeletes;

    public $table = 'schedules';

    protected $dates = [
        'schedule',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'broker',
        'boker_mail',
        'buyer',
        'buyer_mail',
        'schedule',
        'address',
        'buyer_signature',
        'broker_signature',
        'file',
        'time_stamp',
    ];

    public $orderable = [
        'id',
        'broker',
        'boker_mail',
        'buyer',
        'buyer_mail',
        'schedule',
        'address',
        'buyer_signature',
        'broker_signature',
        'file',
        'time_stamp',
    ];

    public $filterable = [
        'id',
        'broker',
        'boker_mail',
        'buyer',
        'buyer_mail',
        'schedule',
        'address',
        'buyer_signature',
        'broker_signature',
        'file',
        'time_stamp',
        'partners.name',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getScheduleAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function setScheduleAttribute($value)
    {
        $this->attributes['schedule'] = $value ? Carbon::createFromFormat(config('project.datetime_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function partners()
    {
        return $this->belongsToMany(Partner::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function getUpdatedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function getDeletedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }
}
