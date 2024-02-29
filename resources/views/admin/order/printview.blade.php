@section('content')
    @include('admin.layouts.components.header', [
        'title' => __('messages.orderview', [
            'name' => trans_choice('content.order', 2),
        ]),
    ])

    <div class="post d-flex ">
        <!--begin::Container-->
        <div id="kt_content_container" class="container">
            <!--begin::Card-->
            <div class="card">
                <div class="mt-5 mx-5">
                    <p style="float:right;" id="printButton"><i class="fa fa-download"
                            style="font-size:20px;cursor: pointer;"></i></p>
                </div>
                <hr />


                <div class="row text-center justify-content-center">
                    {{--  <div class="col-md-1 col-sm-1 col-lg-1 col-xl-1">
                        <p class="fw-bold fs-3">Phone:</p>
                    </div>  --}}
                    <div class="col-md-1 col-sm-1 col-lg-1 col-xl-1">
                        {{--  <label class="fw-bold fs-5 mt-2">{{ $user['store']['store_phone'] }}</label>  --}}
                    </div>
                </div>


                <p class="mx-20">---------------------------------------------------------------------------</p>
                <p class="mx-20">--------</p>

                <p class="mx-20 fw-bold fs-4">Order Id: {{ $user->order_no }}</p>
                <p class="mx-20 fw-bold fs-4">Order Date: {{ $user->order_date }}</p>
                <p class="mx-20 fw-bold fs-4">Customer Name: {{ $user['user']['name'] }}</p>
                <p class="mx-20 fw-bold fs-4">Customer Phone: {{ $user['user']['phone'] }}</p>
                {{--  <p class="mx-20 fw-bold fs-4">Customer Address:</p>  --}}


                <p class="mx-20">-----------------------------------------------------------</p>
                <p class="mx-20">--------</p>


                <div class="row mt-5 mx-10">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-header mx-10">
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
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @foreach ($orderitem as $item)
                                                <tr>
                                                    <th scope="row">{{ $item['item_id'] }}</th>
                                                    <td>{{ $item['item_name'] }}</td>
                                                    <td>{{ $item->item->item_price  }}</td>

                                                    <td>{{ $item['quantity'] }}</td>
                                                    <td>{{ $item->item->item_price * $item['quantity'] }} </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                 <p class="mx-20 mt-5">-----------------------------------------------------------</p>
                <p class="mx-20">--------</p>


                <div class="row mt-5 mx-10">

                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-2 col-sm-2">

                                    <label class="fw-bold fs-3">Subtotal:</label><br />
                                    <hr />
                                    <label class="fw-bold fs-3">Total Amount:</label><br />
                                </div>

                                @php
                                     $itemPrice = collect($orderitem)->map(function ($checkitem) {
                                            return $checkitem->item->item_price * $checkitem['quantity'];
                                    })->sum();
                                    $subTotal = $itemPrice;
                                    $Discount = collect($orderitem)->sum('dis_item_price');
                                    $TotalPrice = $itemPrice - $Discount;
                                @endphp

                                <div class="col-md-2 col-sm-2">

                                    <label class="fw-bold fs-3">{{ $subTotal }}</label><br />
                                    <hr />
                                    <label class="fw-bold fs-3">{{ $TotalPrice }}</label><br />
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection

@push('scripts')
    <script type="text/javascript">
        document.getElementById('printButton').addEventListener('click', function() {
            window.print();
        });
    </script>
@endpush
