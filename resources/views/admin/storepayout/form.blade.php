<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Id</label>

        <div class="col-lg-4 fv-row">
            <select name="store_name" class="form-control form-control-lg form-control-solid">
                <option value="">Select Store Name</option>
                <option value="medical">Medical</option>
                <option value="store">Store</option>
            </select>
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Amount</label>
        
        <div class="col-lg-4 fv-row">
            <input type="number" class="form-control form-control-lg form-control-solid" name="amount">
        </div>

    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Note</label>

        <div class="col-lg-12 fv-row">
           <textarea name="note" class="form-control form-control-lg form-control-solid"></textarea>
        </div>

    </div>


</div>
<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\StorepayoutRequest', 'form') !!}
@endpush