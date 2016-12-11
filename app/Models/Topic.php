<?php
namespace PMU\Models;

use PMU\Presenters\DatePresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends BaseModel
{
    use DatePresenter,SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'topics';

    /**
     * Validation rules to store a topic.
     *
     * @var array
     */
    public static $storeTopicRules = [
        'title' => 'required|max:255',
        'description' => 'required|max:65000',
        'levelId' => 'required|exists:levels,id',
        'authorName' => 'sometimes|full_name',
        'h1' => 'sometimes',
        'metaTitle' => 'sometimes',
        'metaDescription' => 'sometimes',
        'metaKeywords' => 'sometimes'
    ];
    
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'h1'        => 'string',
        'metaTitle' => 'string',
        'metaKeywords' => 'string',
        'metaDescription' => 'string'
    ];

    /**
     * Scope a query to only include active topics.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    /**
     * Scope a query to only include inactive topics.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInactive($query)
    {
        return $query->where('active', 0);
    }

    /**
     * Scope a query to only include Latest topics.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNewestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Scope a query to search topics.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $title)
    {
        return $query->where('title', 'like', '%' . $title . '%');
    }

    /**
     * Scope a query to search topics.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBachelore($query, $title)
    {
        return $query->where('level_id', 1);
    }

    /**
     * Scope a query to search Bachelore topics.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMaster($query, $title)
    {
        return $query->where('level_id', 2);
    }

    /**
     * Scope a query to Specialization topics.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSpecialization($query, $title)
    {
        return $query->where('level_id', 3);
    }

    /**
     * One to Many relation.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function level()
    {
        return $this->belongsTo(env('APP_MODEL_NAMESPACE') . 'Level');
    }
}
