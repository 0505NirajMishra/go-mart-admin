<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Subcategory Name</label>
        <div class="col-lg-4 fv-row">
            <input 
                type="text" name="subcategory_name" 
                class="form-control form-control-lg form-control-solid"
                placeholder="subcategory name" />
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Subcategory Image</label>
        <div class="col-lg-4 fv-row">
            <input type="file" class="form-control form-control-lg form-control-solid" name="subcategory_image"
                accept=".png, .jpg, .jpeg">
        </div>

    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Description</label>
        <div class="col-lg-4 fv-row">
            <textarea name="subcategory_desc" class="form-control form-control-lg form-control-solid" placeholder="description"></textarea>
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Select Category</label>

        <div class="col-lg-4 fv-row">
            <select class="form-control form-control-solid" name="category_id">
                <option value="">Select Category</option>
                @foreach ($category as $data)
                    <option value="{{ $data->cat_id }}">{{ $data->category_name }}</option>
                @endforeach
            </select>
        </div>

    </div>


</div>

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\SubcategoryRequest', 'form') !!}
@endpush

<!--end::Card body-->
