<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class states extends Model
{
    use HasFactory;
    protected $fillable = [
        'state_name',
    ];
    protected array $defaultColumns = [
        'id',
        'state_name',
    ];
    protected $table = "states";
    public function newQuery($excludeDeleted = true)
    {
        $query = parent::newQuery($excludeDeleted);

        $query->select($this->defaultColumns);
        return $query;
    }

    public function post(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->HasMany(Posts::class, 'state_id', 'id');


    }
    public function city(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->HasMany(cities::class, 'state_id', 'id');


    }
}
