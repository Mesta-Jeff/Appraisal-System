<!-- resources/views/student/dashboard.blade.php -->

@extends('layout.free')

@section('title', 'Student Questionaires')

@section('content')
    
<div class="container-fluid mt-4">
      
    <div id="security-notice" class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card mt-4">
                <div class="modal-header bg-primary">
                    <a class="mx-2 my-2">
                        <div class="img-animation cus-shape">
                            <img src="{{ asset('root/images/user.png') }}" alt="#" class="img-fluid">
                        </div>
                        <h3 class="text-white">{{ session('name') ?? ''}}</h3>
                    </a>
                </div>
                
                <div class="card-body">
                    <div class="plan-features text-muted">
                        <h3>FOR QUALITY AND ASSURANCE PURPOSES</h3>
                        <hr class="cus-hr">
                        <p class="mb-1">
                            Before you start appraising a lecturer, we kindly ask you to pledge your commitment to providing honest and constructive feedback. Your appraisal is crucial in improving the quality of education and ensuring that lecturers are recognized for their efforts. Please read the following pledge and confirm your agreement:
                        </p>
                        <p class="mb-1">
                            "I pledge to provide honest, respectful, and constructive feedback in my appraisal of the lecturer. I understand that my feedback will be used to enhance the educational experience and support the continuous improvement of teaching practices."
                        </p>
                        <hr class="cus-hr">
                        <div class="form-check mt-2 text-primary" role="button">
                            <input type="checkbox" class="form-check-input" id="confirmcheck">
                            <label class="form-check-label" for="confirmcheck">
                                <i class="fas fa-thumbs-up mx-1"></i> Yes, I do agree, and I will abide by all protocols
                            </label>
                        </div>
                    </div>                              
                </div>
            </div>
        </div>
    </div>

    

    <div style="display: none" id="must-know" class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card mt-4">
                <div class="card-body">
                    <div class="plan-features text-muted">
                        <h3 class="text-primary">Must Know This:</h3>
                        <hr class="cus-hr">
                        <p class="mb-1">
                            Dear Students, we want to assure you that your participation in this appraisal is both valued and crucial. Your honest and constructive feedback helps us improve the quality of education and supports our lecturers in their professional growth. Remember, your input is confidential and will be used solely for enhancing the learning experience for everyone.
                        </p>
                        <p class="mb-1">
                            Please take a moment to reflect on your experiences and provide thoughtful feedback. We appreciate your dedication and commitment to maintaining high educational standards. By working together, we can create a better learning environment for all.
                        </p>
                        <hr class="cus-hr">
                        <div class="text-center">
                            <button type="button" class="btn btn-outline-primary mt-2 rounded-5" id="icontinue">
                                <i class="mdi mdi-chevron-triple-right mx-1"></i>Yes, Continue
                            </button>
                        </div>
                    </div>                              
                </div>
            </div>
        </div>
    </div>

    <div style="display: none" id="available-lecturers" class="row justify-content-start">
        
        <p>This appraisal categorizes lecturers based on the courses they teach you. A lecturer may appear more than once if they teach you multiple courses. You are expected to appraise each lecturer based on their performance in each specific course.</p>


        <div class="col-12">
            <div class="card">
                <div class="card-body" style="margin: -10px 0  -10px 0;">
                    <div class="row">
                        <div class="row d-flex gap-2 col-lg-12 col-sm-12">
                            <div class="col-lg-12 mb-2">
                                <select id="courses" class="select2 form-control" data-toggle="select2">
                                    <option selected disabled>Filter by course...</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>

        {{-- Course template start here --}}
        <div class="col-lg-12" style="margin-bottom: -17px">
            <div class="card mt-2">
                <div class="card-body">
                    <div class="plan-features text-muted">
                        <hr class="cus-hr">
                        <strong id="c-title">Course Title</strong><br>
                        <b id="c-code">Code Code here</b>
                        <hr class="cus-hr">
                    </div>                              
                </div>
            </div>
        </div>
        {{-- cour template ends here --}}

        <div class="row d-flex" id="lecturer-container">

            <h2><strong>No course selected yet...</strong></h2>
        </div>   

    </div>

    
