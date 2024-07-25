<!-- resources/views/student/dashboard.blade.php -->

@extends('layout.main')

@section('title', 'Permissions')

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
                        <div class="col-lg-8 col-sm-6 d-flex gap-2">
                            <h4 class="page-title">Current @yield('title')</h4>
                            <button class="btn btn-danger" type="button" id="bulk-remove" style="display: none" > Remove</button>
                        </div>
                        <div class="col-lg-4 col-sm-6">
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
                                    <th>#</th>
                                    <th>Default Role</th>
                                    <th>Permission</th>
                                    <th>Permission Key</th>
                                    <th>Status</th>
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
                
                <form class="px-3" method="POST" id="my-form">
                    <input type="hidden" name="id" id="gottenId">
                    <div class="mb-2">
                        <label for="role" class="form-label">Assign Default Role </label>
                        <select id="role" name="role" class="select2 form-control" data-toggle="select2">
                            <option selected disabled>Choose...</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="username" class="form-label">Available Permissions</label>
                        <select id="permission" name="permission" class="select2 form-control" data-toggle="select2">
                            <option selected disabled>Choose...</option>
                            <optgroup label="System Settings">
                                <option value="view-roles">View Roles</option>
                                <option value="view-permissions">View Permissions</option>
                                <option value="view-departments">View Departments</option>
                                <option value="view-faculties">View Faculties</option>
                                <option value="view-courses">View Courses</option>
                                <option value="view-classes">View Classes</option>
                                <option value="view-questions">View Questions</option>
                                <option value="system-config">System Config</option>
                                <option value="system-dictionary">System Dictionary</option>
                                <option value="temp-appraisal">Temp Appraisal</option>
                                <option value="view-programme">View Programme</option>
                                <option value="view-sessions">View Session</option>
                                <option value="view-semester">View Semester</option>
                                <option value="view-session-semester">View Session Semester</option>
                                <option value="view-session-course">View Session Course</option>
                            </optgroup>
                            <optgroup label="Appraisal">
                                <option value="available-staff">Available Staff</option>
                                <option value="rejected-appraisal">Rejected Appraisal</option>
                                <option value="students-been-appraised">Students Been Appraised</option>
                                <option value="staff-been-appraised">Staff Been Appraised</option>
                                <option value="appraisal-statistics">Appraisal Statistics</option>
                                <option value="lecturer-based-statistics">Lecturer Based Statistics</option>
                                <option value="department-based-statistics">Dept Based Statistics</option>
                                <option value="faculty-based-statistics">Faculty Based Statistics</option>
                                <option value="list-of-appraised-staff">List of Appraised Staff</option>
                                <option value="list-of-appraised-students">List of Appraised Students</option>
                            </optgroup>
                            <optgroup label="User Management">
                                <option value="users-account">Users Account</option>
                                <option value="view-students">View Students</option>
                                <option value="view-staff">View Staff</option>
                            </optgroup>
                        </select>                        
                    </div>

                    <div class="form-floating mb-2">
                        <textarea class="form-control" placeholder="Description here..." name="description"  id="description" style="height: 100px">
                        </textarea>
                        <label for="description">Description here...</label>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6 form-check">
                            <input type="radio" class="form-check-input" id="privateRadio" name="hook" value="Public" checked>
                            <label class="form-check-label" for="privateRadio">Leave it Open <small class="text-muted">(Recommended)</small></label>
                        </div>
                        <div class="col-6 form-check">
                            <input type="radio" class="form-check-input" id="publicRadio" name="hook" value="Private">
                            <label class="form-check-label" for="publicRadio">Ristrict Access</label>
                        </div>
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

    function getPermissionAndHide() {
        $.ajax({
            url: '{{ route("fetch-permissions") }}',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $.each(data.permissions, function (key, value) {
                    $('#permission option[value="' + value.permission_key + '"]').prop('disabled', true);
                });
                $('#permission').select2({dropdownParent: $('#permission').parent()});
            },
            error: function (xhr, textStatus, errorThrown) {
                console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
            }
        });
    }

    function getPermissionAndShow() {
        $.ajax({
            url: '{{ route("fetch-permissions") }}',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $.each(data.permissions, function (key, value) {
                    $('#permission option[value="' + value.permission_key + '"]').prop('disabled', false);
                });
                $('#permission').select2({dropdownParent: $('#permission').parent()});
            },
            error: function (xhr, textStatus, errorThrown) {
                console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
            }
        });
    }

    $(document).ready(function() {

        var dataTable = "";
        var counter = 0;

        //GET ROLE FROM DB AND FILL ROLE
        $.ajax({
            url: '{{ route("fetch-roles") }}',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var roleSelect = $('#role');
                roleSelect.empty();
                roleSelect.append('<option value="" selected disabled>Choose...</option>');
                $.each(data.sortroles, function (key, value) {
                    roleSelect.append('<option value="' + value.id + '">' + value.role + '</option>');
                });
                roleSelect.select2({ dropdownParent: roleSelect.parent() });
            },
            error: function (xhr, textStatus, errorThrown) {
                console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
            }
        }); 

        //CALLING THE MODAL TO ADD NEW RECORD
        $('#add-new-button').click( function()
        {
            //GET ROLES
            getPermissionAndHide();

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
                showSweetAlert('error', 'Error!', 'Please all fields are rquired and cant\t be blank....');
                return;
            }

            let selectedPermissionText = $('#permission option:selected').text();
            let formData = $('#my-form').serialize();
            formData += '&perm=' + encodeURIComponent(selectedPermissionText);


            let buttonElement = $(this);
            buttonElement.html('<i class="fa fa-spinner fa-spin"></i> Please wait... ').attr('disabled', true);

            $.ajax({
                url: '{{ route('addPermission') }}',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {

                    counter = 0;
                    dataTable.ajax.reload();
                    // $('#my-form :input').val('');
                    $('#my-modal').modal('hide');
                    getPermissionAndHide();
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

        //SENDING DATA TO THE API FOR EDTING
        $('#edit-data').on('click', function () {
            // Check if form inputs are not null
            if (!validateForm()) {
                showSweetAlert('error', 'Error!', 'Please all fields are rquired and cant\t be blank....');
                return;
            }

            let selectedPermissionText = $('#permission option:selected').text();
            let formData = $('#my-form').serialize();
            formData += '&perm=' + encodeURIComponent(selectedPermissionText);

            let buttonElement = $(this);
            buttonElement.html('<i class="fa fa-spinner fa-spin"></i> Please wait... ').attr('disabled', true);

            $.ajax({
                url: '{{ route('updatePermission') }}',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {

                    counter = 0;
                    dataTable.ajax.reload();
                    // $('#my-form :input').val('');
                    $('#my-modal').modal('hide');
                    getPermissionAndHide();
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
            let role = $('#role').val();
            let descriptions = $('#description').val();
            let permission = $('#permission').val();

            return role && descriptions && permission;
        }

        // Function to show SweetAlert message
        function showSweetAlert(icon, title, text) {
            Swal.fire({ icon: icon, title: title, text: text, });
        }

        // Attach a click event handler to the edit button
        $('#example').on('click', '.edit-btn', function () {
            // Get the data attributes
            let Id = $(this).data('id');
            let title = $(this).data('title');
            let permission = $(this).data('permission');
            let role = $(this).data('role');
            let description = $(this).data('description');
            let hook = $(this).data('hook');

            getPermissionAndShow();

            // Set the values in the input fields
            $('#gottenId').val(Id);
            $('#role').val(role).trigger('change'); 
            $('#permission').val(permission).trigger('change'); 
            $('#description').text(description);
            
            // Set the checked status for radio buttons
            $('input[name="hook"]').prop('checked', false);
            $('input[name="hook"][value="' + hook + '"]').prop('checked', true);

            $('#modal-title').text('Modifying - ' + title);
            $('#save-data').hide('fade');
            $('#edit-data').show('fade');
            $('#my-modal').addClass('modal-blur').modal('show');
        });

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
                        url: '{{ route("destroyPermission") }}',
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
                            var counter = 0;
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



        //DATA TABLE SEETING UP
        dataTable = $("#example").DataTable(
        {
            ajax: {
                url: '{{ route('permissions') }}',
                type: 'GET',
                dataSrc: 'permissions',
                beforeSend: showLoader,
                complete: hideLoader,
            },
            columns: [
                {
                    data: null,
                    render: function (data, type, row) {
                        return '<input type="checkbox" class="select-checkbox" data-id="' + data.id + '" data-title="' + data.permission + '"/>';
                    },
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return ++counter;
                    }
                },
                { data: 'role'},
                { data: 'permission'},
                { data: 'permission_key'},
                { data: 'hook'},
                { data: 'description'},
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<button class="btn btn-primary btn-sm edit-btn mx-2" data-id="' + data.id + '" data-description="' + data.description + '" data-hook="' + data.hook + '" data-role="' + data.role_id + '" data-permission="' + data.permission_key + '" data-title="' + data.permission + '"><i class="fas fa-edit mx-1"></i>Edit</button>' +
                        '<button class="btn btn-danger btn-sm delete-btn" data-id="' + data.id + '" data-title="' + data.permission + '"><i class="fas fa-trash mx-1"></i>Remove</button>';
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
                let table='permissions'
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
                            counter = 0;
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
