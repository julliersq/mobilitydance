<?php
/*
//create additional sizes
add_image_size( 'main-page-slider-image', 1663, 832, false );
add_image_size( 'main-page-slider-thumb', 100, 80, true );


*/
$j2dk_custom_theme_options = get_option('j2dk_custom_theme_options');

add_action('init', 'initialize_function');
function initialize_function() {


    //add featured image to the page add/edit
    add_post_type_support('page', 'thumbnail');
}

if ( function_exists( 'add_theme_support' ) ) { 
    add_theme_support( 'post-thumbnails' ); 
    add_image_size( 'page-feature', 1200, 450, true );    
    add_image_size( 'footer-post-feature', 180, 167, true );  
    add_image_size( 'footer-spotlight-feature', 364, 167, true );  
}


add_action('load-themes.php', 'Init_theme');

function Init_theme() {
    global $pagenow,$wp_roles;    

    if ('themes.php' == $pagenow && isset($_GET['activated'])) { // Test if theme is activate
 
        if ( ! isset( $wp_roles ) )
            $wp_roles = new WP_Roles();

        $editor = $wp_roles->get_role('administrator');
        //Adding a 'new_role' with all admin caps
        $wp_roles->add_role('siteowner', 'Site Owner', $editor->capabilities);

    }
}
 
//remove_role( 'siteowner' );

function j2dk_format_string($string, $hasHTML = false, $listToCsv = false, $maxChar = -1, $end = '... ') {

    //list to csv
    if ($listToCsv && preg_match("/<[^<]+>/", $string, $m) != 0) {
        $string = preg_replace("'</li[^>]*?>.*?<li>'si", ", ", $string);
        $string = strip_tags($string, "<a>");
    }

    //strip html first
    if (!$hasHTML) {
        $string = strip_tags($string);
    }

    //truncate
    if ($maxChar > 0) {
        $encoding = 'UTF-8';
        $string = trim($string);

        if ((mb_strlen($string, $encoding)) <= $maxChar) {
            return $string;
        }

        $cutPos = $maxChar;
        $boundaryPos = mb_strrpos(mb_substr($string, 0, mb_strpos($string, ' ', $cutPos)), ' ');
        return mb_substr($string, 0, $boundaryPos === false ? $cutPos : $boundaryPos) . $end;
    }

    return $string;
}

