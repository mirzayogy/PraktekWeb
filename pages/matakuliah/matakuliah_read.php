<?php
require_once('sql/connection/connection.php');

$database = new Database();
$db = $database->getConnection();

if(isset($_POST['create'])) {

  $nama_matakuliah = $_POST["nama_matakuliah"];
  $singkatan_matakuliah = $_POST["singkatan_matakuliah"];
  $nama_dosen = $_POST["nama_dosen"];
  $kontak_dosen = $_POST["kontak_dosen"];
  if(isset($_POST['aktif'])){
    $aktif = "1";
  }else{
    $aktif = "0";
  }

  $Sql = "INSERT INTO matakuliah VALUES (NULL,?,?,?,?,?) ";
  $database = new Database();
  $db = $database->getConnection();
  $stmt = $db->prepare($Sql);
  $stmt->bindParam(1, $nama_matakuliah);
  $stmt->bindParam(2, $singkatan_matakuliah);
  $stmt->bindParam(3, $nama_dosen);
  $stmt->bindParam(4, $kontak_dosen);
  $stmt->bindParam(5, $aktif);

  if($stmt->execute()) {
    ?>
    <div class="row">
      <div class="col-md-12 my-3">
        <div class="alert alert-success" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Tambah Data Berhasil</strong> Matakuliah  <?php echo $nama_matakuliah; ?> telah ditambahkan
        </div>
      </div>
    </div>
    <?php
  }
}

if(isset($_POST['delete'])) {

  $id_matakuliah = $_POST["id_matakuliah"];
  $nama_matakuliah = $_POST["nama_matakuliah"];

  $Sql = "DELETE FROM matakuliah WHERE id_matakuliah=?";
  $database = new Database();
  $db = $database->getConnection();
  $stmt = $db->prepare($Sql);
  $stmt->bindParam(1, $id_matakuliah);

  if($stmt->execute()) {
    ?>
    <div class="row">
      <div class="col-md-12 my-3">
        <div class="alert alert-success" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Hapus Data Berhasil</strong> Matakuliah  <?php echo $nama_matakuliah; ?> telah dihapus
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
              <th scope="col">Singkatan</th>
              <th scope="col">Dosen</th>
              <th scope="col">Kontak</th>
              <th scope="col">Aktif</th>
              <th scope="col" style="width:15%">Act</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $selectQuery = "SELECT * FROM matakuliah ORDER BY nama_matakuliah";
            $stmt = $db->prepare($selectQuery);
            $stmt->execute();
            if($stmt->rowCount()>0){
              $nomor=0;
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $nomor++;

                ?>
                <tr>
                  <td><?php echo $nomor ?></td>
                  <td><?php echo $row["nama_matakuliah"] ?></td>
                  <td><?php echo $row["singkatan_matakuliah"] ?></td>
                  <td><?php echo $row["nama_dosen"] ?></td>
                  <td><?php echo $row["kontak_dosen"] ?></td>
                  <td><?php echo ($row["aktif"] == 1) ? "Aktif" : "Tidak" ?></td>
                  <td>
                    <div class="row">
                      <form method="post" action="?page=matakuliah_update">
                        <input type="hidden" name="id_matakuliah" value="<?php echo $row["id_matakuliah"] ?>">
                        <button class='btn btn-primary'  type="submit" name="go_to_update">
                          <i class="fa fa-edit"></i>
                        </button>
                      </form>
                      <form method="post">
                        <input type="hidden" name="id_matakuliah" value="<?php echo $row["id_matakuliah"] ?>">
                        <input type="hidden" name="nama_matakuliah" value="<?php echo $row["nama_matakuliah"] ?>">
                        <button class='btn btn-danger' onclick="return confirm('Anda Yakin menghapus Data <?php echo $row["nama_matakuliah"] ?>?')" type="submit" name="delete">
                          <i class="fa fa-trash"></i>
                        </button>
                      </form>
                    </div>

                  </td>
                </tr>
                <?php
              }
            }else{
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
include_once("matakuliah_create.php");
?>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
