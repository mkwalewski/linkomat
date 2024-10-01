<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domains extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function patterns()
    {
        return $this->hasMany(DomainPatterns::class, 'domains_id', 'id');
    }
}
