<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'title', 'description', 'price',
        'rooms', 'gender', 'address',
        'square', 'user_id', 'branch_id',
        'status_id'
    ];

    public function user_element(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User_Element::class)->withTimestamps();
    }
    public function branch(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
    public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Ad_Image::class);
    }
    public static function search(?string $searchPhrase, ?int $searchBranch, ?int $searchMinPrice, ?int $searchMaxPrice): Collection
    {
        $query = Ad::with('branch', 'images')
            ->where(function($query) use ($searchPhrase) {
                $query->where('title', 'LIKE', "%$searchPhrase%")
                    ->orWhere('description', 'LIKE', "%$searchPhrase%");
            })
            ->whereBetween('price', [$searchMinPrice, $searchMaxPrice]);

        if ($searchBranch) {
            $query->where('branch_id', $searchBranch);
        }

        return $query->get();
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function status(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
}
