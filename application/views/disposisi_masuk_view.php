	        <div class="graphs" id="box-content">
            <div class="content_bottom">
                <div class="col-md-12 span_3">
                <div class="bs-example1" data-example-id="contextual-table"><span><h3>Tabel Disposisi Masuk</h3></span></div>
       </div>
      

        <div class="clearfix"> </div>
        </div>
  <div class="bs-example4" data-example-id="simple-responsive-table">
    <div class="table-responsive">
      <?php
        $notif = $this->session->flashdata('notif');
        if($notif != NULL) {
          echo '<div class="alert alert-info">'.$notif.'</div>';
        } 
      ?>
      <table class="table" id="tabel-surar-masuk">
        <thead>
          <tr>
            <th>NO</th>
            <th>NO. SURAT</th>
            <th>POSISI</th>
            <th>NAMA</th>
            <th>TGL. DISPOSISI</th>
            <th>KETERANGAN</th>
            <th>STATUS</th>
            <th id="rowAction">AKSI</th>
          </tr>
        </thead>
        <tbody id="data_suratmasuk">
          <tr>
            <?php
                                    $no = 0;
                                    foreach ($data_disposisi as $disposisi) {
                                        echo '
                                            <tr>
                                                <td>'.++$no.'</td>
                                                <td>'.$disposisi->nomor_surat.'</td>
                                                <td>'.$disposisi->nama_posisi.'</td>
                                                <td>'.$disposisi->nama.'</td>
                                                <td>'.$disposisi->tgl_disposisi.'</td>
                                                <td>'.$disposisi->keterangan.'</td>
                                            ';

                                        if($disposisi->id_user_penerima == $this->session->userdata('id_user')){
                                            echo '<td><label class="label label-success">Disposisi Masuk</label></td>';
                                        }

                                        echo '
                                                <td>
                                                    <a href="'.base_url('uploads/'.$disposisi->file_surat).'" class="btn btn-info btn-sm" target="_blank">Lihat Surat</a>
                                            ';

                                            echo '
                                                        <a href="'.base_url('index.php/surat/disposisi_keluar/'. $disposisi->id_surat).'" class="btn btn-primary btn-sm"> Tambah Disposisi</a>
                                                    </td>
                                                </tr>
                                            ';
                                    }

                                ?>
        </tbody>
      </table>
      <button class="btn btn-info btn-sm" onclick="printDiv('box-content')" id="btnPrint" disabled>Print</button> 
    </div><!-- /.table-responsive -->
<!-- /.table-responsive -->
  </div>
  </div>

  <div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="modal_addLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal_addLabel">Tambah Disposisi Surat</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tujuan Unit</label>
                            <select class="form-control" name="tujuan_unit">
                                <option value="">-- Pilih Tujuan Unit --</option>
                                <option value="Direktur">Director</option>
                                <option value="Manager">Supervisor</option>
                                <option value="Supervisor">Programmer</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="keterangan" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                        <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
