<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Coupon Title</label>

        <div class="col-lg-4 fv-row">
                {!! Form::text('coupan_title', null, [
                    'min' => 2,
                    'max' => 6,
                    'value' => 2,
                    'class' => 'form-control form-control-lg form-control-solid',
                    'placeholder' => trans_choice('content.coupan_title', 1),
                ]) !!}

        </div>

    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Coupon Status</label>

        <div class="col-lg-4 fv-row">
            <select class="form-control form-control-lg form-control-solid" name="coupan_status">
                <option value="">Selecy Active/Deactive</option>
                <option value="0" {{ $coupan->coupan_status == 0 ? 'selected' : '' }}>Active</option>
                <option value="1" {{ $coupan->coupan_status == 1 ? 'selected' : '' }}>Deactive</option>
            </select>
        </div>

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

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Discount %</label>

        <div class="col-lg-4 fv-row">
            {!! Form::number('discount', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.discount', 1),
            ]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Name</label>
        <div class="col-lg-4 fv-row">
            <select class="form-control form-control-lg form-control-solid" name="store_name">
                @foreach ($stores as $data)
                    <option value="{{ $data->store_id }}" {{ $coupan->store_id == $data->store_id ? 'selected' : '' }}>
                        {{ $data->store_name }}</option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Coupon Description</label>

        <div class="col-lg-4 fv-row">
            {!! Form::textarea('coupon_desc', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.coupon_desc', 1),
            ]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Image</label>

        <div class="col-lg-4 fv-row">
            @if ($coupan->coupan_id)
                <input type="file" class="form-control form-control-lg form-control-solid" name="coupon_image"
                    accept=".png, .jpg, .jpeg">
                <img src={{ env('APP_URL') }}/uploads/{{ $coupan->coupon_image }}
                    style="width:50px; height:50px; border-radius:1rem;" />
            @else
                <input type="file" class="form-control form-control-lg form-control-solid" name="coupon_image"
                    accept=".png, .jpg, .jpeg">
            @endif
        </div>

    </div>

</div>
<!--end::Card body-->


@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\CoupanEditRequest', 'form') !!}
@endpush
