<?php

namespace App\Http\Controllers;

use App\class_request_approval;
use App\class_room;
use App\Class_room_has_student;
use App\Lecturer;
use App\Lecturer_class_request;
use App\Mail\AskingLecturerApproval;
use App\Mail\LecturerClassRequested;
use App\Mail\LecturerRequestAccepted;
use App\Mail\NewClassroom;
use App\Mail\RequestingPayment;
use App\moderator;
use App\Payment;
use App\Student;
use App\student_class_request;
use App\subject;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Scalar\MagicConst\Class_;
use Symfony\Component\Debug\Tests\Fixtures\SubClassWithAnnotatedParameters;

class ModeratorController extends Controller
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

        return view('moderator.dashboard',['classrooms'=>$classrooms,'subjects'=>$subjects
                    ,'student_requests'=>$student_requests ,'lecturer_requests'=>$lecturer_requests
                    ,'students'=>$students ,'all_students'=>$all_students ,'lecturers'=>$lecturers,
                    'all_lecturers'=>$all_lecturers,'income'=>$income,'subject_income'=>$subject_income,
                    'all_student_requests'=>$all_student_requests,'all_lecturer_requests'=>$all_lecturer_requests]);
    }

    /**
     * lecturer requests for subject
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lecturerRequests()
    {
        $requests = Lecturer_class_request::with(['lecturer.user','subject'])->get();
        return view('moderator.lecturerRequests',['requests'=>$requests]);
    }

    /**
     * accepting lecturer course request
     * notify user with email
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function lecturerRequestApproval($id)
    {
        $request = Lecturer_class_request::find($id);
        $request->approved_at = Carbon::now()->toDateTimeString();
        if ($request->save())
        {
            $getRequest = Lecturer_class_request::with(['subject','lecturer.user'])->where('id','=',$request->id)->first();
            $user = User::find($getRequest->lecturer->user_id);
            //sending mail to user
            Mail::to($user)
                ->send(new LecturerRequestAccepted($getRequest));
            return redirect()->back()->with('success','Lecturer Request Accepted');
        }
        return redirect()->back()->with('error','Something went wrong.please try again later');
    }

    /**
     * cancelling lecturer request
     * setting approved at value as null
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function lecturerRequestCancel($id)
    {
        $request = Lecturer_class_request::find($id);

        $request->approved_at = null;
        if ($request->save())
        {
            return redirect()->back()->with('success','Lecturer Request canceled');
        }
        return redirect()->back()->with('error','Something went wrong.please try again later');
    }

    /**
     * all profiles of lecturer
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lecturerProfiles()
    {
        $lecturer = Lecturer::with('user')->get();
        return view('moderator.allLecturerProfiles',['lecturers'=>$lecturer]);
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

        return view('moderator.lecturerProfile',['lecturer'=>$lecturer,'requests'=>$requests,'classrooms'=>$classrooms]);
    }


    /**
     * student requests for subject
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function studentRequests()
    {
        $requests = student_class_request::with(['student.user','subject','payment','approve'])->get();
        return view('moderator.studentRequests',['requests'=>$requests]);
    }

    /**
     * suggestion of student requests
     * filtering with subject id and time
     * searching approved and none approved lecturers
     * @param $requestID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function studentRequestSuggestion($requestID)
    {

        $requests = student_class_request::with(['student.user','subject','payment','approve'])
                    ->where('id','=',$requestID)
                    ->first();

        $top_lec        =  Lecturer_class_request::with(['lecturer.user','subject'])
                             ->where('subject_id','=',$requests->subject_id)
                             ->where('day','=',$requests->day)
                             ->where('start_time','<=',$requests->time)
                             ->where('end_time','>',$requests->time)
                             ->whereNotNull('approved_at')
                             ->get();

        $approved_lec    =  Lecturer_class_request::with(['lecturer.user','subject'])
                            ->where('subject_id','=',$requests->subject_id)
                            ->whereNotNull('approved_at')
                            ->get();

        $non_approved_lec  =    Lecturer_class_request::with(['lecturer.user','subject'])
                                ->where('subject_id','=',$requests->subject_id)
                                ->whereNull('approved_at')
                                ->get();

        $subject = subject::find($requests->subject_id);

        $student =    Student::with('user')->where('id','=',$requests->student_id)->first();

        return view('moderator.studentRequestSuggestion',['top_lec'=>$top_lec,'approved_lec'=>$approved_lec,
                    'non_approved_lec'=>$non_approved_lec,'subject'=>$subject,'student'=>$student ,'request'=>$requests]);
    }

    /**
     * assigning lecturer with student request
     * if the request is already in the lecturer will be updated
     * otherwise it will create new approval
     * lecturer will be notified with mail
     * @param $requestID
     * @param $lecID
     * @return \Illuminate\Http\RedirectResponse
     */

    public function requestingClassFromLecturer($requestID ,$lecID)
    {
        $moderator = moderator::where('user_id','=',Auth::user()->id)
                    ->first();
        $lecturer = Lecturer::find($lecID);
        $user = User::find($lecturer->user_id);

        $approval_exitst = class_request_approval::where('student_class_request_id','=', $requestID)->first();

        /**
         * when the approval already exists
         * updating lecturer id
         * notify to new lecturer
         * redirect to student requests page with feedback
         */
        if ($approval_exitst)
        {
            $updateApproval = class_request_approval::find($approval_exitst->id);
            $updateApproval->lecturer_id = $lecID;
            if ($updateApproval->save())
            {
                $getRequestApproval = class_request_approval::with(['student_class_request','lecturer.user'])
                    ->where('id','=',$updateApproval->id)
                    ->first();
                Mail::to($user)
                    ->send(new AskingLecturerApproval($getRequestApproval));
                return redirect('moderator/student/requests')->with('success','lecturer will be updated and notify about the student request');
            }
            else{
                return redirect('moderator/student/requests')->with('error','Something went wrong !please try again');
            }
        }


        /**
         * when there was no any updating
         * creating new approval modal
         * inserting values
         * saving and sent mail to lecturer
         */

        $request_approval = new class_request_approval();
        $request_approval->student_class_request_id = $requestID;
        $request_approval->moderator_id = $moderator->id;
        $request_approval->lecturer_id = $lecID;
        $request_approval->moderator_approved_at = Carbon::now()->toDateTimeString();

        if ($request_approval->save())
        {
            $getRequestApproval = class_request_approval::with(['student_class_request','lecturer.user'])
                                ->where('id','=',$request_approval->id)
                                ->first();
            Mail::to($user)
                ->send(new AskingLecturerApproval($getRequestApproval));
         return redirect('moderator/student/requests')->with('success','lecturer will notify about the student request');
        }
        else
        {
            return redirect('moderator/student/requests')->with('error','Something went wrong !please try again');
        }
    }


    /**
     * show panel before ask the payment
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function askingPaymentPanel($id)
    {
        $requests = student_class_request::with(['student.user','subject'])
            ->where('id','=',$id)
            ->first();
        return view('moderator.requestPayment',['request'=>$requests]);
    }

    /**
     * requesting payment from relavent student
     * checking before payment request(duplicate)
     * return redirecting to request table
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function requestPayment(Request $request)
    {
        $id = $request->input('request_id');
        $amount = $request->input('amount');

        $payment_exitst = Payment::where('student_class_request_id','=',$id)->first();
        if ($payment_exitst)
        {
            return redirect('moderator/student/requests')->with('error','Payment already made');
        }

        $payment = new Payment();
        $payment->student_class_request_id = $id;
        $payment->amount = $amount;

        if ($payment->save())
        {
            $getPayment = Payment::with(['student_class_request.subject','student_class_request.approve.lecturer.user'])
                ->where('id','=',$payment->id)
                ->first();
            $user = User::find($getPayment->student_class_request->student->user->id);
            //sending mail to user
            Mail::to($user)
                ->send(new RequestingPayment($getPayment));

            return redirect('moderator/student/requests')->with('success','Payment Requested from the user');
        }
        return redirect('moderator/student/requests')->with('error','Something went wrong!');
    }


    /**
     * view panel of create classroom
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createClassroomPanel($id)
    {
        $requests = student_class_request::with(['student.user','subject','approve.lecturer.user'])
            ->where('id','=',$id)
            ->first();
        return view('moderator.createClassroom',['request'=>$requests]);
    }

    /**
     * creating new classroom
     * checking if any availability
     * if available put student inside available classroom
     * othervise create new an put into it
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createNewClassroom(Request $request)
    {
        $lecturer = $request->input('lecturer');
        $student = $request->input('student');
        $subject = $request->input('subject');
        $day = $request->input('day');
        $start_time = $request->input('startTime');
        $end_time = $request->input('startTime');
        $requestID = $request->input('requestID');

        $student_request = student_class_request::find($requestID);

        $classroom_exists = Class_room::where('lecturer_id','=',$lecturer)
                            ->where('subject_id','=',$subject)
                            ->where('day','=',$day)
                            ->where('started_at','=',$start_time)
                            ->first();

        $studentDetail= Student::find($student);
        $lecturerDetail= Lecturer::find($lecturer);


        $studentUser = User::find($studentDetail->user_id);
        $lecturerUser = User::find($lecturerDetail->user_id);

        /**
         * if there was classroom matching the crieteria
         * the student will assign into the relevant class
         */
        if ($classroom_exists)
        {
            $classroom_student = new Class_room_has_student();
            $classroom_student->class_room_id = $classroom_exists->id;
            $classroom_student->student_id = $student;
            $student_request->classroom_added_at = Carbon::now()->toDateTimeString();

            if($classroom_student->save() && $student_request->save())
            {
                $get_student_classroom = Class_room_has_student::with(['class_room.subject','class_room.lecturer.user','student.user'])
                                         ->where('id','=',$classroom_student->id)
                                          ->first();

                Mail::to($studentUser)->cc($lecturerUser)
                    ->send(new NewClassroom($get_student_classroom));

                return redirect('moderator/student/requests')->with('success','Classroom created');
            }
            return redirect('moderator/student/requests')->with('error','Something went wrong!');
        }

        /**
         * if there was no class match the crietaria
         * student will assign into new class
         */
        $classroom = new Class_room();
        $classroom->subject_id = $subject;
        $classroom->lecturer_id = $lecturer;
        $classroom->day = $day;
        $classroom->started_at = $start_time;
        $classroom->end_at = $end_time;


        if ($classroom->save())
        {
            $studentClass =  new Class_room_has_student;
            $studentClass->class_room_id = $classroom->id;
            $studentClass->student_id = $student;
            $student_request->classroom_added_at = Carbon::now()->toDateTimeString();

            if ($studentClass->save() && $student_request->save())
            {


                $get_student_classroom = Class_room_has_student::with(['class_room.subject','class_room.lecturer.user','student.user'])
                    ->where('id','=',$studentClass->id)
                    ->first();

                Mail::to($studentUser)->cc($lecturerUser)
                    ->send(new NewClassroom($get_student_classroom));


                return redirect('moderator/student/requests')->with('success','Classroom created');
            }
            else
                return redirect('moderator/student/requests')->with('error','Something went wrong!');
        }

        return redirect('moderator/student/requests')->with('error','Something went wrong!');
    }

    /**
     * all the available student profiles
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function studentProfiles()
    {
        $student = Student::with('user')->get();
        return view('moderator.allStudentProfiles',['students'=>$student]);
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

        return view('moderator.studentProfile',['student'=>$students,'requests'=>$requests,'classrooms'=>$classrooms]);
    }

    /**
     * viewing classrooms panel
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function classrooms()
    {
        $classrooms = class_room::with(['lecturer.user','subject','class_room_has_student'])->get();
        return view('moderator.classrooms',['classrooms'=>$classrooms]);
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
        return view('moderator.classroomStudentProfiles',['c_students'=>$classroom_students ,'classroom'=>$classroom]);
    }

    /**
     * show payment income details
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPayments()
    {
        $payments = Payment::with(['student_class_request.subject','student_class_request.student'])->get();
        return view('moderator.payments',['payments'=>$payments]);
    }

    /**
     * showing add new course panel
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAddNewCoursePanel()
    {
        return view('moderator.addNewCourse');
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
            return redirect('moderator/course/addNew')->with('success','Course Successfully added.Add another one');
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

        return view('moderator.courses',['courses'=>$subjects]);
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
        return redirect('moderator/course/all')->with('success','Course Deleted!');
    }


    /**
     * viewing profile with detail for update
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile()
    {
        $moderator = moderator::where('user_id','=',Auth::user()->id)->first();
        return view('moderator.profile',['moderator'=>$moderator]);
    }

    /**
     * updating password of moderator
     * checking using hash method
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        $old_pw = $request->input('old_pw');
        $new_pw = $request->input('new_pw');
        $user = User::find(Auth::user()->id);

        if ( !Hash::check($old_pw, $user->password)) {
            return redirect()->back()->with('error','Password did not match');
        }
        else{
            $user->password = Hash::make($new_pw);
            $user->save();
            return redirect()->back()->with('success','Password updated');
        }
    }

    /**
     * updating profile with data
     * returning back with success/error
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $fname = $request->input('firstname');
        $lname = $request->input('lastname');
        $email = $request->input('email');
        $mobile = $request->input('mobile');
        $address = $request->input('address');
        $city = $request->input('city');
        $nic = $request->input('nic');
        $dob = $request->input('dob');

        $dob = Carbon::parse($dob)->format('Y-m-d');

        $getModerator = moderator::where('user_id','=',Auth::user()->id)->first();

        $moderator = moderator::find($getModerator->id);
        $user = User::find(Auth::user()->id);


        $user->first_name = $fname;
        $user->last_name = $lname;
        $user->email = $email;

        $moderator->dob = $dob;
        $moderator->nic_no = $nic;
        $moderator->address = $address;
        $moderator->city = $city;
        $moderator->mobile_no = $mobile;

        if ($user->save() && $moderator->save())
        {
            return redirect()->back()->with('success','Your Details updated');
        }
        else{
            return redirect()->back()->with('error','Something went wrong.try again later!');
        }
    }

}
