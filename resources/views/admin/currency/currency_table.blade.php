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

        <div class="row mt-3">
            <div class="col-4" style="float:right;">
                <input 
                    type="search" 
                    name="name" 
                    class="form-control searchEmail"
                    placeholder="Search for Carrency Name" 
                />
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 table-responsive text-center">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Symbol</th>
                            <th>Symbol At Right</th>
                            <th>Currency Status</th>
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
                url: "{{ route('admin.currencys.index') }}",
                data: function(d) {
                    d.name = $('.searchEmail').val(),
                    d.search = $('input[type="search"]').val()
                }
            },
            columns: [
                {
                    data: 'currency_id',
                    name: 'currency_id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'code',
                    name: 'code'
                },
                {
                    data: 'symbol',
                    name: 'symbol'
                },
                {
                    data: 'symbol_at_right',
                    name: 'symbol_at_right'
                },
                {
                    data: 'currency_status',
                    name: 'currency_status'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });

        $(".searchEmail").keyup(function() {
            table.draw();
        });
        
    });
</script>

</html>