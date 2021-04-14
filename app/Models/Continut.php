<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use Laravelista\Comments\Commentable;
use Spatie\Activitylog\Traits\LogsActivity;


class Continut extends Model
{
    use HasFactory,Commentable,LogsActivity;

    protected static $logAttributes=['titlu', 'descriere', 'cover_image'];

    protected static $recordEvents=['created','updated','deleted'];

    protected static $logName='Continut';
    public function getDescriptionForEvent(string $eventName):string{
            
        // return "A fost {$eventName} continutul";
        if($eventName=='created'){
            return "S-a adaugat o postare noua";}
              else if($eventName=='updated'){
              return "Postarea a fost editata";}
              else
                return "Postarea a fost stearsa";
    }

    protected $table = 'continut';
    public $primaryKey = 'id';
    public $timestamps = true;
      protected $fillable =['titlu','keywords'];
    public function user()
    {    
        return $this->belongsTo(User::class, 'idUtilizator');
    }

    public function categorii()
{
   // return $this->belongsToMany(Categorii::class);
    return $this->belongsToMany(Categorii::class, 'categoriicontinut', 'continut_id', 'categorii_id'); 
}

    // public function comments()
    // {
    //     return $this->hasMany(Comments::class)->whereNull('parent_id');
    // }

    // public function withComments(Builder $query)
    // {
    //     $query->leftJoinSub(
    //         'select commentable_id, count(id) nrComms from comments group by commentable_id',
    //         'comments',
    //         'comments.commentable_id',
    //         'continut.id'
    //     );
    // }
}
