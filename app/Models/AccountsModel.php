<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountsModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'account_id',
        'refence_type',
        'reference_id',
        'monitoring_device_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
