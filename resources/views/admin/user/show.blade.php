@extends('admin.user.navbarsidebar')
@section('user_details_breadcrumb')
    @include('admin.layouts.components.header',[
    'title'=> __('messages.detail', ['name' => trans_choice('content.user', 2)]),
    'breadcrumbs'=> Breadcrumbs::render('admin.users.show')
    ])
@endsection
@section('user_details_tab')
    <!--begin:::Tab pane-->
    <div class="tab-pane fade {{ request()->tab == 'details' || request()->tab == '' ? 'show active' : '' }}"
        id="kt_user_view_overview_security" role="tabpanel">
        <!--begin::Card-->
        <div class="card pt-4 mb-6 mb-xl-9">
            <!--begin::Card header-->
            <div class="card-header border-0">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2 style="color:blue">{{ trans_choice('content.profile', 1) }}</h2>
                </div>
               
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0 pb-5">
                <!--begin::Table wrapper-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed gy-5" id="kt_table_users_login_session">
                        <!--begin::Table body-->
                        <tbody class="fs-6 fw-bold text-gray-600">
        
                        <tr>
                                <td>Name</td>
                                <td>{{ $user->name }} {{ $user->l_name }}</td>
                            </tr>

                            <tr>
                                <td>Email</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            
                            <tr>
                                <td>Number</td>
                                <td>{{ $user->phone }}</td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>{{ $user->gender }}</td>
                            </tr>
                            <tr>
                                @if(!empty($user->advisory))
                                <td>Advisory</td>
                                <td> {{ get_advisory($user->advisory)}}</td>
                                @endif
                            </tr>

                            <tr>
                                <td>Bank Name</td>
                                <td>{{ $user->bank_name }}</td>
                            </tr>

                            <tr>
                                <td>Accoount No</td>
                                <td><span>SA-&nbsp;&nbsp;</span>{{ $user->bank_account }}</td>
                            </tr>

                            <tr>
                                <td>About</td>
                                <td>{{ $user->about }}</td>
                            </tr>
                       
                            
                            
                          
                                            
                    </table>
                    
                </div>
                
            </div>
            
        </div>
        <div class="card pt-4 mb-6 mb-xl-9">
            <!--begin::Card header-->
            <div class="card-header border-0">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2 style="color:blueviolet">{{ trans_choice('content.rating', 1) }}</h2>
                </div>
               
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0 pb-5" style="height:300px ;overflow-x: scroll;">
                <!--begin::Table wrapper-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed gy-5" id="kt_table_users_login_session">
                        <!--begin::Table body-->
                        <tbody class="fs-6 fw-bold text-gray-600">
                       
                        @if(count($user->rating)>0 && $user->user_type==0)
                        <tr>
                                <td>Counsultent Name</td>
                                <td>Rating Given</td>
                                <td>Review</td>
                                <td>Date</td>
                            </tr>
                            @else
                            <tr>
                                <td>Rating Given</td>
                                <td>Review</td>
                                <td>Date</td>
                            </tr>

                       @endif
                            @if(count($user->rating)>0 && $user->user_type==0)
                        @foreach($user->rating as $rating)   
                        <tr>
                                <td>{{$rating->name}} {{$rating->l_name}}</td>
                                <td>{{ $rating->rating }}</td>
                                <td>{{ $rating->review }}</td>
                                <td>{{ $rating->rating_date }}</td>
                            </tr>
                        @endforeach
                        @else
                        @foreach($user->rating as $rating)   
                        
                        <tr>
                                <td>{{ $rating->rating }}</td>
                                <td>{{ $rating->review }}</td>
                                <td>{{ $rating->rating_date }}</td>
                            </tr>
                            @endforeach
                        
                        @endif
                          
                          
                        </tbody>
                        
                    </table>
                    
                </div>
                
            </div>
            
        </div>
    
      
        
    </div>


    <div class="card pt-4 mb-6 mb-xl-9">
            <!--begin::Card header-->
            <div class="card-header border-0">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2 style="color:green">Appointment</h2>
                </div>
               
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0 pb-5" style="height:300px ;overflow-x: scroll;">
                <!--begin::Table wrapper-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed gy-5" id="kt_table_users_login_session">
                        <!--begin::Table body-->
                        <tbody class="fs-6 fw-bold text-gray-600">
                       
                        @if(count($user->appointment)>0 && $user->user_type==0)
                        <tr>
                                <td>Name</td>
                                <td>Date</td>
                                <td>Start Time</td>
                                <td>End Time</td>
                                <td>Status</td>
                            </tr>
                            @else
                            <tr>
                            <td>Name</td>
                                <td>Date</td>
                                <td>Start Time</td>
                                <td>End Time</td>
                                <td>Status</td>
                            </tr>

                       @endif
                       
                            @if(count($user->appointment)>0 && $user->user_type==0)
                        @foreach($user->appointment as $appointment)   
                        <tr>
                                <td>{{$appointment->name}}</td>
                                <td>{{ $appointment->date }}</td>
                                <td>{{ $appointment->start_time }}</td>
                                <td>{{ $appointment->end_time }}</td>
                                <td>
                                <a href="#" data-id="` + id + `" title="Book Status">
    
                                <span class="svg-icon svg-icon-3">
                                <?php if($appointment->book_status==0){ ?>
                                <i class='fa fa-clock' style="font-size:20px"><h6 style="color:blue;">Booking</h6></i>
                                        <?php  } ?>
                                        <?php if($appointment->book_status==1){ ?>
                                     <h6 style="color:red">Cancle</h6>
                                                     <?php  } ?>
                                                     <?php if($appointment->book_status==2){ ?>
                                     <h6 style="color:green;">Done</h6>
                                                     <?php  } ?>
                                         </span>  
                                </a>  

                                </td>
                            </tr>
                        @endforeach
                        @else
                        @foreach($user->appointment as $appointment)   
                        <tr>
                                <td>{{$appointment->name}}</td>
                                <td>{{ $appointment->date }}</td>
                                <td>{{ $appointment->start_time }}</td>
                                <td>{{ $appointment->end_time }}</td>
                                <td>
                                <span class="svg-icon svg-icon-3">
                                <?php if($user->book_status==0){ ?>
                                <i class='fa fa-clock' style="font-size:20px"><h6 style="color:blue;">Booking</h6></i>
                                        <?php  } ?>
                                        <?php if($user->book_status==1){ ?>
                                     <i class='fa fa-check' style="color:red;font-size:20px;"><h6 style="color:red">Cancle</h6></i>
                                                     <?php  } ?>
                                                     <?php if($user->book_status==2){ ?>
                                     <i class='fa fa-circle-phone' style="font-size:20px;color:green"><h6 style="color:green;">Done</h6></i>
                                                     <?php  } ?>
                  </span>    

                                </td>
                            </tr>
                        @endforeach
                        
                        @endif
                          
                          
                        </tbody>
                        
                    </table>
                    
                </div>
                
            </div>
    
        </div>

    
    <!--end:::Tab pane-->
@endsection