$args = array(
	'name'          => __( 'Sidebar name', 'theme_text_domain' ),
	'id'            => 'unique-sidebar-id',
	'description'   => '',
        'class'         => '',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>' );

function register_my_menu() {
    register_nav_menus(array(
            'header-menu' => __('Header Menu'), /*
            'footer-column1' => __('Footer-Column1'),
            'footer-column2' => __('Footer-Column2'),
            'footer-column3' => __('Footer-Column3'), */
            ) );
    
}

add_action('init', 'register_my_menu');

add_action('admin_menu', 'j2dk_custom_theme_options_page');

function j2dk_custom_theme_options_page() {
    add_options_page('Theme Settings', 'Theme Settings', 'administrator', __FILE__, 'build_options_page');    
}

function build_options_page() {
    global $j2dk_custom_theme_options;
    $j2dk_custom_theme_options = get_option('j2dk_custom_theme_options');            
    ?>
    <div id="theme-options-wrap">
        <div class="icon32" id="icon-tools"> <br /> </div>
        <h2>EnterPrise Themes Settings</h2>
        <p>Update various settings throughout your website.</p>
        <form method="post" action="options.php" enctype="multipart/form-data">
            <?php settings_fields('j2dk_custom_theme_options'); ?>
            <?php do_settings_sections(__FILE__); ?>
            <p class="submit">
                <input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
            </p>
        </form>
    </div>
    <?php
}


add_action('admin_init', 'register_and_build_fields');

function register_and_build_fields() {
    register_setting('j2dk_custom_theme_options', 'j2dk_custom_theme_options', 'validate_setting');

    add_settings_section('general_settings', 'General Settings', 'section_general', __FILE__);
    
    function section_general() {

    }

    //add_settings_field('devmode', 'Development Mode', 'devmode_setting', __FILE__, 'general_settings');
    add_settings_field('about_excerpt', 'Website Description', 'about_excerpt_setting', __FILE__, 'general_settings');
    
    add_settings_section('contact_settings', 'Contact Information', 'section_contact', __FILE__);
    
    function section_contact() {

    }
    
    add_settings_field('address', 'Address', 'address_setting', __FILE__, 'contact_settings');    
    add_settings_field('city', 'City', 'city_setting', __FILE__, 'contact_settings');    
    add_settings_field('province', 'Province', 'province_setting', __FILE__, 'contact_settings');    
    add_settings_field('postal_code', 'Postal Code', 'postal_code_setting', __FILE__, 'contact_settings');    
    add_settings_field('phone', 'Phone Number', 'phone_setting', __FILE__, 'contact_settings');    
    add_settings_field('fax', 'Fax Number', 'fax_setting', __FILE__, 'contact_settings');    
    add_settings_field('email', 'Email', 'email_setting', __FILE__, 'contact_settings');    
    
    add_settings_section('social_media_settings', 'Social Media', 'section_smedia', __FILE__);
    
    function section_smedia() {

    }
    
    add_settings_field('twitter_link', 'Twitter Account Link', 'twitter_link_setting', __FILE__, 'social_media_settings');
    add_settings_field('facebook_link', 'Facebook Account Link', 'facebook_link_setting', __FILE__, 'social_media_settings');
    add_settings_field('linkedin_link', 'LinkedIn Account Link', 'linkedin_link_setting', __FILE__, 'social_media_settings');
    add_settings_field('youtube_link', 'YouTube Account Link', 'youtube_link_setting', __FILE__, 'social_media_settings');
    add_settings_field('instagram_link', 'Instagram Account Link', 'instagram_link_setting', __FILE__, 'social_media_settings');
}

function validate_setting($j2dk_custom_theme_options) {
    return $j2dk_custom_theme_options;
}    

function devmode_setting() {
    global $j2dk_custom_theme_options;
    $checked = ($j2dk_custom_theme_options['devmode']) ? 'checked' : '';        
    echo "<input name='j2dk_custom_theme_options[devmode]' id='j2dk_custom_theme_options[devmode]' type='checkbox' value='{$j2dk_custom_theme_options['devmode']}' {$checked} /> <label for='j2dk_custom_theme_options[devmode]'>Yes</label>";
}

function about_excerpt_setting() {
    global $j2dk_custom_theme_options;
    echo "<textarea name='j2dk_custom_theme_options[about_excerpt]'>{$j2dk_custom_theme_options['about_excerpt']}</textarea><br /><small>A short excerpt that will be used as description of the website.</small>";
}    

function twitter_link_setting() {
    global $j2dk_custom_theme_options;
    echo "<input name='j2dk_custom_theme_options[twitter_link]' type='text' value='{$j2dk_custom_theme_options['twitter_link']}' /><br /><small>Link pointing to your Twitter account.</small>";
}

function facebook_link_setting() {
    global $j2dk_custom_theme_options;
    echo "<input name='j2dk_custom_theme_options[facebook_link]' type='text' value='{$j2dk_custom_theme_options['facebook_link']}' /><br /><small>Link pointing to your Facebook account.</small>";
}    

function linkedin_link_setting() {
    global $j2dk_custom_theme_options;
    echo "<input name='j2dk_custom_theme_options[linkedin_link]' type='text' value='{$j2dk_custom_theme_options['linkedin_link']}' /><br /><small>Link pointing to your LinkedIn account.</small>";
}    

function youtube_link_setting() {
    global $j2dk_custom_theme_options;
    echo "<input name='j2dk_custom_theme_options[youtube_link]' type='text' value='{$j2dk_custom_theme_options['youtube_link']}' /><br /><small>Link pointing to your YouTube account.</small>";
}    

function instagram_link_setting() {
    global $j2dk_custom_theme_options;
    echo "<input name='j2dk_custom_theme_options[instagram_link]' type='text' value='{$j2dk_custom_theme_options['instagram_link']}' /><br /><small>Link pointing to your Instagram account.</small>";
}    

function address_setting() {
    global $j2dk_custom_theme_options;
    echo "<input name='j2dk_custom_theme_options[address]' type='text' value='{$j2dk_custom_theme_options['address']}' /><br /><small>Street Address</small>";
}   

function city_setting() {
    global $j2dk_custom_theme_options;
    echo "<input name='j2dk_custom_theme_options[city]' type='text' value='{$j2dk_custom_theme_options['city']}' />";
}   

function province_setting() {
    global $j2dk_custom_theme_options;
    echo "<input name='j2dk_custom_theme_options[province]' type='text' value='{$j2dk_custom_theme_options['province']}' />";
}   

function postal_code_setting() {
    global $j2dk_custom_theme_options;
    echo "<input name='j2dk_custom_theme_options[postal_code]' type='text' value='{$j2dk_custom_theme_options['postal_code']}' />";
}   

function phone_setting() {
    global $j2dk_custom_theme_options;
    echo "<input name='j2dk_custom_theme_options[phone]' type='text' value='{$j2dk_custom_theme_options['phone']}' />";
}   

function fax_setting() {
    global $j2dk_custom_theme_options;
    echo "<input name='j2dk_custom_theme_options[fax]' type='text' value='{$j2dk_custom_theme_options['fax']}' />";
}   

function email_setting() {
    global $j2dk_custom_theme_options;
    echo "<input name='j2dk_custom_theme_options[email]' type='text' value='{$j2dk_custom_theme_options['email']}' />";
}   

/*
function home_page_add_meta_box($post) {
    if( $post->ID == 71 ){
        add_meta_box( 'evermore_home_page_gallery', 'Home Page Galleries', 'print_homepage_gallery_metabox', 'page', 'normal' );
    }
}
add_action( 'add_meta_boxes_page', 'home_page_add_meta_box' );


function print_homepage_gallery_metabox(){
    global $wpdb;
    
    //get all galleries from database
    $allGalleries = $wpdb->get_results( 
            "SELECT * FROM wp_ngg_gallery"
            , ARRAY_A );
    //echo '$allGalleries is '.print_r($allGalleries, true);
?>
<script type="text/javascript">
function removeHomePageGalleryItem(listItemNumber){    
    jQuery('#evermore-home-page-gallery-table #home-page-gallery-item-'+listItemNumber).remove();
    //change the names of each
    var counter = 1;
    jQuery('#evermore-home-page-gallery-table .home-page-gallery-item').each( function(index, element){
        var currentId = this.id;
        jQuery('#'+currentId+' .home-page-gallery-items').attr('id', 'home-page-gallery-item-'+counter);
        
        jQuery('#'+currentId+' .gallery_labels').attr('for', 'gallery_label_'+counter);
        jQuery('#'+currentId+' .home_page_gallery_labels').attr('name', 'gallery['+counter+'][label]');
        jQuery('#'+currentId+' .gallery_labels').attr('id', 'home_page_gallery_label_'+counter);
        
        jQuery('#'+currentId+' .gallery_id_labels').attr('for', 'home_page_gallery_id_'+counter);
        jQuery('#'+currentId+' select.home_page_gallery_ids').attr('name', 'gallery['+counter+'][id]');
        jQuery('#'+currentId+' select.home_page_gallery_ids').attr('id', 'home_page_gallery_id_'+counter);
                
        $(this).attr('id', 'home-page-gallery-item-'+counter);
        counter++;
    });
}
function addHomePageGalleryItem(){
    //get the number of current items
    var totalItems = jQuery('#evermore-home-page-gallery-table .home-page-gallery-items').length;    
    var nextItemNumber = totalItems+1;
    jQuery('#evermore-home-page-gallery-table').append('    <tr class="home-page-gallery-items" id="home-page-gallery-item-'+nextItemNumber+'"></tr>');
    
    jQuery('#evermore-home-page-gallery-table #home-page-gallery-item-'+nextItemNumber).append('        <th><label class="gallery_labels" for="gallery_label_'+nextItemNumber+'">Tab Label</label> <input  class="home_page_gallery_labels" type="text" name="gallery['+nextItemNumber+'][label]" id="home_page_gallery_label_'+nextItemNumber+'" value="" /></th>');
    jQuery('#evermore-home-page-gallery-table #home-page-gallery-item-'+nextItemNumber).append('        <td><label class="gallery_id_labels" for="home_page_gallery_id_'+nextItemNumber+'">Select Gallery</label></td>');
    jQuery('#evermore-home-page-gallery-table #home_page_gallery_id_1').clone().appendTo(jQuery('#evermore-home-page-gallery-table #home-page-gallery-item-'+nextItemNumber+' td') );
    jQuery('#evermore-home-page-gallery-table #home-page-gallery-item-'+nextItemNumber+' td select').attr('name', 'gallery['+nextItemNumber+'][id]');
    jQuery('#evermore-home-page-gallery-table #home-page-gallery-item-'+nextItemNumber+' td select').attr('id', 'home_page_gallery_id_'+nextItemNumber);
    jQuery('#evermore-home-page-gallery-table #home-page-gallery-item-'+nextItemNumber).append('<td><input type="button" onclick="removeHomePageGalleryItem('+nextItemNumber+');" value="Remove" /></td>');
    
    if( nextItemNumber >= 5 ){
        jQuery('#home_page_gallery_add_item').hide();
    }
}
</script>
<p>Select the galleries you would like to add to the homepage. You can add up to 5 galleries.</p>
<?php
$homePageGalleries = json_decode(get_post_meta( 71, 'home_page_galleries', true ), true);
?>
<table id="evermore-home-page-gallery-table">
    <?php
    $galleryCounter = 1;
    foreach($homePageGalleries as $currentGallerySaved){
    ?>
    <tr class="home-page-gallery-items" id="home-page-gallery-item-<?php echo $galleryCounter; ?>">
        <th>
            <label class="gallery_labels" for="gallery_label_<?php echo $galleryCounter; ?>">Tab Label</label> <input  class="home_page_gallery_labels" type="text" name="gallery[<?php echo $galleryCounter; ?>][label]" id="home_page_gallery_label_<?php echo $galleryCounter; ?>" value="<?php echo $currentGallerySaved['label']; ?>" />
        </th>
        <td>
            <label class="gallery_id_labels" for="home_page_gallery_id_<?php echo $galleryCounter; ?>">Select Gallery</label>
            <select class="home_page_gallery_ids" id="home_page_gallery_id_<?php echo $galleryCounter; ?>" name="gallery[<?php echo $galleryCounter; ?>][id]" class="home_page_gallery_ids">
                <?php
                foreach($allGalleries as $currentGallery){
                    echo '<option value="'.$currentGallery['gid'].'"';
                    if( $currentGallery['gid'] == $currentGallerySaved['id'] ){
                        echo ' selected="selected" ';
                    }
                    echo '>'.$currentGallery['title'].'</option>';
                }
                ?>        
            </select>            
        </td>
        <td><input type="button" onclick="removeHomePageGalleryItem(<?php echo $galleryCounter; ?>);" value="Remove" /></td>
    </tr>    
    <?php
        $galleryCounter++;
    }
    ?>   
</table>
<input type="button" id="home_page_gallery_add_item" value="Add another gallery" onclick="addHomePageGalleryItem();"/>
<?php
}

add_action( 'save_post', 'save_homepage_galleries' );

function save_homepage_galleries($postId){
    $homePageGalleries = array();
    if( $postId == 71 && isset($_POST['gallery']) ){
        $galleryCounter = 0;
        foreach($_POST['gallery'] as $currentGallery){
            $homePageGalleries[$galleryCounter]['label'] = $currentGallery['label'];
            $homePageGalleries[$galleryCounter]['id'] = $currentGallery['id'];
            $galleryCounter++;
        }
        if( count($homePageGalleries) > 0 ){
            update_post_meta($postId, 'home_page_galleries', json_encode($homePageGalleries) );
        }
        
    }
}

function my_dequeue_styles() {
	wp_dequeue_style( 'gctwidgetstyles' );
}
add_action( 'wp_enqueue_scripts', 'my_dequeue_styles', 99 );
 * 
 */
?>