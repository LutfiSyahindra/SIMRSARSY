<?php

namespace App\Services\PetugasPanggil;

use App\Repositories\PetugasPanggil\PoliRepository;

class PoliService
{
    protected $poliRepository;

    public function __construct(PoliRepository $poliRepository)
    {
        $this->poliRepository = $poliRepository;
    }

    public function getPoliData()
    {
        return $this->poliRepository->getAllPoli();
    }
    public function getPasien($kd_poli, $kd_sps)
    {
        return $this->poliRepository->getPasien($kd_poli, $kd_sps);
    }

    public function getDokter($kd_poli)
    {
        return $this->poliRepository->getDokter($kd_poli);
    }

}
