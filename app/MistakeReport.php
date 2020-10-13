<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MistakeReport extends Model
{
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'mistake_reports';

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
  protected $fillable = ['name' , 'phone' , 'object' , 'email' , 'company_id' , 'status' , 'cancel'];


/* relation function with companies table */
  public function company()
  {
    return $this->belongsTo('App\Company' , 'company_id');
  }
}
