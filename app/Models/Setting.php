<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;

class Setting extends Model
{

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public $table = 'settings';

}
