@extends('admin.layouts.base')
@section('content')
    @include('admin.layouts.components.header', [
        'title' => __('messages.edit', ['name' => trans_choice('content.driver', 1)]),
    ])
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">

        <!--begin::Container-->
        <div id="kt_content_container" class="container">

            <div class="container p-0">
                <div class="row mb-5">

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="card shadow">

                            <div class="card-body">

                                <div class="text-center">
                                    <h2 class="card-title"><i class="fa-sharp fa-solid fa-cart-shopping"
                                            style="color:black;font-size:30px;"></i></h2>
                                    <span style="color:black;font-size:30px;">{{$driver_list}}</span>
                                    <p style="color:black;font-size:15px;">Total Order</p>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="card shadow">

                            <div class="card-body">

                                <div class="text-center">
                                    <h2 class="card-title"><i class="fa fa-wallet" style="color:black;font-size:30px;"></i>
                                    </h2>
                                    <span style="color:black;font-size:30px;">0</span>
                                    <p style="color:black;font-size:15px;">Remaining Payment</p>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>


            <!--begin::Careers - Apply-->
            <div class="card">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Layout-->
                    <div class="d-flex flex-column flex-lg-row mb-17">
                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid me-0 me-lg-20">

                            <!--begin::Form-->
                            {!! Form::model($driver, [
                                'method' => 'PATCH',
                                'route' => ['admin.drivers.update', $driver->driver_id],
                                'class' => 'form mb-15',
                                'enctype' => 'multipart/form-data',
                            ]) !!}
                            @csrf
                            <input type="hidden" name="id" value="{{ $driver->driver_id }}">

                            @include('admin.driver.editform')

                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <a href="{{ route('admin.drivers.index') }}"
                                    class="btn btn-light btn-active-light-primary me-2 text-black">{{ __('content.back_title') }}</a>
                                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save
                                    Changes</button>
                            </div>
                            <!--end::Actions-->
                            {!! Form::close() !!}
                            <!--end::Form-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Layout-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Careers - Apply-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection
