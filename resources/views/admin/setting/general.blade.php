@extends('admin.layouts.base')

@section('title')
    <title>{{ __('header.setting.edit_setting') }}</title>
@endsection

@section('content')
    @include('admin.layouts.components.header',[
    'title'=> __('header.setting.edit_setting'),
    'breadcrumbs'=> Breadcrumbs::render('admin.settings.edit_general')
    ])

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container">
            <!--begin::Careers - Apply-->
            <div class="card">
                <!--begin::Body-->
                <div class="card-body p-lg-17">
                    <!--begin::Hero-->
                    <div class="position-relative mb-17">
                        <!--begin::Overlay-->
                        <div class="overlay overlay-show">
                            <!--begin::Title-->
                            <h3 class="fs-2qx fw-bolder mb-3 m">{{ __('header.setting.edit_setting') }}</h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Overlay-->
                    </div>
                    <!--end::-->
                    <!--begin::Layout-->
                    <div class="d-flex flex-column flex-lg-row mb-17">
                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid me-0 me-lg-20">
                            <!--begin::Form-->
                            {!! Form::open(['route' => 'admin.settings.update_general', 'method' => 'POST', 'class' => 'form mb-15', 'enctype' => 'multipart/form-data']) !!}
                            @csrf

                            <!--begin::Input group-->
                            <div class="row mb-5">
                               
                                <!-- <div class="col-md-4 mb-5 fv-row">
                                    
                                    <label
                                        class="required fs-5 fw-bold mb-2">{{ trans_choice('content.setting.site_name_title', 1) }}</label>
                                    
                                    {!! Form::text('data[site_name]', isset($settings['site_name']) ? $settings['site_name'] : null, ['placeholder' => __('placeholder.site_name'), 'class' => 'form-control form-control-solid']) !!}
                                    
                                    @if ($errors->has('data.tax'))
                                        <span style="color:red">{{ $errors->first('data.tax') }}</span>
                                    @endif
                                </div> -->
                                <!--end::Col-->
                    <div class="row">
                                <!--begin::Col-->
                                <!-- <div class="col-6">
                                  
                                    <label
                                        class="required fs-5 fw-bold mb-2">{{ trans_choice('content.setting.server_key_title', 1) }}</label>
                                  
                                    {!! Form::text('data[agora_server_key]', isset($settings['agora_server_key']) ? $settings['agora_server_key'] : null, ['placeholder' => __('agora_server_key'), 'class' => 'form-control form-control-solid']) !!}
                                    
                                    @if ($errors->has('data.agora_server_key'))
                                        <span style="color:red">{{ $errors->first('data.agora_server_key') }}</span>
                                    @endif
                                </div> -->
                                <!--end::Col-->

                    </div>


                    <div class="row" style="margin-top:2rem">
                               
                    <div class="col-4" style="display: block">
                                    <!--begin::Label-->
                                    <label
                                        class="required fs-5 fw-bold mb-2">{{ trans_choice('content.setting.near_title', 1) }}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    {!! Form::text('data[near_adventure]', isset($settings['near_adventure']) ? $settings['near_adventure'] : null, ['placeholder' => __('placeholder.near_title'), 'class' => 'form-control form-control-solid']) !!}
                                    <!-- <input type="text" class="form-control form-control-solid" placeholder="AAAAk0BXOJU:APA91bF4gDE7JUV-SWpzk3Mg0YNylsFZQtqUrVlWhvg1PXDABnzRlVyfPoQYDuVqL2-xnj7iUgxPard_arh_ikAfoiSTWKBOAoTj84cnWYrau7ccviKf2bmOiq516eclGshBjm9Pbq5T"> -->
                                    <!--end::Input-->
                                    @if ($errors->has('data.near_adventure'))
                                        <span style="color:red">{{ $errors->first('data.near_adventure') }}</span>
                                    @endif
                                </div>
                    
                    <!--begin::Col-->
                                <div class="col-4">
                                  
                                    <label
                                        class="required fs-5 fw-bold mb-2">{{ trans_choice('content.setting.trip_title', 1) }}</label>
                                  
                                    {!! Form::text('data[trip_radius]', isset($settings['trip_radius']) ? $settings['trip_radius'] : null, ['placeholder' => __('trip_title'), 'class' => 'form-control form-control-solid']) !!}
                                    
                                    @if ($errors->has('data.trip_radius'))
                                        <span style="color:red">{{ $errors->first('data.trip_radius') }}</span>
                                    @endif
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                            

                            


                                <!--end::Col-->
                    </div>

              



                                
                                {{-- <!--begin::Col-->
                                <div class="col-md-6 mb-5 fv-row">
                                    <!--begin::Label-->
                                    <label
                                        class="required fs-5 fw-bold mb-2">{{ trans_choice('content.setting.phone_title', 1) }}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    {!! Form::text('data[contact_number]', isset($settings['contact_number']) ? $settings['contact_number'] : null, ['placeholder' => __('placeholder.company_contact_number'), 'class' => 'form-control form-control-solid']) !!}
                                    <!--end::Input-->
                                    @if ($errors->has('data.contact_number'))
                                        <span style="color:red">{{ $errors->first('data.contact_number') }}</span>
                                    @endif
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-md-12 mb-5 fv-row">
                                    <!--begin::Label-->
                                    <label
                                        class="required fs-5 fw-bold mb-2">{{ trans_choice('content.setting.address_title', 1) }}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    {!! Form::textarea('data[address]', isset($settings['address']) ? $settings['address'] : null, ['placeholder' => __('placeholder.company_address'), 'class' => 'form-control form-control-solid', 'rows' => 5, 'cols' => 15]) !!}
                                    <!--end::Input-->
                                    @if ($errors->has('data.address'))
                                        <span style="color:red">{{ $errors->first('data.address') }}</span>
                                    @endif
                                </div>
                                <!--end::Col--> --}}

                                <!--begin::Separator-->
                                <!-- <div class="separator mb-8"></div> -->
                                <!--end::Separator-->

                                @php
                                    $logo_name = isset($settings['logo']) ? $settings['logo'] : null;
                                    if ($logo_name) {
                                        $logo_img = asset('files/settings/' . $settings['logo'] . '');
                                    } else {
                                        $logo_img = 'image-not-found.png';
                                    }
                                    $favicon_name = isset($settings['favicon']) ? $settings['favicon'] : null;
                                    if ($favicon_name) {
                                        $favicon_img = asset('files/settings/' . $settings['favicon'] . '');
                                    } else {
                                        $favicon_img = 'blank.png';
                                    }
                                @endphp

                                <!--begin::Col-->
                                <!-- <div class="col-md-6 mb-5 fv-row">
                                  
                                    <label
                                        class="required fs-5 fw-bold mb-2">{{ trans_choice('content.setting.logo', 1) }}</label>
                                
                                    <div class="col-lg-8">
                                      
                                        <div class="image-input image-input-outline" data-kt-image-input="true"
                                            style="background-image: url(dist/media/avatars/blank.png)">
                                            
                                            <div class="image-input-wrapper w-125px h-125px"
                                                style="background-image: url('{{ $logo_img }}')">
                                            </div>
                                         
                                            <label
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                title="Change avatar">
                                                <i class="bi bi-pencil-fill fs-7"></i>
                                                
                                                <input type="file" name="data[logo]"
                                                    accept=".png, .jpg, .jpeg, .svg, .ico" />
                                           
                                            </label>
                                          
                                    
                                        <div class="form-text">Allowed file types: png, jpg, jpeg, svg, ico.</div>
                                       
                                    </div>
                                 
                                    @if ($errors->has('data.tax'))
                                        <span style="color:red">{{ $errors->first('data.tax') }}</span>
                                    @endif
                                </div> -->
                                <!--end::Col-->

                                <!--begin::Col-->
                                <!-- <div class="col-md-6 mb-5 fv-row">
                               
                                    <label
                                        class="required fs-5 fw-bold mb-2">{{ trans_choice('content.setting.favicon', 1) }}</label>
                                  
                                    <div class="col-lg-8">
                                        
                                        <div class="image-input image-input-outline" data-kt-image-input="true"
                                            style="background-image: url(dist/media/avatars/blank.png)">
                                           
                                            <div class="image-input-wrapper w-125px h-125px"
                                                style="background-image: url('{{ $favicon_img }}')">

                                            </div>
                                           
                                            <label
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                title="Change favicon">
                                                <i class="bi bi-pencil-fill fs-7"></i>
                                                
                                                <input type="file" name="data[favicon]"
                                                    accept=".png, .jpg, .jpeg, .svg, .ico" />
                                               
                                            </label>
                                           
                                        </div>
                                        
                                        <div class="form-text">Allowed file types: png, jpg, jpeg, svg, ico.</div>
                                      
                                    </div>
                                    

                                    @if ($errors->has('data.copyright_text'))
                                        <span style="color:red">{{ $errors->first('data.copyright_text') }}</span>
                                    @endif
                                </div> -->
                                <!--end::Col-->

                            </div>
                            <!--end::Input group-->

                            <!--begin::Separator-->
                            <!-- <div class="separator mb-8"></div> -->
                            <!--end::Separator-->



                            <!--begin::Submit-->
                            <button type="submit" class="btn btn-primary">{{ __('content.update_title') }}</button>
                            <!-- end::Submit -->
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

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\SettingRequest', 'form') !!}
@endpush
