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
            <h1>Choose to view respective players:</h1>
            <br><br>
            <div class="row">
                <div class="col-sm-4">
                        <div class="container text-start">
                        <h2>Guards</h2>
                        <form action="./player_projection.php" method="post">
                            <div class="checkbox">
                                <label class="form-check-label"><input class="form-check-input" type="checkbox" name="guardForm[]" value="full_name">  Full Name</label>
                            </div>
                            <div class="checkbox">
                                <label class="form-check-label"><input class="form-check-input" type="checkbox" name="guardForm[]" value="jersey_num">  Jersey Number</label>
                            </div>
                            <div class="checkbox">
                                <label class="form-check-label"><input class="form-check-input" type="checkbox" name="guardForm[]" value="height">  Height (cm)</label>
                            </div>
                            <div class="checkbox">
                                <label class="form-check-label"><input class="form-check-input" type="checkbox" name="guardForm[]" value="uniID">  University ID</label>
                            </div>
                            <div class="checkbox">
                                <label class="form-check-label"><input class="form-check-input" type="checkbox" name="guardForm[]" value="tID">  Team ID</label>
                            </div>
                            <div class="checkbox">
                                <label class="form-check-label"><input class="form-check-input" type="checkbox" name="guardForm[]" value="free_throw_per">  Free Throw Per Game</label>
                            </div>

                            <br>

                            <input type="submit" value="Show Guards" name="getGuardsRequest">
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="container text-start">
                        <h2>Centers</h2>
                        <form action="./player_projection.php" method="post">
                            <div class="checkbox form-group">
                                <label class="form-check-label"><input class="form-check-input" type="checkbox" name="centerForm[]" value="full_name">  Full Name</label>
                            </div>
                            <div class="checkbox">
                                <label class="form-check-label"><input class="form-check-input" type="checkbox" name="centerForm[]" value="jersey_num">  Jersey Number</label>
                            </div>
                            <div class="checkbox">
                                <label class="form-check-label"><input class="form-check-input" type="checkbox" name="centerForm[]" value="height">  Height (cm)</label>
                            </div>
                            <div class="checkbox">
                                <label class="form-check-label"><input class="form-check-input" type="checkbox" name="centerForm[]" value="uniID">  University ID</label>
                            </div>
                            <div class="checkbox">
                                <label class="form-check-label"><input class="form-check-input" type="checkbox" name="centerForm[]" value="tID">  Team ID</label>
                            </div>
                            <div class="checkbox">
                                <label class="form-check-label"><input class="form-check-input" type="checkbox" name="centerForm[]" value="blocks">  Blocks</label>
                            </div>

                            <br>

                            <input type="submit" value="Show Centers" name="getCentersRequest">
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="container text-start">
                        <h2>Forwards</h2>
                        <form action="./player_projection.php" method="post">
                            <div class="checkbox form-group">
                                <label class="form-check-label"><input class="form-check-input" type="checkbox" name="forwardForm[]" value="full_name">  Full Name</label>
                            </div>
                            <div class="checkbox">
                                <label class="form-check-label"><input class="form-check-input" type="checkbox" name="forwardForm[]" value="jersey_num">  Jersey Number</label>
                            </div>
                            <div class="checkbox">
                                <label class="form-check-label"><input class="form-check-input" type="checkbox" name="forwardForm[]" value="height">  Height (cm)</label>
                            </div>
                            <div class="checkbox">
                                <label class="form-check-label"><input class="form-check-input" type="checkbox" name="forwardForm[]" value="uniID">  University ID</label>
                            </div>
                            <div class="checkbox">
                                <label class="form-check-label"><input class="form-check-input" type="checkbox" name="forwardForm[]" value="tID">  Team ID</label>
                            </div>
                            <div class="checkbox">
                                <label class="form-check-label"><input class="form-check-input" type="checkbox" name="forwardForm[]" value="assists">  Assists</label>
                            </div>

                            <br>

                            <input type="submit" value="Show Forwards" name="getForwardsRequest">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br><br>

        <?php include('player_projection_result.php');?>

        <script src="index.js"></script>
    </body>
</html>