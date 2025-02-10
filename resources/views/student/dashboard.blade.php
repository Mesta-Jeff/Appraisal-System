<!-- resources/views/student/dashboard.blade.php -->

@extends('layout.free')

@section('title', 'Dashboard')

@section('content')
    
<div class="container-fluid mt-5">
      
    <div id="must-know" class="row justify-content-center">
        <div class="col-lg-4">
            <div class="card mt-4">      
                <div class="card-body">
                    <div class="plan-features text-muted">
                        <span class="logo-lg">
                            <img src="{{ asset('root/images/logo-text-dark.png') }}" alt="" height="22">
                        </span>  
                        <hr class="cus-hr">
                        <h5 class="text-muted">Do you want to appraise a lecturer, are you ready to let us know your observations for this semester about your courses...?</h5>
                        <hr class="cus-hr">
                        <div class="text-center">
                            <a href="{{ route('student.questionaires')}}" class="btn btn-primary mt-2 rounded-5" id="icontinue"><i class="mdi mdi-chevron-triple-right mx-1"></i>Yes Continue</a>
                        </div>
                    </div>            
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mt-4">      
                <div class="card-body">
                    <div class="plan-features text-muted">
                        <span class="logo-lg">
                            <img src="{{ asset('root/images/logo-text-dark.png') }}" alt="" height="22">
                        </span>  
                        <hr class="cus-hr">
                        <h5 class="text-muted"><br>I am only in to get my examination number and leave <br></h5>
                        <hr class="cus-hr">
                        <div class="text-center">
                            <a href="{{ route('exams-number')}}" class="btn btn-primary mt-2 rounded-5" id="get-number"><i class="mdi mdi-chevron-triple-right mx-1"></i>Get Number</a>
                        </div>
                    </div>            
                </div>
            </div>
        </div>

        
    </div>

</div>



<script src="{{ asset('root/mint/assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('root/mint/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>


<script>

    $(document).ready(function() {

       

    });
</script>


@endsection



