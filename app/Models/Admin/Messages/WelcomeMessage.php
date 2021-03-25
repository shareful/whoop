<?php

namespace App\Models\Admin\Messages;

use Illuminate\Database\Eloquent\Model;

class WelcomeMessage extends Model
{
    const ICON_PATH = 'messages/welcome';

    protected $table = 'welcome_messages';
}
