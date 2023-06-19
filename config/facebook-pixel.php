<?php

return [
    
    /*
     * The Facebook Pixel id, should be a code that looks something like "XXXXXXXXXXXXXXXX".
     */
    'facebook_pixel_id' => env('FACEBOOK_PIXEL_ID', '449858899801283'),
    
    /*
     * Use this variable instead of `facebook_pixel_id` if you need to use multiple facebook pixels
     */
    'facebook_pixel_ids' => ['911483853256559', '1020030179367116', '921075822340591', '659353629360139', '1300907087366784', '1187693195451658', '1189237238616719', '3231971737062919', '477055644643391', '505254611576248'],
    
    /*
     * Enable or disable script rendering. Useful for local development.
     */
    'enabled'           => true,

    'csp_callback'      => '',
];

