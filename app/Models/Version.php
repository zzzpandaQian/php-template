<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'version';
    protected $fillable = [
        'id',
        'version',
        'disabled',
        'file',
    ];
}
