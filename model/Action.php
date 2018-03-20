<?php

namespace FanClub\model;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $table = 'actions';

    protected $primaryKey = 'id';
    protected $fillable = [

        'name',
        'slug',
        'score',
        'description',
        'status',
        'data',
    ];

    public function getCreatedAt()
    {
        return jdate($this->created_at)->ago();
    }

    public function getUpdatedAt()
    {
        return jdate($this->updated_at)->ago();
    }

    /**
     * status
     * 1 ===> فعال
     * 0 ===> غیر فعال
     */
    public function getStatus()
    {
        if ($this->status == 1)
            return "<span class='label label-success'>فعال</span>";
        return "<span class='label label-danger'>غیر فعال</span>";
    }

    /**
     *
     * @return string
     */
    public function getAction()
    {
        if ($this->status == 1)
            return "<i name='action' class='glyphicon glyphicon-remove text-danger' style='cursor: pointer' data-status='0' data-id='" . $this->id . "' data-toggle='tooltip' data-placement='top' data-original-title='غیر فعال کردن' >  </i>";
        return "<i name='action' class='glyphicon glyphicon-ok text-success' style='cursor: pointer'  data-status='1' data-id='" . $this->id . "'   data-toggle='tooltip' data-placement='top' data-original-title='فعال کردن ' >    </i>";
    }


    public function getScore()
    {

        if ($this->score > 0)
            return "<span class='label label-success'>" . number_format($this->score, 0, '', ',') . "</span>";
        return "<span class='label label-danger' dir='ltr'>" . number_format($this->score, 0, '', ',') . "</span>";
    }
}
