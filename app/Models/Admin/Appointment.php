<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;


class Appointment extends Model
{
    const SLOT_MORNING = 'Morning';
    const SLOT_AFTERNOON = 'Afternoon';
    const SLOT_EVENING = 'Evening';

    const STATUS_NEW = 'New';
    const STATUS_BOOKED = 'Booked';
    const STATUS_COMPLETED = 'Completed';
    
    protected $table = 'appointments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'service_provider_id',
        'appointment_date',
        'job_info',
        'slot',        
        'status',        
    ];

    /**
     * This Appointment User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {        
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * The service provider
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service_provider()
    {
        return $this->belongsTo(ServiceProvider::class, 'service_provider_id');
    }
}    