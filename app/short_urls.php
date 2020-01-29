<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class short_urls extends Model
{
    use SoftDeletes;
    protected $table = 'short_urls';
    protected $primaryKey = 'id';
    protected $fillable = [
        'long_url', 'short_code', 'hits',
    ];
}
