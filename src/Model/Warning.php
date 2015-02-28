<?php

namespace Fourum\Warning\Model;

use Illuminate\Database\Eloquent\Model;

class Warning extends Model
{
    protected $guarded = ['id'];

    public function getId()
    {
        return $this->id;
    }

    public function get($id)
    {
        return self::find($id);
    }

    public function getPoints()
    {
        return $this->points;
    }

    public function getRule()
    {
        return $this->belongsTo('Fourum\Model\Rule', 'rule_id', null, 'rule')->first();
    }

    public function getName()
    {
        return 'warning';
    }

    public function getOffender()
    {
        return $this->belongsTo('Fourum\Model\User', 'user_id')->first();
    }

    public function getAuthor()
    {
        return $this->belongsTo('Fourum\Model\User', 'from_user_id')->first();
    }

    public function getPost()
    {
        return $this->belongsTo('Fourum\Model\Post', 'post_id')->first();
    }

    public function getForeignKey()
    {
        return 'warning_id';
    }

    public function getEntityName()
    {
        return 'warning';
    }

    public function getUrl()
    {
        return $this->getPost()->getUrl();
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }
}