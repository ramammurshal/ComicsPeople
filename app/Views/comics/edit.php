<?= $this->extend("layouts/template") ?>

<?= $this->section("content") ?>
<div class="container">
  <div class="row">
    <div class="col-8">

      <h2 class="my-3">Form edit komik</h2>
      <!-- $validation->listErros() untuk nampilin semua error di variable validation yang dikirimkan -->

      <!-- Form -->
      <form action="/comics/update/<?= $komik['id'] ?>" method="POST" enctype="multipart/form-data">
        <!-- agar form hanya bisa diinput dari page ini -->
        <?= csrf_field() ?>

        <!-- slug -->
        <input type="hidden" name="slug" value="<?= $komik['slug'] ?>">

        <!-- sampulLama -->
        <input type="hidden" name="sampulLama" value="<?= $komik['sampul'] ?>">

        <!-- Judul -->
        <div class="mb-3">
          <label for="judul" class="form-label">Judul</label>
          <!-- autofocus -->
          <!-- jika terdapat error pada judul, maka tambahkan class is-invalid bawaan bootstrap, handle nya ada di div bawah -->
          <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : '' ?>" id="judul" name="judul" autofocus value="<?= (old('judul')) ? old('judul') : $komik['judul'] ?>">
          <div class="invalid-feedback">
            <?= $validation->getError("judul"); ?>
          </div>
        </div>

        <!-- Penulis -->
        <div class="mb-3">
          <label for="penulis" class="form-label">Penulis</label>
          <!-- old untuk memberikan nilai lama ketika form nya sudah di submit, tetapi di method save controllernya kita harus mengirimkan withInput secara chaining -->
          <input type="text" class="form-control" id="penulis" name="penulis" value="<?= (old('penulis')) ? old('penulis') : $komik['penulis'] ?>">
        </div>

        <!-- Penerbit -->
        <div class="mb-3">
          <label for="penerbit" class="form-label">Penerbit</label>
          <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= (old('penerbit')) ? old('penerbit') : $komik['penerbit'] ?>">
        </div>

        <!-- Sampul -->
        <div class="mb-3">
          <label for="sampul" class="form-label">Sampul</label>
          <div class="row">
            <div class="col-sm-3">
              <!-- img-thumbnail bawaan bootstrap untuk beri border -->
              <img src="/img/<?= $komik['sampul'] ?>" class="img-thumbnail img-preview">
            </div>
            <div class="col-sm-9">
              <input class="form-control <?= ($validation->hasError('sampul')) ? 'is-invalid' : '' ?>" type="file" id="sampul" name="sampul" onchange="previewImage()">
              <div class="invalid-feedback">
                <?= $validation->getError("sampul"); ?>
              </div>
            </div>
          </div>
        </div>

        <!-- Button -->
        <button type="submit" class="btn btn-primary">Edit Data</button>

      </form>
      <!-- end form -->

    </div>
  </div>
</div>
<?= $this->endSection(); ?>