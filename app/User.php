<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    //Department
    public function department()
    {
        return $this::belongsTo('\App\Department','department_id');
    }

    //Branch
    public function branch()
    {
        return $this::belongsTo('\App\Branch','branch_id');
    }
    public function module()
    {
        return $this::hasMany('\App\UserModules','user_id','id');
    }

    public function queries()
    {
        return $this::hasMany('\App\QueryAssignment','user_id','id');
    }
    public function unit()
    {
        return $this::hasMany('\App\Unit','unit_id','id');
    }

    //User right
    public function right()
    {
        return $this::belongsTo('\App\Right','right_id');
    }
}
