<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Subcategory Name </label>

        <div class="col-lg-4 fv-row">
            {!! Form::text('subcategory_name', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.subcategory_name', 1),
            ]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">SubCategory Image</label>

        <div class="col-lg-4 fv-row">
            @if ($subcategory->id)
                <input type="file" class="form-control form-control-lg form-control-solid" name="subcategory_image"
                    accept=".png, .jpg, .jpeg">
                <img src={{ env('APP_URL') }}/uploads/{{ $subcategory->subcategory_image }}
                    style="width:50px; height:50px; border-radius:1rem;" />
            @else
                <input type="file" class="form-control form-control-lg form-control-solid" name="subcategory_image"
                    accept=".png, .jpg, .jpeg">
            @endif
        </div>

    </div>


    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Description </label>
        <div class="col-lg-4 fv-row">
            {!! Form::textarea('subcategory_desc', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.description', 1),
            ]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Category Name</label>
        <div class="col-lg-4 fv-row">
            <select class="form-control form-control-solid" name="category_id">
                <option value="">Select Category</option>
                @foreach ($category as $data)
                    <option value="{{ $data->cat_id }}" {{ $subcategory->category_id == $data->cat_id ? 'selected' : '' }}>
                        {{ $data->category_name }}</option>
                @endforeach
            </select>
        </div>

    </div>
</div>
<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\EditSubcategoryRequest', 'form') !!}
@endpush