@extends('layouts.lecturerApp')
@section('title')
    Profile

@stop
@section('pageHeader')
    Profile
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('lecturer')}}">Home</a></li>
        <li class="breadcrumb-item active"> Profile </li>
    </ul>
@stop
@section('content')
    <section class="no-padding-top">
    <div class="row">
            <div class="col-lg-4 ">

            <div class="card card-profile ">
                <div style="background-image: url(../template/img/photos/learning_back.jpg);" class="card-header"></div>
                <div class="card-body text-center">
                    <img src="{{asset('Profilepic/'.Auth::user()->avatar)}}" class="card-profile-img" >
                    <h4 class="mb-3 text-gray-light">{{Auth::user()->first_name}}</h4>
                    <p class="mb-4">Lecturer Since {{Auth::user()->created_at}} </p>
                    <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#changepasswordModal">
                        <span class="fa fa-pencil"></span>
                        Change Password
                    </button>
                </div>
            </div>

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Upload CV (pdf)</h4>
                        </div>
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-lg-12 col-sm-12 col-12 main-section">
                                    {!! csrf_field() !!}
                                    <div class="form-group">
                                        <div class="file-loading offset-md-1">
                                            <input id="file-cv" type="file" name="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="1">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


            </div>
                <div class="col-lg-8  col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Update Profile</h4>
                        </div>
                    <div class="form  ">
                        <div class="content">
                            <form class="text-left form-validate"  method="POST" action="{{route('lecturer/profile/updateProfile')}}">
                                <div class="card-body">
                                @csrf
                                <div class="row">

                                    {{-------------------First Name---------------------------------------}}
                                    <div class="form-group-material col-md-6 col-sm-12 col-lg-6">
                                        <label>First Name</label>
                                        <input id="register-firstname" type="text"  required data-msg="Please enter your first name" class="form-control"  name="firstname" value="{{ Auth::user()->first_name  }}"  autofocus>
                                        <small class="help-block-none">e.g John</small>
                                    </div>
                                    {{-------------------Last Name---------------------------------------}}
                                    <div class="form-group-material col-md-6 col-sm-12 col-lg-6">
                                        <label  >Last Name</label>
                                        <input id="register-lastname" type="text"  required data-msg="Please enter your last name" class="form-control"  name="lastname" value="{{ Auth::user()->last_name  }}"  autofocus>
                                        <small class="help-block-none">e.g Doe</small>
                                    </div>
                                    {{-------------------E Mail---------------------------------------}}
                                    <div class="form-group-material col-md-6 col-sm-12 col-lg-6">
                                        <label>Email Address      </label>
                                        <input id="register-email" type="email"  data-msg="Please enter a valid email address" required class="form-control" name="email" value="{{ Auth::user()->email  }}">
                                        <small class="help-block-none">e.g JohnDoe@gmail.com</small>
                                    </div>
                                    {{-------------------Mobile No---------------------------------------}}
                                    <div class="form-group-material col-md-6 col-sm-12 col-lg-6">
                                        <label>Mobile  </label>
                                        <input  type="text"  data-msg="Please enter a valid mobile no" data-mask="(999) 9999999" required class="form-control" name="mobile" value="{{ $lecturer->mobile_no  }}">
                                        <small class="help-block-none">e.g (071) 9999999</small>
                                    </div>
                                    {{-------------------Address---------------------------------------}}
                                    <div class="form-group-material col-md-6 col-sm-12 col-lg-6">
                                        <label >Address</label>
                                         <input  type="text"  data-msg="Please enter a valid address" required class="form-control" name="address" value="{{ $lecturer->address  }}">
                                        <small class="help-block-none">e.g No:15,galle rd.</small>
                                    </div>
                                    {{-------------------City---------------------------------------}}
                                    <div class="form-group-material col-md-6 col-sm-12 col-lg-6">
                                        <label >City </label>
                                        <input  type="text"  data-msg="Please enter a valid city" required class="form-control" name="city" value="{{ $lecturer->city  }}">
                                        <small class="help-block-none">e.g Colombo.</small>
                                    </div>
                                    {{-------------------NIC No---------------------------------------}}
                                    <div class="form-group-material col-md-6 col-sm-12 col-lg-6">
                                        <label >NIC No      </label>
                                        <input id="register-nic" type="number"  data-msg="Please enter a valid nic" required class="form-control" name="nic" value="{{ $lecturer->nic_no  }}">
                                        <small class="help-block-none">e.g 915555555. (without v)</small>
                                    </div>
                                    {{-------------------Date of birth---------------------------------------}}
                                    <div class="form-group-material col-md-6 col-sm-12 col-lg-6">
                                        <label >DOB      </label>
                                         @if ($lecturer->dob == null)
                                            <input id="register-dob" type="text"  data-msg="Please enter a valid birthday" required class="form-control input-datepicker-autoclose" name="dob" value="01/01/1993" readonly>
                                             @else
                                            <input id="register-dob" type="text"  data-msg="Please enter a valid birthday" required class="form-control input-datepicker-autoclose" name="dob" value="{{\Carbon\Carbon::parse($lecturer->dob)->format('m/d/Y') }}" readonly>
                                         @endif


                                        <small class="help-block-none">e.g Month/Date/Year.</small>
                                    </div>
                                </div>
                                </div>
                                <div class="card-footer">
                                    <div class="form-group text-center">
                                        <button id="register" data-toggle="confirmation" data-title="Update Profile?" type="submit" class="btn btn-primary">
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Profile Picture</h4>
                </div>
            <div class="card-body">
            <div class="row container-fluid">
                    <div class="col-lg-12 col-sm-12 col-12 main-section">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <div class="file-loading offset-md-1">
                                <input id="file-1" type="file" name="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="changepasswordModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title text-primary" ><i class="fa fa-lock"></i> &nbsp;&nbsp;Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="text-left form-validate"  method="POST" action="{{route('lecturer/profile/updatePassword')}}">
                    <div class="modal-body">

                        <input type="hidden"  value="{{csrf_token()}}" name="_token">
                        <div class="input-group">
                            <input type="password" class="form-control pt-3" name="old_pw" id="old_pw" placeholder="Enter Old Password" required>

                        </div>
                        <div class="input-group">
                            <input type="password" class="form-control pt-3" name="new_pw" id="new_pw" placeholder="Enter New Password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary"  id="update_password"  name="update_password" >
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop
@section('javaScripts')
    <script>

        $('#register-dob').datepicker({
            startDate: '02/12/1900',
            endDate: '01/01/2009'
        });

        /**
         * notifications
         * getting error from session
         * getting success from session
         * if exists show using bootstrap notify
         */
        @if(\Session::has('success'))

            Messenger.options=
            {
                extraClasses:"messenger-fixed messenger-on-top  messenger-on-right",
                theme:"flat",
                messageDefaults:{showCloseButton:!0}
            },
            Messenger().post({message:"{{Session::get('success')}}",
                type:"success"});
        @elseif(\Session::has('error'))

            Messenger.options=
            {
                extraClasses:"messenger-fixed messenger-on-top  messenger-on-right",
                theme:"flat",
                messageDefaults:{showCloseButton:!0}
            },
            Messenger().post({message:"{{Session::get('error')}}",
                type:"error"});
        @endif


        $("#file-cv").fileinput({
            theme: 'fa',
            uploadUrl: "/doc-view",
            uploadExtraData: function() {
                return {
                    _token: $("input[name='_token']").val(),
                    type:"lecturer",
                };
            },
            allowedFileExtensions: ['pdf'],
            overwriteInitial: false,
            maxFileSize:2000,
            maxFilesNum: 10,
            maxFileCount: 1,
            slugCallback: function (filename) {
                return filename.replace('(', '_').replace(']', '_');
            },
            btnBrowse: '<div tabindex="500" class=""{status}>{icon}{label}</div>',

        });


    </script>
@stop