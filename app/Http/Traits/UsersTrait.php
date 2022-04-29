<?php

namespace App\Http\Traits;

trait UsersTrait
{
 

    private function get_user_by_id($id)
    {
        return $this->UserModel::findOrFail($id);
    }
}
