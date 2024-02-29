<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Driver Name</label>

        <div class="col-lg-4 fv-row">
            {!! Form::text('driver_name', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.driver_name', 1),
            ]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Driver Image</label>
        <div class="col-lg-4 fv-row">
            @if ($driver->driver_id)
                <input type="file" class="form-control form-control-lg form-control-solid" name="driver_image"
                    accept=".png, .jpg, .jpeg">
                <img src={{ env('APP_URL') }}/uploads/{{ $driver->driver_image }}
                    style="width:50px; height:50px; border-radius:1rem;" />
            @else
                <input type="file" class="form-control form-control-lg form-control-solid" name="driver_image"
                    accept=".png, .jpg, .jpeg">
            @endif
        </div>

    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Driver Phone Number</label>
        <div class="col-lg-4 fv-row">
            {!! Form::number('driver_phone_number', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.driver_phone_number', 1),
            ]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Driver Email</label>
        <div class="col-lg-4 fv-row">
            {!! Form::text('driver_email', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.driver_email', 1),
            ]) !!}
        </div>

    </div>

    <div class="row mb-6">
        <p>* Don't Know your cordinates ? use <a href="https://www.latlong.net/" 
            target="_blank"
            style="color:green;">Latitude and Longitude Finder</a>
        </p>
    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Driver Longitude</label>

        <div class="col-lg-4 fv-row">
            {!! Form::text('driver_longitude', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.driver_longitude', 1),
            ]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Driver Latitude</label>

        <div class="col-lg-4 fv-row">
            {!! Form::text('driver_latitude', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.driver_latitude', 1),
            ]) !!}
        </div>

    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Name</label>
        <div class="col-lg-4 fv-row">
            <select class="form-control form-control-solid" name="store_name">
                <option value="">Select Store Name</option>
                @foreach ($stores as $data)
                    <option value="{{ $data->store_id }}"
                        {{ $driver->store_name == $data->store_id ? 'selected' : '' }}>
                        {{ $data->store_name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mb-6">
        <label class="col-lg-4 col-form-label required fw-bold fs-6">Driver Description</label>
        <div class="col-lg-12 fv-row">
            {!! Form::textarea('driver_address', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.driver_address', 1),
            ]) !!}
        </div>
    </div>

    <div class="row mb-6">
        <h1>Car Details</h1>
    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Car Number</label>
        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid"
                value="{{ $cars->car_number }}" name="car_number" placeholder="Car Number" />
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Car Name</label>
        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" value="{{ $cars->car_name }}"
                placeholder="Car Name" name="car_name" />
        </div>

    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Car Image</label>
        <div class="col-lg-4 fv-row">
            @if ($cars->car_id)
                <input class="form-control form-control-lg form-control-solid" type="file" name="car_image"
                    accept=".png, .jpg, .jpeg">
                <img src={{ env('APP_URL') }}/uploads/{{ $cars->car_image }}
                    style="width:50px; height:50px; border-radius:1rem;" />
            @else
                <input type="file" class="form-control form-control-lg form-control-solid" name="car_image"
                    accept=".png, .jpg, .jpeg">
            @endif
        </div>
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
    {!! JsValidator::formRequest('App\Http\Requests\Admin\EditDriverRequest', 'form') !!}
@endpush