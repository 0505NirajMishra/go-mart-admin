<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Name</label>

        <div class="col-lg-4 fv-row">
            {!! Form::text('name', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.category_name', 1),
            ]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Code</label>

        <div class="col-lg-4 fv-row">
            {!! Form::text('code', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.category_name', 1),
            ]) !!}
        </div>


    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Symbol</label>

        <div class="col-lg-4 fv-row">
            {!! Form::text('symbol', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.category_name', 1),
            ]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Currency Status</label>

        <div class="col-lg-4 fv-row">
            <select class="form-control form-control-lg form-control-solid" name="currency_status">
                <option value="">Selecy Yes/No</option>
                <option value="0" {{ $currency->currency_status == 0 ? 'selected' : '' }} >Active</option>
                <option value="1" {{ $currency->currency_status == 1 ? 'selected' : '' }} >Deactive</option>
            </select>
        </div>


    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Symbol At Right</label>

        <div class="col-lg-4 fv-row">
            <select class="form-control form-control-lg form-control-solid" name="symbol_at_right">
                <option value="">Selecy Yes/No</option>
                <option value="0" {{ $currency->symbol_at_right == 0 ? 'selected' : '' }}>Yes</option>
                <option value="1" {{ $currency->symbol_at_right == 1 ? 'selected' : '' }}>No</option>
            </select>
        </div>

    </div>


</div>
<!--end::Card body-->


@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\EditCategoryRequest', 'form') !!}
@endpush