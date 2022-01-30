<?php

namespace App\Models;

use Laratrust\Models\LaratrustPermission;
use DateTimeInterface;


class Permission extends LaratrustPermission
{
    public $guarded = [];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
