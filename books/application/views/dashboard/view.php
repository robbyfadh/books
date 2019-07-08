  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">View Data Buku</h1>
      </div>

      
      <?php
      // arahkan form submit ke kontroller 'buku/insert' 
      foreach ($buku as $buku_item){
      echo form_open_multipart('buku/edit/'.$buku_item['idbuku']); 
      
        ?>
            <div class="table-responsive">
        <table class="table table-striped table-sm">
          <tbody>
            <?php 
            // menampilkan data buku
            foreach ($buku as $buku_item): 
            ?>
            <tr><td rowspan="6" width="305px"><img src="../../../assets/images/<?php echo $buku_item['imgfile'] ?>" width='300px' height='400px'></td></tr>
            <tr><td width="100px">Judul Buku</td><td><?php echo $buku_item['judul']?></td></tr>
            <tr><td>Pengarang</td><td><?php echo $buku_item['pengarang']?></td></tr>
            <tr><td>Penerbit</td><td><?php echo $buku_item['penerbit']?></td></tr>
            <tr><td>Tahun Terbit</td><td><?php echo $buku_item['thnterbit']?></td></tr>
            <tr><td>Kategori</td><td><?php 
              foreach ($kategori as $item_kategori) {
              echo $item_kategori['kategori']; } ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php } ?>
    </main>
  