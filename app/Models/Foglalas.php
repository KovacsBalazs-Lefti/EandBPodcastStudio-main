<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Foglalas extends Model
{
    protected $table = 'foglalas';
    protected $primaryKey = 'foglalasid';

    use SoftDeletes, HasFactory;

    protected $fillable = [
      'felhasznaloid',
      'szolgaltatasnev',
      'letszam',
      'foglalaskezdete',
      'foglalashossza',
      'megjegyzes',
      'user_felhasznaloid',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function szolgaltatasok() : BelongsTo
    {
        return $this->belongsTo(Szolgaltatasok::class, 'szolgaltatasnev','szolgaltatasnev');
    }
}




