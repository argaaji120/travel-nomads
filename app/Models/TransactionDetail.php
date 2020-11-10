<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionDetail extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transactions_id', 'username', 'nationality', 'is_visa', 'doe_passport'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transactions_id', 'id');
    }
}
