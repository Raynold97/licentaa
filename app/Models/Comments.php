<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Continut;
use Spatie\Activitylog\Traits\LogsActivity;

class Comments extends Model
{
    use HasFactory,LogsActivity;

    protected static $logAttributes=['comment', 'comment_image'];

    protected static $recordEvents=['created','updated'];

    protected static $logName='Continut';
    public function getDescriptionForEvent(string $eventName):string{
            
        return "S-a {$eventName} un comentariu";
    }
    protected $table = 'comments';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable =['comment','commentable_id'];

    public function continut()
    {
        return $this->belongsTo(Continut::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
