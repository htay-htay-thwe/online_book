<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class realOrder extends Model
{
    use HasFactory;
    protected $fillable = ['order_id','bookName','price','bookImage','selected','user_id','orderId','quantity'];
}
