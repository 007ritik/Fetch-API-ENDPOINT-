<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
</head>
<body>
    <h1>User Data</h1>
    <table id="user-table" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, "https://jsonplaceholder.typicode.com/users");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $users_json = curl_exec($curl);
                curl_close($curl);

                $users = json_decode($users_json);

                if ($users) {
                    foreach ($users as $user) {
                        echo "<tr>";
                        echo "<td>{$user->id}</td>";
                        echo "<td>{$user->name}</td>";
                        echo "<td><a href='#' class='user-link' data-user-id='{$user->id}'>{$user->username}</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Error fetching user data</td></tr>";
                }
            ?>
        </tbody>
    </table>

    <div id="user-details"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#user-table').DataTable();

            $('#user-table').on('click', '.user-link', function(event) {
                event.preventDefault();
                var userId = $(this).data('user-id');
                fetchUserDetails(userId);
            });

            function fetchUserDetails(userId) {
                var userDetailsDiv = $('#user-details');

                $.ajax({
                    url: 'fetch_user_details.php',
                    method: 'GET',
                    data: { user_id: userId },
                    success: function(response) {
                        userDetailsDiv.html(response);
                    },
                    error: function() {
                        userDetailsDiv.html("<p>Error fetching user details</p>");
                    }
                });
            }
        });
    </script>
</body>
</html>
