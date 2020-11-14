<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $bio
 * @property string $twitter_username
 * @property string $github_username
 * @property string $avatar
 * @property boolean $avatar_status
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 */
class Profiles extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profiles';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = [
        'bio',
        'twitter_username',
        'github_username',
        'avatar',
        'avatar_status',
        'created_at',
        'updated_at'
    ];

    /**
     * A profile belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
