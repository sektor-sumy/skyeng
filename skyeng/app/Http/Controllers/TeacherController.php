<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Input;
use DB;

class TeacherController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$teachers = \App\Teacher::with('students')->paginate(5);
		return view('teachers.index', ['teachers' => $teachers]);
	}

	/**
	 * Teachers who have max count students
	 */
	
	public function total_students()
	{
		$teachers = \App\Teacher::with('students')->get();
		foreach ($teachers as $teacher) {
				foreach ($teachers as $teach) {
					if($teach->id != $teacher->id){
						$count = 0;
						foreach ($teacher->students as $student) {
							foreach ($teach->students as $stud) {
								if ($student->id == $stud->id) {
									$count++;
								}
							
						}
						$teachersArr[$teacher->id][$teach->id] = $count;
					}
				}
			}
			arsort($teachersArr[$teacher->id]);
			$teachersArr[$teacher->id]['name'] = $teacher->name;
		}
		usort($teachersArr, function($a, $b) {
			    return array_values($a)[0] < array_values($b)[0]? 1 : -1;
			});
		$teachersArr = array_slice($teachersArr, 0, 2, true);
		return view('teachers.total_students', ['teachers' => $teachersArr]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('teachers.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$v = Validator::make(
		    ['name' => Input::get('name')],
		    ['name' => 'required|unique:teachers']
		);

		if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors());
	    }else{
	    	$data = \App\Teacher::create($input);
	    	return redirect('/teachers')->with('message', 'Teacher '.Input::get('name').' create');
	    }
	}

	public function show($id)
	{
		$students = \App\Student::with('teachers')->get();
		return view('teachers.show', ['students' => $students, 'id' => $id]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{	
		\App\Teacher::find($id)->students()->detach(); //очишаем таблицу по ID преподователя
		$input = Input::get('students');
		$arr = array();
		foreach ($input as $value) {
			 $arr[] = array('student_id' => $value, 'teacher_id' => $id);
		}
		if (!empty($arr)) {
			\DB::table('student_teacher')->insert($arr);
		}
		return redirect()->back()->with('message', 'Save');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		\App\Teacher::find($id)->delete();
	    return redirect('/teachers')->with('message', 'Teacher delete');
	}

}
