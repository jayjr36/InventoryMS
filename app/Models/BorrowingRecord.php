<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowingRecord extends Model
{
    use HasFactory;

    protected $fillable = ['item_id', 'user_name', 'quantity', 'borrowed_at', 'returned_at'];
    
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
