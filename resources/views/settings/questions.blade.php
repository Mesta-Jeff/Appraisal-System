<!-- resources/views/student/dashboard.blade.php -->

@extends('layout.main')

@section('title', 'Questions')

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
                        <div class="col-lg-8 col-sm-6">
                            <h4 class="page-title">Current @yield('title')</h4>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="d-flex gap-2 justify-content-lg-end mt-3 mt-lg-0">
                                <button type="button" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-cog"></i></button>
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
                    
                   <table id="example" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Colomn 1</th>
                                <th>Colomn 2</th>
                                <th>Colomn 3</th>
                                <th>Colomn 4</th>
                                <th>Colomn 5</th>
                                <th>Colomn 6</th>
                                <th>Colomn 7</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i <= 15; $i++)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>Name {{ $i }}</td>
                                    <td>Init {{ $i }}</td>
                                    <td>Type {{ $i }}</td>
                                    <td>Location {{ $i }}</td>
                                    <td>Email {{ $i }}@example.com</td>
                                    <td>Phone {{ $i }}</td>
                                    <td>Status {{ $i }}</td>
                                    <td>Action </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
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
                
                <form class="px-3">
                    <div class="mb-2">
                        <label for="username" class="form-label">Available Roles </label>
                        <input type="text" class="form-control" placeholder="Enter faculty title" />
                    </div>

                    <div class="form-floating mb-2">
                        <textarea class="form-control" id="descriptions" style="height: 100px">
                        </textarea>
                        <label for="descriptions">Leave a comment here</label>
                    </div>

                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" id="edit-data" class="btn btn-info">Proceed</button>
                <button type="button" id="save-data" class="btn btn-success">Proceed</button>
            </div>
        </div>
    </div>
</div>
    


<script src="{{ asset('root/mint/assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('root/mint/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>


<script>
    $(document).ready(function() {

        var dataTable = "";
        
        //INITIALIZING THE SELECT STYLE
        $('.select2').each(function() { 
            $(this).select2({ dropdownParent: $(this).parent()});
            $(this).val($(this).find('option:first').val()).trigger('change');
        })

        //CALLING THE MODAL TO ADD NEW RECORD
        $('#add-new-button').click( function()
        {
            $('#descriptions').text(null);
            $('#modal-title').text('ADDING NEW RECORD TO EAS');
            $('#edit-data').hide('fade');
            $('#my-modal').modal('show');
            // $(".select2").select2({dropdownParent: $("#my-modal")});
        })

        //SENDING DATA TO THE API FOR SAVINGS
        $('#save-data').click( function()
        {
            Swal.fire({
                title:"Good job!", text:"Message Here", icon:"success", confirmButtonColor:"#3bafda",
            });
        })


        //DATA TABLE SEETING UP
        dataTable = $("#example").DataTable({
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
            drawCallback: function() {
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
            }
        });
        
        dataTable.buttons().container().appendTo("#example_wrapper .col-md-6:eq(0)");

    });
</script>
    
@endsection


