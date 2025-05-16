<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
	/** @use HasFactory<\Database\Factories\ProfilesFactory> */
	use HasFactory;

	protected $fillable = [
		'user_id',
		'age',
		'height',
		'weight',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
