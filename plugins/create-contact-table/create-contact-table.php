<?php

//Creating the table

function create_custom_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'industrial_affiliate_contacts'; // Replace 'contacts' with your desired table name

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'create_custom_table');


//Inserting user iputs into table

function insert_contact_data() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'industrial_affiliate_contacts';

    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);

    $wpdb->insert(
        $table_name,
        array(
            'name' => $name,
            'email' => $email
        )
    );
}
add_action('admin_post_submit_contact_form', 'insert_contact_data');
add_action('admin_post_nopriv_submit_contact_form', 'insert_contact_data');


?>
