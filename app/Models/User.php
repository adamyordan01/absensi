<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'level',
        'email',
        'password',
        'phone',
        'address',
        'rankandgroup_id',
        'nip',
        'photo',
        'position_id',
        'status',
        'division_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getTakePictureAttribute()
    {
        return "storage/pegawai/" . $this->photo;
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function rank()
    {
        return $this->belongsTo(RankAndGroup::class, 'rankandgroup_id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }
}
