<?php
require_once('sql/connection/connection.php');

$database = new Database();
$db = $database->getConnection();
if (isset($_POST['go_to_update'])) {

  $id_pengingat = $_POST["id_pengingat"];

  $selectQuery = "SELECT * FROM pengingat WHERE id_pengingat=?";
  $stmt = $db->prepare($selectQuery);
  $stmt->bindParam(1, $id_pengingat);
  $stmt->execute();
  if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    extract($row);
    $selesai_checked = $selesai == 1 ? "checked" : "";
  }
}
if (isset($_POST['update'])) {

  $id_pengingat = $_POST["id_pengingat"];
  $id_matakuliah = $_POST["id_matakuliah"];
  $deskripsi = $_POST["deskripsi"];
  $deadline = $_POST["deadline"];

  $selesai_checked = isset($_POST["selesai"]) ? "checked" : "";
  $selesai = isset($_POST["selesai"]) ? "1" : "0";

  $updateQuery = "UPDATE pengingat SET id_matakuliah=?, deskripsi=?, deadline=?, selesai=? WHERE id_pengingat=?";
  $stmt = $db->prepare($updateQuery);
  $stmt->bindParam(1, $id_matakuliah);
  $stmt->bindParam(2, $deskripsi);
  $stmt->bindParam(3, $deadline);
  $stmt->bindParam(4, $selesai);
  $stmt->bindParam(5, $id_pengingat);
  if ($stmt->execute()) {
?>
    <div class="row">
      <div class="col-md-12 my-3">
        <div class="alert alert-success" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Ubah Data Berhasil</strong>
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
          <strong>Ubah Data Gagal</strong>
        </div>
      </div>
    </div>
<?php
  }
}
?>
<div class="row">
  <div class="col-md-12 my-3">
    <h1>Update</h1>
  </div>
</div>
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12 my-3">
        <form method="post">
          <div class="form-group">
            <label for="id_matakuliah">Matakuliah</label>
            <select class="custom-select" id="id_matakuliah" name="id_matakuliah">
              <?php
              require_once('sql/connection/connection.php');

              $database = new Database();
              $db = $database->getConnection();

              $selectQuery = "SELECT * FROM matakuliah ORDER BY nama_matakuliah";
              $stmt = $db->prepare($selectQuery);
              $stmt->execute();
              if ($stmt->rowCount() > 0) {
                $nomor = 0;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  $selected = ($id_matakuliah == $row['id_matakuliah']) ? " selected" : "";
                  echo "<option value=\"" . $row['id_matakuliah'] . "\" " . $selected . ">" . $row['nama_matakuliah'] . "</option>";
                }
              }

              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" aria-label="With textarea" id="deskripsi" name="deskripsi"><?php echo $deskripsi ?></textarea>
          </div>
          <div class="form-group">
            <label for="deadline">Deadline</label>
            <input type="date" class="form-control" id="deadline" name="deadline" value="<?php echo $deadline ?>" aria-describedby="nama_dosen_help">
            <small id="nama_dosen_help" class="form-text text-muted">-</small>
          </div>
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="selesai" name="selesai" value="true">
            <label class="custom-control-label" for="selesai">Selesai</label>
          </div>
          <div class="form-group float-right">
            <input type="hidden" name="id_pengingat" value="<?php echo $id_pengingat ?>">
            <button class="btn btn-success" name="update" type="submit">Simpan</button>
            <a href="?page=pengingat" class="btn btn-danger">
              <span class="text">Kembali</span>
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>