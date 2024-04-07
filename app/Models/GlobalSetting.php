<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GlobalSetting
 * 
 * @property int $id
 * @property string $institute_name
 * @property string $institution_code
 * @property string $reg_prefix
 * @property string $institute_email
 * @property string $address
 * @property string $mobileno
 * @property string $currency
 * @property string $currency_symbol
 * @property string $sms_service_provider
 * @property int $session_id
 * @property string $translation
 * @property string $footer_text
 * @property string $animations
 * @property string $timezone
 * @property string $date_format
 * @property string $facebook_url
 * @property string $twitter_url
 * @property string $linkedin_url
 * @property string $youtube_url
 * @property string|null $cron_secret_key
 * @property bool $preloader_backend
 * @property bool $footer_branch_switcher
 * @property int $cms_default_branch
 * @property string|null $image_extension
 * @property float $image_size
 * @property string|null $file_extension
 * @property float|null $file_size
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class GlobalSetting extends Model
{
	protected $table = 'global_settings';

	protected $casts = [
		'session_id' => 'int',
		'preloader_backend' => 'bool',
		'footer_branch_switcher' => 'bool',
		'cms_default_branch' => 'int',
		'image_size' => 'float',
		'file_size' => 'float'
	];

	protected $hidden = [
		'cron_secret_key'
	];

	protected $fillable = [
		'institute_name',
		'institution_code',
		'reg_prefix',
		'institute_email',
		'address',
		'mobileno',
		'currency',
		'currency_symbol',
		'sms_service_provider',
		'session_id',
		'translation',
		'footer_text',
		'animations',
		'timezone',
		'date_format',
		'facebook_url',
		'twitter_url',
		'linkedin_url',
		'youtube_url',
		'cron_secret_key',
		'preloader_backend',
		'footer_branch_switcher',
		'cms_default_branch',
		'image_extension',
		'image_size',
		'file_extension',
		'file_size'
	];
}
