<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Collection;
use App\Models\Permission;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',      // 'admin' or 'staff'
        'staff_role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relationship to Role model (for staff users).
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'staff_role_id');
    }

    /**
     * Get all permissions for the user.
     * Admins have all permissions by default.
     */
    public function permissions(): Collection
    {
        if ($this->user_type === 'admin') {
            return Permission::all(); // Admin has all permissions
        }

        return $this->role ? $this->role->permissions : collect();
    }

    /**
     * Check if user has a specific permission.
     */
    public function hasPermission(string $permissionName): bool
    {
        if ($this->user_type === 'admin') {
            return true; // Admin bypasses checks
        }

        return $this->permissions()->contains('name', $permissionName);
    }
}
