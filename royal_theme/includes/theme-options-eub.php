<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'general',
        'title'       => 'General'
      ),
      array(
        'id'          => 'social',
        'title'       => 'Social'
      ),	  
      array(
        'id'          => 'header',
        'title'       => 'Header'
      ),	  
      array(
        'id'          => 'home',
        'title'       => 'Home Page Configure'
      ),		  
      array(
        'id'          => 'styling',
        'title'       => 'Styling Options'
      ),
      array(
        'id'          => 'seo',
        'title'       => 'SEO'
      ),	  
      array(
        'id'          => 'footer',
        'title'       => 'Footer'
      ),
      array(
        'id'          => 'others',
        'title'       => 'Others'
      )	  
    ),


	  
    'settings'        => array( 
      array(
        'id'          => 'login_logo',
        'label'       => 'Custom Admin Login Logo',
        'desc'        => 'Upload a custom logo for your WordPress login screen, or specify the URL directly',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'login_bg',
        'label'       => 'Custom Admin Background Image',
        'desc'        => 'Upload your Custom Admin Background Image which should be 1600 pixels width by 1000 pixels height.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  
      array(
        'id'          => 'favicon',
        'label'       => 'Browser Favicon',
        'desc'        => 'Upload your favicon which should be 16 pixels width by 16 pixels height.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  
      array(
        'id'          => 'apple_favicon',
        'label'       => 'Apple Touch Icon',
        'desc'        => 'Upload the default apple touch icon, the icon should be 57 pixels width by 57 pixels height.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'apple_favicon_72',
        'label'       => 'Apple Touch Icon 72x72',
        'desc'        => 'The icon should be 72 pixels width by 72 pixels height.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'apple_favicon_114',
        'label'       => 'Apple Touch Icon 114x114',
        'desc'        => 'The icon should be 114 pixels width by 114 pixels height.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),

  

      array(
        'id'          => 'facebook_button',
        'label'       => 'Facebook Button',
        'desc'        => 'Show or Hide Facebook Button',
        'std'         => 'enabled',
        'type'        => 'select',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'enabled',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => 'disabled',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'facebook_link',
        'label'       => 'Facebook Full URL',        
        'std'         => 'https://facebook.com/mehdiakram/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),  




	  

      array(
        'id'          => 'googleplus_button',
        'label'       => 'Google Plus Button',
        'desc'        => 'Show or Hide Google Plus Button',
        'std'         => 'enabled',
        'type'        => 'select',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'enabled',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => 'disabled',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'googleplus_link',
        'label'       => 'Google Plus Full URL',        
        'std'         => 'https://google.com/+MehdiAkram/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),  
	  
	  
	  

      array(
        'id'          => 'share_button',
        'label'       => 'Share Button',
        'desc'        => 'Show or Hide Share Button',
        'std'         => 'enabled',
        'type'        => 'select',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'enabled',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => 'disabled',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'share_link',
        'label'       => 'Share Full URL',        
        'std'         => '#',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 	  
	  	  

      array(
        'id'          => 'twitter_button',
        'label'       => 'Twitter Button',
        'desc'        => 'Show or Hide Twitter Button',
        'std'         => 'enabled',
        'type'        => 'select',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'enabled',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => 'disabled',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'twitter_link',
        'label'       => 'Twitter Full URL',        
        'std'         => 'http://twitter.com/mehdiakram',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 	   

      array(
        'id'          => 'youtube_button',
        'label'       => 'Youtube Button',
        'desc'        => 'Show or Hide Youtube Button',
        'std'         => 'enabled',
        'type'        => 'select',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'enabled',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => 'disabled',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'youtube_link',
        'label'       => 'Youtube Full URL',        
        'std'         => '#',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 	  
	  	

		
      array(
        'id'          => 'news_scrolling_bg_color',
        'label'       => 'News Scrolling BG Color',        
        'std'         => '#000',
        'type'        => 'colorpicker',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 

      array(
        'id'          => 'news_scrolling_text_color',
        'label'       => 'News Srolling Text Color',        
        'std'         => '#fff',
        'type'        => 'colorpicker',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 


	  
      array(
        'id'          => 'news_scrolling_width',
        'label'       => 'News Scrolling Width FULL or ACTUAL',
        'std'         => 'enabled',
        'type'        => 'select',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'enabled',
            'label'       => 'Full Width',
            'src'         => ''
          ),
          array(
            'value'       => 'disabled',
            'label'       => 'Actual Width',
            'src'         => ''
          )
        ),
      ),	
	  
		
      array(
        'id'          => 'news_or_custom',
        'label'       => 'News Tracker or Custom Announcement',
        'desc'        => 'Select what you want to show, Notice & News and Events OR Custom Announcement.',
        'std'         => 'enabled',
        'type'        => 'select',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'enabled',
            'label'       => 'Notice & News and Events',
            'src'         => ''
          ),
          array(
            'value'       => 'disabled',
            'label'       => 'Announcement',
            'src'         => ''
          )
        ),
      ),		
		
		
      array(
        'id'          => 'announcement',
        'label'       => 'Announcement',
        'desc'        => 'Just put custom Announcement you want to show.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 					

      array(
        'id'          => 'logo',
        'label'       => 'Upload your Logo',
        'desc'        => 'Upload your own logo, or simply specify the URL directly. Delete or leave it empty to show text only.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 	 

	  
      array(
        'id'          => 'contact_numbers',
        'label'       => 'Admission Office Contact Numbers',
        'desc'        => 'Just put Contact Numbers.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 	 
	
      array(
        'id'          => 'result_link',
        'label'       => 'Result Button Full Link',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 	 
      array(
        'id'          => 'admission_link',
        'label'       => 'Admission Button Full Link',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 	 
		
	  

      array(
        'id'          => 'revolution_slider',
        'label'       => 'Revolution Slider',
        'desc'        => '1) Active Revolution Slider Plugin <br/>2) Create a slider name "homeslider", Size (572px X 383px)<br/>3) Than active/show Revolution Slider.',
        'std'         => 'disabled',
        'type'        => 'select',
        'section'     => 'home',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'enabled',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => 'disabled',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),	
	  

      array(
        'id'          => 'revolution_gallery',
        'label'       => 'Home Photo Gallery',
        'desc'        => '1) Active Revolution Slider Plugin <br/>2) Create a slider name "homegallery", Size (278px X 200px)<br/>3) Than active/show Home Photo Gallery.',
        'std'         => 'disabled',
        'type'        => 'select',
        'section'     => 'home',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'enabled',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => 'disabled',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),	
      array(
        'id'          => 'messages',
        'label'       => 'messages',
        'desc'        => '1) Active Revolution Slider Plugin <br/>2) Create a slider name "messages", Size (150px X 160px)<br/>3) Than active/show Home Photo Gallery.',
        'std'         => 'disabled',
        'type'        => 'select',
        'section'     => 'home',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'enabled',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => 'disabled',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),	
      array(
        'id'          => 'home_photo_gallery_url',
        'label'       => 'Home Photo Gallery URL',        
        'std'         => '#',
        'type'        => 'text',
        'section'     => 'home',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  
	  
      array(
        'id'          => 'welcome_title',
        'label'       => 'Welcome Title',        
        'std'         => 'WELCOME TO EUB',
        'type'        => 'text',
        'section'     => 'home',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'welcome_text',
        'label'       => 'Welcome Text',        
        'std'         => 'European University of Bangladesh (EUB) is a third generation private university aiming at providing modern education of European standard in Bangladesh. It has been accredited by the Government of the People\'s Republic of Bangladesh, curricula and academic while its programs have been approved by the University Grants Commission (UGC).',
        'type'        => 'text',
        'section'     => 'home',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'welcome_readmore',
        'label'       => 'Welcome Readmore URL',        
        'std'         => '',
        'type'        => 'text',
        'section'     => 'home',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),


	  array(
        'id'          => 'admission_image',
        'label'       => 'Admission Image',        
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'home',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),

      array(
        'id'          => 'admission_readmore',
        'label'       => 'Admission Readmore full URL',        
        'std'         => '',
        'type'        => 'text',
        'section'     => 'home',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),


	  array(
        'id'          => 'clubs_image',
        'label'       => 'Clubs Image',        
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'home',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	
      array(
        'id'          => 'clubs_readmore',
        'label'       => 'Clubs Readmore full URL',        
        'std'         => '',
        'type'        => 'text',
        'section'     => 'home',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),


	  array(
        'id'          => 'welfare_image',
        'label'       => 'Welfare Image',        
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'home',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	
      array(
        'id'          => 'welfare_readmore',
        'label'       => 'Welfare Readmore full URL',        
        'std'         => '',
        'type'        => 'text',
        'section'     => 'home',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),

      array(
        'id'          => 'contact_address',
        'label'       => 'Contact Address',        
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'home',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),



	  
	  
      array(
        'id'          => 'bodycolor',
        'label'       => 'Body Background',
        'desc'        => 'Choose a color that you would like to use for the body of the page.',
        'std'         => '',
        'type'        => 'background',
        'section'     => 'styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),


      array(
        'id'          => 'header_bg_color',
        'label'       => 'Header Top Background',
        'desc'        => 'Choose a background color for your header.',
        'std'         => '#EAF2FE',
        'type'        => 'colorpicker',
        'section'     => 'styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),

       array(
        'id'          => 'footer_bg_color',
        'label'       => 'Footer Top Background',
        'desc'        => 'Choose a cackground color for your footer.',
        'std'         => '#0ABEFF',
        'type'        => 'colorpicker',
        'section'     => 'styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),

      array(
        'id'          => 'site_keywords',
        'label'       => 'Site Keywords',
        'desc'        => 'Write the list of keywords for you resume site page, separated by commas.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'seo',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'site_description',
        'label'       => 'Site Description',
        'desc'        => 'Write a description for your site.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'seo',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'google_analytics',
        'label'       => 'Google Analytics',
        'desc'        => 'Insert your google analytics tracking code',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'seo',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  
      array(
        'id'          => 'ugc_info',
        'label'       => 'UGC Information',
        'desc'        => 'Enter your UGC Information here',
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),  
	  
      array(
        'id'          => 'gov_info',
        'label'       => 'Govt Information',
        'desc'        => 'Govt Information',
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),  	  

      array(
        'id'          => 'copyright_text',
        'label'       => 'Custom Copyright Text',
        'desc'        => 'Enter your custom copyright message here',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),  
      array(
        'id'          => 'developed_text',
        'label'       => 'Custom Developed Text',
        'desc'        => 'Enter your custom developed message here',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 

      array(
        'id'          => 'prospective_left',
        'label'       => 'Admissions Office',        
        'std'         => '',
        'type'        => 'text',
        'section'     => 'others',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 



	  
      array(
        'id'          => 'the_end',
        'label'       => 'Theme Options End',        
        'std'         => '',
        'type'        => 'info',
        'section'     => 'others',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      )	 	  
	  
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}