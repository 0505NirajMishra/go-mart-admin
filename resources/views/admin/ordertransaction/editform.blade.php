<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">
        <div class="col-lg-4 fv-row">
            <input class="" type="checkbox" value="1" checked />
            &nbsp;&nbsp;<label class="col-lg-10 col-form-label required fw-bold fs-6">Vendor Can Modify</label>
        </div>
    </div>

    <div class="row mb-6">

        <label class="col-lg-4 col-form-label required fw-bold fs-6">Delivery Charges Per km</label>
        <div class="col-lg-2 fv-row">
            {!! Form::number('delivery_charge_per_km', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.delivery_charge_per_km', 1),
            ]) !!}
        </div>

        <label class="col-lg-4 col-form-label required fw-bold fs-6">Minimum Delivery Charges</label>
        <div class="col-lg-2 fv-row">
            {!! Form::number('minimum_delivery_charge', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.minimum_delivery_charge', 1),
            ]) !!}
        </div>


    </div>

    <div class="row mb-6">
        <label class="col-lg-4 col-form-label required fw-bold fs-6">Minimum Delivery Charges Within Km</label>
        <div class="col-lg-4 fv-row">
            {!! Form::number('minimum_delivery_charge_with_km', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.minimum_delivery_charge_with_km', 1),
            ]) !!}
        </div>
    </div>

</div>

<!--end::Card body-->


@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\DeliverRequest', 'form') !!}
@endpush
