<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction_detail extends Model
{
    use HasFactory;

    protected $with = ['transaction_header', 'category'];


 
    // yang dicari tanggal between date_paid-->header, kategori, pencarian berdasarkan nama / deskripsi

    public function scopeSearch($query)
    {
        $filter = request()->query();
 
        return
        $query->when(@$filter['catagory_id'], function($query, $search) {
            return $query->where('transaction_category_id', "{$search}");
        })
        ->when(@$filter['search'], function($query, $search) {
            // dd($search);
            return $query->where('name', 'like', "%{$search}%");
        })
        ->whereHas('transaction_header', function ($query) use ($filter) {
            $query->when(!empty($filter['date_start']) && !empty($filter['date_end']), function ($query) use ($filter) {
                // dd(date('Y-m-d',strtotime($filter['date_end'])));
                return $query->whereBetween('date_paid', [date('Y-m-d', strtotime($filter['date_start'])),date('Y-m-d', strtotime($filter['date_end']))]);
            });
        });
    }


    public function transaction_header()
    {
        return $this->belongsTo(Transaction_header::class, 'transaction_id');
    }

    public function category()
    {
        return $this->belongsTo(Ms_category::class, 'transaction_category_id');
    }
}
