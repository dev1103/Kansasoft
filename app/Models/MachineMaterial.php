<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineMaterial extends Model
{
    use HasFactory;

    protected $table = 'tbl_machine_material';

    protected $fillable = [
        'name',
    ];

    public function machines() {
        return $this->hasMany(Machine::class, 'material', 'id');
    }
}
