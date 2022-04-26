<?php

namespace App;

use App\Models\AccountAddress;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id',
        'inscurance_price',
        'shipping_price',
        'transaction_status',
        'total_price',
        'code',
        'address_id',
        'last_edited',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function address()
    {
        return $this->belongsTo(AccountAddress::class, 'address_id', 'id');
    }

    public function last_edit()
    {
        return $this->belongsTo(User::class, 'last_edited', 'id');
    }

    const STATUSES = [
        'Proses' => 'Proses',
        'Proses Admin' => 'Proses Admin',
        'Sudah dibayar' => 'Sudah dibayar',
        'Proses Pengiriman' => 'Proses Pengiriman',
        'Terkirim' => 'Terkirim',
        'Batal' => 'Batal',
    ];

}
