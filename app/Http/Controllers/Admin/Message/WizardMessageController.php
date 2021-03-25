<?php

namespace App\Http\Controllers\Admin\Message;

use App\Models\Admin\Messages\WizardMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WizardMessageController extends MessageController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wizardMessages = WizardMessage::orderBy('position', 'ASC')->get()->toArray();
        return view("admin.message.wizard.list")->with('wizardMessages', $wizardMessages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.message.wizard.form");
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
            'message' => 'required|string|max:1000',
            'icon' => 'required|image'
        ]);

        $wizardMessage = new WizardMessage();
        $wizardMessage->title = $request->input('title');
        $wizardMessage->message = $request->input('message');
        $wizardMessage->position = 0;
        $wizardMessage->status = MessageController::STATUS_DISABLED;

        //Upload ICON
        $icon = $request->file('icon')->store(WizardMessage::ICON_PATH, 'upload');
        $icon_url = Storage::disk('upload')->url($icon);
        $wizardMessage->icon = $icon_url;

        if ($wizardMessage->save()) {
            return redirect(route('wizard_messages.index'))
                ->withSuccess('Message Added Successfully');
        } else {
            return back()->withErrors(['Failed to add Wizard Message']);
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
        $wizardMessage = WizardMessage::find($id)->toArray();
        return view("admin.message.wizard.form")->with('wizardMessage', $wizardMessage);
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
            'message' => 'required|string|max:1000',
            'icon' => 'image'
        ]);

        $wizardMessage = WizardMessage::find($id);
        $wizardMessage->title = $request->input('title');
        $wizardMessage->message = $request->input('message');

        //Upload ICON
        if ($request->exists('icon')) {
            //Old Icon
            $old_icon = $wizardMessage->icon;

            $icon = $request->file('icon')->store(WizardMessage::ICON_PATH, 'upload');
            $icon_url = Storage::disk('upload')->url($icon);
            $wizardMessage->icon = $icon_url;
        }

        if ($wizardMessage->save()) {
            if (isset($old_icon)) {
                //Delete Old Icon
                Storage::disk('upload')->delete('/' . WizardMessage::ICON_PATH . '/' . basename($old_icon));
            }

            return redirect(route('wizard_messages.index'))
                ->withSuccess('Message Updated Successfully');
        } else {
            return back()->withErrors(['Failed to Update Wizard Message']);
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
        WizardMessage::destroy($id);
        return redirect(route('wizard_messages.index'))
            ->withSuccess('Message Deleted Successfully');
    }
}
