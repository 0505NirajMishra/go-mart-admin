<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Coupan</label>

        <div class="col-lg-4 fv-row">
            {!! Form::text('coupan_code', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.coupan_code', 1),
            ]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Amount</label>

        <div class="col-lg-4 fv-row">
            {!! Form::number('amount', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.amount', 1),
            ]) !!}
        </div>


    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Discount</label>

        <div class="col-lg-4 fv-row">
            {!! Form::number('discount', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.discount', 1),
            ]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Coupan Status</label>

        <div class="col-lg-4 fv-row">
            <select class="form-control form-control-lg form-control-solid" name="coupan_status">
                <option value="">Selecy Active/Deactive</option>
                <option value="0" {{ $coupan->coupan_status == 0 ? 'selected' : '' }}>Active</option>
                <option value="1" {{ $coupan->coupan_status == 1 ? 'selected' : '' }}>Deactive</option>
            </select>
        </div>


    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Expiry Date</label>
        <div class="col-lg-4 fv-row">

            {!! Form::date('expiry_date', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.expiry_date', 1),
            ]) !!}
        </div>

    </div>


</div>
<!--end::Card body-->


@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\CoupanRequest', 'form') !!}
@endpush
