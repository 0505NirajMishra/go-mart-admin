<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Language Name</label>

        <div class="col-lg-4 fv-row">
            {!! Form::text('language_name', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.language_name', 1),
            ]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Language Slug</label>

        <div class="col-lg-4 fv-row">
            {!! Form::text('language_slug', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.language_slug', 1),
            ]) !!}
        </div>

    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Language Status</label>

        <div class="col-lg-4 fv-row">
            <select class="form-control form-control-lg form-control-solid" name="language_status">
                <option value="">Selecy Yes/No</option>
                <option value="0" {{ $language->language_status == 0 ? 'selected' : '' }}>Yes</option>
                <option value="1" {{ $language->language_status == 1 ? 'selected' : '' }}>No</option>
            </select>
        </div>

    </div>

</div>
<!--end::Card body-->


@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\LanguageRequest', 'form') !!}
@endpush