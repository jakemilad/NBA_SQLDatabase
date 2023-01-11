<?php
$success = True; //keep track of errors so it redirects the page only if there are no errors
$db_conn = NULL; // edit the login credentials in connectToDB()
$show_debug_alert_messages = False;

function debugAlertMessage($message) {
    global $show_debug_alert_messages;
    if ($show_debug_alert_messages) {
        echo "<script type='text/javascript'>alert('" . $message . "');</script>";
    }
}

function executePlainSQL($cmdstr) {
    global $db_conn, $success;

    $statement = OCIParse($db_conn, $cmdstr);

    if (!$statement) {
//        echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
        $e = OCI_Error($db_conn);
//        echo htmlentities($e['message']);
        $success = False;
    }

    $r = OCIExecute($statement, OCI_DEFAULT);
    if (!$r) {
//        echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
        $e = oci_error($statement);
//        echo htmlentities($e['message']);
        $success = False;
    }

    return $statement;
}

function printResult($result, $tableHeader) { //prints results from a select statement
    echo "<div class='container'><h2>Result:</h2>";
    echo "<table class='table table-striped table-hover'><thead><tr>";
    foreach ($tableHeader as $header) {
        echo "<th scope='col'>" . $header . "</th>";
    }
    echo "</tr></thead><tbody>";

    while ($row = OCI_Fetch_Array($result, OCI_NUM)) {
        echo "<tr>";
        $size = sizeof($row);
        for($i=0; $i < $size; $i++)
        {
            echo "<td>" . $row[$i] . "</td>";
        }
        echo "</tr>";
    }

    echo "</tbody></table></div>";
}

function connectToDB() {
    global $db_conn;

    $db_conn = OCILogon("ora_sophie84", "a39763420", "dbhost.students.cs.ubc.ca:1522/stu");

    if ($db_conn) {
        debugAlertMessage("Database is Connected");
        return true;
    } else {
        debugAlertMessage("Cannot connect to Database");
        $e = OCI_Error();
        echo htmlentities($e['message']);
        return false;
    }
}

function disconnectFromDB() {
    global $db_conn;

    debugAlertMessage("Disconnect from Database");
    OCILogoff($db_conn);
}

function handleInsertRequest() {
    global $success;

    if (connectToDB()) {
        $pID = $_POST['pID'];
        $full_name = $_POST['full_name'];
        $jersey_num = $_POST['jersey_num'];
        $height = $_POST['height'];
        $uniID = $_POST['uniID'];
        $tID = $_POST['tID'];

        executePlainSQL("insert into Player values($pID, '$full_name', $jersey_num, $height, $uniID, $tID)");
        executePlainSQL('commit');
        if ($success) {
            handleViewPlayerRequest();
        } else {
            echo "<div class='container text-start'><h3>Failed to insert!</h3><p>Make sure Player ID and Jersey Number are unique and Team ID or University ID has existed!</p></div>";
        }

    }
    disconnectFromDB();
}

function handleViewPlayerRequest() {
    if (connectToDB()) {
        $result = executePlainSQL("select * from Player order by pID");
        $headerArray = ["Player ID", "Full Name", "Jersey Number", "Height (cm)", "University ID", "Team ID"];
        printResult($result, $headerArray);
    }
}

if (isset($_POST['insertSubmit'])) {
    handleInsertRequest();
} else if (isset($_POST['viewPlayers'])) {
    handleViewPlayerRequest();
}
?>