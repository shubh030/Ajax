<?php
$student_id = $_POST["id"];
$conn = mysqli_connect("localhost", "root", "", "ajax_practise") or die("Connection Failed");
$sql = "SELECT * FROM ajax_practise WHERE id={$student_id}";
$result = mysqli_query($conn, $sql) or die("failed to show");
$output = "";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= "<tr>
        <td class='input-container'>
            <label for='edit-fname'>First Name</label>
            <input type='text' id='edit-fname' value='{$row["fname"]}'>
            <input type='text' id='edit-id' hidden value='{$row["id"]}'>
        </td>
        <td class='input-container'>
            <label for='edit-lname'>Last Name</label>
            <input type='text' id='edit-lname' value='{$row["lname"]}'>
        </td>
        <td>
            <input type='submit' id='edit-submit' value='Save'>
        </td>
        </tr>";
    }

    mysqli_close($conn);
    echo $output;
} else {
    echo "no record found";
}
?>
