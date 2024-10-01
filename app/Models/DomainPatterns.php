<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainPatterns extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function domain()
    {
        return $this->hasOne(Domains::class, 'id', 'domains_id');
    }

    public function fields()
    {
        return $this->hasMany(DomainPatternFields::class, 'domain_patterns_id', 'id');
    }
}
