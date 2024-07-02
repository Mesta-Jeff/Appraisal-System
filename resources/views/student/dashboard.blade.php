<!-- resources/views/student/dashboard.blade.php -->

@extends('layout.main')

@section('title', 'Student Dashboard')

@section('content')
    

<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box page-title-box-alt">
                <h4 class="page-title">@yield('title')</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">EAS</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ol>
                </div>
            </div>
        </div>
    </div> 

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="knob-chart" dir="ltr">
                            <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#1abc9c"
                                data-bgColor="#d1f2eb" value="58"
                                data-skin="tron" data-angleOffset="0" data-readOnly=true
                                data-thickness=".15"/>
                        </div>
                        <div class="text-end">
                            <h3 class="mb-1 mt-0"> <span data-plugin="counterup">268</span> </h3>
                            <p class="text-muted mb-0">New Customers</p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="knob-chart" dir="ltr">
                            <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#3bafda"
                                data-bgColor="#d8eff8" value="80"
                                data-skin="tron" data-angleOffset="0" data-readOnly=true
                                data-thickness=".15"/>
                        </div>
                        <div class="text-end">
                            <h3 class="mb-1 mt-0"> <span data-plugin="counterup">8574</span> </h3>
                            <p class="text-muted mb-0">Online Orders</p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="knob-chart" dir="ltr">
                            <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#f672a7"
                                data-bgColor="#fde3ed" value="77"
                                data-skin="tron" data-angleOffset="0" data-readOnly=true
                                data-thickness=".15"/>
                        </div>
                        <div class="text-end">
                            <h3 class="mb-1 mt-0"> $<span data-plugin="counterup">958.25</span> </h3>
                            <p class="text-muted mb-0">Revenue</p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="knob-chart" dir="ltr">
                            <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#3bafda"
                                data-bgColor="#d8eff8" value="80"
                                data-skin="tron" data-angleOffset="0" data-readOnly=true
                                data-thickness=".15"/>
                        </div>
                        <div class="text-end">
                            <h3 class="mb-1 mt-0"> <span data-plugin="counterup">8574</span> </h3>
                            <p class="text-muted mb-0">Online Orders</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- end row -->

 
</div> 


@endsection
