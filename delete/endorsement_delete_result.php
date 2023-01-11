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
                echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
        $e = OCI_Error($db_conn);
                echo htmlentities($e['message']);
        $success = False;
    }

    $r = OCIExecute($statement, OCI_DEFAULT);
    if (!$r) {
                echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
        $e = oci_error($statement);
                echo htmlentities($e['message']);
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

function handleDeleteByIDRequest() {
    global $success;

    if (connectToDB()) {
        $eID = $_POST['eID'];
        executePlainSQL("delete from Endorsements where eID=$eID");

        executePlainSQL('commit');
        if ($success) {
            handleViewEndorsementRequest();
        } else {
            echo "<div class='container text-start'><h3>Failed to delete!</h3><p>Make sure Endorsement ID has existed!</p></div>";
        }
    }
    disconnectFromDB();
}

function handleDeleteByBrandRequest() {
    global $success;

    if (connectToDB()) {
        $brand = $_POST['brand'];
        executePlainSQL("delete from Endorsements where brand='$brand'");

        executePlainSQL('commit');
        if ($success) {
            handleViewEndorsementRequest();
        } else {
            echo "<div class='container text-start'><h3>Failed to delete!</h3><p>Make sure Brand has existed!</p></div>";
        }
    }
    disconnectFromDB();
}

function handleViewEndorsementRequest() {
    if (connectToDB()) {
        $result = executePlainSQL("select * from Endorsements order by eID");
        $headerArray = ["Endorsement ID", "Brand"];
        printResult($result, $headerArray);
    }
    disconnectFromDB();
}

function handleViewSponsorRequest() {
    if (connectToDB()) {
        $result = executePlainSQL("select * from Sponsor order by pID");
        $headerArray = ["Player ID", "Endorsement ID"];
        printResult($result, $headerArray);
    }
    disconnectFromDB();
}

if (isset($_POST['deleteByEndorsementIDSubmit'])) {
    handleDeleteByIDRequest();
} else if (isset($_POST['deleteByBrandSubmit'])) {
    handleDeleteByBrandRequest();
} else if (isset($_POST['viewEndorsements'])) {
    handleViewEndorsementRequest();
} else if (isset($_POST['viewSponsors'])) {
    handleViewSponsorRequest();
}
?>