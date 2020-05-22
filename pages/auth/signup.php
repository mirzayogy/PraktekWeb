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
    <div class="container-fluid bg">
        <?php //include "../../partials/nav.php" 

        if (isset($_POST["daftar"])) {
            $nama = $_POST['nama'];
            $email = $_POST['email'];
            $password_1 = $_POST['password_1'];
            $password_2 = $_POST['password_2'];

            if ($password_1 != $password_2) {
        ?>
                <div class="row">
                    <div class="col-md-12 my-3">
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Gagal</strong> Password tidak sama
                        </div>
                    </div>
                </div>
                <?php
            } else {

                $password = md5($password_1);
                require_once('../../sql/connection/connection.php');

                $database = new Database();
                $db = $database->getConnection();

                $Sql = "SELECT * FROM user WHERE email = ?";
                $database = new Database();
                $db = $database->getConnection();
                $stmt = $db->prepare($Sql);
                $stmt->bindParam(1, $email);

                if ($stmt->execute()) {
                    if ($stmt->rowCount() > 0) {
                ?>
                        <div class="row">
                            <div class="col-md-12 my-3">
                                <div class="alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong>Gagal</strong> email sudah terdaftar
                                </div>
                            </div>
                        </div>
                        <?php
                    } else {
                        $insertSql = "INSERT INTO user (nama,email,password) VALUES (?,?,?)";
                        $database = new Database();
                        $db = $database->getConnection();
                        $stmt = $db->prepare($insertSql);
                        $stmt->bindParam(1, $nama);
                        $stmt->bindParam(2, $email);
                        $stmt->bindParam(3, $password);
                        if ($stmt->execute()) {
                        ?>
                            <div class="row">
                                <div class="col-md-12 my-3">
                                    <div class="alert alert-success" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong>sukses</strong> mendaftar
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="row">
                                <div class="col-md-12 my-3">
                                    <div class="alert alert-danger" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong>Gagal</strong> mendaftar
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                } else {
                    ?>
                    <div class="row">
                        <div class="col-md-12 my-3">
                            <div class="alert alert-danger" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Gagal</strong> Pencarian data email gagal
                            </div>
                        </div>
                    </div>
        <?php
                }
            }
        }

        ?>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-6 col-md-3">
                <form class="form-container" method="POST">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" aria-describedby="emailHelp" placeholder="Masukkan nama">
                        <!-- <small id="nameHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Masukkan email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="password_1">Password</label>
                        <input type="password" class="form-control" id="password_1" name="password_1" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="password_2">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_2" name="password_2" placeholder="Konfirmasi Password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="daftar">Daftar</button>
                    <a href="login.php" class="float-right">Login</a>
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