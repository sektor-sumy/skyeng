<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Input;

class StudentController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$students = \App\Student::with('teachers')->paginate(5);
		return view('students.index', ['students' => $students]);
	}

	/**
	 * Display some student for task 5
	 */
	
	public function some_student()
	{
		$teachers = \App\Teacher::whereHas('students', function ($q) { 
			$q->where(function ($query) { 
				$arr = array('Георгий', 'Харитон', 'Денис', 'Андрей'); //так как это ТЗ я просто захардкодил, в реальном проекте лучше бы внести в настройки или по усмотрению проекта
				foreach($arr as $value) { 
					$query->orWhere('name', 'like', '%'.$value.'%'); 
				} 
			}); 
		})->paginate(5);
		return view('students.some_students', ['teachers' => $teachers]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('students.create');
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
		    ['name' => 'required|unique:students']
		);

		if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors());
	    }else{
	    	$data = \App\Student::create($input);
	    	return redirect('/students')->with('message', 'Student '.Input::get('name').' create');
	    }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$teashers = \App\Teacher::all();
		return View::make('students.show', ['students' => $students]);
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
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		\App\Student::find($id)->delete();
	    return redirect('/students')->with('message', 'Student delete');
	}

}
