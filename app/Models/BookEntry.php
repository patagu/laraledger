<?php

namespace App\Models;

use App\Enums\BookEntryStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookEntry extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'debit',
        'credit',
        'account_id',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'datetime',
        'debit' => 'decimal:2',
        'credit' => 'decimal:2',
        'account_id' => 'integer',
        'status' => BookEntryStatus::class
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
