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
            <h1>Nested Aggregation & Division:</h1>
            <br><br>
            <div class="row">
                <div class="col">
                    <div class="container text-start">
                        <h2>Find number of players in a team whose has won a game: </h2><br>
                        <form action="./player_endorsements.php" method="post">
                            <input type="submit" value="Show Table" name="getTeamsWonRequest">
                        </form>
                    </div>
                </div>

                <div class="col">
                    <div class="container text-start">
                        <h2>Find all players who are endorsed by all brands: </h2><br>
                        <form action="./player_endorsements.php" method="post">
                            <input type="submit" value="Show Players" name="getEndorsedPlayersRequest">
                        </form>
                    </div>
                </div>
            </div>
            <br><br>
        </div>
        <?php include('player_endorsements_result.php');?>

        <script src="index.js"></script>
    </body>
</html>