<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    protected $fillable = [
        'title', 'transaction_type', 'parent_id', 'model_name'
    ];
}
