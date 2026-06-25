<?php

namespace App\Controllers;


use App\Models\ArtikelModel;


class Home extends BaseController
{


    public function index()
    {

        $model = new ArtikelModel();


        $artikel = $model
            ->select('artikel.*, kategori.nama_kategori')
            ->join(
                'kategori',
                'kategori.id_kategori = artikel.id_kategori',
                'left'
            )
            ->orderBy('id','DESC')
            ->findAll();



        $data = [


            'title'=>'Portal Berita',


            'deskripsi'=>
            'Website berita berbasis CodeIgniter 4 REST API dan Vue JS',


            'artikel'=>$artikel


        ];



        return view(
            'home/index',
            $data
        );


    }


}