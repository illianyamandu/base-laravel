<?php

namespace App\Models\Permissions;

use App\Models\Base\BaseModel;
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
     * @param string $permissionName
     */
    public function givePermissionTo(string $permissionName, string $description): void
    {
        $permission = Permission::query()->firstOrCreate([
            'identifier_name' => Str::slug($permissionName),
            'name'            => $permissionName,
            'description'     => $description,
        ]);

        $this->permissions()->attach($permission);
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
}
