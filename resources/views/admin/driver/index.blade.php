@extends('admin.layouts.base')

@section('content')
    @include('admin.layouts.components.header', [
        'title' => __('messages.list', [
            'name' => trans_choice('content.driver', 2),
        ]),
        'create_btn' => [
            'status' => true,
            'route' => route('admin.drivers.create'),
            'name' => __('messages.create', [
                'name' => trans_choice('content.driver', 1),
            ]),
        ],
    ])
        
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <!--begin::Card-->
            <div class="card">
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    @include('admin.driver.driver_table')
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
   
    @include('admin.user.filter_drawer')
    
@endsection