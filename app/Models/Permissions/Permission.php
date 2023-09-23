<?php

namespace App\Models\Permissions;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Permission extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'permissions';

    /**
     * @var array<string>
     */
    protected $fillable = [
        'identifier_name', 'name', 'description',
    ];

    /**
     * @return BelongsToMany
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'group_permission');
    }

    /**
     * @param string $val
     */
    public static function getPermissionByVal(string $val): ?Permission
    {
        $permission = self::query();

        if (Str::isUuid($val)) {
            $permission = $permission->where('id', $val);
        } else {
            $permission = $permission->where('identifier_name', $val);
        }

        return $permission->first();
    }
}
