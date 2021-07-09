<?php 

namespace App\Controllers;

use App\Models\AnnoncesModel;

class AnnoncesController extends Controller
{
    public function index()
    {
        $annoncesModel = new AnnoncesModel;

        $annonces = $annoncesModel->findBy(['actif' => 1]);

        $this->render('annonces/index', [
            'annonces' => $annonces,
        ]);
        
    }

    public function lire(int $id)
    {
        $annoncesModel = new AnnoncesModel;

        $annonce = $annoncesModel->find($id);

        $this->render('annonces/lire', [
            'annonce' => $annonce
        ]);
    }
}