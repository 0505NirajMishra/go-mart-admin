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
                <input type="search" name="user_name" class="form-control search p-4"
                    placeholder="Search for User Name" />
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 table-responsive text-center">
                <table class="table table-bordered data-table text-center table-striped">
                    <thead>
                        <tr>
                            <th>Order ID </th>
                            <th>User </th>
                            <!--<th>Store Name </th>-->
                            <th>Amount </th>
                            <!--<th>Drivers </th>-->
                            <th>Date </th>
                            <th>Order Type </th>
                            <th>Order Status </th>
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
                url: "{{ route('admin.orders.index') }}",
                data: function(d) {
                    d.user_name = $('.search').val(),
                    d.search = $('input[type="search"]').val()
                }
            },
            columns: [
                {
                    data: 'order_no',
                    name: 'order_no'
                },
                {
                    data: 'user_name',
                    name: 'user_name'
                },
                // {
                //     data: 'Order_store_name',
                //     name: 'Order_store_name'
                // },
                {
                    data: 'order_amount',
                    name: 'order_amount'
                },
                // {
                //     data: 'dri_name',
                //     name: 'dri_name'
                // },
                {
                    data: 'order_date',
                    name: 'order_date'
                },
                {
                    data: 'order_type',
                    name: 'order_type'
                },
                {
                    data: 'order_status',
                    name: 'order_status',
                    render: function(data, type, full, meta) {
                        return '<select class="form-control status-change" data-order-id="' + full.id + '">' +
                            '<option value="0" ' + (data === '0' ? 'selected' : '') + '>Pending</option>' +
                            '<option value="1" ' + (data === '1' ? 'selected' : '') + '>Processing</option>' +
                            '<option value="2" ' + (data === '2' ? 'selected' : '') + '>Completed</option>' +
                            '<option value="3" ' + (data === '3' ? 'selected' : '') + '>Cancel</option>' +
                            '</select>';
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                },
            ]
        });

        $(".search").keyup(function() {
            table.draw();
        });

        $(document).on('change', '.status-change', function() {
            var orderId = $(this).data('order-id');
            var newStatus = $(this).val();

            $.ajax({
                url: "{{ route('admin.orders.update-status') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    order_id: orderId,
                    new_status: newStatus
                },
                success: function(response) {
                    if(response.success) {
                        // Show the success message
                        alert(response.message);
                        // You can also reload the DataTable or do any other necessary actions
                    } else {
                    }
                },
                error: function(xhr) {
                    // You can add any error handling here if needed
                    console.log(xhr.responseText);
                }
            });
        });

    });
</script>
</html>
