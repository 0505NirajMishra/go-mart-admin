<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <div class="col-lg-4 fv-row">
            <input class="coupon_question" type="checkbox" value="1" onchange="valueChanged()"
                checked
            />
            &nbsp;&nbsp;<label class="col-lg-10 col-form-label required fw-bold fs-6">Enable Admin Commission</label>
        </div>
    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Commission Type</label>
        <div class="col-lg-4 fv-row">
            <select name="commission_type" class="form-control form-control-lg form-control-solid">
                <option value="">Select Type</option>
                <option value="0" {{ $commsion->commission_type == 0 ? 'selected' : '' }}>Percentage</option>
                <option value="1" {{ $commsion->commission_type == 1 ? 'selected' : '' }}>Fixed</option>
            </select>
        </div>

         <label class="col-lg-2 col-form-label required fw-bold fs-6 textboxDiv">Admin Commision</label>
        <div class="col-lg-4 fv-row textboxDiv">
            {!! Form::number('admin_commission', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.admin_commision', 1),
            ]) !!}
        </div>


    </div>

</div>

<!--end::Card body-->


@push('scripts')

    <script type="text/javascript">
        function valueChanged()
        {
            if($('.coupon_question').is(":checked"))   
                $(".textboxDiv").show();
            else
                $(".textboxDiv").hide();
        }
    </script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\CommissionRequest', 'form') !!}
@endpush
