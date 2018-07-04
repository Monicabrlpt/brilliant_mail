	        <div class="graphs" id="box-content">
            <div class="content_bottom">
                <div class="col-md-12 span_3">
                <div class="bs-example1" data-example-id="contextual-table"><span><h3>Tabel Surat Keluar</h3></span></div>
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
            <th>PENERIMA</th>
            <th>TGL. KIRIM</th>
            <th>PERIHAL</th>
            <th id="rowAction">AKSI</th>
          </tr>
        </thead>
        <tbody id="data_suratkeluar">
          <tr>
            <?php
            $no = 0;
            foreach ($data_suratkeluar as $suratkeluar) {
              echo '
            
            <td>'.++$no.'</td>
            <td>'.$suratkeluar->nomor_surat.'</td>
            <td>'.$suratkeluar->penerima.'</td>
            <td>'.$suratkeluar->tgl_kirim.'</td>
            <td>'.$suratkeluar->perihal.'</td>
            <td>
              <a href="'.base_url('uploads/'.$suratkeluar->file_surat).'" class="btn btn-info btn-sm" target="_blank">Lihat Surat</a> 
              <a href="'.base_url('index.php/surat/hapus_suratkeluar/'.$suratkeluar->id_surat).'" class="btn btn-danger btn-sm">Hapus</a> 
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
        <form action="<?php echo base_url('index.php/surat/tambah_suratkeluar');?>" method="post" enctype="multipart/form-data">
          <div class="modal-header">
            <h4 class="modal-title" id="modal_addLabel"> Tambah Surat Keluar </h4>
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

  <script type="text/javascript">
    function printDiv(divName) {
      var originalContents = document.body.innerHTML;
      $('#btnTambahSurat').css('display','none');
      $('#btnPrint').css('display','none');
      $('#rowAction').css('display','none');
      $('#data_suratkeluar td:nth-child(7)').css('display','none');

    var printContents = document.getElemenById(divName).outerHTML;

    document.body.innerHTML = printContents;

    window.print()

    document.body.innerHTML = originalContents;

    }
  </script>
