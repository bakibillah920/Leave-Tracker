<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * 
 * @property int $id
 * @property string $name
 * @property string|null $prefix
 * @property string $is_system
 *
 * @package App\Models
 */
class Role extends Model
{
	protected $table = 'roles';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'prefix',
		'is_system'
	];

	public function leaveCategories()
    {
        return $this->hasMany(LeaveCategory::class);
    }
    public function privileges(){
        return $this->belongsToMany(PermissionModule::class,'staff_privileges','role_id','permission_id');
    }
}
