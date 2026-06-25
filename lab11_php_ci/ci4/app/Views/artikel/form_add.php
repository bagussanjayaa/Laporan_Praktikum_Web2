<?= $this->include('template/admin_header'); ?>

<h2><?= $title; ?></h2>

<?php if(isset($validation)): ?>

<div class="alert alert-danger">

    <?= $validation->listErrors(); ?>

</div>

<?php endif; ?>

<form action=""
      method="post"
      enctype="multipart/form-data">

    <p>
        <label for="judul">
            Judul Artikel
        </label>

        <input type="text"
               name="judul"
               id="judul"
               class="form-control"
               placeholder="Masukkan judul artikel..."
               required>
    </p>

    <p>
        <label for="isi">
            Isi Artikel
        </label>

        <textarea name="isi"
                  id="isi"
                  cols="50"
                  rows="10"
                  class="form-control"
                  placeholder="Tulis isi artikel..."></textarea>
    </p>

    <p>
        <label for="id_kategori">
            Kategori
        </label>

        <select name="id_kategori"
                id="id_kategori"
                class="form-control"
                required>

            <option value="">
                -- Pilih Kategori --
            </option>

            <?php foreach($kategori as $k): ?>

            <option value="<?= $k['id_kategori']; ?>">

                <?= $k['nama_kategori']; ?>

            </option>

            <?php endforeach; ?>

        </select>
    </p>

    <p>
        <label for="gambar">
            Upload Gambar
        </label>

        <input type="file"
               name="gambar"
               id="gambar"
               class="form-control"
               accept="image/*"
               onchange="previewImage(event)"
               required>
    </p>

    <!-- Preview Gambar -->
    <p>

        <img id="preview"
             src=""
             style="
                display:none;
                width:220px;
                margin-top:10px;
                border-radius:10px;
                box-shadow:0 2px 8px rgba(0,0,0,0.2);
             ">

    </p>

    <p style="margin-top:20px;">

        <button type="submit"
                class="btn btn-primary">

            Simpan Artikel

        </button>

        <a href="<?= base_url('/admin/artikel'); ?>"
           class="btn btn-danger">

            Batal

        </a>

    </p>

</form>

<script>

function previewImage(event)
{
    const image = document.getElementById('preview');

    image.src = URL.createObjectURL(event.target.files[0]);

    image.style.display = 'block';
}

</script>

<?= $this->include('template/admin_footer'); ?>