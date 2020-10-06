<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClubPostComment extends Model
{
    protected $table = 'club_post_comment';
    protected $primaryKey = 'comment_id';
}
