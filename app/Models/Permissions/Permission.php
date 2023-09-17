<?php

namespace App\Models\Permissions;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
}
