
<form action="<?php echo base_url('mahasiswa/simpan'); ?>" method="post">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Mahasiswa</h4>
              </div>
              <div class="modal-body">
             
                  <div class="form-group">
                    <label for="nim" class="control-label">NIM:</label>
                    <input type="text" name="nim" class="form-control" id="nim">
                  </div>
                  <div class="form-group">
                    <label for="nama" class="control-label">NAMA:</label>
                    <input type="text" name="nama" class="form-control" id="nama">
                  </div>
                  <div class="form-group">
                    <label for="prodi" class="control-label">PRODI:</label>
                    <select name="prodi" class="form-control" id="prodi">
                        <option>Sistem Informasi</option>
                        <option>Sistem Komputer</option>
                        <option>Manajemen Informatika</option>
                    </select>
                  </div>
             
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </div>
          </div>
        </div>
    </form>
 