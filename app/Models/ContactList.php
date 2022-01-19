<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactList extends Model
{
    use HasFactory;
    protected $table = 'contact_list';

    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'user_id'];

}
