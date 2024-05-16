<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserJobApply extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_id',
        'user_id'
    ];
    protected $table = "UserJobApply";
    protected array $defaultColumns = [
        'id',
        'post_id',
        'user_id'
    ];
    public function newQuery($excludeDeleted = true)
    {
        $query = parent::newQuery($excludeDeleted);

        $query->select($this->defaultColumns);
        return $query;
    }
    public function post(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(Posts::class, 'post_id', 'id');


    }
    public function user(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');


    }
}
