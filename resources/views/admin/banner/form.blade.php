<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Banner Title</label>

        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="banner_title"
                placeholder="banner title">
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Banner Image</label>
        <div class="col-lg-4 fv-row">
            <input type="file" class="form-control form-control-lg form-control-solid" name="banner_image"
                accept=".png, .jpg, .jpeg">
        </div>

    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Publish</label>
        <div class="col-lg-4 fv-row">
            <select name="banner_publish" class="form-control form-control-lg form-control-solid">
                <option value="">Select Yes / No</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Set Order</label>
        <div class="col-lg-4 fv-row">
            <input type="number" class="form-control form-control-lg form-control-solid" name="set_order"
                placeholder="set order">
        </div>


    </div>

</div>
<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\BannerRequest', 'form') !!}
@endpush
