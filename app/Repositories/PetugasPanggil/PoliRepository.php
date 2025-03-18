<?php

namespace App\Repositories\PetugasPanggil;

use App\Models\khanza\dokterModel;
use App\Models\khanza\pasienPoliModel;
use App\Models\khanza\poliModel;
use Carbon\Carbon;

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

    public function getDataPasien()
    {
        return pasienPoliModel::join('poliklinik', 'reg_periksa.kd_poli', '=', 'poliklinik.kd_poli')
        ->join('pasien', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')
        ->join('dokter', 'reg_periksa.kd_dokter', '=', 'dokter.kd_dokter')
        ->select(
            'reg_periksa.no_rawat',
            'reg_periksa.no_reg',
            'pasien.nm_pasien',
            'poliklinik.nm_poli',
            'pasien.tgl_lahir',
            'pasien.alamat',
            'pasien.jk',
            'pasien.no_rkm_medis',
            'dokter.nm_dokter'
        )
        ->whereDate('reg_periksa.tgl_registrasi', Carbon::today())
        ->cursor();
    }

}
