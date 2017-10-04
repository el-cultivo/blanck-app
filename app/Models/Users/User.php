<?php

namespace App\Models\Users;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Traits\User\PermissionRoleTrait;

use App\Notifications\Client\ResetPasswordNotification;

class User extends Authenticatable
{
    use SoftDeletes;
    use PermissionRoleTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'id' => 'integer',
        'active' => 'boolean'
    ];

    protected $appends = [
        'roles_ids',
        'full_name',
    ];
    /**
     * creamos al usuario registrado desde el admin
     * @param array $input valores del request
     * @return User  usuario creado
     */
    public static function CltvoCreate(array $input)
    {

    // creamos el usuario
        return static::create([
            'name'          => trim($input['name']),
            'email'         =>trim($input['email']),
            'first_name'    => trim($input['first_name']),
            'last_name'     => trim($input['last_name']),
            'password'      => bcrypt($input['password']),
            'active'        => $input['active']
        ]);

    }

    public static function setRandomPassword()
    {
        return str_random(4).mt_rand(1, 10).str_random(4).mt_rand(10, 99).str_random(4);
    }

    /**
     * genera un nombre de usuario unico a partir del nombre y apellido
     * @param  string $firstName nombre
     * @param  string $lastName  apellido
     * @return string            nombre de usuario unico
     */
    public static function createUniqueUsername($firstName,$lastName)
    {
        $username = str_slug(trim($firstName)." ".trim($lastName)." ".rand(0,99));

        $userNameNotUnique = true;

        while ($userNameNotUnique) {
            $users = static::withTrashed()->whereName($username)->get();
            if ($users->count() == 0) {
                $userNameNotUnique = false;
            }else {
                $username.= rand(0,9);
            }
        }

        return $username;
    }

    public function getFullNameAttribute()
    {
        return $this->first_name." ".$this->last_name;
    }

    public function isActive()
    {
        return  $this->active;
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    public function getHomeUrl()
    {
        return route("user::profile", $this->name);
    }

    /**
     * Route notifications for the mail channel.
     *
     * @return string
     */
    public function routeNotificationForMail()
    {
        return $this->email;
    }

    public function getActivationAcountUrl()
    {
        return route("client::pass_set:get", cltvoMailEncode($this->email));
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }


}
