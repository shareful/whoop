<?php

namespace App\Models\Admin\Messages;

use Illuminate\Database\Eloquent\Model;

class WizardMessage extends Model
{
    const ICON_PATH = 'messages/wizard';

    protected $table = 'wizard_messages';
}
