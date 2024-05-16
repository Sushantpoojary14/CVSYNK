<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cities extends Model
{
    use HasFactory;
    protected $fillable = [
        'city_name',
        'state_id'
    ];
    protected array $defaultColumns = [
        'id',
        'city_name',
        'state_id',
    ];
    public function newQuery($excludeDeleted = true)
    {
        $query = parent::newQuery($excludeDeleted);

        $query->select($this->defaultColumns);
        return $query;
    }

    public function state(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(states::class, 'state_id', 'id');
    }
    public function post(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->HasMany(Posts::class, 'city_id', 'id');


    }
}
