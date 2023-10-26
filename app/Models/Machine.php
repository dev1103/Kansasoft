<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $table = 'tbl_machine';

    protected $fillable = [
        'name',
        'description',
        'type',
        'material'
    ];

    public function materialDetail() {
        return $this->hasOne(MachineMaterial::class, 'id', 'material');
    }
}
