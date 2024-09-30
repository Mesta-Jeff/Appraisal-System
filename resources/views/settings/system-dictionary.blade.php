<!-- resources/views/student/dashboard.blade.php -->

@extends('layout.main')

@section('title', 'System Configuration')

@section('content')




<div class="container-fluid">

    <div class="row" style="margin-bottom: -15px;">
        <div class="col-12">
            <div class="page-title-box shadow-none" style="position: sticky; top: 0; background-color: transparent; z-index: 1000;">
                
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">EAS</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
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
                            <h4 class="page-title">@yield('title')</h4>
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
                    <table id="example" class="table align-middle table-nowrap mb-0">
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
                            @for ($i = 1; $i <= 1; $i++)
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
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Modal title</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                <div class="text-center">
                    <a class="logo logo-light">
                        <span class="logo-lg">
                            <img src="{{ asset('root/images/logo-text-dark.png') }}" alt="" height="22">
                        </span>
                    </a>
                </div>
            </div>
            <div class="modal-body">
                
                
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
        // Swal.fire({
        //     title:"Good job!", text:"Message Here", icon:"success", confirmButtonColor:"#3bafda",
        // });

        $('#add-new-button').click( function()
        {
            $('#staticBackdrop').modal('show');
        })

        dataTable = $("#example").DataTable({
            lengthChange: false,
            responsive: true,
            buttons: ["copy", "csv", "excel", "pdf"].map(function(type) {
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

