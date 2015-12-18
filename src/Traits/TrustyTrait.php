<?php

namespace Felipeds2\Trusty\Traits;

use Illuminate\Support\Collection;
use Felipeds2\Trusty\Entities\Role;
use Illuminate\Support\Facades\Log;

trait TrustyTrait
{
    /**
     * Relation belongs-to roles.
     *
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(config('trusty.model.role'))->withTimestamps();
    }

    /**
     * Determine whether the user has role that given by name parameter.
     *
     * @param $name
     *
     * @return bool
     */
    public function is($name)
    {
        foreach ($this->roles as $role) {
            if ($role->name == $name || $role->slug == $name || $role->id == $name) {
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Determine whether the user has role that given by name parameter.
     *
     * @param $name
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
    	foreach ($this->roles as $role) {
    		if ($role->name == 'SUPERADMIN' || $role->slug == 'SUPERADMIN') {
    			return true;
    		}
    	}
    
    	return false;
    }
    
    /**
     * Determine whether the current user is not have role that given by name parameter.
     *
     * @return bool
     */
    public function isNot($name)
    {
        return !$this->is($name);
    }
    
    /**
     * Determine whether the user can do specific permission that given by name parameter.
     *
     * @param $name
     *
     * @return bool
     */
    public function has($permission)
    {
    	if ($this->isSuperAdmin()) {
    		return true;
    	}
    	
        foreach ($this->roles as $role) {
            foreach ($role->permissions as $p) {
                if ($p->name == $permission || $p->slug == $permission || $p->id == $permission) {
                    return true;
                }
            }
        }
        
        return false;
    }
    
    /**
     * Verifica se o usuário possui qualquer uma das permissão recebidas
     * 
     * @param $array
     *
     * @return bool
     */
    public function hasAny($permissions)
    {
    	if ($this->isSuperAdmin()) {
    		return true;
    	}
    	
    	foreach ($this->roles as $role) {
    		foreach ($role->permissions as $p) {
    			if (in_array($p->name, $permissions) || in_array($p->slug, $permissions) || in_array($p->id, $permissions)) {
    				return true;
    			}
    		}
    	}
    
    	return false;
    }
    
    /**
     * Determine whether the current user can not do a specified permission.
     *
     * @return bool
     */
    public function hasNot($permission)
    {
        return !$this->has($permission);
    }
    
    /**
     * Get 'permissions' attribute.
     *
     * @return Collection
     */
    public function getPermissionsAttribute()
    {
        $permissions = new Collection();
        
        foreach ($this->roles as $role) {
            foreach ($role->permissions as $permission) {
                $permissions->push($permission);
            }
        }
        
        return $permissions;
    }
}