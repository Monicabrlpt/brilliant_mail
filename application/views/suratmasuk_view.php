	        <div class="graphs" id="box-content">
            <div class="content_bottom">
                <div class="col-md-12 span_3">
                <div class="bs-example1" data-example-id="contextual-table"><span><h3>Tabel Surat Masuk</h3></span></div>
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
            <th>PENGIRIM</th>
            <th>TGL. KIRIM</th>
            <th>TGL. TERIMA</th>
            <th>PERIHAL</th>
            <th id="rowAction">AKSI</th>
          </tr>
        </thead>
        <tbody id="data_suratmasuk">
          <tr>
            <?php
            $no = 0;
            foreach ($data_suratmasuk as $suratmasuk) {
              echo '
            
            <td>'.++$no.'</td>
            <td>'.$suratmasuk->nomor_surat.'</td>
            <td>'.$suratmasuk->pengirim.'</td>
            <td>'.$suratmasuk->tgl_kirim.'</td>
            <td>'.$suratmasuk->tgl_terima.'</td>
            <td>'.$suratmasuk->perihal.'</td>
            <td>
              <a href="'.base_url('uploads/'.$suratmasuk->file_surat).'" class="btn btn-info btn-sm" target="_blank">Lihat Surat</a> 
              <a href="#" class="btn btn-default btn-sm" target="_blank" data-toggle="modal" data-target="#modal_ubah" onclick="prepare_update_surat('.$suratmasuk->id_surat.')">Ubah</a>
              <a href="#" class="btn btn-default btn-sm" target="_blank" data-toggle="modal" data-target="#modal_ubahfile" onclick="prepare_update_surat('.$suratmasuk->id_surat.')">Ubah Surat</a>
              <a href="'.base_url('index.php/surat/disposisi/'. $suratmasuk->id_surat).'" class="btn btn-primary btn-sm">Disposisi</a> 
              <a href="'.base_url('index.php/surat/hapus_suratmasuk/'.$suratmasuk->id_surat).'" class="btn btn-danger btn-sm">Hapus</a> 
            </td>
          </tr>
          ';
        }
         ?>
        </tbody>
      </table>
      <a href="#" class="btn btn-primary btn-sm" target="_blank" data-toggle="modal" data-target="#modal_add">Tambah Surat</a>
      <button class="btn btn-info btn-sm" onclick="printDiv('box-content')" id="btnPrint" disabled>Print</button> 
    </div><!-- /.table-responsive -->
<!-- /.table-responsive -->
  </div>
  </div>

  <!-- MODAL ADD -->
  <div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="modal_addLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="<?php echo base_url('index.php/surat/tambah_suratmasuk');?>" method="post" enctype="multipart/form-data">
          <div class="modal-header">
            <h4 class="modal-title" id="modal_addLabel"> Tambah Surat Masuk </h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Nomor Surat</label>
              <input type="text" name="nomor_surat" class="form-control1">
            </div>
            <div class="form-group">
              <label>Tgl. Kirim</label>
              <input type="date" name="tgl_kirim" class="form-control1">
            </div>
            <div class="form-group">
              <label>Tgl. Terima</label>
              <input type="date" name="tgl_terima" class="form-control1">
            </div>
            <div class="form-group">
              <label>Pengirim</label>
              <input type="text" name="pengirim" class="form-control1">
            </div>
            <div class="form-group">
              <label>Penerima</label>
              <input type="text" name="penerima" class="form-control1">
            </div>
            <div class="form-group">
              <label>Perihal</label>
              <input type="text" name="perihal" class="form-control1">
            </div>
            <div class="form-group">
              <label>Unggah Surat</label>
              <input type="file" name="file_surat" class="form-control1">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
            <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
          </div>
        </form>
      </div>
    </div>
  </div>

   <!-- MODAL EDIT -->
  <div class="modal fade" id="modal_ubah" tabindex="-1" role="dialog" aria-labelledby="modal_ubahLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="<?php echo base_url('index.php/surat/ubah_suratmasuk');?>" method="post" enctype="multipart/form-data">
          <div class="modal-header">
            <h4 class="modal-title" id="modal_addLabel"> Ubah Surat Masuk </h4>
          </div>
          <div class="modal-body">
            <input type="hidden" name="edit_id_surat" id="edit_id_surat">
            <div class="form-group">
              <label>Nomor Surat</label>
              <input type="text" name="edit_nomor_surat" id="edit_nomor_surat" class="form-control1">
            </div>
            <div class="form-group">
              <label>Tgl. Kirim</label>
              <input type="date" name="edit_tgl_kirim" id="edit_tgl_kirim" class="form-control1">
            </div>
            <div class="form-group">
              <label>Tgl. Terima</label>
              <input type="date" name="edit_tgl_terima" id="edit_tgl_terima" class="form-control1">
            </div>
            <div class="form-group">
              <label>Pengirim</label>
              <input type="text" name="edit_pengirim" id="edit_pengirim" class="form-control1">
            </div>
            <div class="form-group">
              <label>Penerima</label>
              <input type="text" name="edit_penerima" id="edit_penerima" class="form-control1">
            </div>
            <div class="form-group">
              <label>Perihal</label>
              <input type="text" name="edit_perihal" id="edit_perihal" class="form-control1">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
            <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
          </div>
        </form>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    function prepare_update_surat(id_surat)
    {
      $('#edit_file_surat').empty();
      $('#edit_id_surat').empty();
      $('#edit_nomor_surat').empty();
      $('#edit_tgl_terima').empty();
      $('#edit_tgl_kirim').empty();
      $('#edit_penerima').empty();
      $('#edit_pengirim').empty();
      $('#edit_perihal').empty();

      $.getJSON('<?php echo base_url() ?>index.php/surat/get_suratmasuk_byid/' + id_surat, function(data){
          $('#edit_file_surat').val(data.id_surat);
          $('#edit_id_surat').val(data.id_surat);
          $('#edit_nomor_surat').val(data.nomor_surat);
          $('#edit_tgl_terima').val(data.tgl_terima);
          $('#edit_tgl_kirim').val(data.tgl_kirim);
          $('#edit_penerima').val(data.penerima);
          $('#edit_pengirim').val(data.pengirim);
          $('#edit_perihal').val(data.perihal);
      });
    }
  </script> 

  <!-- MODAL UBAH FILE-->
  <div class="modal fade" id="modal_ubahfile" tabindex="-1" role="dialog" aria-labelledby="modal_ubahfileLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="<?php echo base_url('index.php/surat/ubah_file_suratmasuk');?>" method="post" enctype="multipart/form-data">
          <div class="modal-header">
            <h4 class="modal-title" id="modal_addLabel"> Ubah File Surat </h4>
          </div>
          <div class="modal-body">
            <input type="hidden" name="edit_id_surat" id="edit_file_surat">
            <div class="form-group">
              <label>Unggah Surat</label>
              <input type="file" name="edit_file_surat" class="form-control1">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
            <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
          </div>
        </form>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    function printDiv(divName) {
      var originalContents = document.body.innerHTML;
      $('#btnTambahSurat').css('display','none');
      $('#btnPrint').css('display','none');
      $('#rowAction').css('display','none');
      $('#data_suratmasuk td:nth-child(7)').css('display','none');

    var printContents = document.getElemenById(divName).outerHTML;

    document.body.innerHTML = printContents;

    window.print()

    document.body.innerHTML = originalContents;

    }
  </script>
