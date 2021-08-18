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

    public const STATE_SA = 'SA';

    public const STATE_VIC = 'VIC';

    public const STATE_NSW = 'NSW';

    public const STATE_NT = 'NT';

    public const STATE_WA = 'WA';

    public const STATE_ACT = 'ACT';

    public const STATE_QLD = 'QLD';

    public const STATE_TAS = 'TAS';
}
