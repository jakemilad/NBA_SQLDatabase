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
//                echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
        $e = OCI_Error($db_conn);
//                echo htmlentities($e['message']);
        $success = False;
    }

    $r = OCIExecute($statement, OCI_DEFAULT);
    if (!$r) {
//                echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
        $e = oci_error($statement);
//                echo htmlentities($e['message']);
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

function handleUpdateRequest() {
    global $success;

    if (connectToDB()) {
        $cID = $_POST['cID'];
        $full_name = $_POST['full_name'];
        $tID = $_POST['tID'];

        if (!empty($full_name))
            executePlainSQL("update Coach set full_name='$full_name' where cID=$cID");
        if (!empty($tID))
            executePlainSQL("update Coach set tID=$tID where cID=$cID");

        executePlainSQL('commit');
        if ($success) {
            handleViewCoachRequest();
        } else {
            echo "<div class='container text-start'><h3>Failed to update!</h3><p>Make sure Coach ID has existed and Team ID ahas existed and is unique!</p></div>";
        }

    }

    disconnectFromDB();
}

function handleViewCoachRequest() {
    if (connectToDB()) {
        $result = executePlainSQL("select * from Coach order by cID");
        $headerArray = ["Coach ID", "Team ID", "Full Name"];
        printResult($result, $headerArray);
    }
    disconnectFromDB();
}

if (isset($_POST['updateSubmit'])) {
    handleUpdateRequest();
} else if (isset($_POST['viewCoaches'])) {
    handleViewCoachRequest();
}
?>