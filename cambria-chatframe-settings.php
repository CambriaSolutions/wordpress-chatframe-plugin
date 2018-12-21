add_action( 'admin_menu', 'chatframe_settings_page');

function chatframe_settings_page{
    add_options_page(
        'Chatframe Options Page',
        'Chatframe Options Page',
        'manage_options',
        'chatframe-api-page',
        'chatframe_setting_page';
    )
};
