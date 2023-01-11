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
            <h1>Choose to view players endorsed:</h1>
            <br><br>

            <div class="container text-start">
                <form action="./endorsement_join.php" method="post">
                    <h2>Enter the brand of endorsements: </h2>

                    <div>
                        <input type="text" id="endorsement" name="endorsement" placeholder="Enter Brand" required>
                    </div>
                    <br>

                    <h2>Choose attributes of player who are endorsed to show: </h2>
                    <div class="checkbox">
                        <label class="form-check-label"><input class="form-check-input" type="checkbox" name="playerForm[]" value="full_name">  Full Name</label>
                    </div>
                    <div class="checkbox">
                        <label class="form-check-label"><input class="form-check-input" type="checkbox" name="playerForm[]" value="jersey_num">  Jersey Number</label>
                    </div>
                    <div class="checkbox">
                        <label class="form-check-label"><input class="form-check-input" type="checkbox" name="playerForm[]" value="height">  Height (cm)</label>
                    </div>
                    <div class="checkbox">
                        <label class="form-check-label"><input class="form-check-input" type="checkbox" name="playerForm[]" value="uniID">  University ID</label>
                    </div>
                    <div class="checkbox">
                        <label class="form-check-label"><input class="form-check-input" type="checkbox" name="playerForm[]" value="tID">  Team ID</label>
                    </div>

                    <br>

                    <input type="submit" value="Show Players" name="getEndorsementsRequest">
                </form>
            </div>
        </div>
        <br><br>

        <?php include('endorsement_join_result.php');?>

        <script src="index.js"></script>
    </body>
</html>