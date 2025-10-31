<?php

namespace App\Services\Loket\Admisi;

use App\Repositories\Loket\Admisi\LoketAdmisiRepository;

class LoketAdmisiService
{
    protected $LoketAdmisiRepository;

    public function __construct(LoketAdmisiRepository $LoketAdmisiRepository)
    {
        $this->LoketAdmisiRepository = $LoketAdmisiRepository;
    }

    public function getAllLoket()
    {
        return $this->LoketAdmisiRepository->getAllLoket();
    }

    public function lockLoket($id, $petugas = null)
    {
        return $this->LoketAdmisiRepository->lockLoket($id, $petugas);
    }

    public function unlockLoket($id)
    {
        return $this->LoketAdmisiRepository->unlockLoket($id);
    }

}
