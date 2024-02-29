<!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>

<body>
    <div class="container-fluid">

        <div class="row mt-5 justify-content-center">
            <div class="col-md-3 col-sm-3 col-xl-3 col-lg-3">
                <input type="search" name="store_name" class="form-control search p-4"
                    placeholder="Search for Store Name" />
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 table-responsive">
                <table class="table table-bordered data-table table-striped text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image </th>
                            <th>Store Name </th>
                            <th>Category Name </th>
                            <th>Address </th>
                            <th>Phone </th>
                            <th>Status </th>
                            <th>Active </th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

    </div>
</body>
<script type="text/javascript">
    $(function() {

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.stores.index') }}",
                data: function(d) {
                    d.store_name = $('.search').val(),
                    d.search = $('input[type="search"]').val()
                }
            },
            columns: [
                {
                    data: 'store_id',
                    name: 'store_id',
                },
                {
                    data: 'store_image',
                    name: 'store_image',
                    render: function(data) {
                        return '<img src="{{ env('APP_URL') }}/uploads/' + data +
                            '" class="avatar" width="50" height="50"/>';
                    }
                },
                {
                    data: 'store_name',
                    name: 'store_name',
                },
                {
                    data: 'category_name',
                    name: 'category_name',
                },
                {
                    data: 'store_address',
                    name: 'store_address',
                },
                {
                    data: 'store_phone',
                    name: 'store_phone',
                },
                {
                    data: 'store_status',
                    name: 'store_status',
                },
                {
                    data: 'store_active',
                    name: 'store_active',
                },
                {
                    data: 'action',
                    name: 'action',
                }
            ]
        });

        $(".search").keyup(function() {
            table.draw();
        });

    });
</script>

</html>