<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../../assets/css/style-outside.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" /> -->

</head>

<body>
    <?php //include "../../partials/nav.php" 
    ?>
    <div class="container-fluid bg">
        <?php
        if (isset($_POST["login"])) {
            $email = $_POST['email'];
            $password = md5($_POST['password']);

            require_once('../../sql/connection/connection.php');

            $database = new Database();
            $db = $database->getConnection();

            $Sql = "SELECT * FROM user WHERE email = ? AND password = ?";
            $database = new Database();
            $db = $database->getConnection();
            $stmt = $db->prepare($Sql);
            $stmt->bindParam(1, $email);
            $stmt->bindParam(2, $password);

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                ?>
                    <div class="row">
                        <div class="col-md-12 my-3">
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Sukses</strong> login berhasil
                            </div>
                        </div>
                    </div>
                <?php
                    echo "<meta http-equiv='refresh' content='2; url=/PraktekWeb/'> ";
                } else {
                ?>
                    <div class="row">
                        <div class="col-md-12 my-3">
                            <div class="alert alert-danger" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Gagal</strong> email / password salah
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="row">
                    <div class="col-md-12 my-3">
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Gagal</strong> login
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-6 col-md-3">
                <form class="form-container" method="POST">
                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Masukkan email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
                    <a href="signup.php" class="float-right">Daftar</a>
                </form>
            </div>
        </div>
    </div>

    <script src="../../plugins/jquery/jquery-3.5.1.min.js"></script>
    <script src="../../plugins/jquery/jquery.slimscroll.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../plugins/moment-js/moment.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script> -->
    <script src="../../assets/js/script.js"></script>


</body>

</html>