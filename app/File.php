<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Watson\Validating\ValidatingTrait;
use Storage;
use Response;
use DraperStudio\Taggable\Traits\Taggable as TaggableTrait;
use Venturecraft\Revisionable\RevisionableTrait;
use Kalnoy\Nestedset\NodeTrait;


class File extends Model
{
  use ValidatingTrait;
  use SoftDeletes;
  use RevisionableTrait;
  use TaggableTrait;
  use NodeTrait;



  protected $onlyUseExistingTags = false;


  protected $rules = [
    'path' => 'required',
    'user_id' => 'required|exists:users,id',
    'group_id' => 'required|exists:groups,id',
  ];

  protected $table = 'files';
  public $timestamps = true;
  protected $dates = ['deleted_at'];
  protected $casts = [ 'user_id' => 'integer' ];

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function group()
  {
    return $this->belongsTo('App\Group');
  }


  public function link()
  {
    return action('FileController@show', [$this->group, $this]);
  }



}
