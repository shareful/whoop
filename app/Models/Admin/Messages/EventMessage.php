<?php
namespace App\Models\Admin\Messages;

use App\Http\Controllers\Api\ProfileController;
use App\Models\Admin\Deal;
use App\Models\Admin\HomeButton;
use App\Models\Admin\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class EventMessage extends Model
{
    const TARGET_USER = 'User';
    const TARGET_BUTTON = 'Home Button';
    const ICON_PATH = 'messages/quote';
    const ALLOWED_TARGETS = array(self::TARGET_USER, self::TARGET_BUTTON);

    const EVENT_USER_JOINED = 'User Joined';
    const EVENT_USER_UNLOCKED_DEAL = 'User Unlocked Deal';
    const EVENT_QUOTE_IS_READY = 'Quote is Ready';
    const ALLOWED_EVENTS = array(
        self::EVENT_USER_JOINED,
        self::EVENT_USER_UNLOCKED_DEAL,
        self::EVENT_QUOTE_IS_READY
    );

    protected $table = 'events_messages';
    protected $cast = ['event_data' => 'json'];
    //protected $hidden = ['event_data'];
    protected $appends = ['data'];

    public function setTargetHomeButton(HomeButton $homeButton)
    {
        $this->target_type = self::TARGET_BUTTON;
        $this->target_id = $homeButton->id;
        return $this;
    }

    public function setTargetUser(User $user)
    {
        $this->target_type = self::TARGET_USER;
        $this->target_id = $user->id;
        return $this;
    }

    public function setEventType($event)
    {
        if (in_array($event, self::ALLOWED_EVENTS)) {
            $this->event_type = $event;
        } else {
            throw new \Exception('Invalid Event Type Provided.');
        }
        return $this;
    }

    public function setEventData(array $data)
    {
        $this->event_data = json_encode($data);
        return $this;
    }

    public function getDataAttribute()
    {
        return json_decode($this->event_data);
    }

    public static function getEventsOfUser(User $user)
    {
        $whereCondition = sprintf("(target_type='%s' AND target_id=%d)",
            self::TARGET_USER, $user->id);
        if ($user->home_button) {
            $whereCondition .= sprintf(" OR (target_type='%s' AND target_id=%d)",
                self::TARGET_BUTTON, $user->home_button->id);
        }
        return EventMessage::whereRaw($whereCondition)->orderBy('created_at', 'DESC')
            ->paginate(10)->toArray();
    }

    public static function addUserJoinedEvent(User $user)
    {
        $event = new self;
        $event->setTargetHomeButton($user->home_button);
        $event->setEventType(self::EVENT_USER_JOINED);
        $event->setEventData(array(
            'name' => $user->full_name,
            'user_id' => $user->id,
            'icon' => getImageUrl(basename($user->photo), ProfileController::UPLOAD_PATH)
        ));
        $event->save();
    }

    public static function addUserUnlockedDealEvent(User $user, Deal $deal)
    {
        $event = new self;
        $event->setTargetHomeButton($user->home_button);
        $event->setEventType(self::EVENT_USER_UNLOCKED_DEAL);
        $event->setEventData(array(
            'name' => $user->full_name,
            'deal' => $user->name,
            'deal_id' => $deal->id,
            'icon' => getImageUrl(basename($deal->image), 'deal')
        ));
        $event->save();
    }
}
?>