<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Subject</label>

        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="notification_subject"
                placeholder="Notification Subject">
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Send To</label>

        <div class="col-lg-4 fv-row">
            <select name="notification_send_to" class="form-control form-control-lg form-control-solid">
                <option value="">Select Send To</option>
                <option value="0">Store</option>
                <option value="1">Customer</option>
                <option value="2">Driver</option>
            </select>
        </div>

    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Message</label>
        <div class="col-lg-4 fv-row">
            {!! Form::textarea('notification_message', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.notification_message', 1),
            ]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Date</label>
        <div class="col-lg-4 fv-row">

            {!! Form::date('notification_date', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.notification_date', 1),
            ]) !!}

        </div>

    </div>

</div>
<!--end::Card body-->


@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\NotificationRequest', 'form') !!}
@endpush
