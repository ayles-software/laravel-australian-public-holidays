<?php

namespace PublicHolidays\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublicHoliday extends Model
{
    use SoftDeletes;

    protected $dates = [
        'date',
    ];

    protected $fillable = [
        'name',
        'date',
        'description',
        'state',
    ];

    const STATE_SA = 'SA';

    const STATE_VIC = 'VIC';

    const STATE_NSW = 'NSW';

    const STATE_NT = 'NT';

    const STATE_WA = 'WA';

    const STATE_ACT = 'ACT';

    const STATE_QLD = 'QLD';
}
