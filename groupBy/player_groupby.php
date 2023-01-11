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
            <h1>Choose to view players info in a team: </h1>
            <br><br>

            <div class="container text-start">
                <form action="./player_groupby.php" method="post">

                    <h2 for="group">Find min/max/avg height in a team:</h2>
                    <select class="form-select" name="group" id="group" style="width:30%;">
                        <option value="" selected>--Choose an option--</option>
                        <option value="Min">Min</option>
                        <option value="Max">Max</option>
                        <option value="Avg">Avg</option>
                    </select>
                    <br>
                    <input type="submit" value="Show Aggregation" name="getMinMaxAvgRequest">
                </form>
                <br><br>
                <form action="./player_groupby.php" method="post">
                    <h2 >Click to show number of players in each team:</h2><br>
                    <input type="submit" value="Show Count" name="getCountRequest">
                </form>
            </div>
        </div>
        <br><br>
        <?php include('player_groupby_result.php');?>

        <script src="index.js"></script>
    </body>
</html>