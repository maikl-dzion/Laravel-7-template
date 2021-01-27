<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseReference extends Model
{
    use HasFactory;
    protected $table = 'basicrefbook';
    protected $primaryKey = 'id';

    public function getPrimaryKey() {
        return $this->primaryKey;
    }
}
