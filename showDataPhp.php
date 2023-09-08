<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php Ajax</title>
    <style>
              body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        #main {
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #header {
            text-align: center;
            padding: 20px 0;
        }

        #table-load {
            text-align: center;
            padding: 20px 0;
        }

        #table-data {
            padding: 20px;
        }

        #load-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        #load-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <table id="main" border="0" cellspacing="0">

    <tr>
        <td id="header">
            <h1>PHP withAjax </h1>
        </td>
    </tr>
    <tr>
        <td id="table-load">

            <input type="button"id="load-button" value="Load data">
        </td>

    </tr>
    <tr>
        <td id="table-data">
           
        </td>
    </tr>
</table>    

<script src="js/code.jquery.com_jquery-3.7.0.min.js"></script>
<script>

    $(document).ready(function(){

        $("#load-button").on("click",function(e){
            $.ajax({
                url :"ajaxLoad.php",
                type :"POST",
                success : function(data){
                    $("#table-data").html(data);
                }
            });

    });
});

</script>
</body>
</html>