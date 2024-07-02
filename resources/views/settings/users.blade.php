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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">NES</a></li>
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
                    <div class="row">
                        <div class="col-lg-5 col-sm-6">
                            <h4 class="page-title">List of @yield('title')</h4>
                        </div>
                        <div class="col-lg-7 col-sm-6">
                            <div class="d-flex gap-2 justify-content-lg-end mt-3 mt-lg-0">
                                <div class="dropdown" >
                                    <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" data-bs-auto-close="outside" aria-expanded="false">
                                        Bulk Actions <i class="mdi mdi-chevron-down"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-md p-4" style="width: 20vw; max-width: none;">
                                        <form>
                                            <div class="mb-3">
                                                <label class="form-label" for="exampleDropdownFormEmail">Bulk action on</label>
                                                <select id="bulk-action" class="select2 form-control" data-toggle="select2">
                                                    <option selected disabled>Choose...</option>
                                                    <option value="store">Store</option>
                                                    <option value="status">Status</option>
                                                    <option value="date-added">Date Added</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <div class="form-check custom-checkbox">
                                                    <input type="checkbox" class="form-check-input" id="rememberdropdownCheck">
                                                    <label class="form-check-label" for="rememberdropdownCheck">Is Featured</label>
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <a class="btn btn-danger btn-sm" href="#">Delete Selected</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                
                                <button class="btn btn-danger" type="button" id="bulk-remove" style="display: none" > Remove</button>
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
    <div class="modal-dialog modal-dialog-centered modal-lg">
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
                        <select class="select2 form-control" data-toggle="select2">
                            <option selected disabled>Choose...</option>
                            <option value="Administrator">Administrator</option>
                            <option value="Dean">Dean</option>
                            <option value="Developer">Developer</option>
                            <option value="Head QA">Head Quality Assurance</option>
                            <option value="HOD">HOD</option>
                            <option value="Lecturer">Lecturer</option>
                            <option value="Staff QA">Staff Quality Assurance</option>
                            <option value="Student">Student</option>
                            <option value="User">User</option>
                            <option value="Vice Dean">Vice Dean</option>
                        </select>
                    </div>

                    <div class="form-floating mb-2">
                        <textarea class="form-control" placeholder="Leave a comment here" id="descriptions" style="height: 100px">
                        </textarea>
                        <label for="descriptions">Description about the role</label>
                    </div>

                    <div class="row mb-3">
                        <div class="col-3 form-check">
                            <input type="radio" class="form-check-input" id="privateRadio" name="accessType" value="private">
                            <label class="form-check-label" for="privateRadio">Set Private</label>
                        </div>
                        <div class="col-3 form-check">
                            <input type="radio" class="form-check-input" id="publicRadio" name="accessType" value="public">
                            <label class="form-check-label" for="publicRadio">Allow Public</label>
                        </div>
                        <div class="col-6 form-check">
                            <input type="radio" class="form-check-input" id="specifyRadio" name="accessType" value="specify" checked>
                            <label class="form-check-label" for="specifyRadio">Specify Only </label><small class="text-muted mx-1">(Recommended)</small>
                        </div>
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

