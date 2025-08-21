<?php

namespace App\Repositories\TaskId;

use App\Models\khanza\LogWaModel;
use App\Models\khanza\TaskIdModel;
use App\Models\khanza\wa_gatewayModel;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class TaskIdRepository
{
    public function getTaskId()
    {
        return TaskIdModel::query();
    }

    public function getLogTaskId($id)
    {
        return TaskIdModel::where('id', $id)->get();
    }
    

}
