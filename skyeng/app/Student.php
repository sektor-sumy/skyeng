<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'students';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name'];

	 public function teachers()
    {
        return $this->belongsToMany('App\Teacher', 'student_teacher');
    }

}
