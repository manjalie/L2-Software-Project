<?php

namespace App\Http\Controllers;

use App\class_room;
use App\Class_room_has_student;
use App\Lecturer;
use App\Lecturer_class_request;
use App\moderator;
use App\Payment;
use App\Student;
use App\student_class_request;
use App\subject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * index view of the student page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $classrooms = class_room::all();
        $subjects = subject::all();
        $student_requests = student_class_request::whereNull('classroom_added_at')->get();
        $lecturer_requests = Lecturer_class_request::whereNull('approved_at')->get();

        $all_student_requests = student_class_request::all();
        $all_lecturer_requests = Lecturer_class_request::all();

        $students = Student::with('user')->limit(3)->get();
        $lecturers = Lecturer::with('user')->limit(3)->get();

        $all_students = Student::with('user')->get();
        $all_lecturers = Lecturer::with('user')->get();

        $income = Payment::sum('amount');

        $subject_income = subject::sum('price');

        return view('admin.dashboard',['classrooms'=>$classrooms,'subjects'=>$subjects
            ,'student_requests'=>$student_requests ,'lecturer_requests'=>$lecturer_requests
            ,'students'=>$students ,'all_students'=>$all_students ,'lecturers'=>$lecturers,
            'all_lecturers'=>$all_lecturers,'income'=>$income,'subject_income'=>$subject_income,
            'all_student_requests'=>$all_student_requests,'all_lecturer_requests'=>$all_lecturer_requests]);
    }

    /**
     * all profiles of lecturer
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lecturerProfiles()
    {
        $lecturer = Lecturer::with('user')->get();
        return view('admin.allLecturerProfiles',['lecturers'=>$lecturer]);
    }

    /**
     * viewing relevant lecturer profile
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lectureProfile($id)
    {
        $lecturer = Lecturer::with('user')->where('id','=',$id)
            ->first();
        $requests = Lecturer_class_request::with(['lecturer.user','subject'])
            ->where('lecturer_id','=',$lecturer->id)
            ->get();
        $classrooms =Class_room::where('lecturer_id','=',$lecturer->id)->get();

        return view('admin.lecturerProfile',['lecturer'=>$lecturer,'requests'=>$requests,'classrooms'=>$classrooms]);
    }

    /**
     * block lecturer
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function blockLecturer($id)
    {
        $lecturer = Lecturer::with('user')->where('id','=',$id)
            ->first();
       $user = User::find($lecturer->user_id);
       $user->status = 'blocked';

        if ($user->save())
        {
            return redirect('admin/lecturer/allProfiles')->with('success','user successfully blocked ');
        }
        else
            return redirect()->back()->with('error','Whoops! something went wrong!try again later');
    }

    /**
     * unblock lecturer
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unblockLecturer($id)
    {
        $lecturer = Lecturer::with('user')->where('id','=',$id)
            ->first();
       $user = User::find($lecturer->user_id);
       $user->status = 'active';

        if ($user->save())
        {
            return redirect('admin/lecturer/allProfiles')->with('success','user is active now ');
        }
        else
            return redirect()->back()->with('error','Whoops! something went wrong!try again later');
    }

    /**
     * all the available student profiles
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function studentProfiles()
    {
        $student = Student::with('user')->get();
        return view('admin.allStudentProfiles',['students'=>$student]);
    }

    /**
     * viewing relevant student profile
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function studentProfile($id)
    {
        $students = Student::with('user')->where('id','=',$id)
            ->first();
        $requests = student_class_request::with(['student.user','subject'])
            ->where('student_id','=',$students->id)
            ->get();
        $classrooms =Class_room::whereHas('class_room_has_student',function ($query) use ($id){
            $query->where('student_id',$id);
        })
            ->get();

        return view('admin.studentProfile',['student'=>$students,'requests'=>$requests,'classrooms'=>$classrooms]);
    }

    /**
     * block student
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function blockStudent($id)
    {
        $student = Student::with('user')->where('id','=',$id)
            ->first();
        $user = User::find($student->user_id);
        $user->status = 'blocked';

        if ($user->save())
        {
            return redirect('admin/student/allProfiles')->with('success','user successfully blocked ');
        }
        else
            return redirect()->back()->with('error','Whoops! something went wrong!try again later');
    }

    /**
     * unblock student
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unblockStudent($id)
    {
        $student = Student::with('user')->where('id','=',$id)
            ->first();
        $user = User::find($student->user_id);
        $user->status = 'active';

        if ($user->save())
        {
            return redirect('admin/student/allProfiles')->with('success','user is active now ');
        }
        else
            return redirect()->back()->with('error','Whoops! something went wrong!try again later');
    }

    /**
     * showing add new course panel
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAddNewCoursePanel()
    {
        return view('admin.addNewCourse');
    }

    /**
     * adding new course to data base
     * if error return back with data
     * if success return back with success msj
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addNewCourse(Request $request)
    {
        $name = $request->input('name');
        $price = $request->input('price');
        $duration = $request->input('duration');

        $name_exists = subject::where('name','=',$name)->first();

        if ($name_exists)
        {
            return redirect()->back()->with('error','Name already exists.Try different name')->withInput(Input::all());
        }

        $subject = new subject();
        $subject->name = $name;
        $subject->duration = $duration;
        $subject->price = $price;

        if ($subject->save())
        {
            return redirect('admin/course/addNew')->with('success','Course Successfully added.Add another one');
        }

        return redirect()->back()->with('error','Something went wrong.Try again')->withInput(Input::all());
    }
    /**
     * show courses panel
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCourses()
    {
        $subjects = subject::all();

        return view('admin.courses',['courses'=>$subjects]);
    }

    /**
     * deleting courses
     * checking availability
     * return with success/error msj
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCourses($id)
    {
        $course = subject::find($id);

        if (!$course)
        {
            return redirect()->back()->with('error','Course not found!');
        }

        $course->delete();
        return redirect('admin/course/all')->with('success','Course Deleted!');
    }

    /**
     * show payment income details
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPayments()
    {
        $payments = Payment::with(['student_class_request.subject','student_class_request.student'])->get();
        return view('admin.payments',['payments'=>$payments]);
    }
    /**
     * viewing classrooms panel
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function classrooms()
    {
        $classrooms = class_room::with(['lecturer.user','subject','class_room_has_student'])->get();
        return view('admin.classrooms',['classrooms'=>$classrooms]);
    }

    /**
     * all the  student profiles relevant to classroom
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function classroomsStudents($id)
    {
        $classroom_students = Class_room_has_student::with(['class_room','student.user'])
            ->where('class_room_id','=',$id)
            ->get();
        $classroom = class_room::with('subject')->where('id','=',$id)->first();
        return view('admin.classroomStudentProfiles',['c_students'=>$classroom_students ,'classroom'=>$classroom]);
    }


//================================Moderators===============================================
    /**
     * all profiles of moderator
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function moderatorProfiles()
    {
        $moderator = moderator::with('user')->get();
        return view('admin.allModeratorProfiles',['moderators'=>$moderator]);
    }

    /**
     * viewing relevant moderator profile
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function moderatorProfile($id)
    {
        $moderator = moderator::with('user')->where('id','=',$id)
            ->first();


        return view('admin.moderatorProfile',['moderator'=>$moderator]);
    }

    /**
     * block moderator
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function blockModerator($id)
    {
        $moderator = Moderator::with('user')->where('id','=',$id)
            ->first();
        $user = User::find($moderator->user_id);
        $user->status = 'blocked';

        if ($user->save())
        {
            return redirect('admin/moderator/allProfiles')->with('success','user successfully blocked ');
        }
        else
            return redirect()->back()->with('error','Whoops! something went wrong!try again later');
    }

    /**
     * unblock moderator
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unblockModerator($id)
    {
        $moderator = Moderator::with('user')->where('id','=',$id)
            ->first();
        $user = User::find($moderator->user_id);
        $user->status = 'active';

        if ($user->save())
        {
            return redirect('admin/moderator/allProfiles')->with('success','user successfully blocked ');
        }
        else
            return redirect()->back()->with('error','Whoops! something went wrong!try again later');
    }

    /**
     * showing add new moderator panel
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAddNewModeratorPanel()
    {
        return view('admin.addNewModerator');
    }

    /**
     * adding new moderator to data base
     * if error return back with data
     * if success return back with success msj
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addNewModerator(Request $request)
    {
        $fname = $request->input('firstname');
        $lname = $request->input('lastname');
        $password = $request->input('password');
        $conpw = $request->input('password_confirmation');
        $email = $request->input('email');

        $email_exists = User::where('email','=',$email)->first();

        if ($email_exists)
        {
            return redirect()->back()->with('error','Email already exists.Try different email')->withInput(Input::all());
        }

        if ($password !== $conpw)
        {
            return redirect()->back()->with('error','Password does not match.')->withInput(Input::all());
        }

       $user = new User();
        $user->first_name = $fname;
        $user->last_name = $lname;
        $user->email = $email;
        $user->role = 'moderator';
        $user->password = Hash::make($password);

        if ($user->save())
        {
            $moderator = new moderator();
            $moderator->user_id = $user->id;

            if ($moderator->save())
            {
                return redirect('admin/moderator/addNew')->with('success','Moderator Successfully added.Add another one');
            }
            else
            {
                return redirect()->back()->with('error','Something went wrong.Try again')->withInput(Input::all());
            }
        }

        return redirect()->back()->with('error','Something went wrong.Try again')->withInput(Input::all());
    }

}
