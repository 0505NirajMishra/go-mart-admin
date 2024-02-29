<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Name</label>

        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="store_name"
                placeholder="Store name" />
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Image</label>

        <div class="col-lg-4 fv-row">
            <input type="file" class="form-control form-control-lg form-control-solid" name="store_image"
                accept=".png, .jpg, .jpeg" />
        </div>

    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Select Category</label>

        <div class="col-lg-4 fv-row">
            <select class="form-control form-control-solid" name="category_name">
                <option value="">Select Category</option>
                @foreach ($categories as $data)
                    <option value="{{ $data->cat_id }}">{{ $data->category_name }}</option>
                @endforeach
            </select>
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Phone</label>
        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="store_phone"
                placeholder="Store Phone" />
        </div>

    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Address </label>
        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="store_address"
                placeholder="Store Address" />
        </div>
        
    </div>

    <div class="row mb-6">
        <p>* Don't Know your cordinates ? use <a href="https://www.latlong.net/" 
            target="_blank"
            style="color:green;">Latitude and Longitude Finder</a></p>
    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Latitude</label>
        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="store_latitude"
                placeholder="Store Latitude" />
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Longititude</label>
        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="store_longitude"
                placeholder="Store Longitude" />
        </div>

        

    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Opening Time</label>
        <div class="col-lg-4 fv-row">
            <input type="time" class="form-control form-control-lg form-control-solid" name="store_opening_time"
                placeholder="Store Opening Time" />
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Closing Time</label>
        <div class="col-lg-4 fv-row">
            <input type="time" class="form-control form-control-lg form-control-solid" name="store_closing_time"
                placeholder="Store Closing Time" />
        </div>

       
    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Status</label>
        <div class="col-lg-4 fv-row">
            <select name="store_status" class="form-control form-control-lg form-control-solid">
                <option value="">Select Status</option>
                <option value="0">Close</option>
                <option value="1">Open</option>
            </select>
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Active</label>
        <div class="col-lg-4 fv-row">
            <select name="store_active" class="form-control form-control-lg form-control-solid">
                <option value="">Select Enable/Disable</option>
                <option value="0">enable</option>
                <option value="1">disable</option>
            </select>
        </div>
    </div>

    <div class="row mb-6">
        <label class="col-lg-4 col-form-label required fw-bold fs-6">Store Description</label>
        <div class="col-lg-12 fv-row">
            <textarea class="form-control form-control-lg form-control-solid" name="store_description"
                placeholder="Store Description"></textarea>
        </div>
    </div>

</div>

<div class="row mb-6">
    <h1 class="ml-5">Gallery </h1>
</div>

<div class="card-body">
    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Gallery Image</label>

        <div class="col-lg-4 fv-row">
            <input type="file" class="form-control form-control-lg form-control-solid" name="gallery_image"
                accept=".png, .jpg, .jpeg" />
        </div>

    </div>
</div>


<div class="row mb-6 mt-5">
    <h1>Bank Details</h1>
</div>

<div class="row mb-6">

    <label class="col-lg-2 col-form-label required fw-bold fs-6">Bank Name</label>
    <div class="col-lg-4 fv-row">
        <input type="text" class="form-control form-control-lg form-control-solid" name="bank_name"
            placeholder="Bank Name" />
    </div>

    <label class="col-lg-2 col-form-label required fw-bold fs-6">Branch Name</label>
    <div class="col-lg-4 fv-row">
        <input type="text" class="form-control form-control-lg form-control-solid" name="branch_name"
            placeholder="Branch Name" />
    </div>

</div>

<div class="row mb-6">

    <label class="col-lg-4 col-form-label required fw-bold fs-6">Holder Name</label>
    <input type="text" class="form-control form-control-lg form-control-solid" name="holder_name"
        placeholder="Holder Name" />
    <label class="col-lg-4 col-form-label required fw-bold fs-6">Account Number</label>
    <input type="text" class="form-control form-control-lg form-control-solid" name="account_number"
        placeholder="Account Number" />

</div>

<div class="row mb-6">
    <label class="col-lg-4 col-form-label required fw-bold fs-6">Other Information</label>
    <input type="text" class="form-control form-control-lg form-control-solid" name="other_info"
        placeholder="Other Information" />
</div>

<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\StoreRequest', 'form') !!}
@endpush