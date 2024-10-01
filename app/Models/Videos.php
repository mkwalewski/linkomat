<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    use HasFactory;

    public $timestamps = false;
    private const VIEWS = ['', 'K', 'M'];
    protected $casts = [
        'date'  => 'date:d-m-Y',
        'created_at'  => 'date:d-m-Y',
    ];
    protected $appends = ['is_watch', 'length_formatted', 'view_count_formatted', 'date_timestamp', 'created_at_timestamp'];
    protected $fillable = ['domains_id', 'url', 'video_id', 'channel_id', 'channel_url', 'title', 'author', 'date', 'category', 'keywords', 'short_description', 'view_count', 'length', 'thumb', 'created_at', 'watch_at'];

    private function getViewCountFormatted()
    {
        $count = 0;

        while ($this->view_count > 1000) {
            $count++;
            $this->view_count /= 1000;
        }
        $views = sprintf('%d%s', $this->view_count, self::VIEWS[$count]);

        return $views;
    }

    protected function isWatch(): Attribute
    {
        return new Attribute(
            get: fn () => (bool)$this->watch_at
        );
    }

    protected function lengthFormatted(): Attribute
    {
        return new Attribute(
            get: fn () => gmdate("H:i:s", $this->length),
        );
    }

    protected function viewCountFormatted(): Attribute
    {
        return new Attribute(
            get: fn () => $this->getViewCountFormatted(),
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
}
