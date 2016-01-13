<?php
/**
 * Super Forms Email Template 1
 *
 * @package   Super Forms Email Template 1
 * @author    feeling4design
 * @link      http://codecanyon.net/item/super-forms-drag-drop-form-builder/13979866
 * @copyright 2015 by feeling4design
 *
 * @wordpress-plugin
 * Plugin Name: Super Forms Email Template 1
 * Plugin URI:  http://codecanyon.net/item/super-forms-drag-drop-form-builder/13979866
 * Description: Adds an extra email template to choose frome
 * Version:     1.0.0
 * Author:      feeling4design
 * Author URI:  http://codecanyon.net/user/feeling4design
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( !class_exists( 'SUPER_Email_Template_1' ) ) :


    /**
     * Main SUPER_Email_Template_1 Class
     *
     * @class SUPER_Email_Template_1
     * @version	1.0.0
     */
    final class SUPER_Email_Template_1 {
    
        
        /**
         * @var string
         *
         *	@since		1.0.0
        */
        public $version = '1.0.0';

        
        /**
         * @var SUPER_Email_Template_1 The single instance of the class
         *
         *	@since		1.0.0
        */
        protected static $_instance = null;

        
        /**
         * Contains an array of registered script handles
         *
         * @var array
         *
         *	@since		1.0.0
        */
        private static $scripts = array();
        
        
        /**
         * Contains an array of localized script handles
         *
         * @var array
         *
         *	@since		1.0.0
        */
        private static $wp_localize_scripts = array();
        
        
        /**
         * Main SUPER_Email_Template_1 Instance
         *
         * Ensures only one instance of SUPER_Email_Template_1 is loaded or can be loaded.
         *
         * @static
         * @see SUPER_Email_Template_1()
         * @return SUPER_Email_Template_1 - Main instance
         *
         *	@since		1.0.0
        */
        public static function instance() {
            if(is_null( self::$_instance)){
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        
        /**
         * SUPER_Email_Template_1 Constructor.
         *
         *	@since		1.0.0
        */
        public function __construct(){
            $this->init_hooks();
            do_action('super_email_template_one_loaded');
        }

        
        /**
         * Define constant if not already set
         *
         * @param  string $name
         * @param  string|bool $value
         *
         *	@since		1.0.0
        */
        private function define($name, $value){
            if(!defined($name)){
                define($name, $value);
            }
        }

        
        /**
         * What type of request is this?
         *
         * string $type ajax, frontend or admin
         * @return bool
         *
         *	@since		1.0.0
        */
        private function is_request($type){
            switch ($type){
                case 'admin' :
                    return is_admin();
                case 'ajax' :
                    return defined( 'DOING_AJAX' );
                case 'cron' :
                    return defined( 'DOING_CRON' );
                case 'frontend' :
                    return (!is_admin() || defined('DOING_AJAX')) && ! defined('DOING_CRON');
            }
        }

        
        /**
         * Hook into actions and filters
         *
         *	@since		1.0.0
        */
        private function init_hooks() {
            
            // Filters since 1.0.0

            // Actions since 1.0.0
            
            if ( $this->is_request( 'frontend' ) ) {
                
                // Filters since 1.0.0

                // Actions since 1.0.0

            }
            
            if ( $this->is_request( 'admin' ) ) {
                
                // Filters since 1.0.0
                add_filter( 'super_settings_after_email_template_filter', array( $this, 'add_settings' ), 10, 2 );
                add_filter( 'super_before_sending_email_body_filter', array( $this, 'create_new_body' ), 50, 2 );
                add_filter( 'super_before_sending_confirm_body_filter', array( $this, 'create_new_confirm_body' ), 50, 2 );

                // Actions since 1.0.0

            }
            
            if ( $this->is_request( 'ajax' ) ) {

                // Filters since 1.0.0

                // Actions since 1.0.0

            }
            
        }

        
        /**
         * Hook into outputting the message and make sure to add the resend activation javascript
         *
         *  @since      1.0.0
        */
        public static function resend_activation_code_script( $data ) {
            $settings = get_option( 'super_settings' );
            $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
            $handle = 'super-register-common';
            $name = str_replace( '-', '_', $handle ) . '_i18n';
            wp_register_script( $handle, plugin_dir_url( __FILE__ ) . 'assets/js/frontend/common' . $suffix . '.js', array( 'jquery' ), '1.0', false );  
            wp_localize_script( $handle, $name, array( 'ajaxurl'=>SUPER_Forms()->ajax_url(), 'duration'=>absint( $settings['form_duration'] ) ) );
            wp_enqueue_script( $handle );
        }


        /**
         * Hook into the load form dropdown and add some ready to use forms
         *
         *  @since      1.0.0
        */
        public static function add_ready_to_use_forms() {
            $html  = '<option value="register-login-register">Register & Login - Registration form</option>';
            $html .= '<option value="register-login-login">Register & Login - Login form</option>';
            $html .= '<option value="register-login-password">Register & Login - Lost password form</option>';
            echo $html;
        }


        /**
         * Hook into the after load form dropdown and add the json of the ready to use forms
         *
         *  @since      1.0.0
        */
        public static function add_ready_to_use_forms_json() {
            $html  = '<textarea hidden name="register-login-register">';
            $html .= '[{"tag":"text","group":"form_elements","inner":"","data":{"name":"user_login","email":"Username","label":"","description":"","placeholder":"Username","tooltip":"","validation":"empty","error":"","grouped":"0","maxlength":"0","minlength":"0","width":"0","exclude":"0","error_position":"","icon_position":"outside","icon_align":"left","icon":"user","conditional_action":"disabled","conditional_trigger":"all","conditional_items":[{"field":"username","logic":"contains","value":""}]}},{"tag":"text","group":"form_elements","inner":"","data":{"name":"user_email","email":"Email","label":"","description":"","placeholder":"Email","tooltip":"","validation":"email","error":"","grouped":"0","maxlength":"0","minlength":"0","width":"0","exclude":"0","error_position":"","icon_position":"outside","icon_align":"left","icon":"envelope","conditional_action":"disabled","conditional_trigger":"all","conditional_items":[{"field":"user_login","logic":"contains","value":""}]}}]';
            $html .= '</textarea>';

            $html .= '<textarea hidden name="register-login-login">';
            $html .= '[{"tag":"column","group":"layout_elements","inner":[{"tag":"text","group":"form_elements","inner":"","data":{"name":"user_login","email":"Username","label":"","description":"","placeholder":"Username","tooltip":"","validation":"empty","error":"","grouped":"0","maxlength":"0","minlength":"0","width":"0","exclude":"0","error_position":"","icon_position":"outside","icon_align":"left","icon":"user","conditional_action":"disabled","conditional_trigger":"all","conditional_items":[{"field":"name","logic":"contains","value":""}]}}],"data":{"size":"1/1","margin":"","conditional_action":"disabled"}},{"tag":"column","group":"layout_elements","inner":[{"tag":"password","group":"form_elements","inner":"","data":{"name":"user_pass","email":"Password","label":"","description":"","placeholder":"Password","tooltip":"","validation":"empty","error":"","grouped":"0","maxlength":"0","minlength":"0","width":"0","exclude":"0","error_position":"","icon_position":"outside","icon_align":"left","icon":"lock","conditional_action":"disabled","conditional_trigger":"all","conditional_items":[{"field":"user_login","logic":"contains","value":""}]}}],"data":{"size":"1/1","margin":"","conditional_action":"disabled"}},{"tag":"column","group":"layout_elements","inner":[{"tag":"activation_code","group":"form_elements","inner":"","data":{"label":"","description":"","placeholder":"[-CODE-]","tooltip":"","grouped":"0","width":"150","exclude":"0","error_position":"","icon_position":"outside","icon_align":"left","icon":"code","conditional_action":"disabled","conditional_trigger":"all","conditional_items":[{"field":"user_login","logic":"contains","value":""}]}}],"data":{"size":"1/1","margin":"","conditional_action":"disabled"}},{"tag":"html","group":"form_elements","inner":"","data":{"title":"","subtitle":"","html":"<a style=\"display:block;float:right;\" href=\"http://f4d.nl/dev/lost-password/\">Lost Password?</a>","conditional_action":"disabled","conditional_trigger":"all","conditional_items":[{"field":"user_login","logic":"contains","value":""}]}}]';
            $html .= '</textarea>';

            $html .= '<textarea hidden name="register-login-password">';
            $html .= '[{"tag":"text","group":"form_elements","inner":"","data":{"name":"user_email","email":"Email","label":"","description":"","placeholder":"Email address","tooltip":"","validation":"email","error":"Please enter a valid email address!","grouped":"0","maxlength":"0","minlength":"0","width":"0","exclude":"0","error_position":"","icon_position":"outside","icon_align":"left","icon":"envelope","conditional_action":"disabled","conditional_trigger":"all","conditional_items":[{"field":"login_email","logic":"contains","value":""}]}},{"tag":"html","group":"form_elements","inner":"","data":{"title":"","subtitle":"","html":"<a style=\"display:block;float:right;\" href=\"http://f4d.nl/dev/login/\">Return to login page</a>","conditional_action":"disabled","conditional_trigger":"all","conditional_items":[{"field":"user_email","logic":"contains","value":""}]}}]';
            $html .= '</textarea>';
            echo $html;
        }


        /**
         * Hook into the default email tags and add extra tags that can be used in our Activation email
         *
         *  @since      1.0.0
        */
        public static function add_email_tags( $tags ) {
            $tags['register_login_url'] = array(
                __( 'Retrieves the login page URL', 'super' ),
                ''
            );
            $tags['register_activation_code'] = array(
                __( 'Retrieves the activation code', 'super' ),
                ''
            );
            $tags['register_generated_password'] = array(
                __( 'Retrieves the generated password', 'super' ),
                ''
            );
            return $tags;
        }


        /**
         * Handle the Activation Code element output
         *
         *  @since      1.0.0
        */
        public static function activation_code( $tag, $atts ) {
            
            $return = false;
            if( ( SUPER_Forms::is_request( 'frontend' ) ) && ( isset( $_GET['code'] ) ) ) {
                $code = sanitize_text_field( $_GET['code'] );
                $return = true;
            }
            if ( SUPER_Forms::is_request( 'admin' ) ) {
                $code = '';
                $return = true;
            }
            if( $return==true ) {
                $atts['name'] = 'activation_code';
                $result = SUPER_Shortcodes::opening_tag( $tag, $atts );
                $result .= SUPER_Shortcodes::opening_wrapper( $atts );
                $result .= '<input class="super-shortcode-field" type="text"';
                $result .= ' name="' . $atts['name'] . '" value="' . $code . '"';
                $result .= SUPER_Shortcodes::common_attributes( $atts, $tag );
                $result .= ' />';
                $result .= '</div>';
                $result .= SUPER_Shortcodes::loop_conditions( $atts );
                $result .= '</div>';
                return $result;
            }

        }


        /**
         * Hook into elements and add Activation Code element
         * This element will show the activation code input field when it has been set in the URL parameter
         *
         *  @since      1.0.0
        */
        public static function add_activation_code_element( $array, $attributes ) {

            // Include the predefined arrays
            require(SUPER_PLUGIN_DIR.'/includes/shortcodes/predefined-arrays.php' );

            $array['form_elements']['shortcodes']['activation_code'] = array(
                'callback' => 'SUPER_Email_Template_1::activation_code',
                'name' => __( 'Activation Code', 'super' ),
                'icon' => 'code',
                'atts' => array(
                    'general' => array(
                        'name' => __( 'General', 'super' ),
                        'fields' => array(
                            'label' => $label,
                            'description'=> $description,
                            'placeholder' => SUPER_Shortcodes::placeholder( $attributes, '[-CODE-]' ),
                            'tooltip' => $tooltip,
                        )
                    ),
                    'advanced' => array(
                        'name' => __( 'Advanced', 'super' ),
                        'fields' => array(
                            'grouped' => $grouped,                    
                            'width' => $width,
                            'exclude' => $exclude, 
                            'error_position' => $error_position_left_only,
                        ),
                    ),
                    'icon' => array(
                        'name' => __( 'Icon', 'super' ),
                        'fields' => array(
                            'icon_position' => $icon_position,
                            'icon_align' => $icon_align,
                            'icon' => SUPER_Shortcodes::icon( $attributes, 'code' ),
                        ),
                    ),
                    'conditional_logic' => $conditional_logic_array
                ),
            );
            return $array;
        }


        /**
         * Hook into settings and add Register & Login settings
         *
         *  @since      1.0.0
        */
        public static function add_settings( $array, $settings ) {
			$array['email_template']['fields']['email_template']['values']['email_template_1'] = __( 'Email Template 1', 'super' );
			$new_fields = array(
	        	'email_template_1_logo' => array(
	                'name' => __( 'Email logo', 'super' ),
	                'desc' => __( 'Upload a logo to use for this email template', 'super' ),
	                'default' => SUPER_Settings::get_value( 0, 'email_template_1_logo', $settings['settings'], '' ),
	                'type' => 'image',
	                'filter' => true,
	                'parent' => 'email_template',
	                'filter_value' => 'email_template_1', 
	            ),
	            'email_template_1_title' => array(
	                'name' => __( 'Email title', 'super' ),
	                'desc' => __( 'A title to display below your logo', 'super' ),
	                'default' => SUPER_Settings::get_value( 0, 'email_template_1_title', $settings['settings'], __( 'Your title', 'super' ) ),
	                'filter' => true,
	                'parent' => 'email_template',
	                'filter_value' => 'email_template_1', 
            	),
            	'email_template_1_confirm_title' => array(
	                'name' => __( 'Email title (confirm)', 'super' ),
	                'desc' => __( 'A title to display below your logo (used for confirmation emails)', 'super' ),
	                'default' => SUPER_Settings::get_value( 0, 'email_template_1_confirm_title', $settings['settings'], __( 'Your title', 'super' ) ),
	                'filter' => true,
	                'parent' => 'email_template',
	                'filter_value' => 'email_template_1', 
	            ),
	            'email_template_1_subtitle' => array(
	                'name' => __( 'Email subtitle', 'super' ),
	                'desc' => __( 'A subtitle to display before the email body (content)', 'super' ),
	                'default' => SUPER_Settings::get_value( 0, 'email_template_1_subtitle', $settings['settings'], __( 'Your subtitle', 'super' ) ),
	                'filter' => true,
	                'parent' => 'email_template',
	                'filter_value' => 'email_template_1', 
	            ),
	            'email_template_1_confirm_subtitle' => array(
	                'name' => __( 'Email subtitle (confirm)', 'super' ),
	                'desc' => __( 'A subtitle to display before the email body (used for confirmation emails)', 'super' ),
	                'default' => SUPER_Settings::get_value( 0, 'email_template_1_confirm_subtitle', $settings['settings'], __( 'Your subtitle', 'super' ) ),
	                'filter' => true,
	                'parent' => 'email_template',
	                'filter_value' => 'email_template_1', 
	            ),
	            'email_template_1_copyright' => array(
	                'name' => __( 'Email copyright', 'super' ),
	                'desc' => __( 'Enter anything you like for the copyright section', 'super' ),
	                'default' => SUPER_Settings::get_value( 0, 'email_template_1_copyright', $settings['settings'], __( '&copy; Someone, somewhere 2016', 'super' ) ),
	                'placeholder' => __( '&copy; Someone, somewhere 2015', 'super' ),
	                'type' => 'textarea',
	                'filter' => true,
	                'parent' => 'email_template',
	                'filter_value' => 'email_template_1',
	            ),
	            'email_template_1_socials' => array(
	                'name' => __( 'Email social icons', 'super' ),
	                'desc' => __( 'Put each social icon on a new line', 'super' ),
	                'default' => SUPER_Settings::get_value( 0, 'email_template_1_socials', $settings['settings'], 'http://twitter.com/company|url_to_social_icon' ),
	                'placeholder' =>  'http://twitter.com/company|url_to_social_icon',
	                'type' => 'textarea',
	                'filter' => true,
	                'parent' => 'email_template',
	                'filter_value' => 'email_template_1',
	            ),
	            'email_template_1_header_colors' => array(
	                'name' => __( 'Header colors', 'super' ),
	                'type' => 'multicolor', 
	                'colors' => array(
	                    'email_template_1_header_bg_color' => array(
	                        'label' => 'Header background color',
	                		'default' => SUPER_Settings::get_value( 0, 'email_template_1_header_bg_color', $settings['settings'], '#5ba1d3' ),
	                    ),
	                    'email_template_1_header_title_color' => array(
	                        'label' => 'Header title color',
	                		'default' => SUPER_Settings::get_value( 0, 'email_template_1_header_title_color', $settings['settings'], '#ffffff' ),
	                    ),
	                ),
	                'filter' => true,
	                'parent' => 'email_template',
	                'filter_value' => 'email_template_1',
	            ),
	            'email_template_1_body_colors' => array(
	                'name' => __( 'Body colors', 'super' ),
	                'type' => 'multicolor', 
	                'colors' => array(
	                    'email_template_1_body_bg_color' => array(
	                        'label' => 'Body background color',
	                		'default' => SUPER_Settings::get_value( 0, 'email_template_1_body_bg_color', $settings['settings'], '#ffffff' ),
	                    ),
	                    'email_template_1_body_subtitle_color' => array(
	                        'label' => 'Body subtitle color',
	                		'default' => SUPER_Settings::get_value( 0, 'email_template_1_body_subtitle_color', $settings['settings'], '#474747' ),
	                    ),
	                    'email_template_1_body_font_color' => array(
	                        'label' => 'Body font color',
	                		'default' => SUPER_Settings::get_value( 0, 'email_template_1_body_font_color', $settings['settings'], '#9e9e9e' ),
	                    ),            
	                ),
	                'filter' => true,
	                'parent' => 'email_template',
	                'filter_value' => 'email_template_1',
	            ),    
	            'email_template_1_footer_colors' => array(
	                'name' => __( 'Footer colors', 'super' ),
	                'type' => 'multicolor', 
	                'colors' => array(
	                    'email_template_1_footer_bg_color' => array(
	                        'label' => 'Footer background color',
	                		'default' => SUPER_Settings::get_value( 0, 'email_template_1_footer_bg_color', $settings['settings'], '#ee4c50' ),
	                    ),
	                    'email_template_1_footer_font_color' => array(
	                        'label' => 'Footer font color',
	                		'default' => SUPER_Settings::get_value( 0, 'email_template_1_footer_font_color', $settings['settings'], '#ffffff' ),
	                    ),
	                ),
	                'filter' => true,
	                'parent' => 'email_template',
	                'filter_value' => 'email_template_1',
	            )
			);
	        $new_array = array_merge( $array['email_template']['fields'], $new_fields );
			$array['email_template']['fields'] = $new_array;
			return $array;
        }


        /**
         * Hook into email body html before sending email
         */
        public function create_new_body( $email_body, $attr ) {
            return self::body_html( $email_body, $attr, 'admin' );
        }

        /**
         * Hook into confirm body html before sending email
         */
        public function create_new_confirm_body( $email_body, $attr ) {
            return self::body_html( $email_body, $attr, 'confirm' );
        }


        /**
         * Create the new email with the email body
         *
         * @param  string $email_body
         * @param  array $attr
         * @param  string $type
         *
         *  @since      1.0.0
        */
        public function body_html( $email_body, $attr, $type='admin' ) {
            
            if( $attr['settings']['email_template']!='email_template_1' ) {
                return $email_body;   
            }
            $settings_prefix = 'email_template_1_';
            $header_bg_color = $attr['settings'][$settings_prefix.'header_bg_color'];
            $header_title_color = $attr['settings'][$settings_prefix.'header_title_color'];
            $header_logo = $attr['settings'][$settings_prefix.'logo'];
            $body_bg_color = $attr['settings'][$settings_prefix.'body_bg_color'];
            $body_subtitle_color = $attr['settings'][$settings_prefix.'body_subtitle_color'];
            $body_font_color = $attr['settings'][$settings_prefix.'body_font_color'];
            $footer_bg_color = $attr['settings'][$settings_prefix.'footer_bg_color'];
            $footer_font_color = $attr['settings'][$settings_prefix.'footer_font_color'];
            $footer_socials = $attr['settings'][$settings_prefix.'socials'];
            $footer_copyright = SUPER_Common::email_tags( $attr['settings'][$settings_prefix.'copyright'], $attr['data'] );
            if($type=='confirm'){
                $settings_prefix = 'email_template_1_confirm_';
            }
            $header_title = SUPER_Common::email_tags( $attr['settings'][$settings_prefix.'title'], $attr['data'] );
            $body_subtitle = SUPER_Common::email_tags( $attr['settings'][$settings_prefix.'subtitle'], $attr['data'] );
            $old_email_body = $email_body;
            $email_body  = '<body style="margin: 0; padding: 0;">';
            $email_body .= '<table border="0" cellpadding="0" cellspacing="0" width="100%">';
            $email_body .= '<tr>';
            $email_body .= '<td style="padding: 10px 0 30px 0;">';
            $email_body .= '<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">';
            $email_body .= '<tr>';
            $email_body .= '<td align="center" bgcolor="'.$header_bg_color.'" style="padding: 40px 0 30px 0; color: '.$header_title_color.'; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">';
            $logo = wp_get_attachment_image_src($header_logo, 'full' );
            $logo = !empty( $logo[0] ) ? $logo[0] : '';
            if( !empty( $logo ) ) {
                $email_body .= '<img src="'.$logo.'" alt="'.$header_title.'" style="padding: 0px 0 30px 0;display: block;" />';
                $email_body .= $header_title;
            }else{
                $email_body .= $header_title;
            }
            $email_body .= '</td>';
            $email_body .= '</tr>';
            $email_body .= '<tr>';
            $email_body .= '<td bgcolor="'.$body_bg_color.'" style="padding: 40px 30px 40px 30px;">';
            $email_body .= '<table border="0" cellpadding="0" cellspacing="0" width="100%">';
            $email_body .= '<tr>';
            $email_body .= '<td style="color: '.$body_subtitle_color.'; font-family: Arial, sans-serif; font-size: 24px;">';
            $email_body .= '<b>'.$body_subtitle.'</b>';
            $email_body .= '</td>';
            $email_body .= '</tr>';
            $email_body .= '<tr>';
            $email_body .= '<td style="padding: 20px 0 0 0; color: '.$body_font_color.'; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">';
            $email_body .= $old_email_body;
            $email_body .= '</td>';
            $email_body .= '</tr>';
            $email_body .= '</table>';
            $email_body .= '</td>';
            $email_body .= '</tr>';
            $email_body .= '<tr>';
            $email_body .= '<td bgcolor="'.$footer_bg_color.'" style="padding: 30px 30px 30px 30px;">';
            $email_body .= '<table border="0" cellpadding="0" cellspacing="0" width="100%">';
            $email_body .= '<tr>';
            $email_body .= '<td style="color:'.$footer_font_color.'; font-family: Arial, sans-serif; font-size: 14px;" width="75%">';
            $email_body .= nl2br($footer_copyright);
            $email_body .= '</td>';
            $email_body .= '<td align="right" width="25%">';
            if( $footer_socials!='' ) {
            	$email_body .= '<table border="0" cellpadding="0" cellspacing="0">';
            	$email_body .= '<tr>';
            	$socials = explode( "\n", $footer_socials );
				foreach( $socials as $v ) {
	                $exploded = explode('|', $v);
	                if( ( $exploded[0]!='' ) && ( $exploded[1]!='' ) ) {
		                $email_body .= '<td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">';
		                    $email_body .= '<a href="' . $exploded[0] . '" target="_blank" style="color:#ffffff;">';
		                        $email_body .= '<img src="' . $exploded[1] . '" alt="Facebook" style="padding-left:5px;display: block;" border="0" />';
		                    $email_body .= '</a>';
		                $email_body .= '</td>';
	            	}
				}
	            $email_body .= '</tr>';
	            $email_body .= '</table>';
        	}
            $email_body .= '</td>';
            $email_body .= '</tr>';
            $email_body .= '</table>';
            $email_body .= '</td>';
            $email_body .= '</tr>';
            $email_body .= '</table>';
            $email_body .= '</td>';
            $email_body .= '</tr>';
            $email_body .= '</table>';
            return $email_body;
        }


        /**
         * Hook into before sending email and check if we need to register or login a user
         *
         * @param  array $atts
         *
         *  @since      1.0.0
        */
        public static function before_sending_email( $atts ) {
            $data = $atts['post']['data'];
            $settings = $atts['settings'];
            
            if( !isset( $settings['register_login_action'] ) ) return true;
            if( $settings['register_login_action']=='none' ) return true;

            if( $settings['register_login_action']=='register' ) {

                // Before we proceed, lets check if we have at least a user_login and user_email field
                if( ( !isset( $data['user_login'] ) ) && ( !isset( $data['user_email'] ) ) ) {
                    $msg = __( 'We couldn\'t find the <strong>user_login</strong> and <strong>user_email</strong> fields which are required in order to register a new user. Please <a href="' . get_admin_url() . 'admin.php?page=super_create_form&id=' . absint( $atts['post']['form_id'] ) . '">edit</a> your form and try again', 'super' );
                    SUPER_Common::output_error(
                        $error = true,
                        $msg = $msg,
                        $redirect = null
                    );
                }

                // Now lets check if a user already exists with the same user_login or user_email
                $user_login = sanitize_user( $data['user_login']['value'] );
                $user_email = sanitize_email( $data['user_email']['value'] );
                $username_exists = username_exists($user_login);
                $email_exists = email_exists($user_email);        
                if( ( $username_exists!=false ) || ( $email_exists!=false ) ) {
                    $msg = __( 'Username or Email address already exists, please try again', 'super' );
                    $_SESSION['super_msg'] = array( 'msg'=>$msg, 'type'=>'error' );
                    SUPER_Common::output_error(
                        $error = true,
                        $msg = $msg,
                        $redirect = null,
                        $fields = array(
                            'user_login' => 'input',
                            'user_pass' => 'input'
                        )
                    );
                }

                // If user_pass field doesn't exist, we can generate one and send it by email to the registered user
                $send_password = false;
                if( !isset( $data['user_pass'] ) ) {
                    $send_password = true;
                    $password = wp_generate_password();
                }else{
                    $password = $data['user_pass']['value'];
                }

                // Lets gather all data that we need to insert for this user
                $userdata = array();
                $userdata['user_login'] = $user_login;
                $userdata['user_email'] = $user_email;
                $userdata['user_pass'] = $password;
                $userdata['role'] = $settings['register_user_role'];
                $userdata['user_registered'] = date('Y-m-d H:i:s');
                $userdata['show_admin_bar_front'] = 'false';

                // Also loop through some of the other default user data that WordPress provides us with out of the box
                $other_userdata = array(
                    'user_nicename',
                    'user_url',
                    'display_name',
                    'nickname',
                    'first_name',
                    'last_name',
                    'description',
                    'rich_editing',
                    'role', // This is in case we have a custom dropdown with the name "role" which allows users to select their own account type/role
                    'jabber',
                    'aim',
                    'yim'
                );
                foreach( $other_userdata as $k ) {
                    if( isset( $data[$k]['value'] ) ) {
                        $userdata[$k] = $data[$k]['value'];
                    }
                }

                // Insert the user and return the user ID
                $user_id = wp_insert_user( $userdata );
                if( is_wp_error( $user_id ) ) {
                    $msg = __( 'Something went wrong while registering your acount, please try again', 'super' );
                    $_SESSION['super_msg'] = array( 'msg'=>$msg, 'type'=>'error' );
                    SUPER_Common::output_error(
                        $error = true,
                        $msg = $msg,
                        $redirect = null
                    );
                }

                // Save custom user meta
                $meta_data = array();
                $custom_user_meta = explode( "\n", $settings['register_login_user_meta'] );
                foreach( $custom_user_meta as $k ) {
                    $field = explode( "|", $k );
                    if( isset( $data[$field[0]]['value'] ) ) {
                        $meta_data[$field[1]] = $data[$field[0]]['value'];
                    }
                }
                foreach( $meta_data as $k => $v ) {
                    update_user_meta( $user_id, $k, $v ); 
                }

                // Check if we need to send an activation email to this user
                if( $settings['register_login_activation']=='verify' ) {
                    $code = wp_generate_password( 8, false );
                    update_user_meta( $user_id, 'super_account_status', 0 ); // 0 = inactive, 1 = active
                    update_user_meta( $user_id, 'super_account_activation', $code ); 
                    $user = get_user_by( 'id', $user_id );

                    // Replace email tags with correct data
                    $subject = SUPER_Common::email_tags( $settings['register_activation_subject'], $data, $settings, $user );
                    $message = $settings['register_activation_email'];
                    $message = str_replace( '{register_login_url}', $settings['register_login_url'], $message );
                    $message = str_replace( '{register_activation_code}', $code, $message );
                    $message = str_replace( '{register_generated_password}', $password, $message );
                    $message = SUPER_Common::email_tags( $message, $data, $settings, $user );
                    $message = nl2br( $message );
                    $from = SUPER_Common::email_tags( $settings['header_from'], $data, $settings, $user );
                    $from_name = SUPER_Common::email_tags( $settings['header_from_name'], $data, $settings, $user );

                    // Send the email
                    $mail = SUPER_Common::email( $user_email, $from, $from_name, '', '', $subject, $message, $settings );

                    // Return message
                    if( !empty( $mail->ErrorInfo ) ) {
                        SUPER_Common::output_error(
                            $error = true,
                            $msg = $mail->ErrorInfo,
                            $redirect = null
                        );
                    }
                }
                
                // Check if we let users automatically login after registering (instant login)
                if( $settings['register_login_activation']=='auto' ) {
                    wp_set_current_user( $user_id );
                    wp_set_auth_cookie( $user_id );
                    update_user_meta( $user_id, 'super_last_login', time() );
                }

            }

            if( $settings['register_login_action']=='login' ) {

                // Before we proceed, lets check if we have at least a user_login or user_email and user_pass field
                if( ( !isset( $data['user_login'] ) ) && ( !isset( $data['user_pass'] ) ) ) {
                    $msg = __( 'We couldn\'t find the <strong>user_login</strong> or <strong>user_pass</strong> fields which are required in order to login a new user. Please <a href="' . get_admin_url() . 'admin.php?page=super_create_form&id=' . absint( $atts['post']['form_id'] ) . '">edit</a> your form and try again', 'super' );
                    SUPER_Common::output_error(
                        $error = true,
                        $msg = $msg,
                        $redirect = null
                    );
                }
                $username = sanitize_user( $data['user_login']['value'] );
                $password = $data['user_pass']['value'];
                $creds = array();
                $creds['user_login'] = $username;
                $creds['user_password'] = $password;
                $creds['remember'] = true;
                $user = wp_signon( $creds, false );
                if( !is_wp_error( $user ) ) {
                    $user_id = $user->ID;
                    $user = get_user_by( 'id', $user_id );
                    if( $user ) {

                        // First check if the user role is allowed to login
                        $allowed = false;
                        if( ( !isset( $settings['login_user_role'] ) ) || ( $settings['login_user_role']=='' ) ) {
                            $allowed = true;
                        }else{
                            $allowed = in_array( $user->roles[0], $settings['login_user_role'] );
                            if( in_array( '', $settings['login_user_role'] ) ) {
                                $allowed = true;
                            }
                        }
                        if( $allowed != true ) {
                            wp_logout();
                            $msg = __( 'You are not allowed to login!', 'super' );
                            SUPER_Common::output_error(
                                $error = true,
                                $msg = $msg,
                                $redirect = null
                            );
                        }

                        // Check if user has not activated their account yet
                        $activated = null;
                        $status = get_user_meta( $user_id, 'super_account_status', true ); // 0 = inactive, 1 = active
                        if( ( !isset( $data['activation_code'] ) ) && ( $status==0 ) ) {
                            wp_logout();
                            $msg = sprintf( __( 'You haven\'t activated your account yet. Please check your email or click <a href="#" class="resend-code" data-form="' . absint( $atts['post']['form_id'] ) . '" data-user="' . $username . '">here</a> to resend your activation email.', 'super' ), $user->user_login );
                            $_SESSION['super_msg'] = array( 'msg'=>$msg, 'type'=>'error' );
                            SUPER_Common::output_error(
                                $error = true,
                                $msg = $msg,
                                $redirect = $settings['register_login_url'] . '?code=[%20CODE%20]&user=' . $username
                            );
                        }

                        // Validate the activation code
                        if( isset( $data['activation_code'] ) ) {    
                            if( $status==0 ) {
                                $code = sanitize_text_field( $data['activation_code']['value'] );
                                $activation = get_user_meta( $user_id, 'super_account_activation', true );
                                if( $code==$activation ) {
                                    update_user_meta( $user_id, 'super_account_status', 1 ); // 0 = inactive, 1 = active
                                    delete_user_meta( $user_id, 'super_account_activation' );
                                    $activated = true;
                                }else{
                                    $activated = false;
                                }
                            }
                            if( $status==1 ) {
                                $activated = true;
                            }
                        }
                        $msg = '';
                        if( ( isset( $settings['register_welcome_back_msg'] ) ) && ( $settings['register_welcome_back_msg']!='' ) ) {
                            $msg = SUPER_Common::email_tags( $settings['register_welcome_back_msg'], $data, $settings, $user );
                        }
                        $error = false;

                        $redirect = get_site_url();
                        if( !empty( $settings['form_redirect_option'] ) ) {
                            if( $settings['form_redirect_option']=='page' ) {
                                $redirect = get_permalink( $settings['form_redirect_page'] );
                            }
                            if( $settings['form_redirect_option']=='custom' ) {
                                $redirect = $settings['form_redirect'];
                            }
                        }
                        if( $activated!=false ) {
                            if( $activated==false ) {
                                wp_logout();
                                $msg = SUPER_Common::email_tags( $settings['register_incorrect_code_msg'], $data, $settings, $user );
                                $error = true;
                                $redirect = null;
                            }else{
                                wp_set_current_user($user_id);
                                wp_set_auth_cookie($user_id);
                                $msg = SUPER_Common::email_tags( $settings['register_account_activated_msg'], $data, $settings, $user );
                            }
                        }else{
                            wp_set_current_user($user_id);
                            wp_set_auth_cookie($user_id);
                        }
                        $_SESSION['super_msg'] = array( 'msg'=>$msg, 'type'=>'success' );
                        SUPER_Common::output_error(
                            $error = $error,
                            $msg = $msg,
                            $redirect = $redirect
                        );
                    }
                }else{
                    wp_logout();
                    if( count( $user->errors ) > 0 ) {
                        $errors = $user->errors;
                        $errors = array_values( $errors );
                        $errors = array_shift( $errors );
                        $msg = $errors[0];
                    }else{
                        $msg = __( '<strong>Error:</strong> Something went wrong while logging in, please try again', 'super' );
                    }
                    SUPER_Common::output_error(
                        $error = true,
                        $msg = $msg,
                        $redirect = null
                    );
                }
            }

            if( $settings['register_login_action']=='reset_password' ) {
   
                // Before we proceed, lets check if we have at least a user_email field
                if( !isset( $data['user_email'] ) ) {
                    $msg = __( 'We couldn\'t find the <strong>user_email</strong> field which is required in order to reset passwords. Please <a href="' . get_admin_url() . 'admin.php?page=super_create_form&id=' . absint( $atts['post']['form_id'] ) . '">edit</a> your form and try again', 'super' );
                    SUPER_Common::output_error(
                        $error = true,
                        $msg = $msg,
                        $redirect = null
                    );
                }

                // Sanitize the user email address
                $user_email = sanitize_email( $data['user_email']['value'] );
                
                // Try to find a user with this email address
                $user = get_user_by( 'email', $user_email );
                $msg = '';
                if( !$user ) {
                    if( ( isset( $settings['register_reset_password_not_exists_msg'] ) ) && ( $settings['register_reset_password_not_exists_msg']!='' ) ) {
                        $msg = SUPER_Common::email_tags( $settings['register_reset_password_not_exists_msg'], $data, $settings, $user );
                    }
                    SUPER_Common::output_error(
                        $error = true,
                        $msg = $msg,
                        $redirect = null
                    );
                }

                // Disable the default lost password emails
                add_filter( 'send_password_change_email', '__return_false' );

                // Generate a new password for this user
                $password = wp_generate_password( 8, false );
                
                // Update the new password for this user
                $user_id = wp_update_user( array( 'ID' => $user->ID, 'user_pass' => $password ) );

                // Replace the email subject tags with the correct data
                $subject = SUPER_Common::email_tags( $settings['register_reset_password_subject'], $data, $settings, $user );

                // Replace the email body tags with the correct data
                $message = $settings['register_reset_password_email'];
                $message = str_replace( '{register_login_url}', $settings['register_login_url'], $message );
                $message = str_replace( '{register_generated_password}', $password, $message );
                $message = SUPER_Common::email_tags( $message, $data, $settings, $user );
                $message = nl2br( $message );
                $from = SUPER_Common::email_tags( $settings['header_from'], $data, $settings, $user );
                $from_name = SUPER_Common::email_tags( $settings['header_from_name'], $data, $settings, $user );

                // Send the email
                $mail = SUPER_Common::email( $user_email, $from, $from_name, '', '', $subject, $message, $settings );

                // Return message
                if( !empty( $mail->ErrorInfo ) ) {
                    SUPER_Common::output_error(
                        $error = true,
                        $msg = $mail->ErrorInfo,
                        $redirect = null
                    );
                }else{
                    $msg = '';
                    if( ( isset( $settings['register_reset_password_success_msg'] ) ) && ( $settings['register_reset_password_success_msg']!='' ) ) {
                        $msg = SUPER_Common::email_tags( $settings['register_reset_password_success_msg'], $data, $settings );
                    }
                    SUPER_Common::output_error(
                        $error = false,
                        $msg = $msg,
                        $redirect = null
                    );                    
                }
            }
        }


        /** 
         *  Resend activation code
         *
         *  @since      1.0.0
        */
        public static function resend_activation() {
            
            $data = $_REQUEST['data'];
            $username = sanitize_user( $data['username'] );
            $form = absint( $data['form'] );
            $user = get_user_by( 'login', $username );
            if( $user ) {
                $to = $user->user_email;
                $name = $user->display_name;
                $code = wp_generate_password( 8, false );
                $password = wp_generate_password();
                $user_id = wp_update_user( array( 'ID' => $user->ID, 'user_pass' => 'stropdas' ) );
                update_user_meta( $user->ID, 'super_account_activation', $code );
                
                // Get the form settings, so we can setup the correct email message and subject
                $settings = get_post_meta( $form, '_super_form_settings', true );

                // Replace email tags with correct data
                $subject = SUPER_Common::email_tags( $settings['register_activation_subject'], $data, $settings );
                $message = $settings['register_activation_email'];
                $message = str_replace( '{field_user_login}', $username, $message );
                $message = str_replace( '{register_login_url}', $settings['register_login_url'], $message );
                $message = str_replace( '{register_activation_code}', $code, $message );
                $message = str_replace( '{register_generated_password}', $password, $message );
                $message = SUPER_Common::email_tags( $message, $data, $settings );
                $message = nl2br( $message );
                $from = SUPER_Common::email_tags( $settings['header_from'], $data, $settings );
                $from_name = SUPER_Common::email_tags( $settings['header_from_name'], $data, $settings );

                // Send the email
                $mail = SUPER_Common::email( $to, $from, $from_name, '', '', $subject, $message, $settings );

                // Return message
                if( !empty( $mail->ErrorInfo ) ) {
                    SUPER_Common::output_error(
                        $error = true,
                        $msg = $mail->ErrorInfo,
                        $redirect = null
                    );
                }else{
                    $msg = __( 'We have send you a new activation code, check your email to activate your account!', 'super' );
                    SUPER_Common::output_error(
                        $error = false,
                        $msg = $msg,
                        $redirect = null
                    );                    
                }
            }
            die();
        }


        /** 
         *  Send email with activation code
         *
         *  Generates the random activation code and adds it to the users table during user registration.
         *
         *  @since      1.0.0
        */
        public static function new_user_notification( $user_id, $notify='', $data=null, $settings=null, $password=null, $method=null, $send_password=false ) {

            global $wpdb, $wp_hasher;
            
            do_action( 'super_before_new_user_notifcation_hook' );

            // Generate a code and save it for the user
            $code = wp_generate_password( 8 );
            $wpdb->update(
                $wpdb->users,
                array(
                    'super_activation_code' => $code,
                    'super_user_status' => '0'
                ),
                array(
                    'ID' => $user_id
                )
            );
            $user = get_userdata( $user_id );
            $user_login = $user->user_login; 
            $user_email = $user->user_email;

            do_action( 'super_after_new_user_notifcation_hook' );
        
        }

    }
        
endif;


/**
 * Returns the main instance of SUPER_Email_Template_1 to prevent the need to use globals.
 *
 * @return SUPER_Email_Template_1
 */
function SUPER_Email_Template_1() {
    return SUPER_Email_Template_1::instance();
}


// Global for backwards compatibility.
$GLOBALS['SUPER_Email_Template_1'] = SUPER_Email_Template_1();
