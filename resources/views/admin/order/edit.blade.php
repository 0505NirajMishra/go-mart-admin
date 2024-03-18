@extends('admin.layouts.base')
@section('content')
    @include('admin.layouts.components.header', [
        'title' => __('messages.edit', ['name' => trans_choice('content.order', 1)]),
    ])
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">

        <!--begin::Container-->
        <div id="kt_content_container" class="container">

            {{--  <div class="row mb-6 mt-2">
                <div class="col-md-6">
                    <div class="mx-1 mt-2">
                        <h6>Billing Details</h6>
                        <hr />
                        <div class="card" style="height:40vh;">
                            <div class="card-body">
                                <strong class="fs-1 fw-bold">{{ $user['user']['name'] }} </strong> <br />
                                <div>{{ $user['user']['address'] }}<br /></div>
                                <div><strong class="fs-5 fw-bold">Email Address:</strong>
                                    <span class="fs-5">{{ $user['user']['email'] }}</span>
                                </div>
                                <div><strong class="fs-5 fw-bold">Phone:</strong>
                                    <span class="fs-5">{{ $user['user']['phone'] }}</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mx-1 mt-2">
                        <h6>Store Details</h6>
                        <hr />
                        <div class="card" style="height:40vh;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src={{ env('IMAGE_URL') }}/uploads/{{ $user['store']['store_image'] }}
                                            style="width:50px; height:50px; border-radius:50px;" />
                                    </div>
                                    <div class="col-md-4 mt-1">
                                        <strong
                                            class="fs-1 fw-bold">{{ $user['store']['store_name'] }}</strong>
                                    </div>
                                </div>



                                <div class="row mt-4">
                                    <strong class="fs-5 fw-bold">Contact Info:</strong>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="fw-bold fs-6">Phone:</div>
                                            <div class="fw-bold fs-8">{{ $user['store']['store_phone'] }}</div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="fw-bold fs-6">Address:</div>
                                            <div class="fw-bold fs-8">{{ $user['store']['store_address'] }}</div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>  --}}

            <div class="card">
                <!--begin::Body-->
                <div class="card-body">

                    <!--begin::Layout-->
                    <div class="d-flex flex-column flex-lg-row mb-17">
                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid me-0 me-lg-20">

                            <!--begin::Form-->
                            {!! Form::model($order, [
                                'method' => 'PATCH',
                                'route' => ['admin.orders.update', $order->order_no],
                                'class' => 'form mb-15',
                                'enctype' => 'multipart/form-data',
                            ]) !!}
                            @csrf
                            <input type="hidden" name="id" value="{{ $order->order_no }}">

                            @include('admin.order.editform')

                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <a href="{{ route('admin.orders.index') }}"
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

            <div class="row mt-5">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <span class="card-title fw-bold fs-3">Item Details</span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-bordered">
                                <table class="table table-striped text-center fw-bold fs-5">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($orderitem as $item)
                                            <tr>
                                                <td>{{ $item->item_id }}</td>
                                                <td>{{ $item->item_name }}</td>
                                                <td>{{ $item->item_price }}</td>
                                                <td>{{ $item->dis_item_price }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->quantity * $item->item_price }} </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5 mx-1">

                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3">
                                <label class="fw-bold fs-3">Discount:</label><br />
                                <label class="fw-bold fs-3">Subtotal:</label><br />
                                <hr />
                                <label class="fw-bold fs-3">Total Amount:</label><br />
                            </div>

                            @php
                                $itemPrice = collect($orderitem)->sum('item_price');
                                $subTotal = collect($orderitem)->sum('item_price');
                                $Discount = collect($orderitem)->sum('dis_item_price');
                                $TotalPrice = $itemPrice + $Discount;
                            @endphp

                            <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3">
                                <label class="fw-bold fs-3">{{ $Discount }}</label><br />
                                <label class="fw-bold fs-3">{{ $subTotal }}</label><br />
                                <hr />
                                <label class="fw-bold fs-3">{{ $TotalPrice }}</label><br />
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!--begin::Careers - Apply-->

            <!--end::Careers - Apply-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection
