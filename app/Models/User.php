<?php

namespace App\Models;

use App\Models\Base\BaseModelAuthenticatable;
use App\Models\Permissions\{Group, Permission};
use App\Traits\Guid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends BaseModelAuthenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use Guid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    /**
     * @return string[]
     */
    public function getListingData()
    {
        return [
            'id', 'name', 'email', 'password',
        ];
    }

    /**
     * @return BelongsToMany
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'group_user');
    }

    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_user');
    }

    /**
     * @param string $permissionVal Permission identifier name or id
     * @return void
     */
    public function givePermissionTo(string $permissionVal): void
    {
        $permission = Permission::query();

        if (Str::isUuid($permissionVal)) {
            $permission = $permission->where('id', $permissionVal);
        } else {
            $permission = $permission->where('identifier_name', $permissionVal);
        }

        $permission = $permission->first();

        /** Filling permissio_user pivot */
        $this->permissions()->attach($permission);

        /** Filling group_user pivot by permission*/
        $this->permissions()->each(function ($permissions) {
            $permissions->groups()->each(function ($group) {
                $group->users()->attach($this);
            });
        });
    }

    /**
     * @param string $groupId
     */
    public function addToGroup(string $groupId): void
    {
        $group = Group::find($groupId);

        if (!$group) {
            return;
        }

        $this->groups()->attach($group);
    }

    /**
     * @param string $groupId
     * @return bool
     */
    public function belongsToTheGroup(string $groupId): bool
    {
        return $this->groups()->where('id', $groupId)->exists();
    }

    /**
     * @param string $permissionVal Permission identifier name or id
     * @return bool
     */
    public function hasPermissionTo(string $permissionVal): bool
    {
        $permission = $this->permissions();

        if (Str::isUuid($permissionVal)) {
            $permission = $permission->where('id', $permissionVal);
        } else {
            $permission = $permission->where('identifier_name', $permissionVal);
        }

        return $permission->exists();
    }
}
