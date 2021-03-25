<?php

namespace App\Http\Controllers\Admin\Message;

use App\Models\Admin\Messages\EventMessage;
use App\Models\Admin\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class QuoteMessageController extends MessageController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quoteMessages = EventMessage::get()->toArray();
        return view("admin.message.quote.list")->with('quoteMessages', $quoteMessages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $userData = $user->where("user_type","!=", User::TYPE_ADMIN)->get(['id','firstname','lastname'])->toArray();
        return view("admin.message.quote.add")->with('users', $userData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'sub_heading' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'message' => 'required|string|max:1000'
        ]);

        $quoteMessageArr = array();
        $quoteMessageArr['title'] = $request->input('title');
        $quoteMessageArr['sub_heading'] = $request->input('sub_heading');
        $quoteMessageArr['job_title'] = $request->input('job_title');
        $quoteMessageArr['message'] = $request->input('message');
        $quoteMessageArr['normal_price'] = $request->input('normal_price');
        $quoteMessageArr['whoop_price'] = $request->input('whoop_price');

        //Upload ICON
        $icon = $request->file('icon')->store(EventMessage::ICON_PATH, 'upload');
        $icon_url = Storage::disk('upload')->url($icon);
        $quoteMessageArr['icon'] = $icon_url;
        $userId = $request->user;

        $event = new EventMessage();
        $event->setEventType($event::EVENT_QUOTE_IS_READY);
        $event->setEventData($quoteMessageArr);
        $event->target_type = $event::TARGET_USER;
        $event->target_id = $userId;
        
        if ($event->save()) {
            return redirect('admin/quote-messages/add')->with('success', "Quote Message Saved Successfully!");
        } else {
            return back()->withErrors(['Failed to add Quote Message']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, User $user)
    {
        $userData = $user->where("user_type","!=", User::TYPE_ADMIN)->get(['id','firstname','lastname'])->toArray();
        $quoteMessage = EventMessage::find($id)->toArray();
        return view("admin.message.quote.edit")->with('quoteMessage', $quoteMessage)->with('users', $userData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'sub_heading' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'message' => 'required|string|max:1000'
        ]);

        $event = EventMessage::find($id);
        $quoteMessageArr = array();
        $quoteMessageArr['title'] = $request->input('title');
        $quoteMessageArr['sub_heading'] = $request->input('sub_heading');
        $quoteMessageArr['job_title'] = $request->input('job_title');
        $quoteMessageArr['message'] = $request->input('message');
        $quoteMessageArr['normal_price'] = $request->input('normal_price');
        $quoteMessageArr['whoop_price'] = $request->input('whoop_price');
        
        //Upload ICON
        if ($request->exists('icon')) {
            //Old Icon
            $getQuoteData = json_decode($event->event_data);
            $old_icon = $getQuoteData->icon;

            $icon = $request->file('icon')->store(EventMessage::ICON_PATH, 'upload');
            $icon_url = Storage::disk('upload')->url($icon);
            $quoteMessageArr['icon'] = $icon_url;
        } else {
            $quoteMessageArr['icon'] = $request->old_img;
        }

        $userId = $request->user;
        $event->setEventType($event::EVENT_QUOTE_IS_READY);
        $event->setEventData($quoteMessageArr);
        $event->target_type = $event::TARGET_USER;
        $event->target_id = $userId;

        if ($event->save()) {
            if (isset($request->icon)) {
                //Delete Old Icon
                Storage::disk('upload')->delete('/' . EventMessage::ICON_PATH . '/' . basename($old_icon));
            }

            return redirect('admin/quote-messages/edit/'.$id)->with('success', "Quote Message updated Successfully!");
        } else {
            return back()->withErrors(['Failed to Update Quote Message']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        EventMessage::destroy($id);
        return Redirect::to('admin/quote-messages/list')->with('success', 'Quote Message deleted successfully');
    }
}
