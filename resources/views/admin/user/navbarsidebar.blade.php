@extends('admin.layouts.base')
@section('content')
    @yield('user_details_breadcrumb')
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row">
                <!--begin::Sidebar-->
                <div class="flex-column flex-lg-row-auto w-100 w-xl-400px mb-10">
                    <!--begin::Card-->
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Card body-->
                        <div class="card-body pt-0 pt-lg-1">  
                            <div class="card">
                                <div class="card-body d-flex flex-center flex-column pt-12 p-9 px-0">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-100px symbol-circle mb-7">
                                    @if(!empty($user->picture))     
                                    <img src="{{Storage::disk('s3')->temporaryUrl($user->picture,now()->addMinutes(5))}}" height="20" width="20" alt="image" />
                                    @endif
                                     
                                    </div>
                                    
                                    <a href="#"
                                        class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-3">{{ $user->name }} {{ $user->l_name }}</a>
                              
                                    
                                    <!--end::Info-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                            <!--end::Summary-->
                            <!--begin::Details toggle-->
                            <div class="d-flex flex-stack fs-4 py-3">
                                <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse"
                                    href="#kt_user_view_details" role="button" aria-expanded="false"
                                    aria-controls="kt_user_view_details">Details
                                    <span class="ms-2 rotate-180">
                                        <!--begin::Svg Icon | path: icons/duotone/Navigation/Angle-down.svg-->
                                       
                                        <!--end::Svg Icon-->
                                    </span>
                                </div>
                               
                            </div>
                            <!--end::Details toggle-->
                            <div class="separator"></div>
                            <!--begin::Details content-->
                            <div id="kt_user_view_details" class="collapse show">
                                <div class="pb-5 fs-6">
                                    <!--begin::Details item-->
                                        
                                    <div class="fw-bolder mt-5">Account ID</div>
                                    <div class="text-gray-600">ID-{{ $user->id }}</div>
                                    <!--begin::Details item-->
                                    <!--begin::Details item-->
                                        @if($user->user_type==1)
                                    <div class="fw-bolder mt-5">Verify Status</div>
                                    <div class="text-gray-600">
                                         
                                    @if($user->is_verify==0)
                                        <a href="{{ url('/') }}/admin/users/verify/{{$user->id}}/{{$user->is_verify==0?1:0}}" class="text-gray-600  text-hover-primary"><button name="find" type="submit" class="form-control" style="height:3rem;width:10rem;background-color:red;color:white;margin-top:6px"><span style="font-size:15px;font-weight:800px;color:white">Unverify</span></button></a>
                                            @else
                                            <a href="{{ url('/') }}/admin/users/verify/{{$user->id}}/{{$user->is_verify==0?1:0}}" class="text-gray-600 "><button name="find" type="submit" class="form-control" style="height:3rem;width:10rem;background-color:blue;color:white;margin-top:6px"><span style="font-size:15px;font-weight:800px">Verifyed</span>&nbsp;<i class="fa fa-check" style="font-size:20px;color:white;"></i></button></a>

                                        @endif

                                    </div>
                                    @endif
                                    <div class="fw-bolder mt-5">Email</div>
                                    <div class="text-gray-600">
                                        <a href="#" class="text-gray-600 text-hover-primary">{{ $user->email }}</a>
                                    </div>
                                    <div class="fw-bolder mt-5">Mobile No</div>
                                    <div class="text-gray-600">
                                        <a href="#" class="text-gray-600 text-hover-primary">{{ $user->phone }}</a>
                                    </div>

                                    @if($user->user_type==0)
                                    <div class="fw-bolder mt-5">Experiance</div>
                                    <div class="text-gray-600">
                                        <a href="#" class="text-gray-600 text-hover-primary">{{ $user->experiance }}</a>
                                    </div>
                                   @endif
                           
                                    @if(!empty($user->certificate_image))
                                    <div class="fw-bolder mt-5">Certificate</div>
                                    
                                    <div class="text-gray-600">

                                    
                                    @foreach(json_decode($user->certificate_image,true) as $users)
                                  <a href="{{Storage::disk('s3')->temporaryUrl($users,now()->addMinutes(5))}}" target="_blank">  <img src="{{Storage::disk('s3')->temporaryUrl($users,now()->addMinutes(5))}}" height="100" width="100" alt="image" /></a>
                                    @endforeach
                                    
                                </div>
                             
                                @endif

                                </div>

                                
                            </div>
                            <!--end::Details content-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->

                    

                </div>
              
                <div class="flex-lg-row-fluid ms-lg-15">
                   
                    <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8">
                       
                        <nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    
  </div>
</nav>
               
                    </ul>
                    <!--end:::Tabs-->
                    <!--begin:::Tab content-->
                    <div class="tab-content" id="myTabContent">
                        @yield('user_details_tab')
                    </div>
                    <!--end:::Tab content-->
                </div>
                
                <!--end::Content-->
            </div>
            <!--end::Layout-->
        </div>
        
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection
