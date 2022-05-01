<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    public $table = 'clients';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'skype',
        'company',
        'country',
        'phone',
        'website',
        'status_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class, 'client_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(ClientStatus::class, 'status_id');
    }
}
