<!--begin::Input group-->
<div class="row mb-5">
	<!--begin::Col-->
	<div class="col-md-6 fv-row">
		<!--begin::Label-->
		<label class="required fs-5 fw-bold mb-2">{{trans_choice('content.name_title', 1)}}</label>
		<!--end::Label-->
		<!--begin::Input-->
		{!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control form-control-solid')) !!}
		<!--end::Input-->
		@if($errors->has('name'))
		<span style="color:red">{{$errors->first('name')}}</span>
		@endif
	</div>
	<!--end::Col-->
</div>
<!--end::Input group-->

<!--begin::Input group-->
<div class="row mb-5">
	<!--begin::Col-->
	<div class="col-md-6 fv-row">
		<!--end::Label-->
		<label class="required fs-5 fw-bold mb-2">{{trans_choice('content.permission_title', 2)}}</label><br>
		<!--end::Label-->
		<!--end::Input-->
		@foreach($permissions as $key => $value)
		{{ Form::checkbox('permissions[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'name', 'id'=>'permission'.$key]) }}
		<label class="fs-5 fw-bold mb-2" for="permission{{$key}}">{{ $value->name }}</label><br>
		@endforeach
		<!--end::Input-->
	</div>
	<!--end::Col-->
</div>
<!--end::Input group-->

<!--begin::Separator-->
<div class="separator mb-8"></div>
<!--end::Separator-->