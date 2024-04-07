<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LeaveApplication
 * 
 * @property int $id
 * @property int $user_id
 * @property int $role_id
 * @property int $category_id
 * @property string $reason
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property string $leave_days
 * @property int $status
 * @property Carbon|null $apply_date
 * @property int $approved_by
 * @property string $orig_file_name
 * @property string $enc_file_name
 * @property string $comments
 * @property int|null $session_id
 * @property int|null $branch_id
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class LeaveApplication extends Model
{
	protected $table = 'leave_application';

	// protected $casts = [
	// 	'user_id' => 'int',
	// 	'role_id' => 'int',
	// 	'category_id' => 'int',
	// 	'start_date' => 'datetime',
	// 	'end_date' => 'datetime',
	// 	'status' => 'int',
	// 	'apply_date' => 'datetime',
	// 	'approved_by' => 'int',
	// 	'session_id' => 'int',
	// 	'branch_id' => 'int'
	// ];

	protected $fillable = [
		'user_id',
		'role_id',
		'category_id',
		'reason',
		'start_date',
		'end_date',
		'leave_days',
		'status',
		'apply_date',
		'approved_by',
		'attachment_file',
		// 'orig_file_name',
		// 'enc_file_name',
		'comments',
		'session_id',
		'branch_id'
	];

	 public function rules()
    {
        return [
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d',
        ];
    }

	public function user(){
		return $this->hasOne(User::class,'id','user_id');
	}

	public function leave(){
		return $this->hasOne(LeaveCategory::class,'id','category_id');
	}
}
