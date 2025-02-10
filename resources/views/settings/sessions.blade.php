<!-- resources/views/student/dashboard.blade.php -->

@extends('layout.main')

@section('title', 'Academic Year')

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
                            <h4 class="page-title">List of @yield('title')s</h4>
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
                                    <th>Title</th>
                                    <th>Starting</th>
                                    <th>Ending</th>
                                    <th>Description</th>
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
                    <input type="hidden" id="gottenId" name="id">
                    
                    <div class="row">
                        <div class="mb-2 col-md-6">
                            <label for="faculty" class="form-label">Academic year begins </label>
                            <input type="date" id="sdate" name="begins" class="form-control" />
                        </div>
                        <div class="mb-2 col-md-6">
                            <label for="faculty" class="form-label">Academic year ends </label>
                            <input type="date" id="edate" name="ends" class="form-control"/>
                        </div>
                    </div>
                    <div class="mb-2">
                        <input type="text" id="sessions" name="name" class="form-control" readonly/>
                    </div>

                    <div class="form-floating mb-2">
                        <textarea class="form-control" placeholder="Description here..." id="description" name="description" style="height: 100px">
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

    /* function generateGUIDs() {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    } */

    $(document).ready(function() {

        var dataTable = "";
        var counter = 0;
        


        // Set minimum date for sdate to the current date
        var today = new Date().toISOString().split('T')[0];
        $('#sdate').attr('min', today);

        $('#sdate').change(function() {
            var sdate = $('#sdate').val();

            if (sdate) {
                var startDate = new Date(sdate);
                var endDate = new Date(startDate);
                endDate.setFullYear(endDate.getFullYear() + 1);
                $('#edate').val(endDate.toISOString().split('T')[0]);
                $('#edate').change();
            }
        });

        // Validating the academic year
        $('#sdate, #edate').change(function() {
            var sdate = $('#sdate').val();
            var edate = $('#edate').val();

            if (sdate && edate) {
                var startDate = new Date(sdate);
                var endDate = new Date(edate);
                var today = new Date();

                // Check if the start date is in the past
                if (startDate < today.setHours(0,0,0,0)) {
                    $('#sessions').val('');
                    Swal.fire({icon: 'error', title: 'Sorry Please', text: 'The start of the academic year cannot be in the past.'});
                    return;
                }

                // Check if the end date is earlier than the start date
                if (endDate < startDate) {
                    $('#sessions').val('');
                    $('#sdate, #edate').val('');
                    Swal.fire({icon: 'error', title: 'Attention Please', text: 'Academic year ending date cannot be earlier than starting date of the session.'});
                    return;
                }

                // Calculate the difference in months
                var yearDiff = endDate.getFullYear() - startDate.getFullYear();
                var monthDiff = endDate.getMonth() - startDate.getMonth() + (yearDiff * 12);

                // Check if the difference is between 9 months and 12 months (1 year)
                if (monthDiff >= 9 && monthDiff <= 28) {
                    var startYear = startDate.getFullYear();
                    var endYear = endDate.getFullYear();
                    $('#sessions').val(startYear + '/' + endYear + ' Academic Year');
                } else {
                    $('#sessions').val(''); 
                    $('#sdate, #edate').val('');
                    Swal.fire({icon: 'error', title: 'Attention Please', text: 'The date difference for the academic year must be between 9 months and 2 years.'});
                }
            }
        });

        //CALLING THE MODAL TO ADD NEW RECORD
        $('#add-new-button').click( function()
        {
            $('#description').text(null);
            $('#modal-title').text('Creating New Academic Year to ' + '{{ env('APP_ALIASE')}}');
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
                url: '{{ route('addSession') }}',
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
            buttonElement.html('<i class="fa fa-spinner fa-spin mx-1"></i> Please wait... ').attr('disabled', true);

            $.ajax({
                url: '{{ route('updateSession') }}',
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
            let sdate= $('#sdate').val();
            let edate= $('#edate').val();
            let sessions= $('#sessions').val();
            let descriptions = $('#description').val();

            return sessions && edate && sdate && descriptions;
        }

        // Function to show SweetAlert message
        function showSweetAlert(icon, title, text) {
            Swal.fire({ icon: icon, title: title, text: text, });
        }

        // Attach a click event handler to the edit button
        $('#example').on('click', '.semester-btn', function () {
            // Get the data attributes
            let id = $(this).data('id');
            let session_name = $(this).data('session_name');
            let session_start = $(this).data('session_start');
            let session_end = $(this).data('session_end');

            var data = { id: id, title: session_name, start: session_start, end: session_end };

            // Encode the data as a Base64 string
            var encodedData = btoa(JSON.stringify(data));
            var routeUrl = `{{ route('session-semester') }}?id=${encodedData}`;
            window.location.href = routeUrl;
        });


        // Attach a click event handler to the edit button
        $('#example').on('click', '.edit-btn', function () {
            // Get the data attributes
            let id = $(this).data('id');
            let session_name = $(this).data('session_name');
            let session_start = $(this).data('session_start');
            let session_end = $(this).data('session_end');
            let description = $(this).data('description');

            // Set the values in the input fields
            $('#gottenId').val(id);
            $('#sessions').val(session_name); 
            $('#sdate').val(session_start); 
            $('#edate').val(session_end); 
            $('#description').text(description);
            
            $('#modal-title').text('Modifying - ' + session_name);
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
                        url: '{{ route("destroySession") }}',
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
                url: '{{ route('sessions') }}',
                type: 'GET',
                dataSrc: 'sessions',
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
                { data: 'name'},
                { data: 'begins'},
                { data: 'ends'},
                { data: 'description', class: 'w-100'},
                { data: 'status'},
                {
                    data: null, class: 'text-end',
                    render: function(data, type, row) {
                        let mountSessionItem  = '';
                        let mountBtnItem = '';
                        
                        let now = new Date();
                        // Check if the session has begun
                        if (data.status !== '' && data.status==='Mounted') {
                            mountSessionItem = `<a class="dropdown-item text-danger umount-btn" href="javascript:void(0);" data-id="${data.id}" data-title="${data.name}">Unmount</a>`;
                        }

                        // Check if the session is InActive and begins within the next 3 months

                        if (data.begins !== '' && data.status==='InActive') {

                            const beginsDate = new Date(data.begins);
                            const threeMonthsFromNow = new Date(now.getTime() + 3 * 30 * 24 * 60 * 60 * 1000);
                            if (beginsDate <= threeMonthsFromNow) {
                                mountBtnItem = `<a class="dropdown-item text-success mount-btn" href="javascript:void(0);" data-id="${data.id}" data-title="${data.name}">Mount</a>`;
                            }
                        }

                        return `
                            <div class="btn-group me-1">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle waves-effect" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical font-18"></i> More
                                    <i class="mdi mdi-chevron-down"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item text-info edit-btn" href="javascript:void(0);" data-id="${data.id}" data-description="${data.description}" data-session_name="${data.name}" data-session_start="${data.begins}" data-session_end="${data.ends}">Modify</a>
                                    <a class="dropdown-item text-danger delete-btn" href="javascript:void(0);" data-id="${data.id}" data-title="${data.name}">Remove</a>
                                    ${mountSessionItem }
                                     ${mountBtnItem}
                                    <a class="dropdown-item semester-btn" href="javascript:void(0);" data-id="${data.id}" data-description="${data.description}" data-session_name="${data.name}" data-session_start="${data.begins}" data-session_end="${data.ends}">View Semesters</a>
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
                let table='sessions'
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


