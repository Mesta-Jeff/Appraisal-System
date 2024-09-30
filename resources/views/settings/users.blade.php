<!-- resources/views/student/dashboard.blade.php -->

@extends('layout.main')

@section('title', 'Users')

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
                            <h4 class="page-title">@yield('title') Account</h4>
                            <button class="btn btn-danger" type="button" id="bulk-remove" style="display: none" > Remove</button>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="d-flex gap-2 justify-content-lg-end mt-3 mt-lg-0">
                                <button type="button" id="btnref" class="btn btn-secondary"><i class="mdi mdi-atom-variant spin"></i> Reload</button>
                                {{-- <button type="button" id="add-new-button" class="btn btn-outline-success waves-effect waves-light"><i class="mdi mdi-plus-circle me-1"></i> Add New</button> --}}
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
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Fullname</th>
                                    <th class="w-100">Email</th>
                                    <th>Status</th>
                                    <th>Date Added</th>
                                    <th>Not Used Before</th>
                                    <th>Default Password</th>
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



<script src="{{ asset('root/mint/assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('root/mint/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>


<script>
    // Function to show loader
    function showLoader() { $('#loader').show(); }
    function hideLoader() { $('#loader').hide(); }

    $(document).ready(function() {

        var dataTable = "";
    

        //CALLING THE MODAL TO ADD NEW RECORD
        $('#add-new-button').click( function()
        {
            $('#description').text(null);
            $('#modal-title').text('Adding New Record to ' + '{{ env('APP_ALIASE')}}');
            $('#edit-data').hide('fade');
            $('#save-data').show('fade');
            $('#my-modal').addClass('modal-blur').modal('show');
        })

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
                        url: '{{ route("destroyFaculty") }}',
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

        // Enable or disable record
        $('#example').on('click', '.state-btn', function () {
            let Id = $(this).data('id');
            let title = $(this).data('title');
            let status = $(this).data('status');
            let message = 'The status of: <span class="text-info"> ' + title +' </span> is currently:  <strong class="text-danger">' + status + '</strong> do you want to change it...?'
            // SweetAlert confirmation dialogShow 
            Swal.fire({
                title: 'Confirm Action',
                html: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3BAFDA',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Change!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route("bulk-status") }}',
                        type: 'POST',
                        data: { id: Id, table: 'users' },
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

        //RESSTING THE USER PASSWORD
        $('#example').on('click', '.reset_password-btn', function () {
            let id = $(this).data('id');
            let referer_id = $(this).data('referer-id');
            let title = $(this).data('title');

            let message = 'Are you sure you want to reset the password for : <span class="text-danger"> ' + title +'</span>'
            // Show SweetAlert confirmation dialog
            Swal.fire({
                title: 'Confirm Action',
                html: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3BAFDA',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, proceed!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route("user.resset-passord") }}',
                        type: 'POST',
                        data: { id: id, referer_id: referer_id },
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

        //RESSTING THE USER PASSWORD
        $('#example').on('click', '.reset_email-btn', function () {
            let id = $(this).data('id');
            let referer_id = $(this).data('referer-id');
            let title = $(this).data('title');

            let message = 'Are you sure you want to reset the email for: <span class="text-danger"> ' + title + '</span>';

            // First SweetAlert confirmation dialog
            Swal.fire({
                title: 'Confirm Action',
                html: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3BAFDA',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, proceed!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Second SweetAlert prompt with input field
                    Swal.fire({
                        title: 'Enter New Email',
                        html: '<input type="email" id="newEmail" class="swal2-input" placeholder="Enter new email">',
                        showCancelButton: true,
                        confirmButtonColor: '#3BAFDA',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Submit',
                        preConfirm: () => {
                            const newEmail = Swal.getPopup().querySelector('#newEmail').value;
                            if (!newEmail) {
                                Swal.showValidationMessage('Please enter a new email');
                            }
                            return newEmail;
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let newEmail = result.value;

                            $.ajax({
                                url: '{{ route("user.resset-email") }}',
                                type: 'POST',
                                data: { id: id, referer_id: referer_id, newmail: newEmail },
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
                                },
                                error: function(xhr, status, error) {
                                    if (xhr.responseJSON && xhr.responseJSON.status === 'error') {
                                        showSweetAlert('error', 'Error!', xhr.responseJSON.message);
                                    } else {
                                        showSweetAlert('error', 'Error!', 'Request Failed: ' + status + ', ' + error);
                                    }
                                }
                            });
                        }
                    });
                }
            });
        });



        //DATA TABLE SEETING UP
        dataTable = $("#example").DataTable(
        {
            ajax: {
                url: '{{ route("users-account") }}',
                type: 'GET',
                dataSrc: 'users',
                beforeSend: showLoader,
                complete: hideLoader,
            },
            
            columns: [
                {
                    data: null,
                    render: function (data, type, row) {
                        return '<input type="checkbox" class="select-checkbox" data-id="' + data.id + '" data-title="' + data.faculty + '"/>';
                    },
                },
                { data: 'username'},
                { data: 'role'},
                { data: 'name'},
                { data: 'email', class: 'w-100'},
                { data: 'status'},
                { data: 'created_at'},
                {
                    data: 'is_first_time',
                    render: function (data, type, row) {
                        return data == 1 ? 'Yes' : 'No';
                    }
                },
                {
                    data: 'default_password',
                    render: function (data, type, row) {
                        return data == 1 ? 'Yes' : 'No';
                    }
                },
                {
                    data: null,
                    class: 'text-end',
                    render: function(data, type, row) {
                        // Determine the text for the status button
                        let statusText = (data.status === 'Active') ? 'Disable User' : 'Enable User';
                        
                        return `
                            <div class="btn-group me-1">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle waves-effect" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical font-18"></i> More
                                    <i class="mdi mdi-chevron-down"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item reset_password-btn" href="javascript:void(0);" data-id="${data.id}" data-title="${data.name}" data-referer-id="${data.referer_id}">
                                        <i class="fa fa-lock fa-sm me-1" aria-hidden="true"></i>
                                        Reset Password
                                    </a>
                                    <a class="dropdown-item reset_email-btn" href="javascript:void(0);" data-id="${data.id}" data-title="${data.name}" data-referer-id="${data.referer_id}">
                                        <i class="fa fa-envelope fa-sm me-1" aria-hidden="true"></i>
                                        Reset Email Address
                                    </a>
                                    <a class="dropdown-item edit-btn" href="javascript:void(0);" data-id="${data.id}" data-title="${data.name}">
                                        <i class="fa fa-key fa-sm me-1" aria-hidden="true"></i>
                                        Enable Token
                                    </a>
                                    <a class="dropdown-item text-danger delete-btn" href="javascript:void(0);" data-id="${data.id}" data-title="${data.name}">
                                        <i class="fa fa-trash fa-sm me-1" aria-hidden="true"></i>
                                        Delete User
                                    </a>
                                    <a class="dropdown-item text-info delete-btn" href="javascript:void(0);" data-id="${data.id}" data-title="${data.name}">
                                        <i class="fa fa-envelope fa-sm me-1" aria-hidden="true"></i>
                                        Issue Email
                                    </a>
                                    <a class="dropdown-item state-btn" href="javascript:void(0);" data-id="${data.id}" data-title="${data.name}" data-status="${data.status}">
                                        <i class="fa fa-user fa-sm me-1" aria-hidden="true"></i>
                                        ${statusText}</a>
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
                let table='faculties'
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


