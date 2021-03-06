<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Log;

class User extends Model implements AuthenticatableContract {

	use SoftDeletes;
	use Authenticatable;

	protected $primaryKey = 'user_id';
	protected $fillable = [
		'notifications_instant', 'notifications_day', 'notifications_week',
	];

	public static function firstSciperOrCreate($sciper) {

		$u = self::where("sciper", "=", $sciper)->get();

		if ($u->isEmpty()) {
			$u = new User;
			$u->sciper = $sciper;

			$u->save();

			// TODO remove when cleaning code for production
			$u->admin = $u->user_id == 1;

			return $u;
		} else {
			return $u->first();
		}
	}

}
