<?php namespace App\Models\Tenant;

use App\Models\BaseTenantModel;

class CalendarEntry extends BaseTenantModel {


    protected $guarded = ['id'];
    protected $casts = [
        'all_day' => 'boolean',
        'editable' => 'boolean',
        'duration_editable' => 'boolean',
        'start_editable' => 'boolean',
        'resource_editable' => 'boolean',
    ];
    public static function getEventTypes()
    {
        return [
            'scheduled_shift',
            'actual_shift',
            'customer_appointment',
            'personal_appointment',
            'internal_meeting',
            'external_meeting',
            'external_event',
            'location_event',
        ];
    }

}