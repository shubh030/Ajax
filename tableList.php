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
            background-image: url('background-image.jpg'); /* Replace with your background image */
            background-size: cover;
            background-repeat: no-repeat;
        }

        #header{
            background-color: rgba(52, 152, 219, 0.8); /* Transparent blue background */
            color: white;
            padding: 20px;
            text-align: center;
        }

        #main {
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
            border-radius: 5px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            margin: 20px auto;
            max-width: 600px;
        }

        #table-load {
            padding: 20px;
            border-bottom: 1px solid #ccc;
        }

        #table-load form input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-bottom: 2px solid #3498db;
            outline: none;
            transition: border-bottom 0.3s ease-in-out;
        }

        #table-load form input[type="text"]:focus {
            border-bottom: 2px solid #e74c3c;
        }

        #Save-button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        #Save-button:hover {
            background-color: #2980b9;
        }

        #table-data {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .delete-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .edit-btn {
            background-color: #27ae60; /* Updated color */
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }

        .edit-btn:hover {
            background-color: #219653; /* Updated hover color */
        }

        /* Transparent Modal */
        #modal {
            background: rgba(0, 0, 0, 0.7);
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 100;
            display: none;
        }

        #modal-form {
            background: #fff;
            width: 30%;
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 15px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5); /* Added box shadow */
        }

        #modal-form h2 {
            margin: 0 0 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #000;
        }

        #close-btn {
            background: red;
            color: white;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            border-radius: 50%;
            position: absolute;
            top: -15px;
            right: -15px;
            cursor: pointer;
        }

        #modal-form table {
            width: 100%;
        }

        #modal-form table td {
            padding: 5px;
        }

        #modal-form table .input-container {
            display: flex;
        }

        #modal-form table .input-container input {
            flex: 1;
            margin-right: 10px;
        }
    </style>
</head>

<body>

    <table id="main" border="0" cellspacing="0">

        <tr>
            <td id="header">
                <h1>PHP jQuery & Ajax </h1>
                <div id="search-bar">
                    <label for="">Search:</label>
                    <input type="text" id="search" autocomplete="off">
                </div>
            </td>
        </tr>
        <tr>
            <td id="table-load">
                <form id="addForm">


                    First Name<input type="text" id="fname">
                    Last Name<input type="text" id="lname">
                    <input type="button" id="Save-button" value="Save">

                </form>
            </td>

        </tr>

        <tr>
            <td id="table-data">


            </td>
        </tr>
    </table>
    <div id="modal">
    <div id="modal-form">
        <h2>Edit Form</h2>
        <table cellpadding="10" width="100%">
            
        </table>
        <div id="close-btn">X</div>
    </div>
</div>

    <script src="js/code.jquery.com_jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Function to load data into the table
            function loadtable() {
                $.ajax({
                    url: "ajaxLoad.php",
                    type: "POST",
                    success: function (data) {
                        // Update the table-data div with the received data
                        $("#table-data").html(data);
                    }
                });
            }
            // Initial data load when the page loads
            loadtable();

            // Event handler for the "Save" button click
            $("#Save-button").on("click", function (e) {
                e.preventDefault();
                var fname = $("#fname").val();
                var lname = $("#lname").val();
                // AJAX request to insert data into the database
                $.ajax({
                    url: "ajaxInsert.php",
                    type: "POST",
                    data: { first_name: fname, last_name: lname },
                    success: function (data) {
                        if (data == 1) {
                            // Reload the table and reset the form if data is successfully saved
                            loadtable();
                            $("#addForm").trigger("reset");
                        } else {
                            alert('Can\'t save');
                        }
                    }
                });
            });

            // Event handler for the "Delete" button click
            $(document).on("click", ".delete-btn", function () {
                var studentId = $(this).data("id");
                var element = this;
                // AJAX request to delete data from the database
                $.ajax({
                    url: "ajaxDelete.php",
                    type: "POST",
                    data: { id: studentId },
                    success: function (data) {
                        console.log(data); // Debugging: Check server response
                        if (data == 1) {
                            // Remove the table row when data is deleted
                            $(element).closest("tr").fadeOut();
                        } else {
                            // Handle the case when no data is deleted
                            alert("No data deleted");
                        }
                    }
                });
            });
            // Show Modal Box

            $(document).on("click", ".edit-btn", function () {

                $("#modal").show();
                var studentId =$(this).data("eid");
                
                $.ajax({
                    url:"load-update-form.php",
                    type:"POST",
                    data:{id:studentId},
                    success:function(data){
                        $("#modal-form table").html(data);

                    }

                })


            });
            //Hide Model Box 
            $("#close-btn").on("click", function (){

                $("#modal").hide();
                loadtable();



            });

            //Save Updated Form

            $(document).on("click", "#edit-submit", function () {

var stuId = $("#edit-id").val();
var fname = $("#edit-fname").val(); 
var lname = $("#edit-lname").val(); 

$.ajax({
    url: "ajax-update-form.php",
    type: "POST",
    data: { id: stuId, first_name: fname, last_name: lname }, // Added a comma after 'data'
    success: function (data) {
        if (data == 1) {
            $("#modal").hide();
            loadtable();
        }
    }
});
});
//Live Search
$("#search").on("keyup", function (){
    var search_term =$(this).val();
    $.ajax({
         url:"ajax-live-search.php",
         type:"POST",
         data:{search:search_term},
         success:function(data){
            $("#table-data").html(data);

         }
    });

});

        });
    </script>

</body>

</html>