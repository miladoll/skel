<?php
$confs = [
    [
        'section' =>
        [
            'name' => 'basis_of_design',
            'title' => __( 'Basis of Design', 'skel' ),
            'priority' => 130
        ]
    ],
    [
        'setting' =>
        [
            'type' => 'radio',
            'name' => 'basis_of_design__disable_pretty_css',
            'description' => __( 'Whether disable CSS for pretty print or not', 'skel' ),
            'label' => __( 'Disable Pretty CSS', 'skel' ),
            'section' => 'basis_of_design',
            'default' => 'no',
            'choices' => [
                'no'   => __( 'No (default)', 'skel' ),
                'disable'  => __( 'Disable', 'skel' )
            ]
        ]
    ],
    [
        'setting' =>
        [
            'type' => 'radio',
            'name' => 'basis_of_design__set_sidebar_right',
            'description' => __( 'Whether set sidebar left or right', 'skel' ),
            'label' => __( 'Set Sidebar Right', 'skel' ),
            'section' => 'basis_of_design',
            'default' => 'left',
            'choices' => [
                'left'   => __( 'Left (default)', 'skel' ),
                'right'  => __( 'Right', 'skel' )
            ]
        ]
    ],
    [
        'setting' =>
        [
            'type' => 'text',
            'name' => 'basis_of_design__format_datetime_article_body',
            'description' => __( 'Display format string in article bodies (default: same as the system setting', 'skel' ),
            'label' => __( 'Date and Time: In Article Bodies', 'skel' ),
            'section' => 'basis_of_design',
            'default' => '',
        ]
    ],
        // site_administration
    [
        'section' =>
        [
            'name' => 'site_administration',
            'title' => __( 'Site Administration', 'skel' ),
            'priority' => 130
        ]
    ],
    [
        'setting' =>
        [
            'type' => 'text',
            'name' => 'site_administration__google_search_console',
            'label' => __( 'Google Search Console', 'skel' ),
            'section' => 'site_administration',
            'default' => '',
            'description' => __( 'set value of META tag', 'skel' )
        ]
    ],
    [
        'setting' =>
        [
            'type' => 'textarea',
            'name' => 'site_administration__google_analytics',
            'label' => __( 'Google Analytics', 'skel' ),
            'section' => 'site_administration',
            'default' => '',
            'description' => __( 'set accounting tag', 'skel' )
        ]
    ],
    [
        'setting' =>
        [
            'type' => 'text',
            'name' => 'site_administration__google_tag_manager',
            'label' => __( 'Google Tag Manager', 'skel' ),
            'section' => 'site_administration',
            'default' => '',
            'description' => __( 'set manager container-ID (such as `GTM-xxxxx`)', 'skel' )
        ]
    ],
        // sns
    [
        'section' =>
        [
            'name' => 'sns',
            'title' => __( 'SNS Related', 'skel' ),
            'priority' => 130
        ]
    ],
    [
        'setting' =>
        [
            'type' => 'text',
            'name' => 'sns__twitter',
            'label' => __( 'Twitter', 'skel' ),
            'section' => 'sns',
            'default' => '',
            'description' => __( 'set account name (without @)', 'skel' )
        ]
    ],
    [
        'setting' =>
        [
            'type' => 'url',
            'name' => 'sns__facebook',
            'label' => __( 'Facebook', 'skel' ),
            'section' => 'sns',
            'default' => '',
            'description' => __( 'set URL for user page/facebook page', 'skel' )
        ]
    ],
    [
        'setting' =>
        [
            'type' => 'url',
            'name' => 'sns__instagram',
            'label' => __( 'Instagram', 'skel' ),
            'section' => 'sns',
            'default' => '',
            'description' => __( 'set URL for Instagram page', 'skel' )
        ]
    ]
];
