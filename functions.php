<?php

add_action( 'wp_enqueue_scripts', 'basel_child_enqueue_styles', 1000 );

function basel_child_enqueue_styles() {
    if( basel_get_opt( 'minified_css' ) ) {
        wp_enqueue_style( 'basel-style', get_template_directory_uri() . '/style.min.css', array('bootstrap') );
    } else {
        wp_enqueue_style( 'basel-style', get_template_directory_uri() . '/style.css', array('bootstrap') );
    }
    
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('bootstrap') );
}


add_filter( 'wpcf7_validate_configuration', '__return_false' );

function arphabet_widgets_init() {

    register_sidebar( array(
        'name'          => 'Home right sidebar',
        'id'            => 'home_right_1',
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="rounded">',
        'after_title'   => '</h2>',
    ) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );

function disable_shipping_calc_on_cart( $show_shipping ) {
    if( is_cart() ) {
        return false;
    }
    return $show_shipping;
}
add_filter( 'woocommerce_cart_ready_to_calc_shipping', 'disable_shipping_calc_on_cart', 99 );



add_filter( 'default_checkout_state', 'change_default_checkout_state' );
  
function change_default_checkout_state() {
  return 'alaska'; // state code
}


// send mail whenever a new post is published

add_action('publish_post', 'send_blog_mail');

function send_blog_mail($post_ID) {
    /*$server = 'localhost';
    $user = 'sweetsiteuser';
    $pass = 'sweetsitedb';
    $db = 'sweetsitedb';
    
    $conn = mysqli_connect($server,$user,$pass,$db);
    
    if (!$conn){
        echo "not connected";
    }
    else{
        $sql = "SELECT * FROM `wp_posts` WHERE `post_type` = 'post' ORDER BY post_date DESC";
        $query = mysqli_query($conn,$sql);
        
        //echo mysqli_num_rows($query);
        
        $fetch = mysqli_fetch_assoc($query);
        
        //echo "<pre>";print_r($fetch);
    
        $post_name = $fetch['post_title'];
        $post_content = $fetch['post_content'];*/
    
    
    global $wpdb;
    
    $results = $wpdb->get_results("SELECT * FROM wp_posts WHERE post_type='post' AND post_status='publish' ORDER BY post_date DESC LIMIT 1");
    
    
       /* $posts_array = get_posts(
                    array(
                    'posts_per_page' => 3,
                    'post_type' => 'post',
                    'post_status'=>'publish',
                    'orderby'=>'id',
                    'order'=>'DESC'
                    )
                );*/
        
        $posts_array = $wpdb->get_results("SELECT * FROM wp_posts WHERE post_type='post' AND post_status='publish' ORDER BY post_date DESC LIMIT 3 OFFSET 1");
        
        $mail_ids = $wpdb->get_results("SELECT * FROM newsletters");
        $elements = array();
        foreach ($mail_ids as $mails) {
        
        $elements[] = $mails->email;
        $sub = implode(",",$elements);
    }
        $to = $sub;
        //$to = 'sahilverma1755@gmail.com,akshayneb@gmail.com';
        $subject = 'New Blog.. Whats the buzz?';
        //$message = $post_name."<br>".$post_content;
    $img="";
        
        $message="<html>
    <head>
    <title>Newsletter</title>
    </head>
    <body>
    <table align='center' border='0' cellpadding='0' cellspacing='0' height='100%' width='100%' id='m_8643198860833275062bodyTable' style='border-collapse:collapse;height:100%;margin:0;padding:0;width:100%'>
                    <tbody><tr>
                        <td align='center' valign='top' id='m_8643198860833275062bodyCell' style='height:100%;margin:0;padding:0;width:100%'>
                            
                            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse:collapse'>
                                <tbody><tr>
                                    <td align='center' valign='top' id='m_8643198860833275062templateHeader' style='background:#f7f7f7 none no-repeat center/cover;background-color:#f7f7f7;background-image:none;background-repeat:no-repeat;background-position:center;background-size:cover;border-top:0;border-bottom:0;padding-top:0px;padding-bottom:0px'>
                                        
                                        <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%' class='m_8643198860833275062templateContainer' style='border-collapse:collapse;max-width:600px!important'>
                                            <tbody><tr>
                                                <td valign='top' class='m_8643198860833275062headerContainer' style='background:transparent none no-repeat center/cover;background-color:transparent;background-image:none;background-repeat:no-repeat;background-position:center;background-size:cover;border-top:0;border-bottom:0;padding-top:0;padding-bottom:0'><table border='0' cellpadding='0' cellspacing='0' width='100%' class='m_8643198860833275062mcnImageBlock' style='min-width:100%;border-collapse:collapse'>
        <tbody class='m_8643198860833275062mcnImageBlockOuter'>
                <tr>
                    <td valign='top' style='padding:9px' class='m_8643198860833275062mcnImageBlockInner'>
                        <table align='left' width='100%' border='0' cellpadding='0' cellspacing='0' class='m_8643198860833275062mcnImageContentContainer' style='min-width:100%;border-collapse:collapse'>
                            <tbody><tr>
                                <td class='m_8643198860833275062mcnImageContent' valign='top' style='padding-right:9px;padding-left:9px;padding-top:0;padding-bottom:0;text-align:center'>
    
    
                                           <img align='center' alt='logo' src='https://sweetcombchicago.com/wp-content/themes/basel-child/mail-imgs/logoweb.png' width='100' style='max-width:200px;padding-bottom:0;display:inline!important;vertical-align:bottom;border:0;height:auto;outline:none;text-decoration:none' class='m_8643198860833275062mcnRetinaImage CToWUd'>
    
    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </td>
                </tr>
        </tbody>
    </table>
    <table border='0' cellpadding='0' cellspacing='0' width='100%' class='m_8643198860833275062mcnTextBlock' style='min-width:100%;border-collapse:collapse'>
        <tbody class='m_8643198860833275062mcnTextBlockOuter'>
            <tr>
                <td valign='top' class='m_8643198860833275062mcnTextBlockInner' style='padding-top:9px'>
                    
                
                    
                    <table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%;border-collapse:collapse' width='100%' class='m_8643198860833275062mcnTextContentContainer'>
                        <tbody><tr>
    
                            <td valign='top' class='m_8643198860833275062mcnTextContent' style='padding-top:0;padding-right:18px;padding-bottom:9px;padding-left:18px;word-break:break-word;color:#757575;font-family:Helvetica;font-size:16px;line-height:150%;text-align:left'>
    
                                <h1 style='display:block;margin:0;padding:0;color:#222222;font-family:Helvetica;font-size:40px;font-style:normal;font-weight:bold;line-height:150%;letter-spacing:normal;text-align:center'>New Blog.. What's the buzz?</h1>
    
                            </td>
                        </tr>
                    </tbody>
                </table>
                    
    
                    
                </td>
            </tr>
        </tbody>
    </table></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                        
                                    </td>
                                </tr>";
    
                                /* new blog start */
                    foreach ($results as $blog) {
                        $img = get_the_post_thumbnail_url($blog->ID);
                        $trimmed = wp_trim_words( $blog->post_content, $num_words = 15, $more = null );
                               $message.="<tr>
                                    <td align='center' valign='top' id='m_8643198860833275062templateBody' style='background:#ffffff none no-repeat center/cover;background-color:#ffffff;background-image:none;background-repeat:no-repeat;background-position:center;background-size:cover;border-top:0;border-bottom:0;padding-top:10px;padding-bottom:45px'>
                                        
                                        <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%' class='m_8643198860833275062templateContainer' style='border-collapse:collapse;max-width:870px!important'>
                                            <tbody><tr>
                                                <td valign='top' class='m_8643198860833275062bodyContainer' style='background:transparent none no-repeat center/cover;background-color:transparent;background-image:none;background-repeat:no-repeat;background-position:center;background-size:cover;border-top:0;border-bottom:0;padding-top:0;padding-bottom:0'><table border='0' cellpadding='0' cellspacing='0' width='100%' class='m_8643198860833275062mcnImageBlock' style='min-width:100%;border-collapse:collapse'>
        <tbody class='m_8643198860833275062mcnImageBlockOuter'>
                <tr>
                    <td valign='top' style='padding:9px' class='m_8643198860833275062mcnImageBlockInner'>
                        <table align='left' width='100%' border='0' cellpadding='0' cellspacing='0' class='m_8643198860833275062mcnImageContentContainer' style='min-width:100%;border-collapse:collapse'>
                            <tbody><tr>
                                <td class='m_8643198860833275062mcnImageContent' valign='top' style='padding-right:9px;padding-left:9px;padding-top:0;padding-bottom:0;text-align:center'>
    
                                         <a href='#'><img align='center' alt='' src='$img' width='564' style='max-width:1128px;padding-bottom:0;display:inline!important;vertical-align:bottom;border:0;height:auto;outline:none;text-decoration:none' class='m_8643198860833275062mcnImage CToWUd a6T' tabindex='0'></a>
                                         
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </td>
                </tr>
        </tbody>
    </table>
    <table border='0' cellpadding='0' cellspacing='0' width='100%' class='m_8643198860833275062mcnTextBlock' style='min-width:100%;border-collapse:collapse'>
        <tbody class='m_8643198860833275062mcnTextBlockOuter'>
            <tr>
                <td valign='top' class='m_8643198860833275062mcnTextBlockInner' style='padding-top:9px'>
                    
                
                    
                    <table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%;border-collapse:collapse' width='100%' class='m_8643198860833275062mcnTextContentContainer'>
                        <tbody><tr>
    
                            <td valign='top' class='m_8643198860833275062mcnTextContent' style='padding-top:0;padding-right:18px;padding-bottom:9px;padding-left:18px;word-break:break-word;color:#757575;font-family:Helvetica;font-size:16px;line-height:150%;text-align:left'>
    
                                <h3 style='text-align:center;display:block;margin:0;padding:0;color:#444444;font-family:Helvetica;font-size:22px;font-style:normal;font-weight:bold;line-height:150%;letter-spacing:normal'><span style='color:#000000'><strong>$blog->post_title</strong></span></h3>
                                
    &nbsp;
    
    <div style='text-align:left;'><span style='font-size:24px'>$trimmed</span></div>
    
    
                            </td>
                        </tr>
                    </tbody>
                </table>
                    
    
                    
                </td>
            </tr>
        </tbody>
    </table>
    <table border='0' cellpadding='0' cellspacing='0' width='100%' class='m_8643198860833275062mcnButtonBlock' style='min-width:100%;border-collapse:collapse'>
        <tbody class='m_8643198860833275062mcnButtonBlockOuter'>
            <tr>
                <td style='padding-top:0;padding-right:18px;padding-bottom:18px;padding-left:18px' valign='top' align='center' class='m_8643198860833275062mcnButtonBlockInner'>
                    <table border='0' cellpadding='0' cellspacing='0' class='m_8643198860833275062mcnButtonContentContainer' style='border-collapse:separate!important;border-radius:3px;background-color:#63bb4d;margin-top: 20px;'>
                        <tbody>
                            <tr>
                                <td align='center' valign='middle' class='m_8643198860833275062mcnButtonContent' style='font-family:Helvetica;font-size:24px;padding:18px'>
                                    <a class='m_8643198860833275062mcnButton' title='Read More' href='https://sweetcombchicago.com/$blog->post_name' style='font-weight:bold;letter-spacing:-0.5px;line-height:100%;text-align:center;text-decoration:none;color:#ffffff;display:block' target='_blank'>Continue Reading<a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>";
    
    }
    /* new blog end */
    
    /* recent blog start */
    
    $message.="<table border='0' cellpadding='0' cellspacing='0' width='100%' class='m_8643198860833275062mcnDividerBlock' style='min-width:100%;border-collapse:collapse;table-layout:fixed!important'>
        <tbody class='m_8643198860833275062mcnDividerBlockOuter'>
            <tr>
                <td class='m_8643198860833275062mcnDividerBlockInner' style='min-width:100%;padding:18px'>
                    <table class='m_8643198860833275062mcnDividerContent' border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%;border-collapse:collapse'>
                        <tbody><tr>
                            <td>
                                <h1 style='display:block;margin:0;padding:0;color:#222222;font-family:Helvetica;font-size:40px;font-style:normal;font-weight:bold;line-height:150%;letter-spacing:normal;text-align:center'>Recent Blogs</h1>
                            </td>
                        </tr>
                    </tbody>
                </table>
    
                </td>
            </tr>
        </tbody>
    </table>
    
    
    
    <table border='0' cellpadding='0' cellspacing='0' width='100%' class='m_8643198860833275062mcnCaptionBlock' style='border-collapse:collapse'>
        <tbody class='m_8643198860833275062mcnCaptionBlockOuter'>
            <tr>
                <td class='m_8643198860833275062mcnCaptionBlockInner' valign='top' style='padding:9px'>";
    
    foreach ($posts_array as $posts_blog) {
        $imgs = get_the_post_thumbnail_url($posts_blog->ID);
        $trimmed = wp_trim_words( $posts_blog->post_content, $num_words = 15, $more = null );
    $message.="<table align='left' border='0' cellpadding='0' cellspacing='0' class='m_8643198860833275062mcnCaptionBottomContent' width='282' style='border-collapse:collapse'>
        <tbody><tr>
            <td class='m_8643198860833275062mcnCaptionBottomImageContent' align='center' valign='top' style='padding:0 9px 9px 9px'>
    
        <a href='#'> <img alt='' src='$imgs' width='264' style='max-width:800px;border:0;height:auto;outline:none;text-decoration:none;vertical-align:bottom' class='m_8643198860833275062mcnImage CToWUd a6T' tabindex='0'></a>
           
    
    
            </td>
        </tr>
        <tr>
            <td class='m_8643198860833275062mcnTextContent' valign='top' style='padding:0 9px 0 9px;word-break:break-word;color:#757575;font-family:Helvetica;font-size:16px;line-height:150%;text-align:left' width='282'>
                <h3 class='m_8643198860833275062null' style='text-align:center;display:block;margin:0;padding:0;color:#444444;font-family:Helvetica;font-size:22px;font-style:normal;font-weight:bold;line-height:150%;letter-spacing:normal'><span style='font-size:21px'><span style='color:#000000'><strong>$posts_blog->post_title</strong></span></span></h3>
    &nbsp;
    
    
    &nbsp;
    
    <p style='margin:10px 0;padding:0;color:#757575;font-family:Helvetica;font-size:16px;line-height:150%;text-align:justify'>$trimmed</p>
    
    <p style='margin:10px 0;padding:0;color:#757575;font-family:Helvetica;font-size:16px;line-height:150%;text-align:left'><a href='https://sweetcombchicago.com/$posts_blog->post_name' style='color:#007c89;font-weight:normal;text-decoration:underline' target='_blank'>Read More »</a></p>
    
            </td>
        </tr>
    </tbody>
    </table>";
    
    }
    /* recent blog end */
    
    /* footer */
    
    
                $message.="</td>
            </tr>
        </tbody>
    </table>
    </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td align='center' valign='top' id='m_8643198860833275062templateFooter' style='background:#333333 none no-repeat center/cover;background-color:#333333;background-image:none;background-repeat:no-repeat;background-position:center;background-size:cover;border-top:0;border-bottom:0;padding-top:45px;padding-bottom:63px'>
                                        
                                        <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%' class='m_8643198860833275062templateContainer' style='border-collapse:collapse;max-width:600px!important'>
                                            <tbody><tr>
                                                <td valign='top' class='m_8643198860833275062footerContainer' style='background:transparent none no-repeat center/cover;background-color:transparent;background-image:none;background-repeat:no-repeat;background-position:center;background-size:cover;border-top:0;border-bottom:0;padding-top:0;padding-bottom:0'><table border='0' cellpadding='0' cellspacing='0' width='100%' class='m_8643198860833275062mcnFollowBlock' style='min-width:100%;border-collapse:collapse'>
        <tbody class='m_8643198860833275062mcnFollowBlockOuter'>
            <tr>
                <td align='center' valign='top' style='padding:9px' class='m_8643198860833275062mcnFollowBlockInner'>
                    <table border='0' cellpadding='0' cellspacing='0' width='100%' class='m_8643198860833275062mcnFollowContentContainer' style='min-width:100%;border-collapse:collapse'>
        <tbody><tr>
            <td align='center' style='padding-left:9px;padding-right:9px'>
                <table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%;border-collapse:collapse' class='m_8643198860833275062mcnFollowContent'>
                    <tbody><tr>
                        <td align='center' valign='top' style='padding-top:9px;padding-right:9px;padding-left:9px'>
                            <table align='center' border='0' cellpadding='0' cellspacing='0' style='border-collapse:collapse'>
                                <tbody><tr>
                                    <td align='center' valign='top'>
                                        
    
                                            
    
    
                                                <table align='left' border='0' cellpadding='0' cellspacing='0' style='display:inline;border-collapse:collapse'>
                                                    <tbody><tr>
                                                        <td valign='top' style='padding-right:10px;padding-bottom:9px' class='m_8643198860833275062mcnFollowContentItemContainer'>
                                                            <table border='0' cellpadding='0' cellspacing='0' width='100%' class='m_8643198860833275062mcnFollowContentItem' style='border-collapse:collapse'>
                                                                <tbody><tr>
                                                                    <td align='left' valign='middle' style='padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px'>
                                                                        <table align='left' border='0' cellpadding='0' cellspacing='0' width='' style='border-collapse:collapse'>
                                                                            <tbody><tr>
    
                                                                                    <td align='center' valign='middle' width='24' class='m_8643198860833275062mcnFollowIconContent'>
                                                                                        <a href='https://sweetcombchicago.us18.list-manage.com/track/click?u=eede14b6330a2dd4ad9db67cf&amp;id=48fbf4d6d1&amp;e=2775977181' target='_blank' data-saferedirecturl='https://www.google.com/url?q=https://sweetcombchicago.us18.list-manage.com/track/click?u%3Deede14b6330a2dd4ad9db67cf%26id%3D48fbf4d6d1%26e%3D2775977181&amp;source=gmail&amp;ust=1554640687896000&amp;usg=AFQjCNEVX1KCWhJxI3X6aWTo7oGOruXWoA'><img src='https://ci6.googleusercontent.com/proxy/iZE-48sXvszGHh6MUoqCYHnlP8ohfGJI6V1fj23YRaJHEaKjOb2V7stez03tl97kcCY9ebD52HlFfqGKcTQbPlQaysAL26ZKjUSa5NGX7CU3WUodCbzb-vFMkIXxvIREY4PT879oIw=s0-d-e1-ft#https://cdn-images.mailchimp.com/icons/social-block-v2/outline-light-facebook-48.png' style='display:block;border:0;height:auto;outline:none;text-decoration:none' height='24' width='24' class='CToWUd'></a>
                                                                                    </td>
    
    
                                                                            </tr>
                                                                        </tbody></table>
                                                                    </td>
                                                                </tr>
                                                            </tbody></table>
                                                        </td>
                                                    </tr>
                                                </tbody></table>
    
                                            
    
                                            
    
    
                                                <table align='left' border='0' cellpadding='0' cellspacing='0' style='display:inline;border-collapse:collapse'>
                                                    <tbody><tr>
                                                        <td valign='top' style='padding-right:10px;padding-bottom:9px' class='m_8643198860833275062mcnFollowContentItemContainer'>
                                                            <table border='0' cellpadding='0' cellspacing='0' width='100%' class='m_8643198860833275062mcnFollowContentItem' style='border-collapse:collapse'>
                                                                <tbody><tr>
                                                                    <td align='left' valign='middle' style='padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px'>
                                                                        <table align='left' border='0' cellpadding='0' cellspacing='0' width='' style='border-collapse:collapse'>
                                                                            <tbody><tr>
    
                                                                                    <td align='center' valign='middle' width='24' class='m_8643198860833275062mcnFollowIconContent'>
                                                                                        <a href='https://sweetcombchicago.us18.list-manage.com/track/click?u=eede14b6330a2dd4ad9db67cf&amp;id=e7cca33bc6&amp;e=2775977181' target='_blank'><img src='https://ci4.googleusercontent.com/proxy/GvgjS4VPlhMl8idO5upbHzEV4AqTNut4mbrm7tN9t-0Y_Os_vvAtMqPaBL6LxSdD50M0_WvdYOaRkeRE25HbR815TslhhzsjoZMzzpKYLiG8MFqu6VDbzkb2JbyH4IjCPWiYy3cT=s0-d-e1-ft#https://cdn-images.mailchimp.com/icons/social-block-v2/outline-light-twitter-48.png' style='display:block;border:0;height:auto;outline:none;text-decoration:none' height='24' width='24' class='CToWUd'></a>
                                                                                    </td>
    
    
                                                                            </tr>
                                                                        </tbody></table>
                                                                    </td>
                                                                </tr>
                                                            </tbody></table>
                                                        </td>
                                                    </tr>
                                                </tbody></table>
    
                                            
    
                                            
    
    
                                                <table align='left' border='0' cellpadding='0' cellspacing='0' style='display:inline;border-collapse:collapse'>
                                                    <tbody><tr>
                                                        <td valign='top' style='padding-right:10px;padding-bottom:9px' class='m_8643198860833275062mcnFollowContentItemContainer'>
                                                            <table border='0' cellpadding='0' cellspacing='0' width='100%' class='m_8643198860833275062mcnFollowContentItem' style='border-collapse:collapse'>
                                                                <tbody><tr>
                                                                    <td align='left' valign='middle' style='padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px'>
                                                                        <table align='left' border='0' cellpadding='0' cellspacing='0' width='' style='border-collapse:collapse'>
                                                                            <tbody><tr>
    
                                                                                    <td align='center' valign='middle' width='24' class='m_8643198860833275062mcnFollowIconContent'>
                                                                                        <a href='https://sweetcombchicago.us18.list-manage.com/track/click?u=eede14b6330a2dd4ad9db67cf&amp;id=aa8c408184&amp;e=2775977181' target='_blank'><img src='https://ci5.googleusercontent.com/proxy/Ihh9hEwk_36d3lzL_tLmGaqmGhc-dLqZP-II9LpKgUDCh37Kvw1N4-DJsrxuyAA9V1NNx3975BQO5w7DNVWvFHpPM4gkDm8eMVCLYy_PtGWEZAxMuaULgOR-6W0K_1sgXOcwNMtgGVE=s0-d-e1-ft#https://cdn-images.mailchimp.com/icons/social-block-v2/outline-light-instagram-48.png' style='display:block;border:0;height:auto;outline:none;text-decoration:none' height='24' width='24' class='CToWUd'></a>
                                                                                    </td>
    
    
                                                                            </tr>
                                                                        </tbody></table>
                                                                    </td>
                                                                </tr>
                                                            </tbody></table>
                                                        </td>
                                                    </tr>
                                                </tbody></table>
    
                                            
    
                                            
    
    
                                                <table align='left' border='0' cellpadding='0' cellspacing='0' style='display:inline;border-collapse:collapse'>
                                                    <tbody><tr>
                                                        <td valign='top' style='padding-right:0;padding-bottom:9px' class='m_8643198860833275062mcnFollowContentItemContainer'>
                                                            <table border='0' cellpadding='0' cellspacing='0' width='100%' class='m_8643198860833275062mcnFollowContentItem' style='border-collapse:collapse'>
                                                                <tbody><tr>
                                                                    <td align='left' valign='middle' style='padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px'>
                                                                        <table align='left' border='0' cellpadding='0' cellspacing='0' width='' style='border-collapse:collapse'>
                                                                            <tbody><tr>
    
                                                                                    <td align='center' valign='middle' width='24' class='m_8643198860833275062mcnFollowIconContent'>
                                                                                        <a href='https://sweetcombchicago.us18.list-manage.com/track/click?u=eede14b6330a2dd4ad9db67cf&amp;id=7d121d6220&amp;e=2775977181' target='_blank' data-saferedirecturl='https://www.google.com/url?q=https://sweetcombchicago.us18.list-manage.com/track/click?u%3Deede14b6330a2dd4ad9db67cf%26id%3D7d121d6220%26e%3D2775977181&amp;source=gmail&amp;ust=1554640687897000&amp;usg=AFQjCNER29Yhvujtfx23wRx7nH_rTJeJww'><img src='https://ci6.googleusercontent.com/proxy/uZ0yuxmORppOSAVlAI9An9dTGgd5WLSQ0CBL7MLu_J4uk8Z1QO7RWFmdlkUYkmd_GLhwph5RoVCp9eKrXzEQnDQ91cNlGygasb_4p2fT-TnBvWoJAX8mqJXeyuG36Kto6QrY=s0-d-e1-ft#https://cdn-images.mailchimp.com/icons/social-block-v2/outline-light-link-48.png' style='display:block;border:0;height:auto;outline:none;text-decoration:none' height='24' width='24' class='CToWUd'></a>
                                                                                    </td>
    
    
                                                                            </tr>
                                                                        </tbody></table>
                                                                    </td>
                                                                </tr>
                                                            </tbody></table>
                                                        </td>
                                                    </tr>
                                                </tbody></table>
    
                                            
    
                                        
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
            </td>
        </tr>
    </tbody></table>
    
                </td>
            </tr>
        </tbody>
    </table><table border='0' cellpadding='0' cellspacing='0' width='100%' class='m_8643198860833275062mcnDividerBlock' style='min-width:100%;border-collapse:collapse;table-layout:fixed!important'>
        <tbody class='m_8643198860833275062mcnDividerBlockOuter'>
            <tr>
                <td class='m_8643198860833275062mcnDividerBlockInner' style='min-width:100%;padding:18px'>
                    <table class='m_8643198860833275062mcnDividerContent' border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%;border-top:2px solid #505050;border-collapse:collapse'>
                        <tbody><tr>
                            <td>
                                <span></span>
                            </td>
                        </tr>
                    </tbody></table>
    
                </td>
            </tr>
        </tbody>
    </table><table border='0' cellpadding='0' cellspacing='0' width='100%' class='m_8643198860833275062mcnTextBlock' style='min-width:100%;border-collapse:collapse'>
        <tbody class='m_8643198860833275062mcnTextBlockOuter'>
            <tr>
                <td valign='top' class='m_8643198860833275062mcnTextBlockInner' style='padding-top:9px'>
                    
                
                    
                    <table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%;border-collapse:collapse' width='100%' class='m_8643198860833275062mcnTextContentContainer'>
                        <tbody><tr>
    
                            <td valign='top' class='m_8643198860833275062mcnTextContent' style='padding-top:0;padding-right:18px;padding-bottom:9px;padding-left:18px;word-break:break-word;color:#ffffff;font-family:Helvetica;font-size:12px;line-height:150%;text-align:center'>
    
                                <em>Copyright © 2019 sweetcombchicago, All rights reserved.</em>
    <br>
        You are receiving this email because you opted in at our website.
        <br>
        <br>
        <strong>Our mailing address is:</strong>
        <br>
        <div class='m_8643198860833275062vcard'><span class='m_8643198860833275062org m_8643198860833275062fn'>sweetcombchicago</span><div class='m_8643198860833275062adr'><div class='m_8643198860833275062street-address'>1847 W Farwell Ave</div><span class='m_8643198860833275062locality'>Chicago</span>, <span class='m_8643198860833275062region'>IL</span>  <span class='m_8643198860833275062postal-code'>60626</span></div><br><a href='https://sweetcombchicago.us18.list-manage.com/vcard?u=eede14b6330a2dd4ad9db67cf&amp;id=5bc9653fce' class='m_8643198860833275062hcard-download'  style='color:#ffffff;font-weight:normal;text-decoration:underline' target='_blank' data-saferedirecturl='https://www.google.com/url?q=https://sweetcombchicago.us18.list-manage.com/vcard?u%3Deede14b6330a2dd4ad9db67cf%26id%3D5bc9653fce&amp;source=gmail&amp;ust=1554640687897000&amp;usg=AFQjCNFSk5hDwrNspQqfqlualE8rt7WM8w'>Add us to your address book</a></div>
        <br>
        <br>
        Want to change how you receive these emails?<br>
        You can <a href='https://sweetcombchicago.us18.list-manage.com/profile?u=eede14b6330a2dd4ad9db67cf&amp;id=5bc9653fce&amp;e=2775977181' style='color:#ffffff;font-weight:normal;text-decoration:underline' target='_blank' data-saferedirecturl='https://www.google.com/url?q=https://sweetcombchicago.us18.list-manage.com/profile?u%3Deede14b6330a2dd4ad9db67cf%26id%3D5bc9653fce%26e%3D2775977181&amp;source=gmail&amp;ust=1554640687897000&amp;usg=AFQjCNF7DVq4r6SGumZHo0w5r6EQNh2llA'>update your preferences</a> or <a href='https://sweetcombchicago.us18.list-manage.com/unsubscribe?u=eede14b6330a2dd4ad9db67cf&amp;id=5bc9653fce&amp;e=2775977181&amp;c=2b07160a13' style='color:#ffffff;font-weight:normal;text-decoration:underline' target='_blank' data-saferedirecturl='https://www.google.com/url?q=https://sweetcombchicago.us18.list-manage.com/unsubscribe?u%3Deede14b6330a2dd4ad9db67cf%26id%3D5bc9653fce%26e%3D2775977181%26c%3D2b07160a13&amp;source=gmail&amp;ust=1554640687897000&amp;usg=AFQjCNElfJaTVy4rufCsW42QiZZPtn5cXQ'>unsubscribe from this list</a>.
        <br>
        <br>
     <a href='http://www.mailchimp.com/monkey-rewards/?utm_source=freemium_newsletter&amp;utm_medium=email&amp;utm_campaign=monkey_rewards&amp;aid=eede14b6330a2dd4ad9db67cf&amp;afl=1' target='_blank' data-saferedirecturl='https://www.google.com/url?q=http://www.mailchimp.com/monkey-rewards/?utm_source%3Dfreemium_newsletter%26utm_medium%3Demail%26utm_campaign%3Dmonkey_rewards%26aid%3Deede14b6330a2dd4ad9db67cf%26afl%3D1&amp;source=gmail&amp;ust=1554640687897000&amp;usg=AFQjCNEy0fVlb0kHbVe8Rs7vOUyPCYnk0g'><img src='https://ci5.googleusercontent.com/proxy/OGX3d0TNPXqgQVMCZ70OTradqfQEGNJuvs461g2Lmk4e1EXhNAfX2rSgIQ-IYBNoTppIhf1ruT9tMAnlc0mdKcKSTYQA8rTfkC6V31nIl4s4iZp7_reu914=s0-d-e1-ft#https://cdn-images.mailchimp.com/monkey_rewards/MC_MonkeyReward_15.png' border='0' alt='Email Marketing Powered by Mailchimp' title='Mailchimp Email Marketing' width='139' height='54' class='CToWUd'></a>
                            </td>
                        </tr>
                    </tbody></table>
                    
    
                    
                </td>
            </tr>
        </tbody>
    </table></td>
                                            </tr>
                                        </tbody></table>
                                        
                                    </td>
                                </tr>
                            </tbody></table>
                            
                        </td>
                    </tr>
                </tbody></table>
    
    </body>
    </html>";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: hello@sweetcombchicago.com'."\r\n";
        $headers .= 'Bcc: abhishekdasuja@gmail.com'."\r\n";
		if ($img){
        wp_mail($to, $subject, $message, $headers);
        
    }
}
