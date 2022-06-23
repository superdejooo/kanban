<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
    ];


    /**
     * Get the cards for the column.
     */
    public function cards(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Card::class)->orderBy('order');
    }

    /**
     * @return bool|null
     */
    public function delete(): ?bool
    {
        $this->cards()->delete();

        return parent::delete();
    }
}
