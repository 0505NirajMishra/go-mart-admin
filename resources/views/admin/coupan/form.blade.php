<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Coupon Title</label>

        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="coupan_title"
                placeholder="coupon title">
        </div>

        {{--  <label class="col-lg-2 col-form-label required fw-bold fs-6">Coupon Code</label>  --}}
        {{--  <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="coupan_code"
            placeholder="coupon code">
        </div>  --}}

    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Discount %</label>

        <div class="col-lg-4 fv-row">
            <input type="number" class="form-control form-control-lg form-control-solid" name="discount"
                placeholder="discount">
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Expiry Date</label>

        <div class="col-lg-4 fv-row">
            <input type="date" class="form-control form-control-lg form-control-solid" name="expiry_date">
        </div>

    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Coupon Status</label>
        <div class="col-lg-4 fv-row">
            <select name="coupan_status" class="form-control form-control-lg form-control-solid">
                <option value="">Select Active/Deactive</option>
                <option value="0">active</option>
                <option value="1">Deactive</option>
            </select>
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Name</label>
        <div class="col-lg-4 fv-row">
            <select name="store_id" class="form-control form-control-lg form-control-solid" name="store_id">
                <option value="">Select Store Name</option>
                @foreach ($stores as $data)
                    <option value="{{ $data->store_id }}">{{ $data->store_name }}</option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Coupon Description</label>
        <div class="col-lg-4 fv-row">
            <textarea
             name="coupon_desc"
             class="form-control form-control-lg form-control-solid"
             placeholder="coupon description"
             ></textarea>
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Coupon Image</label>
        <div class="col-lg-4 fv-row">
            <input type="file" class="form-control form-control-lg form-control-solid" name="coupon_image"
            accept=".png, .jpg, .jpeg">
        </div>

    </div>

</div>
<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\CoupanRequest', 'form') !!}
@endpush
