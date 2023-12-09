<?php

namespace App\Models\Permissions;

use App\Models\Base\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Group extends BaseModel
{
    use HasFactory;

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
     * @return string[]
     */
    public function getListingData()
    {
        return [
            'id', 'name', 'slug', 'description',
        ];
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'group_user');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'group_permission');
    }

    public function hasPermissionTo(string $identifierName): bool
    {
        return $this->permissions()->where('identifier_name', $identifierName)->exists();
    }

    public function givePermissionTo(string $permissionName, mixed $description = null): void
    {
        $permission = Permission::query()->firstOrCreate([
            'identifier_name' => Str::slug($permissionName),
            'name'            => $permissionName,
            'description'     => $description,
        ]);

        /** Filling group_permission pivot */
        $this->permissions()->attach($permission);

        /** Filling group_user pivot by permission */
        $this->users()->each(function ($user) use ($permission) {
            $user->permissions()->attach($permission);
        });
    }
}
