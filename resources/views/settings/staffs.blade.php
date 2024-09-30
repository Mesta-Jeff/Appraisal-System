<!-- resources/views/Staff/dashboard.blade.php -->

@extends('layout.main')

@section('title', 'Staff List')

@section('content')


<div class="container-fluid">

    <div class="row" style="margin-bottom: -15px;">
        <div class="col-12">
            <div class="page-title-box shadow-none" style="position: sticky; top: 0; background-color: transparent; z-index: 1000;">
                
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{ env('APP_ALIASE')}}</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
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
                    <div class="row col-md-12 col-sm-12">
                        <div class="col-lg-12 col-sm-12 d-flex gap-1 justify-content-start">
                            {{-- <h6 class="page-title">Current @yield('title')</h6> --}}
                            <button class="btn btn-sm btn-danger" type="button" id="bulk-remove" style="display: none" >Remove</button>
                        </div>
                        <div class="d-flex col-lg-12 col-sm-12 gap-1 justify-content-end">
                            <button type="button" id="btnref" class="btn btn-sm btn-secondary"><i class="mdi mdi-atom-variant spin"></i> Reload</button>
                            <button type="button" id="add-new-button" class="btn btn-sm btn-outline-info waves-effect waves-light">Add Single</button>
                            <button type="button" id="add-bulk-button" class="btn btn-sm btn-info waves-effect waves-light">Bulk Upload</button>
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
                                    <th>Staff ID</th>
                                    <th>Name</th>
                                    <th>DOB</th>
                                    <th>Gender</th>
                                    <th>Phone</th>                     
                                    <th>Department</th>
                                    <th>Role</th>
                                    <th>State</th>
                                    <th>Status</th>
                                    <th>Email</th>
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
                <h5 class="modal-title" id="modal-title">Modal title</h5>
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
                    <div class="d-flex gap-2">
                        <div class="mb-1">
                            <label for="username" class="form-label">Select Title</label>
                            <select class="form-control" id="title" name="title">
                                <option selected disabled>Choose...</option>
                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Miss">Miss</option>
                                <option value="Ms">Ms</option>
                                <option value="Dr">Dr</option>
                                <option value="Prof">Prof</option>
                                <option value="DDR">DDR</option>
                                <option value="Rev">Rev</option>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="_name" class="form-label">Staff Number</label>
                            <input type="text" id="staff_id" name="staff_id" class="form-control"  maxlength="15"/>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <div class="mb-1">
                            <label for="_name" class="form-label">Person's first name here </label>
                            <input type="text" id="first_name" name="first_name" class="form-control" />
                        </div>
                        <div class="mb-1">
                            <label for="_name" class="form-label">Person's middle name here </label>
                            <input type="text" id="middle_name" name="middle_name" class="form-control" />
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <div class="mb-1 col-md-12">
                            <label for="_name" class="form-label">Person's last name here </label>
                            <input type="text" id="last_name" name="last_name" class="form-control" />
                        </div>
                    </div>
                   
                    <div class="d-flex gap-2">
                        <div class="mb-1">
                            <label for="username" class="form-label">Gender</label>
                            <select class="form-control" id="gender" name="gender">
                                <option selected disabled>Choose...</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="_name" class="form-label">DOB</label>
                            <input type="date" id="dob" name="dob" class="form-control" />
                        </div>
                        <div class="mb-1">
                            <label for="_name" class="form-label">Phone</label>
                            <input type="text" id="phone" name="phone" class="form-control" maxlength="10" />
                        </div>
                    </div>
                    <div class="mb-1">
                        <label for="_mail" class="form-label">Email Address</label>
                        <input type="text" id="address" name="email" class="form-control" />
                    </div>
                    <div class="mb-1">
                        <label for="username" class="form-label">Select Department</label>
                        <select class="form-control dept" id="departments" name="department_id">
                            <option selected disabled>Choose...</option>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label for="username" class="form-label">Select Role</label>
                        <select class="form-control role" id="roles" name="role_id">
                            <option selected disabled>Choose...</option>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-text">Select employement type</label>
                        <select class="form-control" id="types" name="type">
                            <option selected disabled>Choose...</option>
                            <option value="Full-Time">Full Time</option>
                            <option value="Part-Time">Part Time</option>
                            <option value="Casual">Casual</option>
                            <option value="Contract">Contract</option>
                        </select>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" id="edit-data" class="btn btn-sm btn-info">Proceed</button>
                <button type="button" id="save-data" class="btn btn-sm btn-success">Proceed</button>
            </div>
        </div>
    </div>
