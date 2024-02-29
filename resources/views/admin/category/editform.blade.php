<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Category Name </label>

        <div class="col-lg-4 fv-row">
            {!! Form::text('category_name', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.category_name', 1),
            ]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Category Image</label>

        <div class="col-lg-4 fv-row">
            @if ($category->cat_id)
                <input type="file" class="form-control form-control-lg form-control-solid" name="category_image"
                    accept=".png, .jpg, .jpeg">
                <img src={{ env('APP_URL') }}/uploads/{{ $category->category_image }}
                    style="width:50px; height:50px; border-radius:1rem;" />
            @else
                <input type="file" class="form-control form-control-lg form-control-solid" name="category_image"
                    accept=".png, .jpg, .jpeg">
            @endif
        </div>

    </div>


    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Description </label>
        <div class="col-lg-12 fv-row">
            {!! Form::textarea('description', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.description', 1),
            ]) !!}
        </div>
    </div>

</div>
<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\EditCategoryRequest', 'form') !!}
@endpush
