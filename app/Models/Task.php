<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['name','done','order','group_key'];

    protected static function boot()
{
    parent::boot();

    static::addGlobalScope('crated_at', function (Builder $builder) {
        $builder->orderBy('created_at', 'desc');
    });
}
    
}
