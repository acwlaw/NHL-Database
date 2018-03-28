
require_once('../../mysqli_connect.php');
$query = "SELECT ";
$stmt = mysqli_prepare($dbc, $query);
mysqli_stmt_bind_param($stmt, "ss", $f_name, $l_name);
mysqli_stmt_execute($stmt);
$affected_rows = mysqli_stmt_affected_rows($stmt);
