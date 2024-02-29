<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Item Name</label>

        <div class="col-lg-4 fv-row">
            {!! Form::text('item_name', null, [
            'value' => 2,
            'class' => 'form-control form-control-lg form-control-solid',
            'placeholder' => trans_choice('content.item_name', 1),
            ]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Item Price</label>

        <div class="col-lg-4 fv-row">
            {!! Form::number('item_price', null, [
            'value' => 2,
            'class' => 'form-control form-control-lg form-control-solid',
            'placeholder' => trans_choice('content.item_price', 1),
            ]) !!}
        </div>

    </div>

    <div class="row mb-6">

        {{--  <label class="col-lg-2 col-form-label required fw-bold fs-6">Discount Price</label>

        <div class="col-lg-4 fv-row">
            {!! Form::number('dis_item_price', null, [
            'value' => 2,
            'class' => 'form-control form-control-lg form-control-solid',
            'placeholder' => trans_choice('content.item_discount', 1),
            ]) !!}

        </div>  --}}

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Category</label>

        <div class="col-lg-4 fv-row">
            <select class="form-control form-control-solid" name="category_id">
                <option value="">Select Category</option>
                @foreach ($categories as $data)
                <option value="{{ $data->cat_id }}" {{ $item->category_id == $data->cat_id ? 'selected' : '' }}>
                    {{ $data->category_name }}</option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Item Image</label>

        <div class="col-lg-4 fv-row">
            @if ($item->item_id)
            <input type="file" class="form-control form-control-lg form-control-solid" name="item_image"
                accept=".png, .jpg, .jpeg">
            <img src={{ env('APP_URL') }}/uploads/{{ $item->item_image }}
            style="width:50px; height:50px; border-radius:1rem;" />
            @else
            <input type="file" class="form-control form-control-lg form-control-solid" name="item_image"
                accept=".png, .jpg, .jpeg">
            @endif
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Publish</label>
        <div class="col-lg-4 fv-row">
            <select name="item_publish" class="form-control form-control-lg form-control-solid">
                <option value="">Select Yes / No</option>
                <option value="Yes" {{ $item->item_publish == 'Yes' ? 'selected' : '' }}>Yes</option>
                <option value="No" {{ $item->item_publish == 'No' ? 'selected' : '' }}>No</option>
            </select>
        </div>

    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Item Quantity</label>

        <div class="col-lg-4 fv-row">
            {!! Form::number('quantity', null, [
            'value' => 2,
            'class' => 'form-control form-control-lg form-control-solid',
            'placeholder' => trans_choice('content.quantity', 1),
            ]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Name</label>

        <div class="col-lg-4 fv-row">
            <select class="form-control form-control-solid" name="store_id">
                <option value="">Select Store Name</option>
                @foreach ($stores as $data)
                <option value="{{ $data->store_id }}" {{ $item->store_id == $data->store_id ? 'selected' : '' }}>
                    {{ $data->store_name }}</option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="row mt-6">
        <?php $highLightsFrench = json_decode($item->item_weight); ?>
        @if($highLightsFrench !== null)
        <table class="table table-bordered" id="dynamicAddRemove">
            <div class="row mb-6">
                <div class="col-lg-4 fv-row">
                    <button type="button" name="add" id="dynamic-ar" class="btn btn-primary mt-2">
                        Add Item
                        Weight
                    </button>
                </div>
                <label class="col-lg-2 col-form-label required fw-bold fs-6">Item weight kg/Unit</label>
                <div class="col-lg-4 fv-row">



                    <input type="text" name="item_weight[]" value="{{ $highLightsFrench[0] }}"
                        placeholder="Enter Highlight English" class="form-control form-control-lg form-control-solid"
                        maxlength="100" />
                </div>

            </div>

    </div>
</table>

@else

<div class="row mt-6">
    <table class="table table-bordered" id="dynamicAddRemove">
        <div class="row mb-6">
            <div class="col-lg-4 fv-row">
                <button type="button" name="add" id="dynamic-ar" class="btn btn-primary mt-2">Add Item
                    Weight</button>
            </div>
        </div>
    </table>
</div>

@endif
</div>

<div class="row mb-6">
    <label class="col-lg-2 col-form-label required fw-bold fs-6">Description</label>
    <div class="col-lg-4 fv-row">
        {!! Form::textarea('item_description', null, [
        'value' => 2,
        'class' => 'form-control form-control-lg form-control-solid',
        'placeholder' => trans_choice('content.item_description', 1),
        ]) !!}
    </div>

    <label class="col-lg-2 col-form-label required fw-bold fs-6">Item Date Expiry</label>
    <div class="col-lg-4 fv-row">
        {!! Form::text('item_expiry_date', null, [
        'value' => 2,
        'class' => 'form-control form-control-lg form-control-solid',
        'placeholder' => trans_choice('content.item_expiry_date', 1),
        ]) !!}
    </div>

</div>

<div class="row mb-6">

    <label class="col-lg-2 col-form-label required fw-bold fs-6">Organic Image</label>
    <div class="col-lg-4 fv-row">
        @if ($item->item_id)
        <input type="file" class="form-control form-control-lg form-control-solid" name="organic_image"
            accept=".png, .jpg, .jpeg">
        <img src={{ env('APP_URL') }}/uploads/{{ $item->organic_image }}
        style="width:50px; height:50px; border-radius:1rem;" />
        @else
        <input type="file" class="form-control form-control-lg form-control-solid" name="organic_image"
            accept=".png, .jpg, .jpeg">
        @endif
    </div>

</div>

</div>
<!--end::Card body-->

@push('scripts')

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">

    $(document).ready(function() {
        // Function to check for duplicate item weights
        function checkDuplicateWeights() {
            var itemWeights = {};
            var hasDuplicates = false;
            $('input[name="item_weight[]"]').each(function() {
                var weight = $(this).val();
                if (weight in itemWeights) {
                    hasDuplicates = true;
                    return false; // Exit the loop if duplicate found
                } else {
                    itemWeights[weight] = true;
                }
            });
            return hasDuplicates;
        }

        // Submit event handler for the form
        $('form').submit(function(event) {
            if (checkDuplicateWeights()) {
                // If duplicates found, prevent form submission
                event.preventDefault();
                alert('Duplicate item weights are not allowed.');
            }
        });

    });

    var i = 0;
        $("#dynamic-ar").click(function() {
            ++i;
            $("#dynamicAddRemove").append(
                '<tr><td><div style="margin-left:2rem;"></div></td><td><div class="col-md-10 fv-row" style="margin-left:22%;"><label class="col-lg-6 col-form-label required fw-bold fs-6">Item weight Kg/Unit</label><input type="text"name="item_weight[]" placeholder="Enter Item Weight Kg/Unit" class="form-control form-control-lg form-control-solid" /></div></td><div style="margin-left:4rem;"></div> <td><div class="col-md-10 fv-row" style="margin-left:22%;"></div></td><td><div style="margin-top:35px;"><button type="button" class="btn btn-danger remove-input-field" style="margin-left:15%;" >Delete</button></div></td></tr>'
            );
        });
        $(document).on('click', '.remove-input-field', function() {
            $(this).parents('tr').remove();
        });
</script>

<script>
    $(document).ready(function() {

            @if($highLightsFrench !== null)
            <?php  for( $i=1; $i<count($highLightsFrench); $i++){ ?>

                $("#dynamicAddRemove").append(
                    '<tr><td><div style="margin-left:2rem;"></div></td><td><div class="col-md-10 fv-row" style="margin-left:22%;"><label class="col-lg-6 col-form-label required fw-bold fs-6">Item weight Kg/Unit</label><input type="text" name="item_weight[]" value="{{ $highLightsFrench[$i] }}"  placeholder="Enter Item Weight Kg/Unit" class="form-control form-control-lg form-control-solid" /></div></td><div style="margin-left:4rem;"></div> <td><div class="col-md-10 fv-row" style="margin-left:22%;"></div></td><td><div style="margin-top:35px;"><button type="button" class="btn btn-danger remove-input-field" style="margin-left:15%;" >Delete</button></div></td></tr>'
                );

                <?php } ?>
                @else

                @endif
            })



</script>

<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Admin\EditItemRequest', 'form') !!}
@endpush
