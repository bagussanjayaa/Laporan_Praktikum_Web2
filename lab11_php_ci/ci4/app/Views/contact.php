<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h1><?= $title; ?></h1>

<hr>

<p>
    <?= $content; ?>
</p>


<h3>Kontak Pembuat</h3>

<table cellpadding="8">

<tr>
<td>Nama</td>
<td>:</td>
<td>Bagus Sanjaya</td>
</tr>


<tr>
<td>Email</td>
<td>:</td>
<td>bagussanjaya431@gmail.com</td>
</tr>


<tr>
<td>Project</td>
<td>:</td>
<td>Portal Berita CI4 + Vue JS</td>
</tr>


</table>


<?= $this->endSection() ?>