</div>


<div class="modal hide fade" id="my-modal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-uppercase modal-title">Modal title</h5>
                <div class="text-center">
                    <a class="logo logo-light">
                        <span class="logo-lg">
                            <img src="{{ asset('root/images/logo-text-dark.png') }}" alt="" height="22">
                        </span>
                    </a>
                </div>
            </div>
            <div class="modal-body">
                  
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Quality Assurance Directorate</h4>

                            <div id="progrss-wizard" class="twitter-bs-wizard">
                                <ul class="twitter-bs-wizard-nav nav-justified">
                                    <li class="nav-item">
                                        <a href="#progress-seller-details" class="nav-link active"
                                            data-toggle="tab">
                                            <span class="step-number">01</span>
                                            <span class="step-title">Appraise Lecturer</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#progress-confirm-detail" class="nav-link" data-toggle="tab">
                                            <span class="step-number">02</span>
                                            <span class="step-title">Confirm Detail</span>
                                        </a>
                                    </li>
                                </ul>

                                <div id="bar" class="progress mt-4">
                                    <div class="progress-bar bg-success progress-bar-striped progress-bar-animated">
                                    </div>
                                </div>

                                <div class="tab-content twitter-bs-wizard-tab-content">
                                    <div class="tab-pane active" id="progress-seller-details" style="max-height: 600px; overflow-y: auto;">
                                        <div class="row" id="question-contianer">
                                            <div class="col-lg-12">
                                                <div class="card bg-primary" id="section-main">
                                                    <h4 id="section-text" class="text-white mx-2">Section 1 Header Here</h4>
                                                </div>
                                                <section id="questions-holder">
                                                    {{-- <div class="card question-box rounded-4">
                                                        <div class="card-body">
                                                            <div class="col-lg-12">
                                                                <h5>Question with long answer.</h5>
                                                                <div class="form-floating mb-1">
                                                                    <textarea class="form-control" placeholder="Leave a comment here" id="descriptions" style="height: 100px">
                                                                    </textarea>
                                                                    <label for="descriptions">Description here..</label>
                                                                </div>
                                                            </div>      
                                                        </div>
                                                    </div> --}}
                                                    {{-- <div class="card question-box rounded-4">
                                                        <div class="card-body">
                                                            <div class="col-lg-12">
                                                                <h5>Question with short Answer</h5>
                                                                <div class="mb-1">
                                                                    <input type="text" class="form-control" placeholder="Your answer here..">
                                                                </div>
                                                            </div>      
                                                        </div>
                                                    </div> --}}

                                                    <x-long-answer />
                                                    <x-multiple-choice />
                                                </section>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="card bg-primary" id="section-main">
                                                    <h4 id="section-text" class="text-white mx-2">Section 2 Header Here</h4>
                                                </div>
                                                <section id="questions-holder">
                                                    <x-short-answer />
                                                    <x-multi-check />
                                                    <x-multiple-choice />
                                                </section>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="progress-confirm-detail">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-6">
                                                <div class="text-center">
                                                    <div class="mb-4">
                                                        <i
                                                            class="mdi mdi-check-circle-outline text-success display-4"></i>
                                                    </div>
                                                    <div>
                                                        <h5>Confirm Detail</h5>
                                                        <p class="text-muted">If several languages coalesce, the
                                                            grammar of the resulting</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <ul class="pager wizard twitter-bs-wizard-pager-link">
                                    <li class="previous"><a href="javascript: void(0);">Previous</a></li>
                                    <li class="next"><a href="javascript: void(0);">Next</a></li>
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                {{-- <button type="button" id="edit-data" class="btn btn-info">Proceed</button>
                <button type="button" id="save-data" class="btn btn-success">Proceed</button> --}}
            </div>
        </div>
    </div>
</div>



<script src="{{ asset('root/mint/assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('root/mint/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>


