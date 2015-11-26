<?php

namespace Felipeds2\Trusty\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{
    /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'roles';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];
    
    /**
     * Get the users that owns the role.
     */
    public function users()
    {
    	return $this->belongsToMany(config('trusty.model.user'))->withTimestamps();
    }
    
    /**
     * Get the permissions that owns the role.
     */
    public function permissions()
    {
    	return $this->belongsToMany(config('trusty.model.permission'))->withTimestamps();
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
