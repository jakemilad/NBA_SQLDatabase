<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>NBA Player Database</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="./styles.css">
    </head>

    <body>
        <div class="container text-center">
            <br>
            <h1>Show University:</h1>
            <br><br>
            <div class="container text-start">
                <form method="POST" action="./university_having.php">
                    <h3>Which has at least ? number of players:</h3>
                    <div>
                        <input type="number" min="0" id="numOfPlayers" name="numOfPlayers" placeholder="Enter Value" required>
                    </div>
                    <br>
                    <input type="submit" value="Submit" name="havingRequest">
                </form>
                <br><br>
                <form method="POST" action="./university_having.php">
                    <input type="submit" value="View All Universities" name="showAllUniversities">
                </form>
            </div>
        </div>
        <br><br>
        <?php include('university_having_result.php');?>
        <script src="index.js"></script>
    </body>
</html>