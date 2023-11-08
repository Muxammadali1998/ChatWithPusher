<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable =[
        'from',
        'to',
        'count',
        'reader'
    ];

    public function messages(){
        return  $this->hasMany(Message::class);
    }

    public function fromuser(){
        return $this->belongsTo(User::class, 'from');
    }

    public function touser(){
        return $this->belongsTo(User::class, 'to');
    }


}
