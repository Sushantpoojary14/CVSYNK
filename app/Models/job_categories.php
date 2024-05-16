<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class job_categories extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_category_name',
    ];
    protected array $defaultColumns = [
        'id',
        'job_category_name',
    ];
    public function newQuery($excludeDeleted = true)
    {
        $query = parent::newQuery($excludeDeleted);

        $query->select($this->defaultColumns);
        return $query;
    }
    public function post(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->HasMany(Posts::class, 'job_category_id', 'id');


    }
}
