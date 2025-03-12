<?php

namespace App\Services\AntrianApotek3;

use App\Repositories\AntrianApotek\AntrianApotekRepository;

class AntrianApotek3Service
{
    protected $antrianApotekRepository;

    public function __construct(AntrianApotekRepository $antrianApotekRepository)
    {
        $this->antrianApotekRepository = $antrianApotekRepository;
    }

    public function getAntriapotek3()
    {
        return $this->antrianApotekRepository->getAntriapotek3();
    }

    public function updateAntriapotek3($panggil)
    {
        return $this->antrianApotekRepository->updateAntriapotek3($panggil);
    }

    public function dataNonracikan(){
        return $this->antrianApotekRepository->nonRacikan();
    }
    public function dataracikan(){
        return $this->antrianApotekRepository->racikan();
    }

}
