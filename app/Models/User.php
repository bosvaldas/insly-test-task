<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static \Database\Factories\UserFactory factory
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \App\Models\UserDetail $userDetail
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function userDetail(): HasOne
    {
        return $this->hasOne(UserDetail::class, 'user_id', 'id');
    }
}
