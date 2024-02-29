<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Order Review</label>

        <div class="col-lg-4 fv-row">
            {!! Form::text('order_review', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.order_review', 1),
            ]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Order Rate</label>

        <div class="col-lg-4 fv-row">
            {!! Form::number('order_rate', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.order_rate', 1),
            ]) !!}
        </div>

    </div>
</div>
<!--end::Card body-->