<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Questionnaire extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'unit_interest',
        'first_name',
        'last_name',
        'email',
        'contact_number',
        'country_of_residence',
        'remark',
        'consent_transfer',
        'consent_citydynamic_marketing',
        'consent_affiliate_marketing',
        'signature',
        'printed_name',
        'signed_date',
        'created_by',
    ];

    protected $casts = [
        'unit_interest' => 'array',
        'consent_transfer' => 'boolean',
        'consent_citydynamic_marketing' => 'boolean',
        'consent_affiliate_marketing' => 'boolean',
        'signed_date' => 'date',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
