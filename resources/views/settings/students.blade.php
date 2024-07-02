<!-- resources/views/student/dashboard.blade.php -->

@extends('layout.main')

@section('title', 'Students List')

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
                        <div class="col-lg-5 col-sm-6 d-flex gap-2">
                            <h4 class="page-title">Current @yield('title')</h4>
                            <button class="btn btn-danger" type="button" id="bulk-remove" style="display: none" > Remove</button>
                        </div>
                        <div class="col-lg-7 col-sm-12 hstack gap-2 justify-content-end">
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
                            <button type="button" id="btnref" class="btn btn-secondary"><i class="mdi mdi-atom-variant spin"></i> Reload</button>
                            <button type="button" id="add-new-button" class="btn btn-outline-info waves-effect waves-light"><i class="mdi mdi-plus-circle me-1"></i> Add Single</button>
                            <button type="button" id="add-bulk-button" class="btn btn-info waves-effect waves-light"><i class="mdi mdi-plus-circle me-1"></i> Bulk Upload</button>
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
                                    <th>Role</th>
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
                
                <div class="row">
                    <div class="table-responsive pt-5">
                        <div id="loader" class="text-center loader-overlay" style="display: none;">
                            <div class="loader-content">
                                <i class="fas fa-spinner fa-spin fa-2x"></i>
                                <p>Loading...</p>
                            </div>
                        </div>
                        <table id="example1" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr class="text-uppercase">
                                    <th>#</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Middlename</th>
                                    <th>DOB</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Index Number</th>
                                    <th>Level</th>
                                    <th>Deparment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                {{-- <button type="button" id="edit-data" class="btn btn-info">Proceed</button>
                <button type="button" id="save-data" class="btn btn-success">Proceed</button> --}}
            </div>
        </div>
    </div>
</div>
    


<script src="{{ asset('root/mint/assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('root/mint/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- SheetJS (js-xlsx) library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>


<script>
    $(document).ready(function() {

        var dataTable = "";
        
        //CALLING THE MODAL TO ADD NEW RECORD
        $('#add-new-button').click( function()
        {
            $('#descriptions').text(null);
            $('#modal-title').text('ADDING NEW RECORD TO EAS');
            $('#edit-data').hide('fade');
            $('#my-modal').addClass('modal-blur').modal('show');
        })

        $('#add-bulk-button').click( function()
        {
            $('#bulk-modal').modal('show');
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
            var table = document.getElementById('example1');
            var ws = XLSX.utils.table_to_sheet(table);
            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');
            XLSX.writeFile(wb, 'exported_data.xlsx');
        }

        //DATA TABLE SEETING UP
        dataTable = $("#example, #example1").DataTable({
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

