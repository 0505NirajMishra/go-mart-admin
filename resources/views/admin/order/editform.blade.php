<div class="card-body">

    <!--begin::Input group
    -->

    <div class="row mb-6">
        <div class="mx-5">
            <p style="float:right;" id="printButton"><i class="fa fa-download" style="font-size:20px;cursor: pointer;"></i>
            </p>
        </div>
    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Order Amount</label>

        <div class="col-lg-4 fv-row">
            {!! Form::number('order_amount', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.order_amount', 1),
            ]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Order Status</label>
        <div class="col-lg-4 fv-row">
            <select name="order_status" class="form-control form-control-lg form-control-solid">
                <option value="">Select Order Status</option>
                <option value="0" {{ $order->order_status == 0 ? 'selected' : '' }}>Pending</option>
                <option value="1" {{ $order->order_status == 1 ? 'selected' : '' }}>Complete</option>
                <option value="2" {{ $order->order_status == 2 ? 'selected' : '' }}>Cancel</option>
            </select>
        </div>

    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Payment method</label>
        <div class="col-lg-4 fv-row">
            {!! Form::text('order_type', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.order_type', 1),
            ]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Created Date</label>
        <div class="col-lg-4 fv-row">
            {!! Form::date('order_date', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.order_date', 1),
            ]) !!}
        </div>

    </div>



</div>
<!--end::Card body-->

@push('scripts')

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\EditOrderRequest', 'form') !!}

    <script type="text/javascript">
        document.getElementById('printButton').addEventListener('click', function() {
            window.print();
        });
    </script>

@endpush
