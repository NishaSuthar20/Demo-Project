<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets\css\userlisting.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    </link>
    <title>userlisting</title>
</head>

<body>
    <h2>User Listing</h2>
    <table id="tableID" class="display">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email ID</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>


<a href="#" id="addEmailBtn"><button>Add Email</button></a>


<div id="emailForm" style="display: none; margin-top: 10px;">
    <input type="text" id="user_name" placeholder="Enter Name"><br><br>
    <input type="email" id="user_email" placeholder="Enter Email"><br>
    <button id="saveEmail">Save</button>
</div>



<div class="emailEditForm" style="display: none; margin-top: 10px;">
    <input type="text" id="user_name_edit" placeholder="Enter Name"><br><br>
    <input type="email" id="user_email_edit" placeholder="Enter Email"><br>
    <button id="editEmail">Save</button>
</div>



</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
 $(document).ready(function () {
         var table= $('#tableID').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('userlisting') }}",
            columns: [
               { data: 'id', name: 'id'},
               { data: 'user_name', name: 'user_name' },
                { data: 'user_email', name: 'user_email' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
        $("#addEmailBtn").click(function () {
            $("#emailForm").toggle();
        });

        $("#saveEmail").click(function (e) {
            e.preventDefault();

            var userName = $("#user_name").val();
            var userEmail = $("#user_email").val();

            $.ajax({
                url: "{{ route('add.user') }}",
                type: "POST",
                data: {
                    user_name: userName,
                    user_email: userEmail,

                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    alert(response.message);
                    $('#emailForm').hide();
                    table.ajax.reload();
                },
                error: function (xhr) {
                    alert("Error: " + xhr.responseText);
                }
            });
        });

        $(document).on("click", ".edit_button", function () {
            var id = $(this).data("id");

            $.ajax({
                url: "{{ url('user/get') }}/" + id,
                type: "GET",
                success: function (response) {
                    $("#user_name_edit").val(response.user_name);
                    $("#user_email_edit").val(response.user_email);
                    $("#editEmail").data("id", id);
                    $(".emailEditForm").show();
                }
            });
        });

        $("#editEmail").click(function () {
            var id = $(this).data("id");
            var userName = $("#user_name_edit").val();
            var userEmail = $("#user_email_edit").val();

            $.ajax({
                url: "{{ url('user/edit') }}/" + id,
                type: "PUT",
                data: {
                    user_name: userName,
                    user_email: userEmail,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    alert(response.message);
                    $(".emailEditForm").hide();
                    table.ajax.reload();
                },
                error: function (xhr) {
                    alert("Error: " + xhr.responseText);
                }
            });
        });


        $(document).on('click', '.delete_button', function() {
            id = $(this).attr('data-id');

            $.ajax({
                type: 'DELETE',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ url('/user/delete') }}/' + id,
                success: function(respo) {
                    alert(respo);
                    table.clear().draw();
                }
            })
        });

    });
</script>
</html>
