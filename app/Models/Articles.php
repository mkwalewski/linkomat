<?php

namespace App\Models;

use App\Helpers\PluralHelper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    use HasFactory;

    public $timestamps = false;
    private const WPM_COUNT = 200;
    protected $casts = [
        'date'  => 'date:d-m-Y',
        'created_at'  => 'date:d-m-Y',
    ];
    protected $appends = ['domains_name', 'domains_icon', 'date_timestamp', 'created_at_timestamp', 'is_read', 'read_time'];
    protected $fillable = ['domains_id', 'url', 'title', 'image', 'date', 'author', 'category', 'tags', 'content', 'words_count', 'created_at', 'is_premium'];

    public function domain()
    {
        return $this->hasOne(Domains::class, 'id', 'domains_id');
    }

    protected function domainsName(): Attribute
    {
        return new Attribute(
            get: fn () => $this->domain->name
        );
    }

    protected function domainsIcon(): Attribute
    {
        return new Attribute(
            get: fn () => $this->domain->icon
        );
    }

    protected function dateTimestamp(): Attribute
    {
        return new Attribute(
            get: fn () => $this->date->timestamp ?? 0,
        );
    }

    protected function createdAtTimestamp(): Attribute
    {
        return new Attribute(
            get: fn () => $this->created_at->timestamp ?? 0,
        );
    }

    protected function isRead(): Attribute
    {
        return new Attribute(
            get: fn () => (bool)$this->read_at
        );
    }

    protected function readTime(): Attribute
    {
        $minutes = floor($this->words_count / self::WPM_COUNT);
        return new Attribute(
            get: fn () => PluralHelper::plural($minutes,'minuta', 'minuty', 'minut')
        );
    }
}
