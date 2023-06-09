<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationCenter extends Model
{
    use HasFactory;

    protected $fillable = ['name','location_id','admin_id'];

    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function CenterAdmin(){
        return $this->hasOne(Admin::class)->withDefault();
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'id', 'admin_id');
    }
}
