<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets\css\productlisting.css') }}">
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
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product as $prod)
                <tr>
                    <td>{{ $prod->product_name }}</td>
                    <td>{{ $prod->product_price }}</td>
                    <td>
                        {{-- <button class="editbutton" id="edit_btn">Edit</button> --}}
                        <button class="editbutton" data-id="{{ $prod->id }}" data-name="{{ $prod->product_name }}" data-price="{{ $prod->product_price }}">Edit</button>
                        <button class="deletebutton">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table><br>


    <a href="{{ route('productform') }}" class="button">Add New Product</a>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
   <script>
    $(document).ready(function () {
        $('button').on('click', function () {
         alert("clicked button...");
        });
    });
</script>



</html>
