<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Name</label>

        <div class="col-lg-4 fv-row">
            {!! Form::text('store_name', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.store_name', 1),
            ]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Image</label>
        <div class="col-lg-4 fv-row">
            @if ($store->store_id)
                <input type="file" class="form-control form-control-lg form-control-solid" name="store_image"
                    accept=".png, .jpg, .jpeg">
                <img src={{ env('APP_URL') }}/uploads/{{ $store->store_image }}
                    style="width:50px; height:50px; border-radius:1rem;" />
            @else
                <input type="file" class="form-control form-control-lg form-control-solid" name="store_image"
                    accept=".png, .jpg, .jpeg">
            @endif
        </div>

    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Phone</label>
        <div class="col-lg-4 fv-row">
            {!! Form::number('store_phone', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.store_phone', 1),
            ]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Address</label>
        <div class="col-lg-4 fv-row">
            {!! Form::text('store_address', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.store_address', 1),
            ]) !!}
        </div>

    </div>

    <div class="row mb-6">
        <p>* Don't Know your cordinates ? use <a href="https://www.latlong.net/" 
            target="_blank"
            style="color:green;">Latitude and Longitude Finder</a></p>
    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Category Name</label>
        <div class="col-lg-4 fv-row">
            <select class="form-control form-control-solid" name="category_name">
                <option value="">Select Category</option>
                @foreach ($categories as $data)
                    <option value="{{ $data->cat_id }}" {{ $store->category_name == $data->cat_id ? 'selected' : '' }}>
                        {{ $data->category_name }}</option>
                @endforeach
            </select>
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Latitude</label>
        <div class="col-lg-4 fv-row">
            {!! Form::text('store_latitude', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.store_latitude', 1),
            ]) !!}
        </div>

    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Longitude</label>
        <div class="col-lg-4 fv-row">
            {!! Form::text('store_longitude', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.store_longitude', 1),
            ]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Status</label>
        <div class="col-lg-4 fv-row">
            <select name="store_status" class="form-control form-control-lg form-control-solid">
                <option value="">Select Open / Close</option>
                <option value="0" {{ $store->store_status == 0 ? 'selected' : '' }}>Close</option>
                <option value="1" {{ $store->store_status == 1 ? 'selected' : '' }}>Open</option>
            </select>
        </div>

    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Active</label>
        <div class="col-lg-4 fv-row">
            <select name="store_active" class="form-control form-control-lg form-control-solid">
                <option value="">Select Enable / Disable</option>
                <option value="0" {{ $store->store_active == 0 ? 'selected' : '' }}>Enable</option>
                <option value="1" {{ $store->store_active == 1 ? 'selected' : '' }}>Disable</option>
            </select>
        </div>
    </div>

    <div class="row mb-6">
        <label class="col-lg-4col-form-label required fw-bold fs-6">Store Description</label>
        <div class="col-lg-12 fv-row">
            {!! Form::textarea('store_description', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.store_description', 1),
            ]) !!}
        </div>
    </div>

    <label class="col-lg-2 col-form-label required fw-bold fs-6">Gallery Image</label>
    <div class="col-lg-4 fv-row">
        @if ($gallerys->gallery_id)
            <input type="file" class="form-control form-control-lg form-control-solid" name="gallery_image"
                accept=".png, .jpg, .jpeg">
            <img src={{ env('APP_URL') }}/uploads/{{ $gallerys->gallery_image }}
                style="width:50px; height:50px; border-radius:1rem;" />
        @else
            <input type="file" class="form-control form-control-lg form-control-solid" name="gallery_image"
                accept=".png, .jpg, .jpeg">
        @endif
    </div>

    <div class="row mb-6">
        <h1>Bank Details</h1>
    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Bank Name</label>
        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="bank_name"
                value="{{ $bank_details->bank_name }}" placeholder="Bank Name" />
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Branch Name</label>
        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid"
                value="{{ $bank_details->branch_name }}" name="branch_name" placeholder="Branch Name" />
        </div>

    </div>

    <div class="row mb-6">

        <label class="col-lg-4 col-form-label required fw-bold fs-6">Holder Name</label>
        <input type="text" class="form-control form-control-lg form-control-solid"
            value="{{ $bank_details->holder_name }}" name="holder_name" placeholder="Holder Name" />
        <label class="col-lg-4 col-form-label required fw-bold fs-6">Account Number</label>
        <input type="text" class="form-control form-control-lg form-control-solid"
            value="{{ $bank_details->account_number }}" name="account_number" placeholder="Account Number" />

    </div>

    <div class="row mb-6">
        <label class="col-lg-4 col-form-label required fw-bold fs-6">Other Information</label>
        <input type="text" class="form-control form-control-lg form-control-solid"
            value="{{ $bank_details->other_info }}" name="other_info" placeholder="Other Information" />
    </div>

</div>

<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\EditStoreRequest', 'form') !!}
@endpush