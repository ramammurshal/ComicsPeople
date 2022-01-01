<?= $this->extend("layouts/template") ?>

<?= $this->section("content") ?>
<div class="container">
  <div class="row">
    <div class="col">

      <h2 class="my-3">Detail komik</h2>

      <!-- Card start -->
      <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="/img/<?= $komik["sampul"] ?>" class="img-fluid rounded-start" alt="">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title"><?= $komik["judul"] ?></h5>
              <p class="card-text"><b>Penulis : </b><?= $komik["penulis"] ?></p>
              <p class="card-text">
                <small class="text-muted">
                  <b>Penerbit : </b>
                  <?= $komik["penerbit"] ?>
                </small>
              </p>

              <a href="/comics/edit/<?= $komik['slug'] ?>" class="btn btn-warning">Edit</a>

              <!-- button untuk delete dengan penambahan fitur keamanan -->
              <form action="/comics/<?= $komik['id']; ?>" method="post" class="d-inline">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus buku ini?');">
                  Delete
                </button>
              </form>

              <br><br>

              <!-- terdapat masalah apabila menggunakan ini -->
              <!-- <a href="/comics/delete/<?= $komik['id']; ?>" class="btn btn-danger">Delete</a><br><br> -->

              <a href="/comics">Kembali ke daftar</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Card end -->

    </div>
  </div>
</div>
<?= $this->endSection(); ?>