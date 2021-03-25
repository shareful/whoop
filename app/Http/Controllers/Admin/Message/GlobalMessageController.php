<?php

namespace App\Http\Controllers\Admin\Message;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class GlobalMessageController extends Controller
{
    const ICON_PATH = 'messages/global';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $helloMessage = (array)Config::get('messageConfig.HELLO') +
            ['title' => '', 'message' => '', 'icon' => ''];
        $providerMessage = (array)Config::get('messageConfig.PROVIDER') +
            ['title' => '', 'message' => '', 'icon' => ''];
        return view("admin.message.global.form")
            ->with('helloMessage', $helloMessage)
            ->with('providerMessage', $providerMessage);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $configFileName = 'messageConfig';

        $this->validate($request, [
            'hello_title' => 'required|string|max:255',
            'hello_message' => 'required|string|max:1000',
            'hello_icon' => 'image',
            'provider_title' => 'required|string|max:255',
            'provider_message' => 'required|string|max:1000',
            'provider_icon' => 'image'
        ]);

        $messageConfig = Config::get($configFileName);
        $messageConfig['HELLO']['title'] = $request->input('hello_title');
        $messageConfig['HELLO']['message'] = $request->input('hello_message');

        //If Icon exists Upload New File
        if ($request->exists('hello_icon')) {
            //Old Icon
            $old_icon_hello = $messageConfig['HELLO']['icon'];
            $icon = $request->file('hello_icon')->store(self::ICON_PATH, 'upload');
            $messageConfig['HELLO']['icon'] = Storage::disk('upload')->url($icon);
        }

        $messageConfig['PROVIDER']['title'] = $request->input('provider_title');
        $messageConfig['PROVIDER']['message'] = $request->input('provider_message');

        //If Icon exists Upload New File
        if ($request->exists('provider_icon')) {
            //Old Icon
            $old_icon_provider = $messageConfig['PROVIDER']['icon'];
            $icon = $request->file('provider_icon')->store(self::ICON_PATH, 'upload');
            $messageConfig['PROVIDER']['icon'] = Storage::disk('upload')->url($icon);
        }

        $fp = fopen(base_path() . '/config/' . $configFileName . '.php', 'w');
        fwrite($fp, '<?php return ' . var_export($messageConfig, true) . ';');
        fclose($fp);

        //Delete Old icon if replaced
        if (isset($old_icon_hello)) {
            if ($old_icon_hello) {
                Storage::disk('upload')->delete('/' . self::ICON_PATH . '/'
                    . basename($old_icon_hello));
            }
        }
        if (isset($old_icon_provider)) {
            if ($old_icon_provider) {
                Storage::disk('upload')->delete('/' . self::ICON_PATH . '/'
                    . basename($old_icon_provider));
            }
        }

        return back()->withSuccess('Global Messages Updated Successfully.');
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
        return back();
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
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return back();
    }
}
