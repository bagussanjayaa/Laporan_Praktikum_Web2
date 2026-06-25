<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>


<h1>
    <?= $title; ?>
</h1>

<hr>


<p>
    <?= $deskripsi; ?>
</p>



<h2>
    Artikel Terbaru
</h2>


<?php foreach($artikel as $a): ?>


<div style="
    border-bottom:1px solid #ddd;
    padding:15px 0;
">


<h3>

<?= $a['judul']; ?>

</h3>



<p>

<b>
Kategori:
</b>

<?= $a['nama_kategori'] ?? 'Tanpa Kategori'; ?>

</p>



<p>

<?= substr($a['isi'],0,150); ?>...

</p>



<a href="/artikel/<?= $a['slug']; ?>">

Baca Selengkapnya

</a>


</div>



<?php endforeach; ?>



<?= $this->endSection() ?>