<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'publish',
        'common_name_eng',
        'percent_formula',
        'trade_name',
        'registrant',
        'distributor',
        'importer',
        'trial_summary',
        'crop',
        'pest',
        'protocol_sent',
        'protocol_inspector_status',
        'protocol_approved',
        'efficacy_report_sent',
        'efficacy_status',
        'efficacy_report_approval',
        'efficacy_responsible_person',
        'residue_protocol_sent',
        'residue_protocol_inspector_status',
        'residue_protocol_approved',
        'residue_report_sent',
        'residue_status',
        'residue_report_approval',
        'residue_responsible_person',
    ];
}
