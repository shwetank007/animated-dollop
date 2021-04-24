<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    protected $table = 'searches';

    protected $fillable = ['title', 'description', 'url'];
}
