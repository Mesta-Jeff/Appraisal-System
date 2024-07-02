<!-- resources/views/student/dashboard.blade.php -->

@extends('layout.free')

@section('title', 'Examination Seat Number')

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
                        <h3 class="text-muted">Want your seating number..?</h3>
                        <form action="">
                            <input type="text" class="form-control" id="" maxlength="10" placeholder="Enter your Index Number">

                            <div class="mb-2 pt-4" id="course-block" style="display: none">
                                <label for="username" class="form-label">Your Courses For The Semester</label>
                                <select id="courses" class="select2 form-control" data-toggle="select2">
                                    <option selected disabled>Choose...</option>
                                    <option value="Course 1">Course 1</option>
                                    <option value="Course 2">Course 2</option>
                                    <option value="Course 3">Course 3</option>
                                </select>
                                <div class="form-text">Select the course to see your examination seat number</div>
                            </div>
                        </form>
                        <hr class="cus-hr">
                        <div class="text-center">
                            <button type="button" class="btn btn-primary mt-2 rounded-5" id="icontinue"><i class="mdi mdi-chevron-triple-right mx-1"></i>Yes Continue</button>
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

        $('#icontinue').click( function()
        {
            if ($('#course-block').is(':visible')) {
                $('#course-block').fadeOut('slow');
            } else {
                $('#course-block').fadeIn('slow');
            }
        })


        $('#courses').change( function()
        {
            Swal.fire({
                title:"Good job!", text:"Message Here", icon:"info", confirmButtonColor:"#3bafda",
            });
        })

    });
</script>


@endsection



