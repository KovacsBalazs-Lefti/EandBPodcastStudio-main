<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Szolgaltatasok extends Model
{
    protected $table = 'szolgaltatasok';
    protected $primaryKey = 'szolgaltatasid';
    use HasFactory;

    protected $fillable = [
        'szolgaltatasid',
        'szolgaltatasnev',
        'leiras',
        'ar',
        'user_felhasznaloid',
      ];


      public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function foglalasok() : HasMany
    {
        return $this->hasMany(Foglalas::class, 'szolgaltatasnev');
    }

}
