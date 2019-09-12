<?php

namespace App;

use App\Models\Project_manager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserChat extends Model
{
    protected $table = 'user_chats';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id', 'sender_id', 'resever_id', 'message',
        'type', 'conv_id', 'status',
        'created_at', 'updated_at', 'deleted_at'
    ];


    public function sender()
    {
        return $this->belongsTo('App\Models\User', 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo('App\Models\User', 'resever_id');
    }
}