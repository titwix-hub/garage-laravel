<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;

    protected $table = 'annonces';

    protected $primaryKey = 'id';

    protected $fillable = [
        'title', 'content', 'price', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commentaire()
    {
        return $this->hasMany(Commentaire::class);
    }
}
