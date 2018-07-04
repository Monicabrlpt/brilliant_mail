	        <div class="graphs" id="box-content">
            <div class="content_bottom">
                <div class="col-md-12 span_3">
                <div class="bs-example1" data-example-id="contextual-table"><span><h3>Disposisi Surat</h3></span></div>
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
        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_add"><span class="fa fa-pl"></span> Tambah Disposisi</a> <br><br><span class="label btn_6 label-default">No. Surat : <?php echo $data_surat->nomor_surat; ?> </span> <br> <br>
          <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>PENGIRIM</th>
                                    <th>TUJUAN DISPOSISI</th>
                                    <th>TGL.DISPOSISI</th>
                                    <th>KETERANGAN</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 0;
                                    foreach ($data_disposisi as $disposisi) {
                                        echo '
                                            <tr>
                                                <td>'.++$no.'</td>
                                                <td>'.$disposisi->nama_posisi.'</td>
                                                <td>'.$disposisi->nama.'</td>
                                                <td>'.$disposisi->tgl_disposisi.'</td>
                                                <td>'.$disposisi->keterangan.'</td>
                                                <td>
                                                    <a href="'.base_url('uploads/'.$disposisi->file_surat).'" class="btn btn-info btn-sm" target="_blank">Lihat Surat</a>

                                            ';

                                        echo'
                                                    
                                                    <a href="'.base_url('index.php/surat/hapus_disposisi/'.$this->uri->segment(3).'/'. $disposisi->id_disposisi).'" class="btn btn-danger btn-sm">Hapus</a>
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
                <form action="<?php echo base_url('index.php/surat/tambah_disposisi/'.$this->uri->segment(3)) ?>" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal_addLabel">Tambah Disposisi Surat</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tujuan Unit</label>
                            <select class="form-control1" name="tujuan_unit" onchange="get_user_byposisi(this.value)">
                                <option value="">-- Pilih Tujuan Unit --</option>
                                <?php
                                    foreach ($drop_down_posisi as $posisi) {
                                        if($posisi->id_posisi != $this->session->userdata('id_posisi') && $posisi->id_posisi > $this->session->userdata('id_posisi')){
                                            echo '
                                                <option value="'.$posisi->id_posisi.'">'.$posisi->nama_posisi.'</option>
                                            ';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tujuan Disposisi</label>
                            <select class="form-control1" name="tujuan_user" id="tujuan_user">
                                <option value="">-- Pilih Nama --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control1" name="keterangan" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                        <input type="submit" name="submit" value="Simpan" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script type="text/javascript">
        function get_user_byposisi(id_posisi)
        {
            $('#tujuan_user').empty();

            $.getJSON('<?php echo base_url() ?>index.php/surat/get_user_byposisi/'+id_posisi, function(data){
                $.each(data, function(index,value){
                    $('#tujuan_user').append('<option value="'+value.id_user+'">'+value.nama+'</option>');
                })
            });
        }
    </script>
