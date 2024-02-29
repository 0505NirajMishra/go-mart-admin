@section('content')
    @include('admin.layouts.components.header', [
        'title' => __('messages.storeview', [
            'name' => trans_choice('content.store', 2),
        ]),
    ])

    <div class="container">
        <div class="row mb-5">

            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <div class="card shadow">

                    <div class="card-body">

                        <div class="text-center">
                            <h2 class="card-title"><i class="fa-sharp fa-solid fa-cart-shopping"
                                    style="color:black;font-size:30px;"></i></h2>
                            <span style="color:black;font-size:30px;">{{ $storeordercount }}</span>
                            <p style="color:black;font-size:15px;">Total Order</p>
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <div class="card shadow">

                    <div class="card-body">

                        <div class="text-center">
                            <h2 class="card-title">
                                <i class="fa-sharp fa-solid fa-building-columns" style="color:black;font-size:30px;"></i>
                            </h2>
                            <span style="color:black;font-size:30px;">0</span>
                            <p style="color:black;font-size:15px;">Total Earning</p>
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <div class="card shadow">

                    <div class="card-body">

                        <div class="text-center">
                            <h2 class="card-title">
                                <i class="fa fa-wallet" style="color:black;font-size:30px;"></i>
                            </h2>
                            <span style="color:black;font-size:30px;">0</span>
                            <p style="color:black;font-size:15px;">Total Payment</p>
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
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

    <div class="post d-flex">
        <!--begin::Container-->
        <div id="kt_content_container" class="container">
            <!--begin::Card-->
            <div class="card p-5">

                <div class="mt-4">
                    <h4>Store Details</h4>
                </div>

                <br />

                <div class="row mb-6">

                    <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Name</label>

                    <div class="col-lg-4">
                        <input class="form-control form-control-lg form-control-solid" value={{ $storedata->store_name }}
                            readOnly />
                    </div>

                    <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Address</label>

                    <div class="col-lg-4 fv-row">
                        <input type="text" class="form-control form-control-lg form-control-solid"
                            value={{ $storedata->store_address }} readOnly />

                    </div>

                </div>

                <br />

                <div class="row mb-6">

                    <label class="col-lg-2 col-form-label fw-bold fs-6">Store Phone</label>

                    <div class="col-lg-4">
                        <input class="form-control form-control-lg form-control-solid" value={{ $storedata->store_phone }}
                            readOnly />
                    </div>

                    <label class="col-lg-2 col-form-label fw-bold fs-6">Store Description</label>

                    <div class="col-lg-4 fv-row">
                        <input type="textarea" class="form-control form-control-lg form-control-solid"
                            value={{ $storedata->store_description }} readOnly />

                    </div>

                </div>

                <br />

                <div class="row mb-6">

                    <label class="col-lg-2 col-form-label fw-bold fs-6">Store Latitude</label>

                    <div class="col-lg-4 fv-row">
                        <input class="form-control form-control-lg form-control-solid"
                            value={{ $storedata->store_latitude }} readOnly />
                    </div>

                    <label class="col-lg-2 col-form-label fw-bold fs-6">Store Longitude</label>

                    <div class="col-lg-4 fv-row">
                        <input class="form-control form-control-lg form-control-solid"
                            value={{ $storedata->store_longitude }} readOnly />
                    </div>

                </div>

                <br />

                <div class="row mb-6">

                    <label class="col-lg-2 col-form-label fw-bold fs-6">Store Open/Close</label>

                    <div class="col-lg-4 fv-row mt-5">
                        <span>{{ $storedata->store_status == 0 ? 'Close' : 'Open' }}</span>
                    </div>

                    <label class="col-lg-2 col-form-label fw-bold fs-6">Store Active/Deactive</label>

                    <div class="col-lg-4 fv-row mt-5">
                        <span>{{ $storedata->store_active == 0 ? 'Enable' : 'Disable' }}</span>
                    </div>

                </div>

                <br />

                <div class="row mb-6">

                    <label class="col-lg-2 col-form-label fw-bold fs-6">Store Image</label>

                    <div class="col-lg-4 fv-row mt-5">
                        <img src={{ env('IMAGE_URL') }}/uploads/{{ $storedata->store_image }}
                            style="width:50px; height:50px;" />
                    </div>

                    <label class="col-lg-2 col-form-label fw-bold fs-6">Category</label>

                    <div class="col-lg-4 fv-row mt-5">
                        <span>{{ $storedata->cat_name }}</span>
                    </div>


                </div>

            </div>
            <!--end::Card-->

            <!-- timing section -->
            <div class="card p-5 mt-5">

                <div class="mt-4">
                    <h4>Timing </h4>
                </div>

                <br />

                <div class="row mb-6">

                    <label class="col-lg-2 col-form-label fw-bold fs-6">Opening Time</label>

                    <div class="col-lg-4 fv-row">
                        <input class="form-control form-control-lg form-control-solid"
                            value={{ $storedata->store_opening_time }} readOnly />
                    </div>

                    <label class="col-lg-2 col-form-label fw-bold fs-6">Closing Time</label>

                    <div class="col-lg-4 fv-row">
                        <input class="form-control form-control-lg form-control-solid"
                            value={{ $storedata->store_closing_time }} readOnly />
                    </div>

                </div>

            </div>
            <!-- end timing section -->

            <!-- timing section -->
            <div class="card p-5 mt-5">

                <div class="mt-4">
                    <h4>Gallery </h4>
                </div>

                <br />

                <div class="row mb-6">

                    <label class="col-lg-2 col-form-label fw-bold fs-6">Gallery Image</label>
                    <div class="col-lg-4 fv-row">
                        <img src={{ env('IMAGE_URL') }}/uploads/{{ $storedata->gallery_image }}
                            style="width:50px; height:50px;" />
                    </div>

                </div>

            </div>
            <!-- end timing section -->

        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection