<?php
/**
 * Created by PhpStorm.
 * User: joker
 * Date: 3/20/2018
 * Time: 5:39 PM
 */

namespace FanClub\repository;



use FanClub\model\Action;

class ActionRepository
{
    /** @var Action $model  */
    private $model;
    const  DEACTIVATE = 0;
    const  ACTIVATE = 1;

    public function __construct()
    {
        $this->model = new Action;
    }

    /**
     * this method return all actions
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {

        return $this->model->all();
    }

    /**
     * store new action
     * @param $request
     */
    public function store($request)
    {
        if (!key_exists('status', $request))
            $request['status'] = self::ACTIVATE;


        $this->model->create($request);
    }

    /**
     * change action status
     * @param $actionId
     * @param $status
     */
    public function changeStatus($actionId, $status)
    {
        $this->model->find($actionId)->update(['status' => $status]);
    }

    /**
     * find a action by id
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function find($id)
    {
        return $this->model->find($id);
    }


    /**
     * update a action information
     * @param $request
     */
    public function update($request)
    {
        if (!key_exists('status', $request))
            $request['status'] = self::ACTIVATE;

        $this->model = $this->find($request['id']);

        $this->model->name = $request['name'];
        $this->model->slug = $request['slug'];
        $this->model->score = $request['score'];
        $this->model->description = $request['description'];

        $this->model->update();


    }
}