</div>


<!-- Department Modal -->
<div class="modal hide fade" id="department-modal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <div class="text-center">
                    <a class="logo logo-light">
                        <span class="logo-lg">
                            <img src="{{ asset('root/images/logo-text-dark.png') }}" alt="" height="22">
                        </span>
                    </a>
                </div>
            </div>
            <div class="modal-body">
                <form class="px-3">
                    <div class="mb-1">
                        <select class="form-control dept" id="dept">
                            <option selected disabled>Choose...</option>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-text">Select employement type</label>
                        <select class="form-control"  id="type">
                            <option selected disabled>Choose...</option>
                            <option value="Full-Time">Full Time</option>
                            <option value="Part-Time">Part Time</option>
                            <option value="Casual">Casual</option>
                            <option value="Contract">Contract</option>
                        </select>
                    </div>
                    <div class="mb-1">
                        <select class="form-control role" id="role">
                            <option selected disabled>Choose...</option>
                        </select>
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn-call-modal">Proceed</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Bulk Modal --}}
<div class="modal hide fade" id="bulk-modal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-lg-8 col-sm-8 d-flex gap-2 justify-content-start">
                    <button type="button" id="btn-export" class="btn btn-secondary"><i class="mdi mdi-export"></i> Export Template</button>
                    <button type="button" id="btn-import" class="btn btn-secondary"><i class="mdi mdi-import"></i> Import Data</button>
                </div>
                <div class="text-center">
                    <a class="logo logo-light">
                        <span class="logo-lg">
                            <img src="{{ asset('root/images/logo-text-dark.png') }}" alt="" height="32">
                        </span>
                    </a>
                </div>
            </div>
            <div class="modal-body">
                <input type="file" id="fileInput" accept=".xlsx,.xls" style="display: none;" />
                <div class="row">
                    <div class="table-responsive pt-2">
                        <div id="loader" class="text-center loader-overlay" style="display: none;">
                            <div class="loader-content">
                                <i class="fas fa-spinner fa-spin fa-2x"></i>
                                <p>Loading...</p>
                            </div>
                        </div>
                        <table id="bulk-table" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr class="text-uppercase">
                                    <th>SN</th>
                                    <th>Title</th>
                                    <th>Firstname</th>
                                    <th>Middlename</th>
                                    <th>Lastname</th>                                 
                                    <th>DOB</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Staff Number</th>
                                    <th>Role</th>
                                    <th>Employement Type</th>
                                    <th>Department</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-sync" class="btn btn-success"><i class="mdi mdi-refresh"></i> Sync Data</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<script src="{{ asset('root/mint/assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('root/mint/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- SheetJS (js-xlsx) library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>


<script>

    // Function to show loader
    function showLoader() { $('#loader').show(); }
    function hideLoader() { $('#loader').hide(); }

    $(document).ready(function() {

        var dataTable = "";
        var selectedRoleText = "";
        var selectedRoleValue = "";
        var selectedTypeText = "";
        var selectedTypeValue = "";
        var selectedDepartmentText = "";
        var selectedDepartmentValue = "";      
        var table = "";



        // Triming the numeric values
        $('#phone').on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        const maxDate = new Date();
        maxDate.setFullYear(maxDate.getFullYear() - 25);
        const formattedDate = `${maxDate.getFullYear()}-12-31`;
        $('#dob').attr('max', formattedDate);

        
        //CALLING THE MODAL TO ADD NEW RECORD
        $('#add-new-button').click( function()
        {
            $('#descriptions').text(null);
            $('#modal-title').text('Adding New Record to ' + '{{ env('APP_ALIASE')}}');
            $('#edit-data').hide('fade');
            $('#my-modal').modal('show');
        })

        //GET Role
        $.ajax({
            url: '{{ route("fetch-roles") }}',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var roleSelect = $('.role');
                roleSelect.empty();
                roleSelect.append('<option value="" selected disabled>Choose designation...</option>');
                $.each(data.roles, function (key, value) {
                    roleSelect.append('<option value="' + value.id + '">' + value.role + '</option>');
                });
                roleSelect.select({ dropdownParent: roleSelect.parent() });
            },
            error: function (xhr, textStatus, errorThrown) {
                console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
            }
        });

        //GET DEPARTMENTS
        $.ajax({
            url: '{{ route("fetch-departments") }}',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var roleSelect = $('.dept');
                roleSelect.empty();
                roleSelect.append('<option value="" selected disabled>Choose department...</option>');
                $.each(data.departments, function (key, value) {
                    roleSelect.append('<option value="' + value.id + '">' + value.department + '</option>');
                });
                roleSelect.select({ dropdownParent: roleSelect.parent() });
            },
            error: function (xhr, textStatus, errorThrown) {
                console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
            }
        });


        // Calling the bulk upload modal, when the user select programme and level
        $('#btn-call-modal').on('click', function() {
            var roleValue = $('#role').val();
            var roleText = $("#role option:selected").text();
            selectedRoleText = roleText;
            selectedRoleValue = roleValue;

            var typeValue = $('#type').val();
            var typeText = $("#type option:selected").text();
            selectedTypeText = typeText;
            selectedTypeValue = typeValue;

            var deptValue = $('#dept').val();
            var deptText = $("#dept option:selected").text();
            selectedDepartmentText = deptText;
            selectedDepartmentValue = deptValue;

            if (roleValue && typeValue && deptValue) {
                $('#btn-sync').hide('fade');
                $('#bulk-modal').modal('show');
                $('#department-modal').modal('hide');
            } else {
                Swal.fire('Oops!', 'Please make sure Department, Role and Employement Type are not empty', 'error');
            }
        });


        // Calling  the bulk upload
        $('#add-bulk-button').click( function()
        {
            $('#btn-sync').hide('fade');
            $('#type').trigger('change');
            $('.modal-title').text('Assign The Uploads To A Department');
            $('#department-modal').modal('show');
        })

        //SENDING DATA TO THE API FOR SAVINGS
        $('#btn-export').click( function()
        {
            let message = 'Are you sure you want to <strong class="text-danger">Export this template </strong> or you click by mistake...?';
            Swal.fire({
                title: 'Confirm Action',
                html: message,
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3BAFDA',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, export!'
            }).then((result) => {
                if (result.isConfirmed) {
                    exportToExcel();
                }
                else { }
                
            });
        })

        // Function to export data to Excel
        function exportToExcel() {
            var table = document.getElementById('bulk-table');
            var exportColumns = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];

            // Create a new table in memory with just the header row and specified columns
            var newTable = document.createElement('table');
            var newThead = document.createElement('thead');
            var newTr = document.createElement('tr');

            // Extract the header row
            var thead = table.getElementsByTagName('thead')[0];
            var headerRow = thead.getElementsByTagName('tr')[0];
            var headers = headerRow.getElementsByTagName('th');

            // Loop through the specified columns and add them to the new header row
            for (var i = 0; i < exportColumns.length; i++) {
                var newTh = document.createElement('th');
                newTh.innerText = headers[exportColumns[i]].innerText;
                newTr.appendChild(newTh);
            }

            newThead.appendChild(newTr);
            newTable.appendChild(newThead);

            // Convert the new table to a worksheet
            var ws = XLSX.utils.table_to_sheet(newTable);
            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');
            XLSX.writeFile(wb, 'List of staff template.xlsx');
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
                        url: '{{ route("destroyStaff") }}',
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
                        data: { id: Id, table: 'lecturers' },
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


        // Attach a click event handler to the edit button
        $('#example').on('click', '.edit-btn', function () {
            // Get the data attributes
            let id = $(this).data('id');
            let StaffNumber = $(this).data('staff_id');
            let departmentId = $(this).data('department_id');
            let roleId = $(this).data('role_id');
            let firstName = $(this).data('first_name');
            let middleName = $(this).data('middle_name');
            let lastName = $(this).data('last_name');
            let gender = $(this).data('gender');
            let dob = $(this).data('dob');
            let phone = $(this).data('phone');
            let email = $(this).data('email');
            let types = $(this).data('types');
            let title = $(this).data('title');

            // Set the values in the input fields
            $('#gottenId').val(id);
            $('#staff_id').val(StaffNumber);
            $('#departments').val(departmentId).change();
            $('#roles').val(roleId).change();
            $('#first_name').val(firstName);
            $('#middle_name').val(middleName);
            $('#last_name').val(lastName);
            $('#gender').val(gender).change();
            $('#types').val(types).change();
            $('#dob').val(dob);
            $('#phone').val(phone);
            $('#address').val(email);
            $('#title').val(title).change();

            // Set the modal title
            $('#modal-title').text('Modifying - ' + StaffNumber);
            $('#save-data').hide('fade');
            $('#edit-data').show('fade');
            $('#my-modal').modal('show');
        });

        //DATA TABLE SEETING UP
        dataTable = $("#example").DataTable(
        {
            ajax: {
                url: '{{ route("staff") }}',
                type: 'GET',
                dataSrc: 'staffs',
                beforeSend: showLoader,
                complete: hideLoader,
            },
            columns: [
                {
                    data: null,
                    render: function (data, type, row) {
                        return '<input type="checkbox" class="select-checkbox" data-id="' + data.id + '" data-title="' + data.staff_id + '"/>';
                    },
                },
                { data: 'staff_id'},
                {
                    data: function(row) {
                        return row.first_name + ' ' + row.middle_name + ' ' + row.last_name;
                    }
                },
                { data: 'dob'},
                { data: 'gender'},
                { data: 'phone'},
                { data: 'department', class: 'w-100'},            
                { data: 'role'},
                { data: 'type'},
                { data: 'status'},
                { data: 'email', class: 'w-100'},
                {
                    data: null,
                    class: 'text-end',
                    render: function(data, type, row) {
                        // Determine the text for the status button
                        let statusText = (data.status === 'Active') ? 'Disable Staff' : 'Enable Staff';
                        
                        return `
                            <div class="btn-group me-1">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle waves-effect" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical font-18"></i> More
                                    <i class="mdi mdi-chevron-down"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item text-info edit-btn" href="javascript:void(0);" data-id="${data.id}" data-staff_id="${data.staff_id}" data-department_id="${data.department_id}" data-role_id="${data.role_id}" data-first_name="${data.first_name}" data-middle_name="${data.middle_name}" data-last_name="${data.last_name}" data-gender="${data.gender}" data-dob="${data.dob}" data-phone="${data.phone}" data-email="${data.email}" data-types="${data.type}" data-title="${data.title}">Edit Record</a>
                                    <a class="dropdown-item text-danger delete-btn" href="javascript:void(0);" data-id="${data.id}" data-title="${data.staff_id}">Remove Staff</a>
                                    <a class="dropdown-item state-btn" href="javascript:void(0);" data-id="${data.id}" data-title="${data.staff_id}" data-status="${data.status}">${statusText}</a>
                                </div>
                            </div>`;
                    }
                }

            ],
            drawCallback: function() {
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

        // Event listener for checkbox change
        $('#example tbody').on('change', '.select-checkbox', function () {
            var anyCheckboxChecked = $('.select-checkbox:checked').length > 0;
            $('#bulk-remove').toggle(anyCheckboxChecked);
        });

        // Event listener for button click
        $('#bulk-remove').on('click', function () {
            var checkedCheckboxes = $('.select-checkbox:checked');
            if (checkedCheckboxes.length > 0) {
                let table='lecturers'
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

        
        // importing the file
        $("#btn-import").on("click", function(e) {
            if (selectedRoleValue === "null" || selectedRoleValue === "") {
                Swal.fire('Oops!', 'Please make sure Department is not empty', 'error')
                    .then(function() {
                        $("#fileInput").val("");
                        $("#mymodal").modal("hide");
                        $("#btnInsert").hide();
                    });
                return;
            } else {
                let message = `Please make sure the <strong class="text-danger">DOD</strong> follows the format in the image below, it should be a format of <strong class="text-info">TEXT</strong> and also <strong class="text-info">YYYY-MM-DD</strong><br><br>
                       <img src="{{ asset('root/images/dob-template.png') }}" alt="Image" height="150">`;
                Swal.fire({
                    title: 'PAY ATTENTION',
                    html: message,
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3BAFDA',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok, Continue'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#fileInput").click();
                    }
                });
            }
        });

        // file uploader
        $("#fileInput").on("change", function(e) {
            var file = e.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                var data = new Uint8Array(e.target.result);
                var workbook = XLSX.read(data, { type: "array" });
                var worksheet = workbook.Sheets[workbook.SheetNames[0]];
                var jsonData = XLSX.utils.sheet_to_json(worksheet, { header: 1 });
                var tableBody = $("#bulk-table tbody");
                tableBody.empty();

                var headings = jsonData[0];
                for (var i = 1; i < jsonData.length; i++) {
                    var row = jsonData[i];
                    var tableRow = $("<tr></tr>");
                    for (var j = 0; j < row.length; j++) {
                        var cellData = row[j];
                        var tableCell = $("<td></td>").text(cellData);
                        tableRow.append(tableCell);
                    }
                    var levelCell = $("<td></td>").text(selectedRoleText);
                    var programmeCell = $("<td></td>").text(selectedTypeText);
                    var departmentCell = $("<td></td>").text(selectedDepartmentText);
                    tableRow.append(levelCell);
                    tableRow.append(programmeCell);
                    tableRow.append(departmentCell);
                    tableBody.append(tableRow);
                }

                // Initialize DataTable or refresh it if already initialized
                if ($.fn.DataTable.isDataTable('#bulk-table')) {
                    $('#bulk-table').DataTable().draw();
                } else {
                    $('#bulk-table').DataTable();
                }

                $("#btn-sync").show();
            };
            reader.readAsArrayBuffer(file);
        });

        $("#btn-sync").click(function (e) {
            e.preventDefault();
            let buttonElement = $(this);
            buttonElement.html('<i class="fa fa-spinner fa-spin"></i> Please wait... ').attr('disabled', true);

            var tableData = [];
            var table = $('#bulk-table').DataTable();

            // Check if DataTable instance is correctly initialized
            if (!table) {
                console.error('DataTable is not initialized.');
                return;
            }

            console.log('Table rows length:', table.rows().count());

            table.rows().every(function () {
                var data = this.data();
                console.log('Row data:', data);

                if (data) {
                    var rowData = {
                        title: data[1],
                        first_name: data[2],
                        middle_name: data[3],
                        last_name: data[4],
                        dob: data[5],
                        gender: data[6],
                        phone: data[7],
                        email: data[8],
                        staff_id: data[9],
                        role_id: selectedRoleValue,
                        type: selectedTypeValue,
                        department_id: selectedDepartmentValue,
                    };
                    tableData.push(rowData);
                }
            });

            console.log('Table data:', tableData);

            $.ajax({
                url: '{{ route("staff-bulk-add") }}',
                type: 'POST',
                data: JSON.stringify(tableData),
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    dataTable.ajax.reload();
                    $('#bulk-modal').modal('hide');
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


        //SENDING DATA TO THE API FOR SAVINGS
        $('#save-data').on('click', function () {
            // Check if form inputs are not null
            if (!validateForm()) {
                showSweetAlert('error', 'Error!', 'Please all fields are required and can\'t be blank....');
                return;
            }

            let formDataArray = $('#my-form').serializeArray();
            let groupedData = [];
            let currentStaff = {};

            formDataArray.forEach(function (item) {
                if (item.name === 'id' && Object.keys(currentStaff).length > 0) {
                    // Push the current Staff data to groupedData and reset currentStaff
                    groupedData.push(currentStaff);
                    currentStaff = {};
                }
                currentStaff[item.name] = item.value;
            });

            // Push the last Staff data
            if (Object.keys(currentStaff).length > 0) {
                groupedData.push(currentStaff);
            }

            let buttonElement = $(this);
            buttonElement.html('<i class="fa fa-spinner fa-spin"></i> Please wait... ').attr('disabled', true);

            $.ajax({
                url: '{{ route("staff-bulk-add") }}',
                type: 'POST',
                data: JSON.stringify(groupedData),
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
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

        //EDITING DATA TO THE API FOR EDTING
        $('#edit-data').on('click', function () {
            // Check if form inputs are not null
            if (!validateForm()) {
                showSweetAlert('error', 'Error!', 'Please all fields are rquired and cant\t be blank....');
                return;
            }

            let formData = $('#my-form').serialize();
            let buttonElement = $(this);
            buttonElement.html('<i class="fa fa-spinner fa-spin"></i> Please wait... ').attr('disabled', true);

            $.ajax({
                url: '{{ route("staff-editRecord") }}',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {

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
            let StaffNumber = $('#staff_id').val();
            let firstName = $('#first_name').val();
            let middleName = $('#middle_name').val();
            let lastName = $('#last_name').val();
            let gender = $('#gender').val();
            let dob = $('#dob').val();
            let phone = $('#phone').val();
            let email = $('#address').val();
            let programme = $('#departments').val();
            let level = $('#roles').val();

            return StaffNumber && firstName && lastName && gender && dob && phone && email && programme && level;
        }

        //TO REFRESH THE Page
        $('#btnref').click( function(){
            dataTable.ajax.reload();
            // window.location.reload();
        })

        // Function to show SweetAlert message
        function showSweetAlert(icon, title, text) {
            Swal.fire({ icon: icon, title: title, text: text, });
        }


    });
</script>
    
@endsection

