<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class LeaveCategory
 * 
 * @property int $id
 * @property string $name
 * @property bool $role_id
 * @property int $days
 * @property int|null $branch_id
 *
 * @package App\Models
 */
class LeaveCategory extends Model
{
	protected $table = 'leave_category';
	public $timestamps = false;

	// protected $casts = [
	// 	'role_id' => 'bool',
	// 	'days' => 'int',
	// 	'branch_id' => 'int'
	// ];

	protected $fillable = [
		'name',
		'role_id',
		'days',
		'branch_id'
	];

	public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

}
