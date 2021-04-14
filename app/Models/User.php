<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravelista\Comments\Commenter;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use HasFactory, Notifiable,Commenter,LogsActivity;

    protected static $logAttributes=['Nume', 'email'];

    protected static $recordEvents=['created','updated'];

    protected static $logName='User';
    public function getDescriptionForEvent(string $eventName):string{
            
        // return "A fost {$eventName} user-ul";
        if($eventName=='created'){
            return "S-a creat un utilizator nou";}
              else if($eventName=='created'){
              return "Datele utilizatorul au fost editate";}
              else
                return "Utilizatorul a fost sters";
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'UserName',
        'Nume',
        'imagine',
        'Prenume',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function continut(){
        return $this->hasMany('App\Models\Continut');
 
    }
}
