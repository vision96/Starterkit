<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChequeRecipient extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function cheques(){
        return $this->hasMany(Cheque::class,'recipient_id','id');
    }
}