<script>

    $(document).ready(function() {


        $('#confirmcheck').prop('checked', false);

        //INITIALIZING THE SELECT STYLE
        $('.select2').each(function() { 
            $(this).select2({ dropdownParent: $(this).parent()});
            $(this).val($(this).find('option:first').val()).trigger('change');
        })

        $('#confirmcheck').change(function() {
            if ($(this).prop('checked')) {
                $('#security-notice').fadeOut('slow', function() {
                    $('#must-know').fadeIn('fast');
                });
            } else {
                $('#must-know').fadeOut('slow', function() {
                    $('#security-notice').fadeIn('fast');
                });
            }
        });

        $('#icontinue').click(function(e) {
            $('#must-know').fadeOut('slow', function() {
                $('#available-lecturers').fadeIn('fast');
            });
        });

        // Get the courses for the dropdown
        $.ajax({
            url: '{{ route("student.SemesterCourses") }}',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var roleSelect = $('#courses');
                roleSelect.empty();
                roleSelect.append('<option value="" selected disabled>Choose...</option>');
                $.each(data.courses, function (key, value) {
                    roleSelect.append('<option value="' + value.id + '">' + value.course.toUpperCase() +" (" + value.course_code + " )" + '</option>');
                });
                roleSelect.select2({ dropdownParent: roleSelect.parent() });
            },
            error: function (xhr, textStatus, errorThrown) {
                console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
            }
        }); 

        // GET Lecturersinformation
        $('#courses').on('change', function() {
            let course_id = $(this).val();
            $.ajax({
                url: '{{ route("get.lecturersByCourse") }}',
                type: 'GET',
                data: { course_id: course_id },
                dataType: 'json',
                success: function(data) {
                    let lecturerContainer = $('#lecturer-container');
                    lecturerContainer.empty();

                    // Check if data contains courses
                    if (data.courses.length > 0) {
                        // Loop through the courses (lecturers)
                        $.each(data.courses, function(index, course) {
                            // Create instance of each lecturer's data
                            let lecturerCard = `
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card plan-card" style="border-end-end-radius: 20px; border-bottom-left-radius: 20px">
                                        <div class="card-body text-center">
                                            <div class="pt-3 bg-primary" style="margin: -22px;">
                                                <div class="img-animation cus-shape">
                                                    <img src="{{ asset('root/mint/assets/images/users/avatar-8.jpg') }}" alt="#" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                                                </div>
                                                <h4 class="text-uppercase text-white lec-name">${course.lecturer}</h4>
                                                <hr style="border-color: white;">
                                            </div>

                                            <div class="plan-features pt-3 text-muted">
                                                <p class="mb-1">${course.email}</p>
                                                <hr class="cus-hr">
                                                <button type="button" class="btn btn-outline-primary mt-2 say-something" data-lecturer="${course.lecturer}" 
                                                    data-course-id="${course.id}" data-course="${course.course}">
                                                    <i class="mdi mdi-comment mx-1"></i>Say Something
                                                </button>
                                            </div>                    
                                        </div>
                                    </div>
                                </div>
                            `;

                            // Append the dynamically created lecturer card to the container
                            lecturerContainer.append(lecturerCard);
                            $('#c-title').text("Course Title: " + course.course);
                            $('#c-code').text("Course Code: " + course.course_code);
                        });
                    } else {
                        lecturerContainer.html('<p>No lecturers found for this course.</p>');
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
                }
            });
        });

        // Event listener for the 'say-something' button, using event delegation
        $('#lecturer-container').on('click', '.say-something', function() {
            $('#edit-data').hide('fade');
            
            // Access the data attributes from the button
            let lecturerName = $(this).data('lecturer');
            let courseId = $(this).data('course-id');
            let course = $(this).data('course');
            
            $('.modal-title').text('You\'re Appraising - ' + lecturerName + ' on: ' + course);
            $('#my-modal').modal('show');
   
        });



        // GET QUESTIONS
        $.ajax({
            url: '{{ route("student.questionaires") }}',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                let lecturerContainer = $('#question-contianer');
                lecturerContainer.empty();

                // Check if data contains courses
                if (data.courses.length > 0) {
                    $.each(data.courses, function(index, course) {
                        
                    });
                } else {
                    lecturerContainer.html('<p>No questions available at the moment</p>');
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
            }
        });



    });
</script>


@endsection



