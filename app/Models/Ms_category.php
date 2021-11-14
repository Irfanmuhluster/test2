<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ms_category extends Model
{
    use HasFactory;

    public function transaction_detail() 
    {
        return $this->hasMany(Transaction_detail::class, 'transaction_category_id');
    }
}
