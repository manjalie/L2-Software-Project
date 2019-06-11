<?php

namespace App\Http\Controllers;

use App\class_request_approval;
use App\class_room;
use App\Class_room_has_student;
use App\Mail\CoursePayed;
use App\Mail\CourseRequested;
use App\Payment;
use App\Student;
use App\student_class_request;
use App\subject;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
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
        $student = Student::where('user_id','=',Auth::user()->id)->first();
        $my_classrooms = Class_room_has_student::with(['class_room.lecturer.user','class_room.subject'])
                        ->where('student_id','=',$student->id   )
                        ->get();
        $requests   = student_class_request::where('student_id')->get();
        $subjects = subject::all();
        $all_classrooms = class_room::all();

        $all_payments = Payment::with(['student_class_request'=> function($q) use($student) {
            $q->where('student_id', '=', $student->id);
        }])->get();

        $pending_payments = Payment::with(['student_class_request'=> function($q) use($student) {
            $q->where('student_id', '=', $student->id);
        }])->where('status','=','pending')
            ->get();



        return view('student.dashboard',['my_classrooms'=>$my_classrooms, 'requests'=>$requests,'subjects'=>$subjects,
                                             'all_classrooms'=>$all_classrooms ,'pending_payments'=>$pending_payments,
                                             'all_payments'=>$all_payments  ]);
    }

    /**
     * panel of the request new course
     *passing current days and subjects as parameters
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newCourse()
    {
        $subjects = subject::all();

        $days = ['monday','tuesday','wednesday' ,'thursday','friday','saturday','sunday'];

        return view('student.subjectRequest',['subjects'=>$subjects ,'days'=>$days]);
    }


    /**
     * add new request to database
     * send mail after adding request
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function addNewRequest(Request $request)
    {
            $subject = $request->input('subject');
            $day = $request->input('day');
            $time = $request->input('time');

            $student = Student::where('user_id','=',Auth::user()->id)->first();

            //if the user cannot be found
            if (!$student)
            {
                return redirect()->back()->with('error','Invalid user credential.please contact support');
            }

            $courseRequest = new student_class_request();
            $courseRequest->student_id = $student->id;
            $courseRequest->subject_id = $subject;
            $courseRequest->day = $day;
            $courseRequest->time = $time;

            if ($courseRequest->save())
            {
                $getRequest = student_class_request::with(['subject','student.user'])->where('id','=',$courseRequest->id)->first();
                //sending mail to user
                Mail::to(Auth::user())
                    ->send(new CourseRequested($getRequest));

                return redirect()->back()->with('success','request sent successfully');
            }
            else
                return redirect()->back()->with('error','something went wrong.please try again later');
    }

    /**
     * show available courses panel
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function availableCourses()
    {
        $subjects = subject::all();
        return view('student.availableCourses',['subjects'=>$subjects]);
    }

    /**
     * panel of the request new course with id
     * came from available courses
     *passing current days and subjects as parameters
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newCourseSelected($id)
    {
        $subjects = subject::all();
        $selected_subject = subject::find($id);

        $days = ['monday','tuesday','wednesday' ,'thursday','friday','saturday','sunday'];

        return view('student.subjectRequest',['selected_subject'=>$selected_subject,'subjects'=>$subjects ,'days'=>$days]);
    }

    /**
     * classroom details relevant to student
     * only show registered class
     * getting data using whereHas eloquent relation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function classrooms()
    {
        $student = Student::where('user_id','=',Auth::user()->id)->first();


        $classrooms = Class_room::with(['lecturer.user','subject'])
            ->whereHas('class_room_has_student',function ($query) use ($student){
                $query->where('student_id',$student->id);
            })
            ->get();

        return view('student.myClassrooms',['classrooms'=>$classrooms]);

    }

    /**
     * panel for show request history
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function requestHistory()
    {
        $student = Student::where('user_id','=',Auth::user()->id)->first();

        $requests = student_class_request::with(['subject','payment'])
            ->where('student_id','=',$student->id)
            ->get();

        return view('student.requestHistory',['requests'=>$requests]);
    }

    /**
     * deleting request when user cancelled
     * using soft delete
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteRequest($id)
    {
        $request = student_class_request::find($id);
        $approvel = class_request_approval::where('student_class_request_id','=',$id)->first();

        if ($approvel)
        {
            return redirect()->back()->with('error','Request already approved');
        }

        if ($request->delete())
        {
            return redirect()->back()->with('success','Request cancelled successfully');
        }
        else
            return redirect()->back()->with('error','Something went wrong!Try again later');
    }

    /**
     * panel for show payment history
     * payed/pending and non payed
     * using student class request as primary
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function paymentHistory()
    {
        $student = Student::where('user_id','=',Auth::user()->id)->first();

        $payments = student_class_request::with(['subject'])
            ->where('student_id','=',$student->id)
            ->whereHas('payment')
            ->get();

        return view('student.paymentHistory',['payments'=>$payments]);
    }

    /**
     * make a payment that payment status in pending
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */

    public function makePayment($id)
    {
        $student = Student::where('user_id','=',Auth::user()->id)->first();
        $payment = Payment::with(['student_class_request.subject','student_class_request.approve.lecturer.user'])
                    ->where('id','=',$id)
                    ->first();

        if ($payment->status == 'payed')
            return redirect()->back()->with('error','Payment already made');

        return view('student.makePayment',['payment'=>$payment ,'student'=>$student]);
    }

    /**
     * using payhere return method
     * not secure
     * using get input to get order id
     * order id = payment id
     * saving and sending mail after saving
     * @return \Illuminate\Http\RedirectResponse
     */

    public function returnPayment()
    {
        $order_id = Input::get('order_id');

        $payment = Payment::find($order_id);
        $payment->status = 'payed';


        if ($payment->save()) {

            $getPayment = Payment::with(['student_class_request.subject','student_class_request.approve.lecturer.user'])
                ->where('id','=',$payment->id)
                ->first();
            //sending mail to user
            Mail::to(Auth::user())
                ->send(new CoursePayed($getPayment));

            return redirect('/student/paymentHistory')->with('success', 'payment successfull');
        }
        else
            return redirect('/student/paymentHistory')->with('error', 'payment error');

    }

    /**
     * original call back of payhere
     * cannot use in localhost
     * document in https://support.payhere.lk/api-&-mobile-sdk/payhere-checkout
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function returnPaymentNotify(Request $request)
    {
        $status_code             = $request->input('status_code');
        $merchant_id             = $request->input('merchant_id');
        $payhere_amount          = $request->input('payhere_amount');
        $payhere_currency        = $request->input('payhere_currency');
        $md5sig                  = $request->input('md5sig');
        $order_id                = $request->input('order_id');

        $merchant_secret = 'K2ART123';

        $local_md5sig = strtoupper (md5 ( $merchant_id . $order_id . $payhere_amount . $payhere_currency . $status_code . strtoupper(md5($merchant_secret)) ) );


        if (($local_md5sig === $md5sig) AND ($status_code == 2) ){
            $payment = Payment::find($order_id);
            $payment->status = 'payed';


           if ($payment->save()) {
               return redirect('/student/paymentHistory')->with('success', 'payment successfull');
           }
           else
               return redirect('/student/paymentHistory')->with('error', 'payment error');
        }

        return redirect('/student/paymentHistory')->with('error', 'payment error');

    }

    /**
     * viewing profile with detail for update
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile()
    {
        $student = Student::where('user_id','=',Auth::user()->id)->first();
        return view('student.profile',['student'=>$student]);
    }

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

        $getStudent = Student::where('user_id','=',Auth::user()->id)->first();

        $student = Student::find($getStudent->id);
        $user = User::find(Auth::user()->id);


        $user->first_name = $fname;
        $user->last_name = $lname;
        $user->email = $email;

        $student->dob = $dob;
        $student->nic_no = $nic;
        $student->address = $address;
        $student->city = $city;
        $student->mobile_no = $mobile;

        if ($user->save() && $student->save())
        {
            return redirect()->back()->with('success','Your Details updated');
        }
        else{
            return redirect()->back()->with('error','Something went wrong.try again later!');
        }
    }
}
