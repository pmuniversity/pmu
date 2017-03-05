<?php

namespace App\Models;

use Auth;
use App\Models\Topic;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use CrudTrait;

    /*
   |--------------------------------------------------------------------------
   | GLOBAL VARIABLES
   |--------------------------------------------------------------------------
   */

    //protected $table = 'articles';
    //protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['topic_id', 'type_title', 'source_url', 'title',
        'description', 'web_picture', 'mobile_picture', 'video_url',
        'author_name', 'author_location', 'author_organization',
        'author_designation', 'author_picture',
        'status', 'top', 'date'];
    // protected $hidden = [];
    // protected $dates = [];

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
            $model->topic_id = \Route::current()->parameter('topic_id');
        });
        static::updating(function ($model) {
            $user = Auth::user();
            $model->last_user_id = $user->id;
        });
    }

    /*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
	*/

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'article_tag');
    }

    /*
	|--------------------------------------------------------------------------
	| SCOPES
	|--------------------------------------------------------------------------
	*/
    public function scopePublished($query)
    {
        return $query->where('status', 1)
            ->where('date', '<=', date('Y-m-d'))
            ->orderBy('date', 'DESC');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }


    /*
	|--------------------------------------------------------------------------
	| ACCESORS
	|--------------------------------------------------------------------------
	*/

    /*
	|--------------------------------------------------------------------------
	| MUTATORS
	|--------------------------------------------------------------------------
	*/
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucwords(trim($value));
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = ucwords(trim($value));
    }

    public function setSourceUrlAttribute($value)
    {
        $this->attributes['source_url'] = strtolower(trim($value));
    }

    public function setVideoUrlAttribute($value)
    {
        $this->attributes['video_url'] = strtolower(trim($value));
    }

    public function setAuthorNameAttribute($value)
    {
        $this->attributes['author_name'] = ucwords(trim($value));
    }

    public function setAuthorLocationAttribute($value)
    {
        $this->attributes['author_location'] = ucwords(trim($value));
    }

    public function setAuthorOrganizationAttribute($value)
    {
        $this->attributes['author_organization'] = ucwords(trim($value));
    }

    public function setAuthorDesignationAttribute($value)
    {
        $this->attributes['author_designation'] = ucwords(trim($value));
    }
}
