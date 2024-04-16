@extends('admin.layouts.base')
@section('content')
    @include('admin.layouts.components.header', [
        'title' => __('header.dashboard'),
        'breadcrumbs' => Breadcrumbs::render('admin.dashboard'),
    ])

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <!--begin::Row-->

            <div class="row gy-5 g-xl-8">
                <!--begin::Col-->
                <div class="col-12">
                    <!--begin::Mixed Widget 2-->
                    <div class="card">
                        <!--begin::Body-->
                        <div class="card-body p-0 ">
                            <!--begin::Stats-->
                            <div class="card-p mt-20 position-relative">
                                <!--begin::Row-->
                                <div class="row g-0">

                                    <!--begin::Col-->

                                    <div class="col bg-light-primary px-6 py-8 rounded-2 me-7 mb-7 text-center">
                                        <i class="fa fa-users" style="font-size:35px;color:#009EF7;"></i>
                                        <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                            <h5>{{ total_user() }}</h5>
                                        </span>

                                        <a class="text-primary fw-bold fs-6">
                                            {{ trans_choice('content.dashboard_cards.new_users', 1) }}
                                        </a>

                                        <a href="{{ route('admin.users.index') }}">
                                            <div class="mt-1">
                                                <div class="fw-bold fs-6" style="margin-left:15px;">
                                                    <label style="color:black;cursor: pointer;">More infos &nbsp;</label><i
                                                        class="fa-solid fa-arrow-right p-1 fs-8"
                                                        style="background-color: #009EF7;color:white;border-radius:12px;"></i>
                                                </div>
                                            </div>

                                        </a>

                                    </div>

                                    <!--end::Col-->

                                    <!--begin::Col-->

                                    {{--
                                    <div class="col bg-light-primary px-6 py-8 rounded-2 me-7 mb-7 text-center">
                                        <i class="fa fa-bag-shopping" style="font-size:35px;color:#009EF7;"></i>
                                        <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                            <h5>{{ total_store() }}</h5>
                                        </span>
                                        <a class="text-primary fw-bold fs-6">
                                            {{ trans_choice('content.dashboard_cards.total_store', 1) }}
                                        </a>

                                        <a href="{{ route('admin.stores.index') }}" class="text-primary fw-bold fs-6">
                                            <div class="mt-1">
                                                <div class="fw-bold fs-6" style="margin-left:15px;">
                                                    <label style="color:black;cursor: pointer;">More infos &nbsp;</label><i
                                                        class="fa-solid fa-arrow-right p-1 fs-8"
                                                        style="background-color: #009EF7;color:white;border-radius:12px;"></i>
                                                </div>
                                            </div>
                                        </a>

                                    </div>
                                    --}}

                                    <div class="col bg-light-primary px-6 py-8 rounded-2 me-7 mb-7 text-center">
                                        <i class="fa fa-cart-shopping" style="font-size:35px;color:#009EF7;"></i>
                                        <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                            <h5>{{ total_order() }}</h5>
                                        </span>

                                        <a class="text-primary fw-bold fs-6">
                                            {{ trans_choice('content.dashboard_cards.total_orders', 1) }}
                                        </a>

                                        <a href="{{ route('admin.orders.index') }}">

                                            <div class="mt-1">
                                                <div class="fw-bold fs-6" style="margin-left:15px;">
                                                    <label style="color:black;cursor: pointer;">More infos &nbsp;</label><i
                                                        class="fa-solid fa-arrow-right p-1 fs-8"
                                                        style="background-color: #009EF7;color:white;border-radius:12px;"></i>
                                                </div>
                                            </div>

                                        </a>

                                    </div>

                                    <!--end::Col-->

                                    <!--begin::Col-->

                                    {{--  <div class="col bg-light-primary px-6 py-8 rounded-2 me-7 mb-7 text-center">
                                        <i class="fa fa-car" style="font-size:35px;color:#009EF7;"></i>
                                        <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                            <h5>{{ total_driver() }}</h5>
                                        </span>
                                        <a class="text-primary fw-bold fs-6">
                                            {{ trans_choice('content.dashboard_cards.total_driver', 1) }}
                                        </a>

                                        <a href="{{ route('admin.drivers.index') }}">

                                            <div class="mt-1">
                                                <div class="fw-bold fs-6" style="margin-left:15px;">
                                                    <label style="color:black;cursor: pointer;">More infos &nbsp;</label><i
                                                        class="fa-solid fa-arrow-right p-1 fs-8"
                                                        style="background-color: #009EF7;color:white;border-radius:12px;"></i>
                                                </div>
                                            </div>

                                        </a>


                                    </div>  --}}

                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Body-->
            </div>

            {{--  <div class="row gy-3 g-xl-8">
                <!--begin::Col-->
                <div class="col-12">
                    <!--begin::Mixed Widget 2-->
                    <div class="card">
                        <!--begin::Body-->
                        <div class="card-body p-0 ">
                            <!--begin::Stats-->
                            <div class="card-p position-relative">
                                <!--begin::Row-->
                                <div class="row g-0">

                                    <!--begin::Col-->

                                    <div class="col bg-light-primary px-6 py-8 rounded-2 me-7 mb-7 text-center">
                                        <i class="fa fa-cart-shopping" style="font-size:35px;color:#009EF7;"></i>
                                        <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                            <h5>{{ total_order() }}</h5>
                                        </span>

                                        <a class="text-primary fw-bold fs-6">
                                            {{ trans_choice('content.dashboard_cards.total_orders', 1) }}
                                        </a>

                                        <a href="{{ route('admin.orders.index') }}">

                                            <div class="mt-1">
                                                <div class="fw-bold fs-6" style="margin-left:15px;">
                                                    <label style="color:black;cursor: pointer;">More infos &nbsp;</label><i
                                                        class="fa-solid fa-arrow-right p-1 fs-8"
                                                        style="background-color: #009EF7;color:white;border-radius:12px;"></i>
                                                </div>
                                            </div>

                                        </a>

                                    </div>

                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col bg-light-primary px-6 py-8 rounded-2 me-7 mb-7 text-center">
                                        <i class="fa fa-building-columns" style="font-size:35px;color:#009EF7;"></i>
                                        <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                            <h5>{{ total_order() }}</h5>
                                        </span>

                                        <a class="text-primary fw-bold fs-6">
                                            {{ trans_choice('content.dashboard_cards.total_earning', 1) }} (After taxes)
                                        </a>

                                        <a>
                                            <div class="mt-1">
                                                <div class="fw-bold fs-6" style="margin-left:15px;">
                                                    <label style="color:black;cursor: pointer;">More infos &nbsp;</label><i
                                                        class="fa-solid fa-arrow-right p-1 fs-8"
                                                        style="background-color: #009EF7;color:white;border-radius:12px;"></i>
                                                </div>
                                            </div>
                                        </a>

                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col bg-light-primary px-6 py-8 rounded-2 me-7 mb-7 text-center">
                                        <i class="fa fa-wallet" style="font-size:35px;color:#009EF7;"></i>
                                        <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">

                                        </span>

                                        <a class="text-primary fw-bold fs-6">
                                            {{ trans_choice('content.dashboard_cards.total_commission', 1) }}
                                        </a>

                                        <a href="">
                                            <div class="mt-1">
                                                <div class="fw-bold fs-6" style="margin-left:15px;">
                                                    <label style="color:black;cursor: pointer;">More infos &nbsp;</label><i
                                                        class="fa-solid fa-arrow-right p-1 fs-8"
                                                        style="background-color: #009EF7;color:white;border-radius:12px;"></i>
                                                </div>
                                            </div>
                                        </a>

                                    </div>
                                    <!--end::Col-->

                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Body-->
            </div>  --}}

            <!-- start earning and top stores -->
            {{--  <div class="row gy-5 g-xl-8 mt-5 mb-5 d-flex">
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card h-100">
                        <div class="card-header">
                            <div class="float-left mt-5">
                                <h1 class="card-title" style="font-size:18px;">Earnings</h1>
                                <span class="card-title" style="font-size:18px;"><b>Total Sell:</b></span>
                                <span class="card-title" style="font-size:18px;"><b>Admin Commission:</b></span>
                            </div>
                            <div class="float-right mt-5">
                                <label class="card-title" style="color:#009EF7;">All Payments</label>
                            </div>
                        </div>

                        <div class="card-body">
                            <div style="width: 100%; margin: auto;">
                                <canvas id="canvas"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card h-100">
                        <div class="card-header">
                            <h4 class="card-title">Stores</h4>
                            <a href=" {{ route('admin.stores.index') }}">
                                <label class="mt-8"><i class="fa fa-solid fa-bars"
                                        style="font-size: 18px;color:#009EF7;cursor:pointer;"></i></label>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-bordered">
                                <table class="table table-striped fw-bold fs-4">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Store</th>
                                            <th>Review</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{--  @foreach ($data as $stores)
                                            <tr>
                                                <td>
                                                    <img src={{ env('IMAGE_URL') }}/uploads/{{ $stores->store_image }}
                                                        style="width:50px; height:50px;" />
                                                </td>
                                                @php
                                                    $rating = $stores->rating;
                                                    $stars = '';
                                                    for ($i = 1; $i <= 5; $i++) {
                                                        $stars .= $i <= $rating ? '★' : '☆';
                                                    }
                                                @endphp
                                                <td>{{ $stores->store_name }}</td>
                                                <td> {{ $stars }}</td>
                                                <td><a href="{{ url('/') }}/admin/stores/{{ $stores->store_id }}/edit"
                                                        style="cursor: pointer;">
                                                        <label class="badge badge-success"><i
                                                                class="fa-regular fa-pen-to-square"
                                                                style="color:white;"></i></label>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach  --}}


                                    {{--  </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>  --}}
            {{--  </div>  --}}
            <!-- end earning and top stores -->

            <!-- start recent order and top driver list -->

            {{--  <div class="row gy-5 g-xl-8 mt-5 mb-5 d-flex">
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card h-100">
                        <div class="card-header">
                            <h3 class="card-title">Recent Orders</h3>
                            <a href=" {{ route('admin.orders.index') }}">
                                <label class="mt-8"><i class="fa fa-solid fa-bars"
                                        style="font-size: 18px;color:#009EF7;cursor:pointer;"></i></label>
                            </a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive table-bordered">
                                <table class="table table-striped fw-bold fs-4">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Store</th>
                                            <th>Total Amount</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        {{--  @foreach ($recent_order as $order)
                                            <tr>
                                                <td>{{ $order->order_id }}</td>
                                                <td>{{ $order['store']['store_name'] }}</td>
                                                <td>{{ itemTotal($order->order_id) }}</td>
                                                <td><i class="fa-solid fa-cart-shopping"
                                                        style="color: #009EF7; font-size:15px;"></i>
                                                    &nbsp;{{ itemCount($order->order_id) }}</td>
                                            </tr>
                                        @endforeach  --}}
                                    {{--  </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>  --}}
                {{--  <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card h-100">
                        <div class="card-header">
                            <h4 class="card-title">Top Drivers</h4>
                            <a href=" {{ route('admin.drivers.index') }}">
                                <label class="mt-8"><i class="fa fa-solid fa-bars"
                                        style="font-size: 18px;color:#009EF7;cursor:pointer;"></i></label>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-bordered">
                                <table class="table table-striped fw-bold fs-4">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Driver</th>
                                            <th>Order Completed</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>  --}}
                                        {{--  @foreach ($driver_list as $driver)
                                            <tr>
                                                <td> <img src={{ env('IMAGE_URL') }}/uploads/{{ $driver->driver_image }}
                                                        style="width:50px; height:50px;" /></td>
                                                <td>{{ $driver->driver_name }}</td>
                                                <td>{{ driver_order_complete_count($driver->driver_id) }}</td>
                                                <td>
                                                    <a href="{{ url('/') }}/admin/drivers/{{ $driver->driver_id }}/edit"
                                                        style="cursor: pointer;">
                                                        <label class="badge badge-success">
                                                            <i class="fa-regular fa-pen-to-square"
                                                                style="color:white;"></i></label>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach  --}}
                                    {{--  </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>  --}}
            {{--  </div>  --}}

            <!-- end recent order and top driver list -->

            <!--end::Col-->
        </div>
        <!--end::Post-->
    @endsection

    <script src="https://raw.githubusercontent.com/nnnick/Chart.js/master/dist/Chart.bundle.js"></script>

    @push('scripts')
        <script>
            function dashboard() {
                $.ajax({
                        url: `{{ route('admin.dashboard-counts') }}`,
                        type: "get",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                    })
                    .done(function(response) {
                        console.log(response);
                        $('.new_users').text(response.data.new_users);
                        $('.total_clients').text(response.data.total_clients);
                        $('.yearly_sales_count').text(response.data.yearly_sales_count);

                        $('.total_vendors').text(response.data.total_vendors);

                        $('.total_purchase').text(response.data.total_purchase);

                        $('.total_unpaid_bill').text(response.data.total_unpaid_bill);
                        $('.total_unrecieved_bill').text(response.data.total_unrecieved_bill);
                        $('.total_unrecieved_amount').text((response.data.total_unrecieved_amount).toLocaleString());

                        $('.total_dept_balance').text((response.data.total_dept_balance).toLocaleString());
                        $('.total_asset').text(response.data.total_asset);
                    })
                    .fail(function() {
                        Swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                    });
            }
            dashboard();
        </script>

        <script>
            var columnchartData = @json($columnchart);

            var barChartData = {
                labels: columnchartData.year,
                datasets: [{
                    label: 'Year',
                    color: '#000000',
                    backgroundColor: "#009EF7",
                    data: columnchartData.data_form_year_wise
                }]
            };

            window.onload = function() {
                var ctx = document.getElementById("canvas").getContext("2d");
                window.myBar = new Chart(ctx, {
                    type: 'bar',
                    data: barChartData,
                    options: {
                        elements: {
                            rectangle: {
                                borderWidth: 2,
                                borderColor: 'rgb(0, 255, 0)',
                                borderSkipped: 'bottom'
                            }
                        },
                        responsive: true,
                        title: {
                            display: true,
                            text: 'Yearly Website Visitor'
                        }
                    }
                });
            };
        </script>
    @endpush
