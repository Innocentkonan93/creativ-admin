<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_demande';
    // protected $hidden = [
    //     'id',
    // ];

    public $incrementing = false;
    public $timestamps = false;
}
