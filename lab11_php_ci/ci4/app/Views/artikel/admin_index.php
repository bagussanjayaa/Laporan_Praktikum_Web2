<?= $this->include('template/admin_header'); ?>

<h2><?= $title; ?></h2>

<div class="row mb-3">

    <form id="search-form" method="get" class="form-search">

        <input type="text"
               name="q"
               value="<?= $q; ?>"
               placeholder="Cari judul artikel">

        <select name="kategori_id">

            <option value="">Semua Kategori</option>

            <?php foreach($kategori as $k): ?>

            <option value="<?= $k['id_kategori']; ?>"
                <?= ($kategori_id == $k['id_kategori']) ? 'selected' : ''; ?>>

                <?= $k['nama_kategori']; ?>

            </option>

            <?php endforeach; ?>

        </select>

        <select id="sort" name="sort">
            <option value="">Urutkan</option>
            <option value="judul_asc">Judul A-Z</option>
            <option value="judul_desc">Judul Z-A</option>
        </select>

        <input type="submit"
               value="Cari"
               class="btn btn-primary">

    </form>

</div>

<div id="article-container">
    <p>Loading data...</p>
</div>

<div id="pagination-container"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

$(document).ready(function(){

    const articleContainer = $('#article-container');
    const paginationContainer = $('#pagination-container');

    function fetchData(url)
    {
        articleContainer.html(
            '<p style="text-align:center">Loading data...</p>'
        );

        $.ajax({

            url: url,
            type: 'GET',
            dataType: 'json',

            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },

            success: function(data)
            {
                renderArticles(data.artikel);
                renderPagination(data.pager);
            },

            error: function(xhr)
            {
                console.log(xhr.responseText);
            }

        });
    }

    function renderArticles(articles)
    {
        let html = `
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
        `;

        if(articles.length > 0)
        {
            articles.forEach(article => {

                html += `
                <tr>

                    <td>${article.id}</td>

                    <td>
                        <b>${article.judul}</b>
                        <p>
                            <small>
                                ${article.isi.substring(0,50)}
                            </small>
                        </p>
                    </td>

                    <td>
                        ${article.nama_kategori}
                    </td>

                    <td>
                        ${article.status == 1 ? 'Publish' : 'Draft'}
                    </td>

                    <td>

                        <a class="btn"
                        href="/admin/artikel/edit/${article.id}">
                        Ubah
                        </a>

                        <a class="btn btn-danger"
                        href="/admin/artikel/delete/${article.id}"
                        onclick="return confirm('Yakin menghapus data?')">
                        Hapus
                        </a>

                    </td>

                </tr>
                `;
            });
        }
        else
        {
            html += `
            <tr>
                <td colspan="5">
                    Tidak ada data.
                </td>
            </tr>
            `;
        }

        html += '</tbody></table>';

        articleContainer.html(html);
    }

    function renderPagination(pager)
    {
        let html = '';

        for(let i = 1; i <= pager.pageCount; i++)
        {
            html += `
                <a href="#"
                   class="page-link"
                   data-page="${i}"
                   style="
                        padding:8px 12px;
                        border:1px solid #ddd;
                        margin-right:5px;
                        text-decoration:none;
                   ">
                    ${i}
                </a>
            `;
        }

        paginationContainer.html(html);
    }

    $('#search-form').submit(function(e){

        e.preventDefault();

        let q = $('input[name=q]').val();
        let kategori = $('select[name=kategori_id]').val();
        let sort = $('#sort').val();

        fetchData(
            "<?= base_url('/admin/artikel'); ?>" +
            "?q=" + q +
            "&kategori_id=" + kategori +
            "&sort=" + sort
        );

    });

    $(document).on('click', '.page-link', function(e){

        e.preventDefault();

        let page = $(this).data('page');

        let q = $('input[name=q]').val();
        let kategori = $('select[name=kategori_id]').val();

        fetchData(
            "<?= base_url('/admin/artikel'); ?>" +
            "?page=" + page +
            "&q=" + q +
            "&kategori_id=" + kategori
        );

    });

    $('#sort').change(function(){

        let q = $('input[name=q]').val();
        let kategori = $('select[name=kategori_id]').val();
        let sort = $(this).val();

        fetchData(
            "<?= base_url('/admin/artikel'); ?>" +
            "?q=" + q +
            "&kategori_id=" + kategori +
            "&sort=" + sort
        );

    });

    fetchData("<?= base_url('/admin/artikel'); ?>");

});
</script>

<?= $this->include('template/admin_footer'); ?>