<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'job_title',
        'job_description',
        'job_requirement',
        'job_category_id',
        'state_id',
        'city_id',
        'user_id',
        'posted_date'
    ];
    protected array $defaultColumns = [
        'id',
        'company_name',
        'job_title',
        'job_description',
        'job_requirement',
        'job_category_id',
        'state_id',
        'city_id',
        'user_id',
        'posted_date'
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

    public function city(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(cities::class, 'city_id', 'id');
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(job_categories::class, 'job_category_id', 'id');


    }
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');

    }
    public function applied(): \Illuminate\Database\Eloquent\Relations\hasOne{
        return $this->hasOne(UserJobApply::class, 'post_id', 'id');

    }

}
