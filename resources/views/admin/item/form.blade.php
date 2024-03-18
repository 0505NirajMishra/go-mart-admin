<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Item Name</label>

        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="item_name"
                placeholder="item name">
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Item Price</label>

        <div class="col-lg-4 fv-row">
            <input type="number" class="form-control form-control-lg form-control-solid" name="item_price"
                placeholder="item price">
        </div>

    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Category</label>

        <div class="col-lg-4 fv-row">
            <select class="form-control form-control-solid" name="category_id">
                <option value="">Select Category</option>
                @foreach ($categories as $data)
                    <option value="{{ $data->cat_id }}">{{ $data->category_name }}</option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Item Quantity</label>

        <div class="col-lg-4 fv-row">
            <input type="number" class="form-control form-control-lg form-control-solid" name="quantity"
                placeholder="Quantity">
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Item Image</label>

        <div class="col-lg-4 fv-row">
            <input type="file" class="form-control form-control-lg form-control-solid" name="item_image"
                accept=".png, .jpg, .jpeg">
        </div>

    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Publish</label>
        <div class="col-lg-4 fv-row">
            <select name="item_publish" class="form-control form-control-lg form-control-solid">
                <option value="">Select Yes / No</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Name</label>

        <div class="col-lg-4 fv-row">
            <select class="form-control form-control-solid" name="store_id">
                <option value="">Select Store Name</option>
                @foreach ($stores as $data)
                    <option value="{{ $data->store_id }}">{{ $data->store_name }}</option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="row mt-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Item Weight</label>

        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="item_weight[]"
                placeholder="Item weight kg/unit">
        </div>

        <table class="table table-bordered" id="dynamicAddRemove">
            <div class="row mb-6">
                <div class="col-lg-4 fv-row">
                    <button type="button" name="add" id="dynamic-ar" class="btn btn-primary mt-2">Add Item
                        Weight</button>
                </div>
            </div>
        </table>

    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Description</label>
        <div class="col-lg-4 fv-row">
            <textarea name="item_description" class="form-control form-control-lg form-control-solid" placeholder="Description"></textarea>
        </div>
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Item Expiry Date</label>
        <div class="col-lg-4 fv-row">
            <input type="date" class="form-control form-control-lg form-control-solid" name="item_expiry_date"
                placeholder="Item Expiry Date">
        </div>

    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Organic Image</label>
        <div class="col-lg-4 fv-row">
            <input
                type="file"
                class="form-control form-control-lg form-control-solid"
                name="organic_image"
                accept=".png, .jpg, .jpeg">
        </div>
    </div>

</div>
<!--end::Card body-->

@push('scripts')

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">
        var i = 0;
        $("#dynamic-ar").click(function() {
            ++i;
            $("#dynamicAddRemove").append(
                '<tr><td><div style="margin-left:2rem;"></div></td><td><div class="col-md-10 fv-row" style="margin-left:22%;"><label class="col-lg-6 col-form-label required fw-bold fs-6">Item weight Kg/Unit</label><input type="text"name="item_weight[]" placeholder="Enter Item Weight Kg/Unit" class="form-control form-control-lg form-control-solid item-weight-input" /></div></td><div style="margin-left:4rem;"></div> <td><div class="col-md-10 fv-row" style="margin-left:22%;"></div></td><td><div style="margin-top:35px;"><button type="button" class="btn btn-danger remove-input-field" style="margin-left:15%;" >Delete</button></div></td></tr>'
            );
        });
        $(document).on('click', '.remove-input-field', function() {
            $(this).parents('tr').remove();
        });

        $("#submit-btn").click(function() {
            var itemWeights = [];
            var isValid = true;

            $(".item-weight-input").each(function() {
                var weight = $(this).val().trim();
                if (itemWeights.indexOf(weight) !== -1) {
                    isValid = false;
                    return false;
                }
                itemWeights.push(weight);
            });

            if (!isValid) {
                alert("Duplicate item weights are not allowed.");
                return false;
            }
        });

    </script>

    <script type="text/javascript">
        var i = 0;
        $("#dynamic-addons").click(function() {
            ++i;
            $("#dynamicAddaddons").append(
                '<tr><td><div  style="margin-left:2rem;"></div></td><td><div class="col-md-10 fv-row" style="margin-left:22%;"><label class="col-lg-2 col-form-label required fw-bold fs-6">Title</label><input type="text"name="addons_title[]" placeholder="Enter Title" class="form-control form-control-lg form-control-solid" /></div></td><div  style="margin-left:4rem;"></div> <td><div class="col-md-10 fv-row" style="margin-left:22%;"><label class="col-lg-4 col-form-label required fw-bold fs-6">Price</label><input type="text" name="addons_price[]" placeholder="Enter Price" class="form-control form-control-lg form-control-solid" /></div></td><td><div style="margin-top:35px;"><button type="button" class="btn btn-danger remove-add-addons" style="margin-left:15%;" >Delete</button></div></td></tr>'
            );
        });
        $(document).on('click', '.remove-add-addons', function() {
            $(this).parents('tr').remove();
        });
    </script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\ItemRequest', 'form') !!}
@endpush
