<?php

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
        case "p.full_name":
            return "Full Name";
        case "p.jersey_num":
            return "Jersey Number";
        case "p.height":
            return "Height (cm)";
        case "p.uniID":
            return "University ID";
        case "p.tID":
            return "Team ID";
    }
}

function handleTeamChampionships() {
    if (connectToDB()) {
        $operation = $_POST["operations"];
        $championships = $_POST["championships"];

        $result = executePlainSQL("select * from Team where championships $operation $championships");
        $headerArray = array("Team ID", "Championship", "Team Name", "Game ID", "Team Owner ID");
        printResult($result, $headerArray);

        disconnectFromDB();
    }
}

function handleTeamWon() {
    if (connectToDB()) {

        $result = executePlainSQL("SELECT t.TEAM_NAME, COUNT(*) nums FROM PLAYER p, TEAM t WHERE p.TID = t.TID AND GID NOT IN (SELECT GID FROM GAME WHERE WINNER = 'winner') GROUP BY t.TEAM_NAME");
        $headerArray = array("Team Name", "Number of Players");
        printResult($result, $headerArray);

        disconnectFromDB();
    }
}

function handleEndorsedPlayers() {
    if (connectToDB()) {
        $result = executePlainSQL("select * from Player p where not exists ((select e.eid FROM Endorsements e) minus (select s.eid from Sponsor s where s.pid=p.pid))");
        $headerArray = array("Player ID", "Full Name", "Jersey Number", "Height (cm)", "University ID", "Team ID");
        printResult($result, $headerArray);
        disconnectFromDB();
    }
}

if (isset($_POST['getTeamsWonRequest'])) {
    handleTeamWon();
} else if (isset($_POST['getEndorsedPlayersRequest'])) {
    handleEndorsedPlayers();
}
?>