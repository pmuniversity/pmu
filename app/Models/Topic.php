<?php

namespace App\Models;

use Auth;
use App\Models\Article;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;


class Topic extends Model
{
    use CrudTrait;
    use Sluggable, SluggableScopeHelpers;
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    protected $fillable = ['level_title',
        'title', 'slug', 'summary', 'note_title', 'note_description', 'h1', 'meta_description', 'meta_keywords',
        'featured', 'date', 'web_picture', 'web_hover_picture', 'mobile_picture', 'mobile_hover_picture'];
    protected $casts = [
        'featured' => 'boolean',
        'date' => 'date',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'slug_or_title',
            ],
        ];
    }
    /*
	|--------------------------------------------------------------------------
	| FUNCTIONS
	|--------------------------------------------------------------------------
	*/
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->user_id = $user->id;
            $model->last_user_id = $user->id;
        });
        static::updating(function ($model) {
            $user = Auth::user();
            $model->last_user_id = $user->id;
        });
    }

    /**
     * Get next record
     */
    public function nextRecord()
    {
        return $this->where('id', '<', $this->id)->where('level_title', '=', $this->level_title)->max('id');
    }

    /**
     * * Get previous record
     */
    public function previousRecord()
    {
        return $this->where('id', '>', $this->id)->where('level_title', '=', $this->level_title)->min('id');
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopePublished($query)
    {
        return $query->where('status', 'PUBLISHED')
            ->where('date', '<=', date('Y-m-d'))
            ->orderBy('date', 'DESC');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    // The slug is created automatically from the "title" field if no slug exists.
    public function getSlugOrTitleAttribute()
    {
        if ($this->slug != '') {
            return $this->slug;
        }

        return $this->title;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = trim(ucwords($value));
    }

    public function setSummaryAttribute($value)
    {
        $this->attributes['summary'] = trim(ucwords($value));
    }

    public function setNoteTitleAttribute($value)
    {
        $this->attributes['note_title'] = trim(ucwords($value));
    }

    public function setNoteDescriptionAttribute($value)
    {
        $this->attributes['note_description'] = trim(ucwords($value));
    }

    public function setWebPictureAttribute($value)
    {
        $this->attributes['web_picture'] = $value;
        $this->attributes['web_hover_picture'] = $value;
    }

    public function setMobilePictureAttribute($value)
    {
        $this->attributes['mobile_picture'] = $value;
        $this->attributes['mobile_hover_picture'] = $value;
    }
}
