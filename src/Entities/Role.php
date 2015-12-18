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
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['permissions'];
    
    /**
     * Get the users that owns the role.
     */
    public function users()
    {
    	return $this->belongsToMany(config('trusty.model.user'), 'user_role')->withTimestamps();
    }
    
    /**
     * Get the permissions that owns the role.
     */
    public function permissions()
    {
    	return $this->belongsToMany(config('trusty.model.permission'), 'role_permission')->withTimestamps();
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
