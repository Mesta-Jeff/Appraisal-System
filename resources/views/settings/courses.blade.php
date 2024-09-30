<!-- resources/views/student/dashboard.blade.php -->

@extends('layout.main')

@section('title', 'Courses')

@section('content')




<div class="container-fluid">

    <div class="row" style="margin-bottom: -15px;">
        <div class="col-12">
            <div class="page-title-box shadow-none" style="position: sticky; top: 0; background-color: transparent; z-index: 1000;">
                <small></small>
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
                            <h4 class="page-title">Current @yield('title')</h4>
                            <button class="btn btn-danger" type="button" id="bulk-remove" style="display: none" > Remove</button>
                        </div>
                        <div class="col-lg-6 col-sm-8">
                            <div class="d-flex gap-2 justify-content-lg-end mt-3 mt-lg-0">
                                <button type="button" id="btnref" class="btn btn-secondary"><i class="mdi mdi-atom-variant spin"></i> Reload</button>
                                <button type="button" id="add-new-button" class="btn btn-outline-success waves-effect waves-light"><i class="mdi mdi-plus-circle me-1"></i> Add New</button>
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
                                    <th><input type="checkbox" id="selectAllCheckboxes"/></th>
                                    <th>Course Title</th>
                                    <th>Code</th>
                                    <th>Course Type</th>
                                    <th>Course Owner</th>
                                    <th>Description</th>
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
<div class="modal modal-blur hide fade" id="my-modal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
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
                    <input type="hidden" id="gottenId" name="id">
                    <div class="mb-1">
                        <label for="course" class="form-label">Course title here </label>
                        <input type="text" name="course" id="course" class="form-control" placeholder="Enter title here" />
                    </div>
                    <div class="mb-1">
                        <label for="course" class="form-label">Course Code </label>
                        <input type="text" name="course-code" id="course-code" class="form-control" placeholder="Enter course code" />
                    </div>

                    <div class="mb-1">
                        <label for="types" class="form-label">Course Type</label>
                        <select id="course-type" name="course-type" class="form-control">
                            <option selected disabled>Choose...</option>
                            <option value="Departmental">Departmental Course</option>
                            <option value="General">General Course</option>                           
                            <option value="Faculty">Faculty Based Course</option>
                            <option value="Liberal">Liberal Course</option>
                        </select>
                    </div>

                    <div class="mb-1" id="accessors-1">
                        <label for="types" class="form-label">Programme owning this course default</label>
                        <select id="programme" name="programme" class="select2 form-control" data-toggle="select2">
                            <option selected disabled>Choose...</option>
                        </select>
                    </div>
                    <div class="mb-1" id="accessors-2" style="display: none">
                        <label for="types" class="form-label">Select Departments that will offer this course</label>
                        <select id="programmes" name="programmes" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Choose ..." data-toggle="select2"></select>
                    </div>

                    <div class="form-floating mb-2">
                        <textarea class="form-control" placeholder="Description here..." name="description"  id="description" style="height: 100px">
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


        // Helper function to truncate text
        function truncateText(text, maxLength) {
            if (text.length > maxLength) {
                return text.substring(0, maxLength) + '...';
            }
            return text;
        }

        // function to reset form
        function resetting(){
            $('#my-form')[0].reset();
            $('#course-type, #programme').val('').trigger('change');
            $('#programmes').val('').trigger('change');
            dataTable.ajax.reload();
        }

        //GET programmeS FROM DB
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

        //GET DEPARTMENTS IN FACULTY
        $.ajax({
            url: '{{ route("fetch-departmentsInfaculty") }}',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var roleSelect = $('#programmes');
                roleSelect.empty();
                $.each(data.departments, function (key, value) {
                    roleSelect.append('<option value="' + value.id + '">' + value.department+ '</option>');
                });
                roleSelect.select2({ dropdownParent: roleSelect.parent() });
            },
            error: function (xhr, textStatus, errorThrown) {
                console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
            }
        }); 

        // Course type checking
        $('#course-type').on('change', function(){
            if($(this).val() == 'Faculty'){
                $('#accessors-2').show('fade');
                // $('#accessors-1').hide('fade');
            }else{
                $('#accessors-2').hide('fade');
                $('#accessors-1').show('fade');
            }
        })

        //CALLING THE MODAL TO ADD NEW RECORD
        $('#add-new-button').click( function()
        {
            // resetting();
            $('#description').text(null);
            $('#modal-title').text('Creating Course to ' + '{{ env('APP_ALIASE')}}');
            $('#edit-data').hide('fade');
            $('#save-data').show('fade');
            $('#my-modal').modal('show');
        })


        //SENDING DATA TO THE API FOR SAVINGS
        $('#save-data').on('click', function () {
            // Check if form inputs are not null
            if (!validateForm()) {
                showSweetAlert('error', 'Error!', 'All fields are required and cannot be blank.');
                return;
            }

            let formData = $('#my-form').serialize();
            let courseType = $('#course-type').val();
            if (courseType === 'Faculty') {
                let selectedProgrammes = $('#programmes').val();
                if (selectedProgrammes) {
                    formData += '&accessors=' + encodeURIComponent(selectedProgrammes.join(','));
                }
            }

            let buttonElement = $(this);
            buttonElement.html('<i class="fa fa-spinner fa-spin"></i> Please wait...').attr('disabled', true);

            $.ajax({
                url: '{{ route('addCourse') }}',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    
                    buttonElement.prop('disabled', false).html('Send Request').css('cursor', 'pointer');

                    if (response.status === 'success') {
                        showSweetAlert('success', 'Success!', response.message);
                        resetting();
                        $('#my-modal').modal('hide');

                    } else {
                        showSweetAlert('error', 'Error!', response.message);
                    }
                },
                error: function (xhr, status, error) {
                    buttonElement.prop('disabled', false).html('Send Request').css('cursor', 'pointer');

                    if (xhr.responseJSON && xhr.responseJSON.status === 'error') {
                        showSweetAlert('error', 'Error!', xhr.responseJSON.message);
                    } else {
                        showSweetAlert('error', 'Error!', 'Request Failed: ' + status + ', ' + error);
                    }
                }
            });
        });


        //SENDING DATA TO THE API FOR EDTING
        $('#edit-data').on('click', function () {
            // Check if form inputs are not null
            if (!validateForm()) {
                showSweetAlert('error', 'Error!', 'Please all fields are rquired and cant\t be blank....');
                return;
            }

            let formData = $('#my-form').serialize();
            let courseType = $('#course-type').val();
            if (courseType === 'Faculty') {
                let selectedProgrammes = $('#programmes').val();
                if (selectedProgrammes) {
                    formData += '&accessors=' + encodeURIComponent(selectedProgrammes.join(','));
                }
            }

            let buttonElement = $(this);
            buttonElement.html('<i class="fa fa-spinner fa-spin"></i> Please wait...').attr('disabled', true);

            $.ajax({
                url: '{{ route('updateCourse') }}',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    buttonElement.prop('disabled', false).text('Send Request').css('cursor', 'pointer');

                    if (response.status === 'success') {
                        showSweetAlert('success', 'Success!', response.message);
                        resetting();
                        $('#my-modal').modal('hide');
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
            let course = $('#course').val();
            let ctype = $('#course-type').val();
            let ccode = $('#course-code').val();
            let des = $('#description').val();
            return course && ctype && ccode && des;
        }

        // Function to show SweetAlert message
        function showSweetAlert(icon, title, text) {
            Swal.fire({ icon: icon, title: title, text: text, });
        }

        // Attach a click event handler to the view accessors
        $('#example').on('click', '.view-btn', function () {
            // Get the data attributes
            let accessors = $(this).data('accessors');
            let accessorsArray = accessors.split(',');

            $.ajax({
                url: '{{ route("fetch-departmentsInfaculty") }}',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    let htmls = '';

                    // Iterate through the fetched programmes and build HTML for matching accessors
                    $.each(data.departments, function (key, value) {
                        if (accessorsArray.includes(value.id.toString())) {
                            htmls += `
                            <hr style="margin-top: -5px; margin-bottom: 5px;"/>
                            <div class="d-flex align-items-left">
                                <div class="notify-icon text-primary" style="margin-bottom: 20px; margin-right: 10px;">
                                    <i class="mdi mdi-school"></i>
                                </div>
                                <p class="notify-details" style="font-size: 13px; font-style: italic">${value.department}</p>
                            </div>`;
                        }
                    });

                    if (htmls === '') {  htmls = '<p style="font-style: italic">No department found for the selected accessors.</p>'; }

                    Swal.fire({
                        title: 'List of Deparmtents Taking This Course',
                        html: htmls,
                        confirmButtonColor: '#3BAFDA',
                        confirmButtonText: 'Ok'
                    });
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
                }
            });
        });


        // Attach a click event handler to the edit button
        $('#example').on('click', '.edit-btn', function () {
            // Get the data attributes
            let Id = $(this).data('id');
            let title = $(this).data('course');
            let code = $(this).data('code');
            let coursetype = $(this).data('course-type');
            let accessors = $(this).data('accessors');
            let programme = $(this).data('programme');
            let des = $(this).data('description');

            // Set the values in the input fields
            $('#gottenId').val(Id);
            $('#description').text(des);
            $('#programme').val(programme).trigger('change'); 
            $('#course').val(title).trigger('change');
            $('#course-code').val(code);
            $('#course-type').val(coursetype).trigger('change');

            if (coursetype === 'Faculty' && accessors) {
                let accessorsArray = accessors.split(',');
                $('#programmes').val(accessorsArray).trigger('change');
                $('#accessors-2').show('fade');
            } else {
                $('#programmes').val('').trigger('change');
            }
            
            $('#modal-title').text('Modifying - ' + title);
            $('#save-data').hide('fade');
            $('#edit-data').show('fade');
            $('#my-modal').modal('show');
        });

        //DELETE THE DATA
        $('#example').on('click', '.delete-btn', function () {
            let Id = $(this).data('id');
            let title = $(this).data('title');
            let message = 'Are you sure you want to remove: <span class="text-danger"> ' + title +'</span>'

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
                        url: '{{ route("destroyCourse") }}',
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

        var sessionData = {
            role: "{{ session('role') }}",
            department: "{{ session('department') }}",
            faculty: "{{ session('faculty') }}"
        };
        //DATA TABLE SEETING UP
        dataTable = $("#example").DataTable(
        {
            ajax: {
                url: '{{ route('courses') }}',
                type: 'GET',
                dataSrc: 'courses',
                beforeSend: showLoader,
                complete: hideLoader,
            },
            columns: [
                {
                    data: null,
                    render: function (data, type, row) {
                        return '<input type="checkbox" class="select-checkbox" data-id="' + data.id + '" data-title="' + data.course + '"/>';
                    },
                },
                { data: 'course'},
                { data: 'course_code'},
                { data: 'course_type'},
                {
                    data: 'programme',
                    render: function(data, type, row) {
                        return truncateText(data, 20);
                    }
                },
                {
                    data: 'description',
                    render: function(data, type, row) {
                        return truncateText(data, 20);
                    }
                },
                
                {
                    data: null,
                    render: function (data, type, row) {
                        let viewAccessorsItem = '';
                        if (data.course_type === 'Faculty') {
                            viewAccessorsItem = `<a class="dropdown-item view-btn" href="javascript:void(0);" data-accessors="${data.accessors}">View Accessors</a>`;
                        }

                        // Check if the role is HOD or Officer and if the department matches
                        let addControlButton = '';
                        if (['hod', 'officer'].includes(data.role.toLowerCase()) && data.department_id == data.department || ['dean', 'administrator','developer', 'head qa'].includes(data.role.toLowerCase())) {
                            addControlButton = `<a class="dropdown-item text-info edit-btn" href="javascript:void(0);" data-id="${data.id}" data-code="${data.course_code}" data-course-type="${data.course_type}" data-accessors="${data.accessors}" data-programme="${data.programme_id}" data-course="${data.course}" data-description="${data.description}">Modify Course</a>
                                                <a class="dropdown-item text-danger delete-btn" href="javascript:void(0);" data-id="${data.id}" data-title="${data.course}">Release Course</a>`;
                        }

                        return `
                            <div class="btn-group me-1">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle waves-effect" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical font-18"></i> More
                                    <i class="mdi mdi-chevron-down"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);">Add Task</a>                         
                                    ${viewAccessorsItem}
                                    ${addControlButton}
                                </div>
                            </div>`;
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
            initComplete: function (settings, json) {
                dataTable.buttons().container().appendTo("#example_wrapper .col-md-6:eq(0)");
                $('#selectAllCheckboxes').on('change', function () {
                    let isChecked = $(this).prop('checked');
                    $('.select-checkbox').prop('checked', $(this).prop('checked'));
                    $('#bulk-remove').toggle(isChecked);
                });
            }
        });

        //TO REFRESH THE Page
        $('#btnref').click( function(){
            dataTable.ajax.reload();
            // window.location.reload();
        })

        // Event listener for checkbox change
        $('#example tbody').on('change', '.select-checkbox', function () {
            var anyCheckboxChecked = $('.select-checkbox:checked').length > 0;
            $('#bulk-remove').toggle(anyCheckboxChecked);
        });

        // Event listener for button click
        $('#bulk-remove').on('click', function () {
            var checkedCheckboxes = $('.select-checkbox:checked');
            if (checkedCheckboxes.length > 0) {
                let table='courses'
                performBulkRemove(table);
            } else {
                Swal.fire({
                    icon: 'error',title: 'No Record selected',
                    text: 'Please select at least one record before removing.',
                });
            }
        });

        // Function to perform the bulk remove action
        function performBulkRemove(table) {
            let selectedtitles = $('.select-checkbox:checked').map(function () {
                return $(this).data('title');
            }).get();
            let selectedIds = $('.select-checkbox:checked').map(function () {
                return $(this).data('id');
            }).get();

            let message = 'Are you sure you want to remove the item(s) below:<br><span class="text-danger"> ' + selectedtitles.join(', ') +'</span>';
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
                        url: '{{ route("bulk-destroy") }}',
                        type: 'POST',
                        data: { id: selectedIds, table: table },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            
                            if (response.status === 'success') {
                                showSweetAlert('success', 'Success!', response.message);
                            } else {
                                showSweetAlert('error', 'Error!', response.message);
                            }
        
                            dataTable.ajax.reload();
                            $('#bulk-remove').fadeOut();
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
                else { dataTable.ajax.reload();}
                
            });
        }

    });
</script>
    
@endsection


