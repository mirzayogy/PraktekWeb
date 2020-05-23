<?php
require_once('sql/connection/connection.php');

$database = new Database();
$db = $database->getConnection();

if (isset($_POST['create'])) {

  $id_matakuliah = $_POST["id_matakuliah"];
  $deskripsi = $_POST["deskripsi"];
  $deadline = $_POST["deadline"];
  if (isset($_POST['selesai'])) {
    $selesai = "1";
  } else {
    $selesai = "0";
  }

  $Sql = "INSERT INTO pengingat VALUES (NULL,?,?,?,?) ";
  $database = new Database();
  $db = $database->getConnection();
  $stmt = $db->prepare($Sql);
  $stmt->bindParam(1, $id_matakuliah);
  $stmt->bindParam(2, $deskripsi);
  $stmt->bindParam(3, $deadline);
  $stmt->bindParam(4, $selesai);

  if ($stmt->execute()) {
?>
    <div class="row">
      <div class="col-md-12 my-3">
        <div class="alert alert-success" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Tambah Data Berhasil</strong>
        </div>
      </div>
    </div>
  <?php
  }
}

if (isset($_POST['delete'])) {

  $id_pengingat = $_POST["id_pengingat"];

  $Sql = "DELETE FROM pengingat WHERE id_pengingat=?";
  $database = new Database();
  $db = $database->getConnection();
  $stmt = $db->prepare($Sql);
  $stmt->bindParam(1, $id_pengingat);

  if ($stmt->execute()) {
  ?>
    <div class="row">
      <div class="col-md-12 my-3">
        <div class="alert alert-success" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Hapus Data Berhasil</strong> Matakuliah <?php echo $nama_matakuliah; ?> telah dihapus
        </div>
      </div>
    </div>
<?php
  }
}

?>
<div class="row">
  <div class="col-md-12 my-3">
    <h1>Read</h1>
  </div>
</div>
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12 my-3">
        <button class="btn btn-primary float-right" onclick="window.print();"><i class=" fa fa-print"></i> Cetak</button>
        <button class="btn btn-success float-right" type="submit" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i> Tambah</button>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 my-3">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Matakuliah</th>
              <th scope="col">Deskripsi</th>
              <th scope="col">Deadline</th>
              <th scope="col">Selesai</th>
              <th scope="col" style="width:15%">Act</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $selectQuery = "SELECT P.*,M.nama_matakuliah  FROM pengingat P INNER JOIN matakuliah M ON P.id_matakuliah = M.id_matakuliah ORDER BY id_pengingat";
            $stmt = $db->prepare($selectQuery);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
              $nomor = 0;
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $nomor++;

            ?>
                <tr>
                  <td><?php echo $nomor ?></td>
                  <td><?php echo $row["nama_matakuliah"] ?></td>
                  <td><?php echo $row["deskripsi"] ?></td>
                  <td><?php echo $row["deadline"] ?></td>
                  <td><?php echo ($row["selesai"] == 1) ? "Selesai" : "Belum" ?></td>
                  <td>
                    <div class="row">
                      <form method="post" action="?page=pengingat_update">
                        <input type="hidden" name="id_pengingat" value="<?php echo $row["id_pengingat"] ?>">
                        <button class='btn btn-primary btn-sm' type="submit" name="go_to_update">
                          <i class="fa fa-edit"></i>
                        </button>
                      </form>
                      <form method="post">
                        <input type="hidden" name="id_pengingat" value="<?php echo $row["id_pengingat"] ?>">
                        <button class='btn btn-danger btn-sm' onclick="return confirm('Anda Yakin menghapus Data?')" type="submit" name="delete">
                          <i class="fa fa-trash"></i>
                        </button>
                      </form>
                    </div>

                  </td>
                </tr>
              <?php
              }
            } else {
              ?>
              <tr>
                <td colspan="5" style="text-align:center">Data masih kosong</td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php
include_once("pengingat_create.php");
?>
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>