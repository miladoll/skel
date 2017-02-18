<?php
require_once
    get_template_directory()
    . '/skel/vendor/tgm-plugin-activation/class-tgm-plugin-activation.php'
;

add_action(
    'tgmpa_register',
    function () {
        $plugin_source = skel::DIR_STEM_ROOT() . '/source/plugin/';
        $plugins = array(
    /*
            array(
                'name'               => 'TGM Example Plugin', // The plugin name.
                'slug'               => 'tgm-example-plugin', // The plugin slug (typically the folder name).
                'source'             => get_template_directory() . '/lib/plugins/tgm-example-plugin.zip', // The plugin source.
                'required'           => true, // If false, the plugin is only 'recommended' instead of required.
                'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
                'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
                'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
                'external_url'       => '', // If set, overrides default API URL and points to an external URL.
                'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
            ),
    */
            // Simpleset
            array(
                'name' => 'WP Multibyte Patch',
                'slug' => 'wp-multibyte-patch',
                'source' => $plugin_source . 'wp-multibyte-patch.zip',
            ),
            array(
                'name' => 'Jetpack by WordPress.com',
                'slug' => 'jetpack',
                'source' => $plugin_source . 'jetpack.zip',
            ),
            array(
                'name' => 'Crayon Syntax Highlighter',
                'slug' => 'crayon-syntax-highlighter',
                'source' => $plugin_source . 'crayon-syntax-highlighter.zip',
            ),
            array(
                'name' => 'Meta Slider',
                'slug' => 'ml-slider',
                'source' => $plugin_source . 'ml-slider.zip',
            ),
            array(
                'name' => 'Toggle wpautop',
                'slug' => 'toggle-wpautop',
                'source' => $plugin_source . 'toggle-wpautop.zip',
            ),
            array(
                'name' => 'WP to Twitter',
                'slug' => 'wp-to-twitter',
                'source' => $plugin_source . 'wp-to-twitter.zip',
            ),
        );

        $config = array(
            'id' => 'skel',
            'default_path' => '', // Default absolute path to bundled plugins.
            'menu' => 'tgmpa-install-plugins',
            'parent_slug' => 'themes.php',
            'capability' => 'edit_theme_options',
            'has_notices' => true,
            'dismissable' => true,
            'dismiss_msg' => '',
            'is_automatic' => false, // Automatically activate plugins after installation or not.
            'message' => '',

            /*
            'strings'      => array(
                'page_title'                      => __( 'Install Required Plugins', 'skel' ),
                'menu_title'                      => __( 'Install Plugins', 'skel' ),
                /* translators: %s: plugin name. * /
                'installing'                      => __( 'Installing Plugin: %s', 'skel' ),
                /* translators: %s: plugin name. * /
                'updating'                        => __( 'Updating Plugin: %s', 'skel' ),
                'oops'                            => __( 'Something went wrong with the plugin API.', 'skel' ),
                'notice_can_install_required'     => _n_noop(
                    /* translators: 1: plugin name(s). * /
                    'This theme requires the following plugin: %1$s.',
                    'This theme requires the following plugins: %1$s.',
                    'skel'
                ),
                'notice_can_install_recommended'  => _n_noop(
                    /* translators: 1: plugin name(s). * /
                    'This theme recommends the following plugin: %1$s.',
                    'This theme recommends the following plugins: %1$s.',
                    'skel'
                ),
                'notice_ask_to_update'            => _n_noop(
                    /* translators: 1: plugin name(s). * /
                    'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
                    'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
                    'skel'
                ),
                'notice_ask_to_update_maybe'      => _n_noop(
                    /* translators: 1: plugin name(s). * /
                    'There is an update available for: %1$s.',
                    'There are updates available for the following plugins: %1$s.',
                    'skel'
                ),
                'notice_can_activate_required'    => _n_noop(
                    /* translators: 1: plugin name(s). * /
                    'The following required plugin is currently inactive: %1$s.',
                    'The following required plugins are currently inactive: %1$s.',
                    'skel'
                ),
                'notice_can_activate_recommended' => _n_noop(
                    /* translators: 1: plugin name(s). * /
                    'The following recommended plugin is currently inactive: %1$s.',
                    'The following recommended plugins are currently inactive: %1$s.',
                    'skel'
                ),
                'install_link'                    => _n_noop(
                    'Begin installing plugin',
                    'Begin installing plugins',
                    'skel'
                ),
                'update_link'                       => _n_noop(
                    'Begin updating plugin',
                    'Begin updating plugins',
                    'skel'
                ),
                'activate_link'                   => _n_noop(
                    'Begin activating plugin',
                    'Begin activating plugins',
                    'skel'
                ),
                'return'                          => __( 'Return to Required Plugins Installer', 'skel' ),
                'plugin_activated'                => __( 'Plugin activated successfully.', 'skel' ),
                'activated_successfully'          => __( 'The following plugin was activated successfully:', 'skel' ),
                /* translators: 1: plugin name. * /
                'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'skel' ),
                /* translators: 1: plugin name. * /
                'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'skel' ),
                /* translators: 1: dashboard link. * /
                'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'skel' ),
                'dismiss'                         => __( 'Dismiss this notice', 'skel' ),
                'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'skel' ),
                'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'skel' ),

                'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
            ),
            */
        );

        tgmpa( $plugins, $config );
    }
);
