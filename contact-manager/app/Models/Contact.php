<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = ['name', 'email', 'phone'];

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'contact_groups');
    }
}
