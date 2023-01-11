<?php

error_reporting(-1);
ini_set('display_errors',1);

$success = True; //keep track of errors so it redirects the page only if there are no errors
$db_conn = NULL; // edit the login credentials in connectToDB()
$show_debug_alert_messages = False; // set to True if you want alerts to show you which methods are being triggered (see how it is used in debugAlertMessage())

function connectToDB(): bool
{
    global $db_conn;

    // Your username is ora_(CWL_ID) and the password is a(student number). For example,
    // ora_platypus is the username and a12345678 is the password.
    $db_conn = OCILogon("ora_sophie84", "a39763420", "dbhost.students.cs.ubc.ca:1522/stu");

    if ($db_conn) {
        debugAlertMessage("Database is Connected");
        return true;
    } else {
        debugAlertMessage("Cannot connect to Database");
        $e = OCI_Error(); // For OCILogon errors pass no handle
        echo htmlentities($e['message']);
        return false;
    }
}

function disconnectFromDB() {
    global $db_conn;

    debugAlertMessage("Disconnect from Database");
    OCILogoff($db_conn);
}

function debugAlertMessage($message) {
    global $show_debug_alert_messages;

    if ($show_debug_alert_messages) {
        echo "<script type='text/javascript'>alert('" . $message . "');</script>";
    }
}

function executePlainSQL($cmdstr)
{ //takes a plain (no bound variables) SQL command and executes it
    //echo "<br>running ".$cmdstr."<br>";
    global $db_conn, $success;

    $statement = OCIParse($db_conn, $cmdstr);
    //There are a set of comments at the end of the file that describe some of the OCI specific functions and how they work

    if (!$statement) {
        echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
        $e = OCI_Error($db_conn); // For OCIParse errors pass the connection handle
        echo htmlentities($e['message']);
        $success = False;
    }

    $r = OCIExecute($statement, OCI_DEFAULT);
    if (!$r) {
        echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
        $e = oci_error($statement); // For OCIExecute errors pass the statementhandle
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

function getHeader($input) {
    switch ($input) {
        case "full_name":
            return "Full Name";
        case "jersey_num":
            return "Jersey Number";
        case "height":
            return "Height (cm)";
        case "uniID":
            return "University ID";
        case "tID":
            return "Team ID";
        case "free_throw_per":
            return "Number of Free Throw";
        case "assists":
            return "Number of Assists";
        case "blocks":
            return "Number of Blocks";
    }
}

// handle POST request from the forms.
function handlePOST($tableName) {
    if (connectToDB()) {
        $formName = ''; // $p->getFormName();
        switch ($tableName) {
            case "Guards":
                $formName = "guardForm";
                break;
            case "Centers":
                $formName = "centerForm";
                break;
            case "Forwards":
                $formName = "forwardForm";
                break;
        }
        if (array_key_exists($formName, $_POST)) {
            $dataArray = $_POST[$formName];
            if(empty($dataArray))
            {
                echo("You didn't select any attributes.");
            }
            else
            {
                $allAttributes = implode(',', $dataArray);
                $result = executePlainSQL("select $allAttributes from $tableName inner join Player on $tableName.pID = Player.pID");
                $headerArray = array();
                foreach ($dataArray as $value)
                    array_push($headerArray, getHeader($value));
                printResult($result, $headerArray);
            }

        }
        disconnectFromDB();
    }
}

if (isset($_POST['getGuardsRequest'])) {
    handlePOST("Guards");
} else if (isset($_POST['getCentersRequest'])) {
    handlePOST("Centers");
} else if (isset($_POST['getForwardsRequest'])) {
    handlePOST("Forwards");
}
?>
