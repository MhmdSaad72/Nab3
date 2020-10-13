<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'companies';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [ 'companyName', 'telephone', 'telephone2', 'telephone3', 'fax', 'zip', 'postBox', 'city', 'location', 'street', 'url', 'career', 'email', 'logo_path', 'bio', 'pageView', 'fb', 'linkedin', 'twitter', 'insta', 'status', 'featured' , 'category_id' , 'country_id' , 'degree_id' , 'latest_search'];


    /* relation function with categories table */
    public function category()
    {
      return $this->belongsTo('App\Category' , 'category_id');
    }

    /* relation function with countries table */
    public function country()
    {
      return $this->belongsTo('App\Country' , 'country_id');
    }

    /* relation function with degrees table */
    public function degree()
    {
      return $this->belongsTo('App\Degree' , 'degree_id');
    }

    /* relation function with mistake_reports table */
    public function mistakes()
    {
      return $this->hasMany('App\MistakeReport' , 'company_id');
    }


    public function getStatusAttribute($attribute)
    {
      return [
        NULL => 'Not Approved',
        0 => 'Not Approved',
        1 => 'Approved',
      ][$attribute];
    }
    public function getFeaturedAttribute($attribute)
    {
      return [
        NULL => 'No',
        0 => 'No',
        1 => 'Yes',
      ][$attribute];
    }

}
