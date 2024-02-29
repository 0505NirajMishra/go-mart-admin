<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Name</label>

        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="name"
            placeholder="Name"
            >
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Code</label>
        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="code"
            placeholder="Code"
            >
        </div>

    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Symbol</label>

        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="symbol"
            placeholder="Symbol"
            >
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Symbol At Right</label>

        <div class="col-lg-4 fv-row">
            <select name="symbol_at_right" class="form-control form-control-lg form-control-solid">
                <option value="">Select Yes/No</option>
                <option value="0">Yes</option>
                <option value="1">No</option>
            </select>
        </div>

    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Currency Status</label>
        <div class="col-lg-4 fv-row">
            <select name="currency_status" class="form-control form-control-lg form-control-solid">
                <option value="">Select Active/Deactive</option>
                <option value="0">active</option>
                <option value="1">Deactive</option>
            </select>
        </div>
    </div>

</div>
<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\CurrencyRequest', 'form') !!}
@endpush