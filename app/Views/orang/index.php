<?= $this->extend("layouts/template"); ?>

<?= $this->section("content"); ?>
<div class="container">
  <!-- Search -->
  <div class="row">
    <div class="col-sm-6">
      <h1 class="mt-3">Daftar Orang</h1>
      <form action="" method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Masukkan keyword pencarian" name="keyword">
          <button class="btn btn-primary" type="submit" id="submit">Cari</button>
        </div>
      </form>
    </div>
  </div>

  <!-- List -->
  <div class="row">
    <div class="col">
      <!-- Table start -->
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Alamat</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1 + (8 * ($currentPage - 1)); ?>
          <?php foreach ($orang as $k) : ?>
            <tr>
              <th scope="row"><?= $i++; ?></th>
              <td><?= $k["nama_orang"] ?></td>
              <td><?= $k["alamat_orang"] ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <!-- table end -->
      <!-- nama table, file handler pagination -->
      <?= $pager->links('orang', 'orang_pagination'); ?>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>