<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">
        <div class="col-lg-4 fv-row">
            <input class="" type="checkbox" value="1" checked />
            &nbsp;&nbsp;<label class="col-lg-10 col-form-label required fw-bold fs-6">Is Enabled</label>
        </div>
    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Vat Type</label>
        <div class="col-lg-4 fv-row">
            <select name="vat_type" class="form-control form-control-lg form-control-solid">
                <option value="">Select Type</option>
                <option value="0" {{ $vat->vat_type == 0 ? 'selected' : '' }}>Percentage</option>
                <option value="1" {{ $vat->vat_type == 1 ? 'selected' : '' }}>Fixed</option>
            </select>
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Vat Tax</label>
        <div class="col-lg-4 fv-row">
            {!! Form::number('vat_tax', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.vat_tax', 1),
            ]) !!}
        </div>


    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Lable</label>
        <div class="col-lg-4 fv-row">
            {!! Form::text('vat_lable', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.vat_lable', 1),
            ]) !!}
        </div>
    </div>

</div>

<!--end::Card body-->


@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\VatRequest', 'form') !!}
@endpush
