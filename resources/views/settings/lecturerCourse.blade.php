<!-- resources/views/student/dashboard.blade.php -->

@extends('layout.main')

@section('title', 'Lecturers & Courses')

@section('content')


<div class="container-fluid">

    <div class="row" style="margin-bottom: -15px;">
        <div class="col-12">
            <div class="page-title-box shadow-none" style="position: sticky; top: 0; background-color: transparent; z-index: 1000;">
                
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{ env('APP_ALIASE')}}</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">System Settings</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="overflow-y: auto; max-height: calc(100vh - 100px);">
        
        <div class="col-12">
            <div class="card">
                <div class="card-body" style="margin: -10px 0  -10px 0;">
                    <div class="row">
                        <div class="col-lg-6 col-sm-4 d-flex gap-2">
                            <h4 class="page-title">@yield('title')</h4>
                            <button class="btn btn-danger" type="button" id="bulk-remove" style="display: none" > Remove</button>
                        </div>
                        <div class="col-lg-6 col-sm-8">
                            <div class="d-flex gap-2 justify-content-lg-end mt-3 mt-lg-0">
                                <button type="button" id="btnref" class="btn btn-secondary"><i class="mdi mdi-atom-variant spin"></i> Reload</button>
                                <button type="button" id="add-new-button" class="btn btn-outline-success waves-effect waves-light"><i class="mdi mdi-plus-circle me-1"></i> Assign New</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="loader" class="text-center loader-overlay" style="display: none;">
                            <div class="loader-content">
                                <i class="fas fa-spinner fa-spin fa-2x"></i>
                                <p>Loading...</p>
                            </div>
                        </div>
                        <table id="example" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr class="text-uppercase">
                                    <th>Programme</th>
                                    <th>Level</th>
                                    <th>Course</th>
                                    <th>Course Code</th>
                                    <th>Semester</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
</div>


<!-- Modal -->
<div class="modal hide fade" id="my-modal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">...</h5>
                <div class="text-center">
                    <a class="logo logo-light">
                        <span class="logo-lg">
                            <img src="{{ asset('root/images/logo-text-dark.png') }}" alt="" height="22">
                        </span>
                    </a>
                </div>
            </div>
            <div class="modal-body">
                <form class="px-3" id="my-form">
                    <div class="mb-1">
                        <label for="username" class="form-label">Select Programme</label>
                        <select id="programme" name="programme" class="select2 form-control" data-toggle="select2">
                            <option selected disabled>Choose...</option>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label for="username" class="form-label">Select all Courses you want to assign</label>
                        <select id="course" name="course" class="select2 form-control" data-placeholder="Choose ..." data-toggle="select2"></select>
                    </div>
                    <div class="mb-1">
                        <label for="lecturer" class="form-label">Select Lecturer</label>
                        <select id="lecturer" name="lecturer" class="select2 form-control" data-toggle="select2">
                            <option selected disabled>Choose...</option>
                        </select>
                    </div>
                   
                   
                    <div class="form-floating mb-2">
                        <textarea class="form-control" placeholder="Description here..." name="description" id="description" style="height: 100px">
                        </textarea>
                        <label for="descriptions">Description here...</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" id="edit-data" class="btn btn-info">Send Request</button>
                <button type="button" id="save-data" class="btn btn-success">Send Request</button>
            </div>
        </div>
    </div>
</div>
    


<script src="{{ asset('root/mint/assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('root/mint/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>


