<?php

namespace FanClub\controller\admin;

use FanClub\repository\ActionRepository;
use FanClub\request\ActionChangeStatusRequest;
use FanClub\request\StoreActionRequest;
use FanClub\request\UpdateActionRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionController extends Controller
{
    private $action;

    public function __construct()
    {
        $this->action = new ActionRepository;
    }

    /**
     * list all actions | method:get
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('FanClub::index', ['actions' => $this->action->all()]);
    }

    /**
     * store new action | method:post
     * @param StoreActionRequest $request
     * @return array
     */
    public function store(StoreActionRequest $request)
    {
        $this->action->store($request->all());

        return redirect()->route('FanClub::index');
    }

    /**
     * changing action status | method:post
     * @param ActionChangeStatusRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeStatus(ActionChangeStatusRequest $request)
    {
        $this->action->changeStatus($request->get('action_id'), $request->get('status'));
        flashMessage("وضعیت فعالیت تغییر کرد", 'success');

        return redirect()->back();
    }

    /**
     * edit action information
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        $action = $this->action->find($id);
        if (empty($action)) {
            flashMessage("فعالیت مورد نظر پیدا نشد", 'danger');

            return redirect()->route('FanClub::index');
        }

        return view('FanClub::edit', ['action' => $action]);
    }


    public function update(UpdateActionRequest $request)
    {
        $this->action->update($request->all());
        flashMessage('تغییرات با موفقیت اعمال شد','success');

        return redirect()->back();
    }
}
