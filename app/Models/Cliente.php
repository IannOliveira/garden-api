<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cliente extends Model
{
    use HasFactory, HasFactory, Notifiable;

    protected $guarded = ['id'];

    protected $table = 'cliente';


}
