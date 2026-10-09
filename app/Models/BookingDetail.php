<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;

class BookingDetail extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    
    public function booking()
    {
      return $this->belongsTo(Booking::class);
    }
    
    public function court()
    {
      return $this->belongsTo(Court::class);
    }
}
