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
//        return [
//            'scheduled_shift',
//            'actual_shift',
//            'customer_appointment',
//            'personal_appointment',
//            'internal_meeting',
//            'external_meeting',
//            'external_event',
//            'location_event',
//        ];

        return [
                    [
                        'id'=>  'null',
                        'text'=>  'Select....',
                        'visible'=> true
                    ],
                    [
                        'id'=>  'scheduled_shift',
                        'text'=>  'Scheduled Shift',
                        'visible'=> true
                    ],
                    [
                        'id'=>  'actual_shift',
                        'text'=>  'Actual Shift',
                        'visible'=> false
                    ],
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
                        'id'=>  'location_event',
                        'text'=>  'Event',
                        'visible'=> false

                    ],
                    [
                        'id'=>  'external_meeting',
                        'text'=>  'External Meeting',
                        'visible'=> false
                    ],
                    [
                        'id'=>  'external_event',
                        'text'=>  'Event',
                        'visible'=> true
                    ]

                ];

    }

}