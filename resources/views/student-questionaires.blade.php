<!-- resources/views/student/dashboard.blade.php -->

@extends('layout.free')

@section('title', 'Student Questionaires')

@section('content')
    
<div class="container-fluid mt-5">
      
    <div id="security-notice" class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card mt-4">
                <div class="modal-header bg-primary">
                    <a class="mx-2 my-2">
                        <div class="img-animation cus-shape">
                            <img src="{{ asset('root/mint/assets/images/users/avatar-8.jpg') }}" alt="#" class="img-fluid">
                        </div>
                        <h3 class="text-white">Name here</h3>
                    </a>
                    
                </div>
                
                <div class="card-body">
                    <div class="plan-features text-muted">
                        <h3>Be Assured That:</h3>
                        <p class="mb-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, tempora totam at alias ut tenetur rerum magnam commodi dolorum odio inventore temporibus qui amet architecto necessitatibus est facilis eum exercitationem! Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio nisi unde consequuntur at doloremque numquam, praesentium minus eaque quia magnam? Beatae, distinctio ex similique doloribus provident dolorum? Sed, eligendi quo. Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis dolor vero omnis, quos facere ad quae, aut accusamus laudantium, nesciunt dolorum aliquam consequuntur expedita unde blanditiis quaerat corporis similique.</p>
                        <hr class="cus-hr">
                        <div class="form-check mt-2 text-primary">
                            <input type="checkbox" class="form-check-input" id="confirmcheck">
                            <label class="form-check-label" for="confirmcheck">
                                <i class="fas fa-thumbs-up mx-1"></i>Yes I do agree, and I will abide by all protocols
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
                        <h3 class="text-primary">Must Know This: </h3>
                        <hr class="cus-hr">
                        <p class="mb-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, tempora totam at alias ut tenetur rerum magnam commodi dolorum odio inventore temporibus qui amet architecto necessitatibus est facilis eum exercitationem! Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio nisi unde consequuntur at doloremque numquam, praesentium minus eaque quia magnam? Beatae, distinctio ex similique doloribus provident dolorum? Sed, eligendi quo. Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis dolor vero omnis, quos facere ad quae, aut accusamus laudantium, nesciunt dolorum aliquam consequuntur expedita unde blanditiis quaerat corporis similique.</p>
                        <hr class="cus-hr">
                        <div class="text-center">
                            <button type="button" class="btn btn-outline-primary mt-2 rounded-5" id="icontinue"><i class="mdi mdi-chevron-triple-right mx-1"></i>Yes Continue</button>
                        </div>
                    </div>            
                </div>
            </div>
        </div>
    </div>

    <div style="display: none" id="available-lecturers" class="row justify-content-start">
        <div class="col-12">
            <div class="card">
                <div class="card-body" style="margin: -10px 0  -10px 0;">
                    <div class="row">
                        <div class="d-flex gap-2 col-lg-8 col-sm-6">
                            <input type="text" class="col-lg-4 mb-2 form-control" placeholder="Sort here...">
                            <div class="col-lg-4 mb-2">
                                <select id="roles" class="select2 form-control" data-toggle="select2">
                                    <option selected disabled>Choose...</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="d-flex gap-2 justify-content-lg-end mt-3 mt-lg-0">
                                <button type="button" class="btn btn-secondary waves-effect waves-light"><i class="mdi mdi-cog"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>

        @for ($i = 1; $i <= 14; $i++)
            <div class="col-lg-3">
                <div class="card plan-card mt-4 rounded-4">
                    <div class="card-body text-center">
                        <div class="pt-3 bg-primary" style="margin: -22px;">
                            <div class="img-animation cus-shape">
                                <img src="{{ asset('root/mint/assets/images/users/avatar-8.jpg') }}" alt="#" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                            </div>
                            <h4 class="text-uppercase text-white lec-name">Lecturer Name here..</h4>
                            <hr style="border-color: white;">
                        </div>
            
                        <div class="plan-features pt-3 text-muted">
                            <p class="mb-1">Free Live Support</p>
                            <p class="mb-1">Unlimited User</p>
                            <p class="mb-1">No Time Tracking</p>
                            <p class="mb-1">Free Setup</p>
                            <hr class="cus-hr">
                            <button type="button" class="btn btn-outline-primary mt-2 say-something"><i class="mdi mdi-comment mx-1"></i>Say Something</button>
                        </div>                    
                    </div>
                </div>
            </div>
        @endfor

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
                                        <a href="#progress-company-document" class="nav-link" data-toggle="tab">
                                            <span class="step-number">02</span>
                                            <span class="step-title">Appraise Course</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#progress-confirm-detail" class="nav-link" data-toggle="tab">
                                            <span class="step-number">03</span>
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
                                        <div class="row">
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
                                                    <x-date-answer />
                                                    <x-multiple-choice />
                                                    <x-time-answer />
                                                    <x-dropdown />
                                                    <x-true-false />
                                                    <x-multi-select />
                                                    <x-linear-scale />
                                                    <x-short-answer />
                                                    <x-multi-check />
                                                </section>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="card bg-primary" id="section-main">
                                                    <h4 id="section-text" class="text-white mx-2">Section 2 Header Here</h4>
                                                </div>
                                                <section id="questions-holder">
                                                    <x-long-answer />
                                                    <x-date-answer />
                                                    <x-linear-scale />
                                                    <x-short-answer />
                                                    <x-multi-check />
                                                    <x-multiple-choice />
                                                    <x-time-answer />
                                                    <x-dropdown />
                                                    <x-true-false />
                                                    <x-multi-select />
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="progress-company-document">
                                        <div>
                                            <div class="row">
                                                <div>
                                                    <p class="text-muted">The Next Tab 2 Content</p>
                                                </div>
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

        $('.say-something').click(function(){
            $('#edit-data').hide('fade');
            let lecturerName = $('.lec-name', $(this).closest('.card')).text().trim();;
            $('.modal-title').text('you\'re Appraising [' + lecturerName + ']');
            $('#my-modal').modal('show');
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

    });
</script>


@endsection



