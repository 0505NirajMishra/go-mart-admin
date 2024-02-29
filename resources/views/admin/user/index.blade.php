@extends('admin.layouts.base')

@section('content')
    @include('admin.layouts.components.header', [
        'title' => __('messages.list', ['name' => trans_choice('content.user', 2)]),
    ])

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <!--begin::Card-->
            <div class="card" style="border-radius:10px;">
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    @include('admin.user.usertable')
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