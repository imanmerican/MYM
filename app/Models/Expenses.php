<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    //
    use HasFactory;

    protected $fillable = ['title', 'amount', 'expense_date', 'notes'];
}
