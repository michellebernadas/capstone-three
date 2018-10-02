@extends('template')

@section('title', 'Register')

@section('content')
<!-- Material form register -->
<div class="row top">
    <div class="card card-inverse text-center img-fluid col-4 login-image">

    <!-- Image -->
    {{-- <img class="card-img-top login-image" src="{{asset('images/bg4.jpg')}}" alt="Photo of sunset"> --}}

    <!-- Text Overlay -->
    <div class="card-img-overlay">
    <h4 class="card-title">What Next?</h4>
    <p class="card-text">Is this the end?</p>
    </div>
</div>
   {{--  <div class="card img-fluid col-4 login-image">
         <img class="card-img-top" src="{{asset('images/bg1.jpg')}}" alt="Christian image">
    </div> --}}
    <div class="card">
    <div>
        <h5 class="card-header info-color white-text text-center py-4">
            <strong>Sign up</strong>
        </h5>

        <!--Card content-->
        <div class="card-body px-lg-5 pt-0">

            <!-- Form -->
            <form class="text-center" style="color: #757575;">
                <div class="form-group-row mt-4 image-holder mx-auto">
                    
                </div>
                <div class="form-group-row mb-4 mt-4">
                    <input type="file" id="image" >
                </div>

                <div class="form-row mt-4">
                    <div class="col-5">
                
                        <div class="mb-4">
                            <input type="text" class="form-control" placeholder="First Name" id="first_name">
                        </div>
                    </div>
                    <div class="col-7">
                 
                        <div class="mb-4 offset-2">
                            <input type="text" class="form-control" placeholder="Last Name" id="last_name">
                        </div>
                    </div>
                </div>

                <div class="form-group-row mb-4">
                    <input type="email" class="form-control" placeholder="Email" id="email">
                </div>

                <div class="form-group-row mb-4">
                    <input type="text" class="form-control" placeholder="Username" id="username">
                </div>

                <div class="form-group-row mb-4">
                    <input type="password" class="form-control" placeholder="Password" id="password">
                </div>

                <div class="form-group-row mb-4">
                    <input type="password" class="form-control" placeholder="Confirm Password" id="confirm_password">
                </div>

                <div class="row">
                    <div class="col-3">
                      <div class="male">
                        <input name="gender" type="radio" id="male" value="1" required/>
                        <label for="male">Male</label>
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="female">
                        <input name="gender" type="radio" id="female" value="2" required/>
                        <label for="female">Female</label>
                      </div>
                    </div>
                    <div class="input-field col s6">
                      <button class="btn btn-large" id="btn-register" type="button">Register
                      </button>
                    </div>
                </div>

            </form>
            <!-- Form -->

        </div>
    </div> {{-- end of card --}}
    </div>
</div> {{-- end of row --}}
<!-- Material form register -->
@endsection