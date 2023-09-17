<?php

namespace App\Models\Permissions;

use App\Models\Base\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Group extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'groups';

    /**
     * @var array<string>
     */
    protected $fillable = [
        'name', 'slug', 'description',
    ];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'group_user');
    }

    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'group_permission');
    }

    /**
     * @param string $identifierName
     *
     * @return bool
     */
    public function hasPermissionTo(string $identifierName): bool
    {
        return $this->permissions()->where('identifier_name', $identifierName)->exists();
    }

    /**
     * @param string $permissionName
     * @param mixed $description
     */
    public function givePermissionTo(string $permissionName, mixed $description = null): void
    {
        $permission = Permission::query()->firstOrCreate([
            'identifier_name' => Str::slug($permissionName),
            'name'            => $permissionName,
            'description'     => $description,
        ]);

        $this->permissions()->attach($permission);
        $this->users()->each(function ($user) use ($permission) {
            $user->permissions()->attach($permission);
        });
    }
}
