<?php

namespace Felipeds2\Trusty\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Permission extends Model
{
    /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'permissions';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];
    
    /**
     * Get the roles that owns the permission.
     */
    public function roles()
    {
    	return $this->belongsToMany(config('trusty.model.role'))->withTimestamps();
    }
    
    /**
     * Cria a slug a poartir do nome
     * @param string $value
     */
    public function setNameAttribute($value) {
    	$this->attributes['name'] = $value;
    	$this->attributes['slug'] = Str::slug($value);
    }
}
