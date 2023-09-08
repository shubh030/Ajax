<?php
$conn = mysqli_connect("localhost", "root", "", "ajax_practise") or die("Connection Failed");
$sql = "SELECT * FROM ajax_practise";
$result = mysqli_query($conn, $sql) or die("failed to show");
$output = "";
$sno = 0; //

if (mysqli_num_rows($result) > 0) {
    $output = ' <table border="1" width="100%" cellspacing="0" cellpadding="10px">
    <tr>
        <th width="100px">Serial No</th>
        <th>Name</th>
        <th width="100px">Edit</th>
        <th width="100px">Delete</th>
    </tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        $sno++; // Increment the serial number
        $output .="<tr>
        <td>{$sno}</td>
        <td>{$row["fname"]} {$row["lname"]}</td>
        <td><button class='edit-btn' data-eid='{$row["id"]}'>Edit</button></td>
        <td><button class='delete-btn' data-id='{$row["id"]}'>Delete</button></td>
        </tr>";
    }
    $output .= "</table>";
    mysqli_close($conn);
    echo $output;
} else {
    echo "no record found";
}
?>
