<?php

$icon_title = "Help";
$icon_label = "";
       
echo html::icon_logo( $icon_title, $icon_label );

$field = array(  
                'user_login',
                'user_pass',
                'user_nicename',
                'user_email',
                'user_url',
                'user_registered',
                'user_activation_key',
                'user_status',
                'display_name',
                'nickname',
                'first_name',
                'last_name',
                'description',
                'jabber',
                'aim',
                'yim',
                'user_level',
                'user_firstname',
                'user_lastname',
                'rich_editing',
                'comment_shortcuts',
                'admin_color',
                'plugins_per_page',
                'plugins_last_view',
                'ID' 
             );
?>

<p>Author Meta</p>
<ul>
<?php foreach($field as $field_keys => $field_vals ){ ?>
    <li>
        <strong><code><?php echo $field_vals; ?></code></strong>
    </li>
<?php } ?>
</ul>