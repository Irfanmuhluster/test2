<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction_header extends Model
{
    use HasFactory;

    protected $dates = ['date_paid'];

    public function transaction_detail() 
    {
        return $this->hasMany(Transaction_detail::class, 'transaction_id');
    }
}
