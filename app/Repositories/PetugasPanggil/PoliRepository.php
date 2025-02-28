<?php

namespace App\Repositories\PetugasPanggil;

use App\Models\khanza\dokterModel;
use App\Models\khanza\pasienPoliModel;
use App\Models\khanza\poliModel;

class PoliRepository
{
    public function getAllPoli()
    {
        return poliModel::getPoli();
    
    }
    public function getDokter($kd_poli)
    {
        return dokterModel::getDokter($kd_poli);
    }

    public function getPasien($kd_poli, $kd_sps)
    {
        return pasienPoliModel::getPasien($kd_poli, $kd_sps);
    }

}
