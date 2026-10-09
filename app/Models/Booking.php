<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BookingDetail;

class Booking extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    protected $casts = ['booking_date' => 'date'];
    
  public function details()
  {
    return $this->hasMany(BookingDetail::class, 'booking_id');
  }
}
