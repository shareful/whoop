<?php

namespace App\Http\Controllers\Admin\Message;

use App\Models\Admin\Messages\WelcomeMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WelcomeMessageController extends MessageController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $welcomeMessages = WelcomeMessage::orderBy('position', 'ASC')->get()->toArray();
        return view("admin.message.welcome.list")->with('welcomeMessages', $welcomeMessages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.message.welcome.form");
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
            'sub_title' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'icon' => 'required|image'
        ]);

        $welcomeMessage = new WelcomeMessage();
        $welcomeMessage->title = $request->input('title');
        $welcomeMessage->sub_title = $request->input('sub_title');
        $welcomeMessage->message = $request->input('message');
        $welcomeMessage->position = 0;
        $welcomeMessage->status = MessageController::STATUS_DISABLED;

        //Icon Upload
        $icon = $request->file('icon')->store(WelcomeMessage::ICON_PATH, 'upload');
        $icon_url = Storage::disk('upload')->url($icon);
        $welcomeMessage->icon = $icon_url;

        if ($welcomeMessage->save()) {
            return redirect(route('welcome_messages.index'))
                ->withSuccess('Message Added Successfully');
        } else {
            return back()->withErrors(['Failed to add Welcome Message']);
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
    public function edit($id)
    {
        $welcomeMessage = WelcomeMessage::find($id)->toArray();
        return view("admin.message.welcome.form")
            ->with('welcomeMessage', $welcomeMessage);
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
            'sub_title' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'icon' => 'image'
        ]);

        $welcomeMessage = WelcomeMessage::find($id);
        $welcomeMessage->title = $request->input('title');
        $welcomeMessage->sub_title = $request->input('sub_title');
        $welcomeMessage->message = $request->input('message');

        //Icon Upload
        if ($request->exists('icon')) {
            $old_icon = $welcomeMessage->icon;
            $icon = $request->file('icon')->store(WelcomeMessage::ICON_PATH, 'upload');
            $icon_url = Storage::disk('upload')->url($icon);
            $welcomeMessage->icon = $icon_url;
        }

        if ($welcomeMessage->save()) {
            if (isset($old_icon)) {
                //Delete Old Icon
                Storage::disk('upload')->delete('/' . WelcomeMessage::ICON_PATH . '/' . basename($old_icon));
            }
            return redirect(route('welcome_messages.index'))
                ->withSuccess('Message Updated Successfully');
        } else {
            return back()->withErrors(['Failed to Update Welcome Message']);
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
        if (WelcomeMessage::destroy($id)) {
            return back()->withSuccess('Message Deleted Successfully.');
        } else {
            return back()->withError('Message Deleted Failed.');
        }
    }
}
