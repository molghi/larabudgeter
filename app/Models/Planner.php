<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planner extends Model
{
    use HasFactory;

    protected $table = 'planner';

    protected $fillable = ['title',	'amount', 'when',	'user_id'];
}
