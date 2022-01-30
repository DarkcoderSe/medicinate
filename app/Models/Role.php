<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;
use DateTimeInterface;


class Role extends LaratrustRole
{
    public $guarded = [];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
