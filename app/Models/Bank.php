<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function cheques(){
        return $this->hasMany(Cheque::class,'bank_id','id');
    }

    public function branches(){
        return $this->hasMany(Branch::class,'bank_id','id');
    }
}
