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
            <h1>Insert Values For New Player:</h1>
            <br><br>
            <div class="container text-start">
                <form method="POST" action="./player_insert.php">
                    <div class="form-group row">
                        <label for="pID" class="col-sm-2 col-form-label">Player ID:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pID" name="pID" required>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="full_name" class="col-sm-2 col-form-label">Player Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="full_name" name="full_name" required>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="jersey_num" class="col-sm-2 col-form-label">Jersey Number:</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="jersey_num" name="jersey_num" required>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="height" class="col-sm-2 col-form-label">Player Height (cm):</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="height" name="height" required>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="uniID" class="col-sm-2 col-form-label">University ID:</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="uniID" name="uniID" required>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="tID" class="col-sm-2 col-form-label">Team ID:</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="tID" name="tID" required>
                        </div>
                    </div>
                    <br><br>
                    <input type="submit" value="Insert" name="insertSubmit">
                </form>
                <br>
                <form method="POST" action="./player_insert.php">
                    <input type="submit" value="View All Players" name="viewPlayers">
                </form>
            </div>
        </div>
        <br><br>
        <?php include('player_insert_result.php');?>
        <script src="index.js"></script>
    </body>
</html>