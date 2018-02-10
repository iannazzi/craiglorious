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
    public static function getEventTypes($access)
    {

        $event_types = [];
        $event_types[] = [
            'id'=>  'null',
            'text'=>  'Select....',
            'visible'=> true
        ];
        if($access){
            $event_types[] =[
                'id'=>  'scheduled_shift',
                'text'=>  'Scheduled Shift',
                'visible'=> true
            ];
            $event_types[] =  [
                'id'=>  'actual_shift',
                'text'=>  'Actual Shift',
                'visible'=> false
            ];

        }
        $remaining_events =  [
                    [
                        'id'=>  'customer_appointment',
                        'text'=>  'Appointment',
                        'visible'=> true
                    ],
                    [
                        'id'=>  'personal_appointment',
                        'text'=>  'Personal Appointment',
                        'visible'=> true
                    ],
                    [
                        'id'=>  'internal_meeting',
                        'text'=>  'Meeting',
                        'visible'=> true
                    ],
                    [
                        'id'=>  'external_event',
                        'text'=>  'Event',
                        'visible'=> true
                    ]

                ];
        return array_merge($event_types,$remaining_events);
    }

}