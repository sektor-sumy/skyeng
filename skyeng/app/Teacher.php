<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'teachers';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name'];

	public function students()
    {
        return $this->belongsToMany('App\Student', 'student_teacher');
    }

}
