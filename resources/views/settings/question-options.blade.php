<!-- resources/views/student/dashboard.blade.php -->

@extends('layout.main')

@section('title', 'Question & Options')

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
                                <button type="button" id="add-new-button" class="btn btn-outline-success waves-effect waves-light"><i class="mdi mdi-plus-circle me-1"></i> Add New</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>

        <div class="col-12">
            <div class="mb-3" id="accessors-1">
                <label for="types" class="form-label">Select Question you want and view all the options or assign new to it</label>
                <select id="question_id" name="question_id" class="select2 form-control" data-toggle="select2">
                    <option selected disabled>Choose...</option>
                </select>
            </div>
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
                                    <th>Question</th>
                                    <th>Option</th>
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
                    <div class="mb-1" id="accessors-1">
                        <label for="types" class="form-label">Assign Option to this question</label>
                        <select id="option_id" name="option_id" class="select2 form-control" data-toggle="select2">
                            <option selected disabled>Choose...</option>
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

        //GET OPTIONS
        $.ajax({
            url: '{{ route("fetch-options") }}',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var roleSelect = $('#option_id');
                roleSelect.empty();
                roleSelect.append('<option value="" selected disabled>Choose...</option>');
                $.each(data.options, function (key, value) {
                    roleSelect.append('<option value="' + value.id + '">' + value.option_text + '</option>');
                });
                roleSelect.select2({ dropdownParent: roleSelect.parent() });
            },
            error: function (xhr, textStatus, errorThrown) {
                console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
            }
        }); 

        //GET QUESTIONS
        $.ajax({
            url: '{{ route("fetch-questions") }}',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var roleSelect = $('#question_id');
                roleSelect.empty();
                roleSelect.append('<option value="" selected disabled>Choose...</option>');
                $.each(data.questions, function (key, value) {
                    roleSelect.append('<option value="' + value.id + '">' + value.question_text + '</option>');
                });
                roleSelect.select2({ dropdownParent: roleSelect.parent() });
            },
            error: function (xhr, textStatus, errorThrown) {
                console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
            }
        }); 


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
            $('#option_text').val('');
            dataTable.ajax.reload();
        }

        //CALLING THE MODAL TO ADD NEW RECORD
        $('#add-new-button').click( function()
        {
            // resetting();
            $('#modal-title').text('Creating Option to ' + '{{ env('APP_ALIASE')}}');
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

            let option_id = $('#option_id').val();
            let question_id = $('#question_id').val();
            
            let buttonElement = $(this);
            buttonElement.html('<i class="fa fa-spinner fa-spin"></i> Please wait...').attr('disabled', true);

            $.ajax({
                url: '{{ route("addQuestionOption") }}',
                type: 'POST',
                data: {option_id: option_id, question_id: question_id},
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

            let option_id = $('#option_id').val();
            let question_id = $('#question_id').val();
            let gottenId = $('#gottenId').val();
            
            let buttonElement = $(this);
            buttonElement.html('<i class="fa fa-spinner fa-spin"></i> Please wait...').attr('disabled', true);

            $.ajax({
                url: '{{ route("updateQuestionOption") }}',
                type: 'POST',
                data: {option_id:option_id, question_id:question_id, id:gottenId},
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
            let option_id = $('#option_id').val();
            let question_id = $('#question_id').val();
            return option_id && question_id;
        }

        // Function to show SweetAlert message
        function showSweetAlert(icon, title, text) {
            Swal.fire({ icon: icon, title: title, text: text, });
        }

        // Attach a click event handler to the edit button
        $('#example').on('click', '.edit-btn', function () {
            // Get the data attributes
            let Id = $(this).data('id');
            let title = $(this).data('option_text');

            // Set the values in the input fields
            $('#gottenId').val(Id);
            $('#option_text').val(title);
            
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
                        url: '{{ route("destroyQuestionOption") }}',
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


        // Event listener for the select element
        $('#question_id').on('change', function() {
            var questionId = $(this).val();
            initializeDataTable(questionId);
        });

        // Function to initialize DataTable
        function initializeDataTable(questionId) {
            // Destroy any existing DataTable instance
            if ($.fn.DataTable.isDataTable('#example')) {
                $('#example').DataTable().destroy();
            }

            // Initialize DataTable
            dataTable = $("#example").DataTable({
                ajax: {
                    url: '{{ route("question.option") }}',
                    type: 'GET',
                    data: function(d) {
                        d.question_id = questionId;
                    },
                    dataSrc: 'QuestionOptions',
                    beforeSend: function() {
                        showLoader();
                    },
                    complete: function() {
                        hideLoader();
                    }
                },
                columns: [
                    
                    {
                        data: 'question_text', class: 'w-100',
                        render: function(data, type, row) {
                            return truncateText(data, 100);
                        }
                    },
                    { data: 'option_text' },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<button class="btn btn-primary btn-sm edit-btn mx-2" data-id="' + data.id + '" data-option_text="' + data.option_text + '"><i class="fas fa-edit mx-1"></i>Edit</button>' +
                                '<button class="btn btn-danger btn-sm delete-btn" data-id="' + data.id + '" data-title="' + data.option_text + '"><i class="fas fa-trash mx-1"></i>Remove</button>';
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
                initComplete: function(settings, json) {
                    dataTable.buttons().container().appendTo("#example_wrapper .col-md-6:eq(0)");
                }
            });
        }

        //TO REFRESH THE Page
        $('#btnref').click( function(){
            dataTable.ajax.reload();
            // window.location.reload();
        })


    });
</script>
    
@endsection


