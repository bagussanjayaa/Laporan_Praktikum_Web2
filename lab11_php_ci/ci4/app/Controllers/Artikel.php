<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
use App\Models\KategoriModel;

class Artikel extends BaseController
{
    // ==========================================
    // PUBLIC
    // ==========================================

    public function index()
    {
        $title = 'Daftar Artikel';

        $model = new ArtikelModel();

        $artikel = $model->getArtikelDenganKategori();

        return view('artikel/index', [
            'title'   => $title,
            'artikel' => $artikel
        ]);
    }

    public function view($slug)
    {
        $model = new ArtikelModel();

        $artikel = $model
            ->select('artikel.*, kategori.nama_kategori')
            ->join(
                'kategori',
                'kategori.id_kategori = artikel.id_kategori',
                'left'
            )
            ->where('slug', $slug)
            ->first();

        if (!$artikel) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('artikel/detail', [
            'title'   => $artikel['judul'],
            'artikel' => $artikel
        ]);
    }

    // ==========================================
    // ADMIN
    // ==========================================

    public function admin_index()
    {
        $title = 'Daftar Artikel';

        $q = $this->request->getVar('q') ?? '';
        $kategori_id = $this->request->getVar('kategori_id') ?? '';
        $sort = $this->request->getVar('sort') ?? '';

        $model = new ArtikelModel();

        $builder = $model
        ->select('artikel.*, kategori.nama_kategori')
        ->join(
            'kategori',
            'kategori.id_kategori = artikel.id_kategori',
            'left'
        );

        if ($q != '') {
            $builder->like('judul', $q);
        }

        if ($kategori_id != '') {
            $builder->where('artikel.id_kategori', $kategori_id);
        }
        if ($sort == 'judul_asc') {
            $builder->orderBy('judul', 'ASC');
        }

        if ($sort == 'judul_desc') {
            $builder->orderBy('judul', 'DESC');
        }

        $artikel = $builder->paginate(5);
        $pager = $model->pager;

        $data = [
            'title' => $title,
            'artikel' => $artikel,
            'pager' => $pager,
            'q' => $q,
            'kategori_id' => $kategori_id,
            'sort' => $sort
        ];

        if ($this->request->isAJAX()) {

            return $this->response->setJSON([
                'artikel' => $artikel,
                'pager' => [
                    'currentPage' => $pager->getCurrentPage(),
                    'pageCount' => $pager->getPageCount(),
                    'links' => $pager->links()
                ],
                'q' => $q,
                'kategori_id' => $kategori_id,
                'sort' => $sort
            ]);
        }

        $kategoriModel = new \App\Models\KategoriModel();
        $data['kategori'] = $kategoriModel->findAll();

        return view('artikel/admin_index', $data);
    }

    // ==========================================
    // TAMBAH ARTIKEL
    // ==========================================

    public function add()
    {
        helper(['form', 'text']);

        $kategoriModel = new KategoriModel();

        if (strtolower($this->request->getMethod()) === 'post') {

            $rules = [
                'judul' => 'required',
                'isi' => 'required',
                'id_kategori' => 'required',
                'gambar' => [
                    'rules' => 'uploaded[gambar]|max_size[gambar,2048]|is_image[gambar]',
                    'errors' => [
                        'uploaded' => 'Gambar wajib diupload',
                        'max_size' => 'Ukuran gambar terlalu besar',
                        'is_image' => 'File harus berupa gambar'
                    ]
                ]
            ];

            if (!$this->validate($rules)) {

                return view('artikel/form_add', [
                    'title'      => 'Tambah Artikel',
                    'kategori'   => $kategoriModel->findAll(),
                    'validation' => $this->validator
                ]);
            }

            // Upload gambar
            $fileGambar = $this->request->getFile('gambar');

            $namaGambar = $fileGambar->getRandomName();

            $fileGambar->move(
                ROOTPATH . 'public/gambar',
                $namaGambar
            );

            // Simpan ke database
            $model = new ArtikelModel();

            $result = $model->insert([
                'judul'       => $this->request->getPost('judul'),
                'isi'         => $this->request->getPost('isi'),
                'slug'        => url_title(
                    $this->request->getPost('judul'),
                    '-',
                    true
                ),
                'id_kategori' => $this->request->getPost('id_kategori'),
                'gambar'      => $namaGambar,
                'status'      => 1
            ]);

            dd($result);

            return redirect()->to('/admin/artikel');
        }

        return view('artikel/form_add', [
            'title'    => 'Tambah Artikel',
            'kategori' => $kategoriModel->findAll()
        ]);
    }

    // ==========================================
    // EDIT ARTIKEL
    // ==========================================

    public function edit($id)
    {
        helper(['form', 'text']);

        $model = new ArtikelModel();

        $kategoriModel = new KategoriModel();

        $artikel = $model->find($id);

        if (!$artikel) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->request->is('post')) {

            $data = [
                'judul'       => $this->request->getPost('judul'),
                'isi'         => $this->request->getPost('isi'),
                'slug'        => url_title(
                    $this->request->getPost('judul'),
                    '-',
                    true
                ),
                'id_kategori' => $this->request->getPost('id_kategori'),
            ];

            // Cek apakah upload gambar baru
            $fileGambar = $this->request->getFile('gambar');

            if ($fileGambar && $fileGambar->isValid()) {

                $namaGambar = $fileGambar->getRandomName();

                dd(
                    $fileGambar->isValid(),
                    $fileGambar->getError(),
                    $fileGambar->getName()
                );
                $fileGambar->move(
                    ROOTPATH . 'public/gambar',
                    $namaGambar
                );

                $data['gambar'] = $namaGambar;
            }

            $model->update($id, $data);

            return redirect()->to('/admin/artikel');
        }

        return view('artikel/form_edit', [
            'title'    => 'Edit Artikel',
            'artikel'  => $artikel,
            'kategori' => $kategoriModel->findAll()
        ]);
    }

    // ==========================================
    // HAPUS ARTIKEL
    // ==========================================

    public function delete($id)
    {
        $model = new ArtikelModel();

        $artikel = $model->find($id);

        // Hapus gambar dari folder
        if (
            $artikel['gambar'] != ''
            && file_exists(ROOTPATH . 'public/gambar/' . $artikel['gambar'])
        ) {
            unlink(ROOTPATH . 'public/gambar/' . $artikel['gambar']);
        }

        $model->delete($id);

        return redirect()->to('/admin/artikel');
    }
}