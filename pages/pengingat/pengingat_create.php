<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="anggotaModalLabel" aria-hidden="true">
  <form method="post" action="">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="anggotaModalLabel">Create</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
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
                    echo "<option value=\"" . $row['id_matakuliah'] . "\">" . $row['nama_matakuliah'] . "</option>";
                  }
                }

                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="deskripsi">Deskripsi</label>
              <textarea class="form-control" aria-label="With textarea" id="deskripsi" name="deskripsi"></textarea>
            </div>
            <div class="form-group">
              <label for="deadline">Deadline</label>
              <input type="date" class="form-control" id="deadline" name="deadline" aria-describedby="nama_dosen_help">
              <small id="nama_dosen_help" class="form-text text-muted">-</small>
            </div>
            <div class="custom-control custom-switch">
              <input type="checkbox" class="custom-control-input" id="selesai" name="selesai" value="true">
              <label class="custom-control-label" for="selesai">Selesai</label>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success" name="create" type="submit">Simpan</button>
          <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
  </form>
</div>