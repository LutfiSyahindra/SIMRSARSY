<?php

namespace App\Repositories\WaGateway;

use App\Models\khanza\wa_gatewayModel;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class WaGatewayRepository
{
    public function getWaTerkirim()
    {
        return wa_gatewayModel::query();
    }
    

}
