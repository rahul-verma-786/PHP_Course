
<?php include "admindashboard.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link href="search.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="./script.js"></script>
</head>
<body>
    <h3>Search User</h3>
    <form action="" method="post">
        <input type="text" name="search" id="search" required autocomplete="off">
        <button type="submit">Search</button>
    </form>
    <div class="resultdata"></div>
<script>

$(document).ready(function () {
    $("#search").keyup(function () {
        var searchValue = $(this).val();
        if (searchValue !== "") {
            $.ajax({
                url: "livesearch.php",
                method: "post",
                data: { searchvalue: searchValue }, 
                success: function (data) {
                    $(".resultdata").html(data);
                }
            });
        } else {
          $(".resultdata").css("display","none");
        }
    });
});
</script>
</body>
</html>