<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
use CodeIgniter\Controller;

class AjaxController extends Controller
{
    public function index()
    {
        return view('ajax/index', [
            'title' => 'Data Artikel AJAX'
        ]);
    }

    public function getData()
    {
        $model = new ArtikelModel();

        $data = $model->getArtikelAjax();

        return $this->response->setJSON($data);
    }

    public function delete($id)
    {
        $model = new ArtikelModel();

        $model->delete($id);

        return $this->response->setJSON([
            'status' => 'OK'
        ]);
    }
}