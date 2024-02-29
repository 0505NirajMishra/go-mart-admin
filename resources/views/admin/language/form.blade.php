<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Language Name</label>

        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="language_name">
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Language Slug</label>
        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="language_slug">
        </div>

    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Language Status</label>
        <div class="col-lg-4 fv-row">
            <select name="language_status" class="form-control form-control-lg form-control-solid">
                <option value="">Select Yes/No</option>
                <option value="0">Yes</option>
                <option value="1">No</option>
            </select>
        </div>
    </div>

</div>
<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\LanguageRequest', 'form') !!}
@endpush