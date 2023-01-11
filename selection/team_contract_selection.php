<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>NBA Player Database</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

        <div class="container text-center">
            <br>
            <h1>Choose based on conditions:</h1>
            <br><br>
            <div class="row">
                <div class="col">
                    <div class="container text-start">
                        <h2>Display Team: </h2>
                        <form action="./team_contract_selection.php" method="post">
                            <br>
                            <h3>who has championships: </h3>
                            <input type="radio" id="lessThan" name="operations" value="<" checked="checked">
                            <label for="lessThan"> <</label><br>

                            <input type="radio" id="greaterThan" name="operations" value=">">
                            <label for="greaterThan"> ></label><br>

                            <input type="radio" id="equal" name="operations" value="=">
                            <label for="equal"> =</label>
                            <br>

                            <div>
                                <input type="number" id="championships" name="championships" placeholder="Enter Championships" required>
                            </div><br>

                            <input type="submit" value="Show Teams" name="getTeamsChampionshipRequest">
                        </form>
                        <br>
                    </div>
                </div>
                <div class="col">
                    <div class="container text-start">
                        <h2>Display Team: </h2>
                        <form action="./team_contract_selection.php" method="post">
                            <br>
                            <h3>whose name include: </h3>

                            <div>
                                <input type="text" id="team_name" name="team_name" placeholder="Enter Name" required>
                            </div><br>

                            <input type="submit" value="Show Teams" name="getTeamsNamesRequest">
                        </form>
                        <br><br>
                    </div>
                </div>

                <div class="col">
                    <div class="container text-start">

                        <h2>Display Players: </h2>
                        <form action="./team_contract_selection.php" method="post">
                            <br>
                            <h3>who has: </h3>
                            <input type="radio" id="length" name="contract_attributes" value="length" checked="checked">
                            <label for="length">Contract Length (years)</label><br>
                            
                            <input type="radio" id="con_value" name="contract_attributes" value="con_value">
                            <label for="con_value">Contract Value (millions)</label><br>

                            <br>

                            <input type="radio" id="lessThan" name="operations" value="<" checked="checked">
                            <label for="lessThan"> <</label><br>

                            <input type="radio" id="greaterThan" name="operations" value=">">
                            <label for="greaterThan"> ></label><br>

                            <input type="radio" id="equal" name="operations" value="=">
                            <label for="equal"> =</label>
                            <br>

                            <div>
                                <input type="number" step="0.01" min="0" id="contract_input" name="contract_input" placeholder="Enter Value" required>
                            </div><br>

                            <input type="submit" value="Show Players" name="getPlayersRequest">
                        </form>
                    </div>
                </div>
            </div>
            <br><br>
        </div>

        <?php include('team_contract_selection_result.php');?>

        <script src="index.js"></script>
    </body>
</html>