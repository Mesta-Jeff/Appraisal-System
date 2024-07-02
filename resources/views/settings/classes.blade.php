<!-- resources/views/student/dashboard.blade.php -->

@extends('layout.main')

@section('title', 'Classes')

@section('content')




<div class="container-fluid">

    <div class="row" style="margin-bottom: -15px;">
        <div class="col-12">
            <div class="page-title-box shadow-none" style="position: sticky; top: 0; background-color: transparent; z-index: 1000;">
                
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">NES</a></li>
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
                                    <th>#</th>
                                    <th>Department</th>
                                    <th>Class</th>
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
                    <div class="mb-1">
                        <label for="types" class="form-label">Related Department</label>
                        <select id="department" name="department" class="select2 form-control" data-toggle="select2">
                            <option selected disabled>Choose...</option>
                        </select>
                    </div>

                    <div class="mb-0" id="div-class">
                        <label for="classes" class="form-label">Available Classes</label>
                        <select id="classes" name="classes" class="select2 form-control" data-toggle="select2">
                            <option selected disabled>Choose...</option>
                            @for ($level = 100; $level <= 900; $level += 100)
                                <optgroup label="Level {{ $level }}">
                                    @for ($subgroup = 1; $subgroup <= 10; $subgroup++)
                                        <option value="{{ $level }} Group {{ $subgroup }}">{{ $level }} Group {{ $subgroup }}</option>
                                    @endfor
                                </optgroup>
                            @endfor
                        </select>
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

        //GET DEPARTMENTS FROM DB AND FILL ROLE
        $.ajax({
            url: '{{ route("fetch-departments") }}',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var roleSelect = $('#department');
                roleSelect.empty();
                roleSelect.append('<option value="" selected disabled>Choose...</option>');
                $.each(data.departments, function (key, value) {
                    roleSelect.append('<option value="' + value.id + '">' + value.department + '</option>');
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
            $('#modal-title').text('ADDING NEW RECORD TO EAS');
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

            let formData = $('#my-form').serialize();
            let buttonElement = $(this);
            buttonElement.html('<i class="fa fa-spinner fa-spin"></i> Please wait... ').attr('disabled', true);

            $.ajax({
                url: '{{ route('addClass') }}',
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

        //SENDING DATA TO THE API FOR EDTING
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
                url: '{{ route('updateClass') }}',
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
            let classes = $('#classes').val();
            let dept = $('#department').val();
            return dept && classes;
        }

        // Function to show SweetAlert message
        function showSweetAlert(icon, title, text) {
            Swal.fire({ icon: icon, title: title, text: text, });
        }

        // Attach a click event handler to the edit button
        $('#example').on('click', '.edit-btn', function () {
            // Get the data attributes
            let Id = $(this).data('id');
            let title = $(this).data('classes');
            let department = $(this).data('department');

            // Set the values in the input fields
            $('#gottenId').val(Id);
            $('#department').val(department).trigger('change'); 
            $('#classes').val(title).trigger('change');
            
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
                        url: '{{ route("destroyClass") }}',
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

        //DATA TABLE SEETING UP
        dataTable = $("#example").DataTable(
        {
            ajax: {
                url: '{{ route('classes') }}',
                type: 'GET',
                dataSrc: 'classes',
                beforeSend: showLoader,
                complete: hideLoader,
            },
            columns: [
                {
                    data: null,
                    render: function (data, type, row) {
                        return '<input type="checkbox" class="select-checkbox" data-id="' + data.id + '" data-title="' + data.name + '"/>';
                    },
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return ++counter;
                    }
                },
                { data: 'department'},
                { data: 'name'},
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<button class="btn btn-primary btn-sm edit-btn mx-2" data-id="' + data.id + '" data-department="' + data.department_id + '" data-classes="' + data.name + '"><i class="fas fa-edit mx-1"></i>Edit</button>' +
                        '<button class="btn btn-danger btn-sm delete-btn" data-id="' + data.id + '" data-title="' + data.name + '"><i class="fas fa-trash mx-1"></i>Remove</button>';
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
                let table='classes'
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


