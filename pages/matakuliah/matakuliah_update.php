<?php
require_once('sql/connection/connection.php');

$database = new Database();
$db = $database->getConnection();

if(isset($_POST['go_to_update'])){

  $id_matakuliah = $_POST["id_matakuliah"];

  $selectQuery = "SELECT * FROM matakuliah WHERE id_matakuliah=?";
  $stmt = $db->prepare($selectQuery);
  $stmt->bindParam(1, $id_matakuliah);
  $stmt->execute();
  if($stmt->rowCount()>0){
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    extract($row);
    $aktif_checked = $aktif==1 ? "checked" : "";

  }
}
if(isset($_POST['update'])){

  $id_matakuliah = $_POST["id_matakuliah"];
  $nama_matakuliah = $_POST["nama_matakuliah"];
  $singkatan_matakuliah = $_POST["singkatan_matakuliah"];
  $nama_dosen = $_POST["nama_dosen"];
  $kontak_dosen = $_POST["kontak_dosen"];

  $aktif_checked = isset($_POST["aktif"]) ? "checked" : "";
  $aktif = isset($_POST["aktif"]) ? "1" : "0";

  $updateQuery = "UPDATE matakuliah SET nama_matakuliah=?, singkatan_matakuliah=?, nama_dosen=?, kontak_dosen=?, aktif=? WHERE id_matakuliah=?";
  $stmt = $db->prepare($updateQuery);
  $stmt->bindParam(1, $nama_matakuliah);
  $stmt->bindParam(2, $singkatan_matakuliah);
  $stmt->bindParam(3, $nama_dosen);
  $stmt->bindParam(4, $kontak_dosen);
  $stmt->bindParam(5, $aktif);
  $stmt->bindParam(6, $id_matakuliah);
  if($stmt->execute()){
    ?>
    <div class="row">
      <div class="col-md-12 my-3">
        <div class="alert alert-success" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Ubah Data Berhasil</strong> Matakuliah <?php $nama_matakuliah ?> telah diubah
        </div>
      </div>
    </div>
    <?php
  }else{
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
            <label for="nama_matakuliah">Matakuliah</label>
            <input type="text" class="form-control" id="nama_matakuliah" name="nama_matakuliah" value="<?php echo $nama_matakuliah ?>"  aria-describedby="matakuliah_help">
            <small id="matakuliah_help" class="form-text text-muted">Nama panjang matakuliah</small>
          </div>
          <div class="form-group">
            <label for="singkatan_matakuliah">Singkatan</label>
            <input type="text" class="form-control" id="singkatan_matakuliah" name="singkatan_matakuliah" value="<?php echo $singkatan_matakuliah ?>" aria-describedby="singkatan_matakuliah_help">
            <small id="singkatan_matakuliah_help" class="form-text text-muted">Maksimal 9 huruf</small>
          </div>
          <div class="form-group">
            <label for="nama_dosen">Dosen</label>
            <input type="text" class="form-control" id="nama_dosen" name="nama_dosen"  value="<?php echo $nama_dosen ?>" aria-describedby="nama_dosen_help">
            <small id="nama_dosen_help" class="form-text text-muted">-</small>
          </div>
          <div class="form-group">
            <label for="kontak_dosen">Kontak Dosen</label>
            <input type="text" class="form-control" id="kontak_dosen" name="kontak_dosen" value="<?php echo $kontak_dosen ?>" aria-describedby="kontak_dosen_help">
            <small id="kontak_dosen_help" class="form-text text-muted">No HP Dosen</small>
          </div>
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="aktif" name="aktif" <?php echo $aktif_checked ?>>
            <label class="custom-control-label" for="aktif">Aktif</label>
          </div>
          <div class="form-group float-right">
            <input type="hidden" name="id_matakuliah" value="<?php echo $id_matakuliah ?>">
            <button class="btn btn-success" name="update" type="submit" >Simpan</button>
            <a href="?page=matakuliah" class="btn btn-danger">
              <span class="text">Kembali</span>
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
