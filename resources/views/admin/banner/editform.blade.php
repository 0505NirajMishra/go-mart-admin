<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Banner Title</label>

        <div class="col-lg-4 fv-row">
            {!! Form::text('banner_title', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.banner_title', 1),
            ]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Banner Image</label>
        <div class="col-lg-4 fv-row">
            @if ($banner->banner_id)
                <input type="file" class="form-control form-control-lg form-control-solid" name="banner_image"
                    accept=".png, .jpg, .jpeg">
                <img src={{ env('APP_URL') }}/uploads/{{ $banner->banner_image }}
                    style="width:50px; height:50px; border-radius:1rem;" />
            @else
                <input type="file" class="form-control form-control-lg form-control-solid" name="banner_image"
                    accept=".png, .jpg, .jpeg">
            @endif
        </div>

    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Publish</label>
        <div class="col-lg-4 fv-row">
            <select name="banner_publish" class="form-control form-control-lg form-control-solid">
                <option value="">Select Yes / No</option>
                <option value="Yes" {{ $banner->banner_publish == 'Yes' ? 'selected' : '' }}>Yes</option>
                <option value="No" {{ $banner->banner_publish == 'No' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Set Order</label>

        <div class="col-lg-4 fv-row">
            {!! Form::number('set_order', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.set_order', 1),
            ]) !!}
        </div>

    </div>

</div>
<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\EditBannerRequest', 'form') !!}
@endpush