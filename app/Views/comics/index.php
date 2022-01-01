<?= $this->extend("layouts/template"); ?>

<?= $this->section("content"); ?>
<div class="container">
  <div class="row">
    <div class="col">

      <h1 class="mt-3">Comic List</h1>
      <a href="/comics/create" class="btn btn-primary mb-3">Tambah data buku</a>

      <!-- Jika session flash data dengan key pesan ada, maka tampilkan pada alert -->
      <?php if (session()->getFlashdata("pesan")) : ?>
        <div class="alert alert-success" role="alert">
          <?= session()->getFlashdata("pesan") ?>
        </div>
      <?php endif ?>

      <!-- Table start -->
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Preview</th>
            <th scope="col">Title</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1 ?>
          <?php foreach ($komik as $k) : ?>
            <tr>
              <th scope="row"><?= $i++; ?></th>
              <td><img src="/img/<?= $k["sampul"] ?>" alt="Sampul Buku" class="sampul"></td>
              <td><?= $k["judul"] ?></td>
              <td><a href="/comics/<?= $k["slug"] ?>" class="btn btn-success">Detail</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <!-- table end -->
    </div>

  </div>
</div>
<?= $this->endSection(); ?>