<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{

    protected $fillable = [
        'id',
        'description',
        'hash_file',
        'hash_user',
    ];


}
