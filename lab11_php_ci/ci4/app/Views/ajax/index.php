<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .table-container {
        overflow-x: auto;
        margin-top: 20px;
    }

    .ajax-table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
    }

    .ajax-table th {
        background: #2c3e50;
        color: white;
        padding: 12px;
        text-align: left;
    }

    .ajax-table td {
        padding: 12px;
        border-bottom: 1px solid #ddd;
        vertical-align: top;
    }

    .ajax-table tr:hover {
        background: #f5f5f5;
    }

    .badge {
        padding: 5px 10px;
        border-radius: 5px;
        color: white;
        font-size: 12px;
    }

    .publish {
        background: green;
    }

    .draft {
        background: orange;
    }

    .btn {
        padding: 6px 10px;
        text-decoration: none;
        border-radius: 4px;
        color: white;
        font-size: 13px;
    }

    .btn-edit {
        background: #3498db;
    }

    .btn-delete {
        background: #e74c3c;
    }
</style>

<h1>Data Artikel AJAX</h1>

<div class="table-container">

    <table class="ajax-table" id="artikelTable">

        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Isi</th>
                <th>Status</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td colspan="7">Loading data...</td>
            </tr>
        </tbody>

    </table>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){

    function loadData()
    {
        $.ajax({

            url: "<?= base_url('admin/ajax/getData'); ?>",
            type: "GET",
            dataType: "json",

            success: function(data){

                let html = "";

                $.each(data, function(i, row){

                    let statusBadge =
                        row.status == 1
                        ? '<span class="badge publish">Publish</span>'
                        : '<span class="badge draft">Draft</span>';

                    html += `
                    <tr>

                        <td>${row.id}</td>

                        <td>
                            <strong>${row.judul}</strong>
                        </td>

                        <td>${row.nama_kategori}</td>

                        <td>
                            ${row.isi.substring(0, 100)}...
                        </td>

                        <td>
                            ${statusBadge}
                        </td>

                        <td>
                            ${row.gambar ? row.gambar : '-'}
                        </td>

                        <td>

                            <a href="<?= base_url('/admin/artikel/edit/'); ?>${row.id}"
                               class="btn btn-edit">
                               Edit
                            </a>

                            <a href="#"
                               class="btn btn-delete"
                               data-id="${row.id}">
                               Delete
                            </a>

                        </td>

                    </tr>
                    `;
                });

                $('#artikelTable tbody').html(html);
            },

            error: function(xhr){
                console.log(xhr.responseText);
            }

        });
    }

    loadData();

    // DELETE AJAX
    $(document).on('click', '.btn-delete', function(e){

        e.preventDefault();

        let id = $(this).data('id');

        if(confirm('Yakin ingin hapus artikel?'))
        {
            $.ajax({

                url: "<?= base_url('admin/ajax/delete/'); ?>" + id,
                type: "DELETE",

                success: function(response){

                    alert('Data berhasil dihapus');

                    loadData();
                },

                error: function(xhr){
                    console.log(xhr.responseText);
                }

            });
        }

    });

});
</script>

<?= $this->endSection() ?>