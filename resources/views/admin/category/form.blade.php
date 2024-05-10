<div class="card-body">

    <!--begin::Input group-->



        <div class="row mb-6">

            <label class="col-lg-2 col-form-label required fw-bold fs-6">Category Name</label>
            <div class="col-lg-4 fv-row">
                <input type="text" name="category_name" class="form-control form-control-lg form-control-solid"
                    placeholder="category name" />
            </div>

            <label class="col-lg-2 col-form-label required fw-bold fs-6">Category Image</label>
            <div class="col-lg-4 fv-row">
                <input type="file" class="form-control form-control-lg form-control-solid" name="category_image"
                    accept=".png, .jpg, .jpeg">
            </div>

        </div>

        <div class="row mb-6">

            <label class="col-lg-2 col-form-label required fw-bold fs-6">Description</label>
            <div class="col-lg-12 fv-row">
                <textarea name="description" class="form-control form-control-lg form-control-solid" placeholder="description"></textarea>
            </div>

        </div>

</div>

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\CategoryRequest', 'form') !!}
@endpush

<!--end::Card body-->
