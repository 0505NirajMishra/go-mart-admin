<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Enable Razorpay</label>
        <div class="col-lg-4 fv-row">
            <select class="form-control form-control-solid" name="razorpay_status">
                <option value="">Select Enable / Disable </option>
                <option value="0">Disable</option>
                <option value="1">Enable</option>
            </select>
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Sand Box Mode</label>
        <div class="col-lg-4 fv-row">
            <select class="form-control form-control-solid" name="sandbox_mode_status">
                <option value="">Select Enable/Disable</option>
                <option value="0">Disable</option>
                <option value="1">Enable</option>
            </select>
        </div>

    </div>

    <div class="row mb-6">
        <label class="col-lg-4 col-form-label required fw-bold fs-6">Razorpay Key</label>
        {!! Form::text('razorpay_key', null, [
            'min' => 2,
            'max' => 6,
            'value' => 2,
            'class' => 'form-control form-control-lg form-control-solid',
            'placeholder' => trans_choice('content.razorpay_key', 1),
        ]) !!}
    </div>

    <div class="row mb-6">
        <label class="col-lg-4 col-form-label required fw-bold fs-6">Razorpay Secret</label>
        {!! Form::text('razorpay_secret', null, [
            'min' => 2,
            'max' => 6,
            'value' => 2,
            'class' => 'form-control form-control-lg form-control-solid',
            'placeholder' => trans_choice('content.razorpay_secret', 1),
        ]) !!}
    </div>

</div>

<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\EditpaymentkeyRequest', 'form') !!}
@endpush