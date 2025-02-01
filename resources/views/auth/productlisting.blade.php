<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets\css\productlisting.css') }}">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    </link>
    <title>productlisting</title>
</head>

<body>
    <style>
        .editbutton {
            padding: 8px 12px;
            text-decoration: none;
            color: #fff;
            background-color: rgb(2, 134, 2);
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .deletebutton {
            padding: 8px 12px;
            text-decoration: none;
            color: #fff;
            background-color: rgb(182, 10, 10);
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
    <h1>Product Management</h1>
    <h2>Product Listing</h2>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>





    <a href="{{ route('productform') }}" class="button">Add New Product</a>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#myTable').DataTable({
            "processing": true,
            "serverSide": true,
            ajax: "{{ route('productlisting') }}",
            order: [
                [0, 'desc']
            ],
            columns: [{
                    data: 'id',
                    name: 'id',
                    searchable: true
                },
                {
                    data: 'product_name',
                    name: 'product_name',
                    searchable: true
                },
                {
                    data: 'product_price',
                    name: 'product_price',
                    searchable: true
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    searchable: true
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
        });

        $(document).on('click', '.delete_button', function() {
            id = $(this).attr('data-id');

            $.ajax({
                type: 'DELETE',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ url('/product/delete') }}/' + id,
                success: function(respo) {
                    alert(respo);
                    table.clear().draw();
                }
            })
        });

        $(document).on('click', '.edit_button', function() {
             id = $(this).attr('data-id');

            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '{{ url('/product/edit') }}/' + id,
                success: function(response) {

                    $('#editModal').find('#product_name').val(response.product_name);
                    $('#editModal').find('#product_price').val(response.product_price);
                    $('#editModal').find('#id').val(response.id);
                    $('#editModal').modal('show');
                },
                error: function() {
                    alert('Error fetching product details.');
                }
            });
        });

        $('#editProductForm').on('submit', function(e) {
            e.preventDefault();
            var id = $('#productId').val();

            $.ajax({
                type: 'PUT',
                dataType: 'json',
                url: '{{ url('/product/update') }}/' + id,
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert('Product updated successfully!');
                    $('#editModal').modal('hide');
                    table.draw();
                },
                error: function() {
                    alert('Error updating product.');
                }
            });
        });

    });
</script>



</html>
