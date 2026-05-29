<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'description', 'price', 'is_ready', 'image'])]
class Menu extends Model
{
    public function getStatusAttribute() {
        return $this->is_ready;
    }
}