<script>

    // Function to show loader
    function showLoader() { $('#loader').show(); }
    function hideLoader() { $('#loader').hide(); }

    $(document).ready(function() {

        var dataTable = "";
        var counter = 0;

        //GET Lecturers
        $.ajax({
            url: '{{ route("staff") }}',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var roleSelect = $('#lecturer');
                roleSelect.empty();
                roleSelect.append('<option value="" selected disabled>Choose...</option>');
                $.each(data.staffs, function (key, value) {
                    roleSelect.append('<option value="' + value.id + '">' + value.title + " " + value.first_name + " " +  value.middle_name + " " + value.last_name + '</option>');
                });
                roleSelect.select2({ dropdownParent: roleSelect.parent() });
            },
            error: function (xhr, textStatus, errorThrown) {
                console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
            }
        }); 

        // Gett semesters
        $('#sessions').on('change', function(){
            session_id = $(this).val();
            $.ajax({
                url: '{{ route("fetch-session-semesters") }}',
                type: 'GET',
                data: { session_id: session_id },
                dataType: 'json',
                success: function (data) {
                    var roleSelect = $('#semester');
                    roleSelect.empty();
                    roleSelect.append('<option value="" selected disabled>Choose...</option>');
                    $.each(data['semesters'], function (key, value) {
                        roleSelect.append('<option value="' + value.id + '">' + value.semester + '</option>');
                    });
                    $('#semester').select2({ dropdownParent: $('#semester').parent() });
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
                }
            }); 
        });


        // GET PROGRAMMES
        $.ajax({
            url: '{{ route("fetch-programmes") }}',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var roleSelect = $('#programme');
                roleSelect.empty();
                roleSelect.append('<option value="" selected disabled>Choose...</option>');
                $.each(data.programmes, function (key, value) {
                    roleSelect.append('<option value="' + value.id + '">' + value.programme + '</option>');
                });
                roleSelect.select2({ dropdownParent: roleSelect.parent() });
            },
            error: function (xhr, textStatus, errorThrown) {
                console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
            }
        }); 

        // GET COURSES
        $('#programme').on('change', function(){
            programme_id = $(this).val();
            $.ajax({
                url: '{{ route("fetch-session-courses") }}',
                type: 'GET',
                data: { programme_id: programme_id },
                dataType: 'json',
                success: function (data) {
                    var roleSelect = $('#course');
                    roleSelect.empty();
                    $.each(data['courses'], function (key, value) {
                        roleSelect.append('<option value="' + value.id + '">' + value.course + '</option>');
                    });
                    roleSelect.select2({ dropdownParent: roleSelect.parent() });
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
                }
            }); 
        });
        

        //CALLING THE MODAL TO ADD NEW RECORD
        $('#add-new-button').click( function()
        {
            $('#description').text(null);
            $('#modal-title').text('Adding New Record to ' + '{{ env('APP_ALIASE')}}');
            $('#edit-data').hide('fade');
            $('#save-data').show('fade');
            $('#my-modal').addClass('modal-blur').modal('show');
        })

        //SENDING DATA TO THE API FOR SAVINGS
        $('#save-data').on('click', function () {
            // Check if form inputs are not null
            if (!validateForm()) {
                showSweetAlert('error', 'Error!', 'Please all fields are required and can\'t be blank....');
                return;
            }

            // Serialize the form data
            let formData = $('#my-form').serializeArray();

            let buttonElement = $(this);
            buttonElement.html('<i class="fa fa-spinner fa-spin"></i> Please wait... ').attr('disabled', true);

            $.ajax({
                url: "{{ route('assign.courses') }}",
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    counter = 0;
                    dataTable.ajax.reload();
                    $('#my-modal').modal('hide');

                    buttonElement.prop('disabled', false).text('Send Request').css('cursor', 'pointer');

                    if (response.status === 'success') {
                        showSweetAlert('success', 'Success!', response.message);
                    } else {
                        showSweetAlert('error', 'Error!', response.message);
                    }
                },
                error: function (xhr, status, error) {
                    buttonElement.prop('disabled', false).text('Send Request').css('cursor', 'pointer');

                    if (xhr.responseJSON && xhr.responseJSON.status === 'error') {
                        showSweetAlert('error', 'Error!', xhr.responseJSON.message);
                    } else {
                        showSweetAlert('error', 'Error!', 'Request Failed: ' + status + ', ' + error);
                    }
                }
            });
        });


        //VALIDATE FORM
        function validateForm() {
            let lecturer= $('#lecturer').val();
            let course = $('#course').val();

            return  lecturer && course ;
        }

        // Function to show SweetAlert message
        function showSweetAlert(icon, title, text) {
            Swal.fire({ icon: icon, title: title, text: text, });
        }

        //DELETE THE DATA
        $('#example').on('click', '.delete-btn', function () {
            let Id = $(this).data('id');
            let title = $(this).data('title');
            let message = 'Are you sure you want to remove: <span class="text-danger"> ' + title +'</span>'
            // Show SweetAlert confirmation dialog
            Swal.fire({
                title: 'Confirm Action',
                html: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3BAFDA',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route("destroyDepartment") }}',
                        type: 'POST',
                        data: { id: Id },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            
                            if (response.status === 'success') {
                                showSweetAlert('success', 'Success!', response.message);
                            } else {
                                showSweetAlert('error', 'Error!', response.message);
                            }
                            var counter = 1;
                            dataTable.ajax.reload();
                        },
                        error: function (xhr, status, error) {
                            if (xhr.responseJSON && xhr.responseJSON.status === 'error') {
                                showSweetAlert('error', 'Error!', xhr.responseJSON.message);
                            } else {
                                showSweetAlert('error', 'Error!', 'Request Failed: ' + status + ', ' + error);
                            }
                        }
                    });
                }
            });
        });

        // Helper function to truncate text
        function truncateText(text, maxLength) {
            if (text.length > maxLength) {
                return text.substring(0, maxLength) + '...';
            }
            return text;
        }

        //DATA TABLE SEETING UP
        dataTable = $("#example").DataTable(
        {
            ajax: {
                url: '{{ route('session-course') }}',
                type: 'GET',
                dataSrc: 'sessionCourses',
                beforeSend: showLoader,
                complete: hideLoader,
            },
            columns: [
                {
                    data: 'programme',
                    render: function(data, type, row) {
                        return truncateText(data, 20);
                    }
                },
                { data: 'class'},
                {
                    data: 'course',
                    render: function(data, type, row) {
                        return truncateText(data, 50);
                    }
                },
                { data: 'course_code'},
                { data: 'semester'},
                { data: 'status'},
                {
                    data: null,
                    render: function(data, type, row) {
                        if (data.status === 'Unmounted') {
                            return '<button class="btn btn-info btn-sm mount-btn" data-id="' + data.id + '" data-title="' + data.department + '">Mount</button>';
                        } else {
                            return '<button class="btn btn-danger btn-sm unmount-btn" data-id="' + data.id + '" data-title="' + data.department + '">Unmount</button>';
                        }
                    }
                }

                
            ],
            drawCallback: function() {
                counter = 0;
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
            },
            lengthChange: false,
            responsive: true,
            buttons: ["copy", "csv", "print", "pdf"].map(function(type) {
                return { extend: type, className: "btn-info" };
            }),
            language: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'>",
                    next: "<i class='mdi mdi-chevron-right'>"
                }
            },
        });

        //TO REFRESH THE Page
        $('#btnref').click( function(){
            dataTable.ajax.reload();
            // window.location.reload();
        })


    });
</script>
    
@endsection

