<?php
/**
 * Plugin Name: AKD Essentials
 * Description: AKD Elementor extension.
 * Plugin URI:  http://designingmedia.com
 * Version:     1.0.0
 * Author:      Designing Media
 * Author URI:  http://designingmedia.com
 * Text Domain: akd-essentials-extension
 */

if (!defined('ABSPATH'))
{
    exit; // Exit if accessed directly.
    
}

/**
 * For Elementor Global Kit Settings
 */
use Elementor\Core\App\Modules\ImportExport\Directories\Root;
use Elementor\Core\App\Modules\ImportExport\Module;
use Elementor\Core\Settings\Page\Manager as PageManager;
use Elementor\Plugin;

/**
 * Main AKD Elementor Extension Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class AKD_Essentials
{

    /**
     * Plugin Version
     *
     * @since 1.0.0
     *
     * @var string The plugin version.
     */
    const VERSION = '1.0.0';

    /**
     * Minimum Elementor Version
     *
     * @since 1.0.0
     *
     * @var string Minimum Elementor version required to run the plugin.
     */
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

    /**
     * Minimum PHP Version
     *
     * @since 1.0.0
     *
     * @var string Minimum PHP version required to run the plugin.
     */
    const MINIMUM_PHP_VERSION = '7.0';

    /**
     * Instance
     *
     * @since 1.0.0
     *
     * @access private
     * @static
     *
     * @var AKD_Essentials The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.0.0
     *
     * @access public
     * @static
     *
     * @return AKD_Essentials An instance of the class.
     */
    public static function instance()
    {

        if (is_null(self::$_instance))
        {
            self::$_instance = new self();
        }
        return self::$_instance;

    }

    /**
     * Constructor
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function __construct()
    {

        add_action('init', [$this, 'i18n']);
        add_action('plugins_loaded', [$this, 'init']);
        $this->register_callbacks();

    }

    /**
     * Load Textdomain
     *
     * Load plugin localization files.
     *
     * Fired by `init` action hook.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function i18n()
    {

        load_plugin_textdomain('akd-essentials-extension');

    }

    /**
     * Initialize the plugin
     *
     * Load the plugin only after Elementor (and other plugins) are loaded.
     * Checks for basic plugin requirements, if one check fail don't continue,
     * if all check have passed load the files required to run the plugin.
     *
     * Fired by `plugins_loaded` action hook.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function init()
    {

        // Check if Elementor installed and activated
        if (!did_action('elementor/loaded'))
        {
            add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
            return;
        }

        // Check for required Elementor version
        if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>='))
        {
            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
            return;
        }

        // Check for required PHP version
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<'))
        {
            add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
            return;
        }

        // Register widgets.
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);
        // Register categories.
        add_action('elementor/elements/categories_registered', [$this, 'register_cats']);
        // Register Custom CSS Option.
        add_action('elementor/init', [$this, 'akd_custom_css_control_init']);
        // Register Navigation Option.
        add_action('elementor/init', [$this, 'me_nav_control_init']);

        function Slider_widget_enqueue_script()
        {
            wp_enqueue_script('my_custom_script', plugin_dir_url(__FILE__) . 'myscript.js', array(
                'jquery'
            ) , false, false);
        }
        add_action('wp_enqueue_scripts', 'Slider_widget_enqueue_script');


    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have Elementor installed or activated.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function admin_notice_missing_main_plugin()
    {

        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
        /* translators: 1: Plugin name 2: Elementor */
        esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'akd-essentials') , '<strong>' . esc_html__('AKD Essentials', 'akd-essentials') . '</strong>', '<strong>' . esc_html__('Elementor', 'akd-essentials') . '</strong>');

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);

    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required Elementor version.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function admin_notice_minimum_elementor_version()
    {

        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
        /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
        esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'akd-essentials') , '<strong>' . esc_html__('AKD Essentials', 'akd-essentials') . '</strong>', '<strong>' . esc_html__('Elementor', 'akd-essentials') . '</strong>', self::MINIMUM_ELEMENTOR_VERSION);

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);

    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required PHP version.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function admin_notice_minimum_php_version()
    {

        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
        /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
        esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'akd-essentials') , '<strong>' . esc_html__('AKD Essentials', 'akd-essentials') . '</strong>', '<strong>' . esc_html__('PHP', 'akd-essentials') . '</strong>', self::MINIMUM_PHP_VERSION);

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);

    }

    /**
     * Function for accesiing wordpress upload directory.
     *
     * @since 1.0.0
     *
     * @access public
     */
    static function upload_dir()
    {
        $path = wp_upload_dir();
        return $path['basedir'];
    }

    /**
     * Custom CSS option for Advanced Tab in Elementor.
     *
     * @since 1.0.0
     *
     * @access public
     */

    public function me_nav_control_init()

    {

        add_action('elementor/element/after_section_end', function ($section, $section_id)
        {

            if ('section_advanced' === $section_id || '_section_style' === $section_id)
            {

                //Start Custom Settings Section
                

                $section->start_controls_section(

                'opt_nav',

                [

                'label' => __('AKD Essentials Navigation', 'akd-essentials') ,

                'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,

                ]
);

                $section->add_control(

                'front_nav',

                [

                'type' => \Elementor\Controls_Manager::RAW_HTML,

                'raw' => __('This Feature Only Works on the frontend.', 'akd-essentials') ,

                'content_classes' => 'elementor-descriptor',

                ]
);

                $section->add_control('navigation', ['label' => __('Navigate Style', 'akd-essentials') , 'type' => \Elementor\Controls_Manager::SELECT, 'default' => 'both', 'options' => ['both' => __('Arrows and Dots', 'akd-essentials') , 'arrows' => __('Arrows', 'akd-essentials') , 'dots' => __('Dots', 'akd-essentials') , 'none' => __('None', 'akd-essentials') , ], 'frontend_available' => true, ]);

                $section->add_control('heading_style_arrows', ['label' => __('Arrows', 'akd-essentials') , 'type' => \Elementor\Controls_Manager::HEADING, 'separator' => 'before', 'condition' => ['navigation' => ['arrows', 'both'], ], ]);

                $section->add_control('arrows_size', ['label' => __('Arrows Size', 'akd-essentials') , 'type' => \Elementor\Controls_Manager::SLIDER, 'range' => ['px' => ['min' => 20, 'max' => 60, ], ], 'selectors' => ['{{WRAPPER}} .akd-navigation-arrow' => 'font-size: {{SIZE}}{{UNIT}}', ], 'condition' => ['navigation' => ['arrows', 'both'], ], ]);

                $section->add_control('arrows_color', ['label' => __('Arrows Color', 'akd-essentials') , 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .akd-navigation-arrow' => 'color: {{VALUE}}', ], 'condition' => ['navigation' => ['arrows', 'both'], ], ]);

                $section->add_control('heading_style_dots', ['label' => __('Dots', 'akd-essentials') , 'type' => \Elementor\Controls_Manager::HEADING, 'separator' => 'before', 'condition' => ['navigation' => ['dots', 'both'], ], ]);

                $section->add_control('dots_size', ['label' => __('Dots Size', 'akd-essentials') , 'type' => \Elementor\Controls_Manager::SLIDER, 'range' => ['px' => ['min' => 5, 'max' => 15, ], ], 'selectors' => ['{{WRAPPER}} .akd-navigation-dots' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',

                ], 'condition' => ['navigation' => ['dots', 'both'], ], ]);

                $section->add_control('dots_color', ['label' => __('Dots Color', 'akd-essentials') , 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .akd-navigation-dots' => 'background-color: {{VALUE}};', ], 'condition' => ['navigation' => ['dots', 'both'], ], ]);

                $section->end_controls_section();

            }

        }
        , 10, 2);
    }

    public function akd_custom_css_control_init()
    {
        //////////////////////
        

        ////////////////////
        add_action('elementor/element/after_section_end', function ($section, $section_id)
        {

            if ('section_advanced' === $section_id || '_section_style' === $section_id)
            {

                //Start Custom Settings Section.
                $section->start_controls_section(

                'opt_css', ['label' => __('AKD Custom CSS', 'akd-essentials') ,

                'tab' => \Elementor\Controls_Manager::TAB_ADVANCED, ]
);

                $section->add_control(

                'front_note', ['type' => \Elementor\Controls_Manager::RAW_HTML, 'raw' => __('This Feature Only Works on the frontend.', 'akd-essentials') , 'content_classes' => 'elementor-descriptor', ]);

                $repeater = new \Elementor\Repeater();

                $repeater->add_control(

                'break_title', ['label' => __('Title', 'akd-essentials') , 'type' => \Elementor\Controls_Manager::TEXT, 'default' => __('Default title', 'akd-essentials') , 'placeholder' => __('Type your title here', 'akd-essentials') , ]);

                $repeater->add_control(

                'break_enable', ['label' => __('Enable Media Query', 'akd-essentials') ,

                'type' => \Elementor\Controls_Manager::SWITCHER,

                'label_on' => __('Show', 'akd-essentials') ,

                'label_off' => __('Hide', 'akd-essentials') ,

                'return_value' => 'yes',

                'default' => 'yes', ]);

                $repeater->add_control(

                'show_min',

                [

                'label' => __('Show Min', 'akd-essentials') ,

                'type' => \Elementor\Controls_Manager::SWITCHER,

                'label_on' => __('Show', 'akd-essentials') ,

                'label_off' => __('Hide', 'akd-essentials') ,

                'return_value' => 'yes',

                'default' => 'yes',

                'condition' => [

                'break_enable' => 'yes',

                ]

                ]
);

                $repeater->add_control(

                'show_max',

                [

                'label' => __('Show Max', 'akd-essentials') ,

                'type' => \Elementor\Controls_Manager::SWITCHER,

                'label_on' => __('Show', 'akd-essentials') ,

                'label_off' => __('Hide', 'akd-essentials') ,

                'return_value' => 'yes',

                'default' => 'yes',

                'condition' => [

                'break_enable' => 'yes',

                ]

                ]
);

                $repeater->add_control(

                'break_min',

                [

                'label' => __('Min Width (px)', 'akd-essentials') ,

                'type' => \Elementor\Controls_Manager::NUMBER,

                'min' => 5,

                'max' => 1000,

                'step' => 5,

                'default' => 0,

                'condition' => [

                'show_min' => 'yes',

                'break_enable' => 'yes',

                ]

                ]
);

                $repeater->add_control(

                'break_max',

                [

                'label' => __('Max Width (px)', 'akd-essentials') ,

                'type' => \Elementor\Controls_Manager::NUMBER,

                'min' => 5,

                'max' => 3000,

                'step' => 5,

                'default' => 100,

                'condition' => [

                'show_max' => 'yes',

                'break_enable' => 'yes',

                ]

                ]
);

                $repeater->add_control(

                'custom_css',

                [

                'type' => \Elementor\Controls_Manager::CODE,

                'label' => __('Add Your Own Custom Css Here', 'akd-essentials') ,

                'language' => 'css',

                'render_type' => 'ui',

                'show_label' => false,

                'separator' => 'none',

                ]
);

                $repeater->add_control(

                'css_description',

                [

                'raw' => __('Use "selector" to target wrapper element. Examples:<br>selector {color: red;} // For main element<br>selector .child-element {margin: 10px;} // For child element<br>.my-class {text-align: center;} // Or use any custom selector', 'akd-essentials') ,

                'type' => \Elementor\Controls_Manager::RAW_HTML,

                'content_classes' => 'elementor-descriptor',

                ]
);

                $section->add_control(

                'breakpoints_list',

                [

                'label' => __('Add Your Own Custom Css Here', 'akd-essentials') ,

                'type' => \Elementor\Controls_Manager::REPEATER,

                'fields' => $repeater->get_controls() ,

                'default' => [

                [

                'break_title' => __('Title #1', 'akd-essentials') ,

                'break_enable' => __('yes', 'akd-essentials') ,

                'show_min' => __('yes', 'akd-essentials') ,

                'show_max' => __('yes', 'akd-essentials') ,

                'break_min' => __('Min', 'akd-essentials') ,

                'break_max' => __('Max', 'akd-essentials') ,

                'custom_css' => __('', 'akd-essentials') ,

                ],

                ],

                'title_field' => '{{{ break_title }}}',

                ]
);

                #End Custom Settings Section
                $section->end_controls_section();

            }

        }
        , 10, 2);
        add_action('elementor/frontend/after_render', function ($section_render)
        {

            /**
             * Creating akd directory in wordpress uploads folder.
             *
             * @since 1.0.0
             *
             * @access public
             */
            $akd_dir = new \AKD_Essentials();
            $dir = $akd_dir::upload_dir() . "/akd-essentials";

            if (is_dir($dir) === false)
            {

                mkdir($dir);

            }

            /**
             * Responsive Controls for Custom CSS option in Elementor.
             *
             * @since 1.0.0
             *
             * @access public
             */
            foreach ($section_render->get_settings_for_display('breakpoints_list') as $item)
            {

                if ($item['break_enable'])
                {

                    if ($item['show_min'] == 'yes')
                    {

                        $text = '@media screen and (min-width:' . $item['break_min'] . 'px){' . $item['custom_css'] . '}';

                    }
                    elseif ($item['show_max'] == 'yes')
                    {

                        $text = '@media screen and (max-width:' . $item['break_max'] . 'px){' . $item['custom_css'] . '}';

                    }

                    if ($item['show_min'] == 'yes' && $item['show_max'] == 'yes')
                    {

                        $text = '@media  (min-width:' . $item['break_min'] . 'px) and (max-width:' . $item['break_max'] . 'px){' . $item['custom_css'] . '}';

                    }

                }
                else
                {

                    $text = $item['custom_css'];

                }

                if ($item['break_min'] === 'Min' || $item['break_max'] === 'Max' || $item['custom_css'] === '')
                {

                }
                else
                {

                    $filename = $dir . "/post-" . $item['_id'] . ".css";

                    $fh = fopen($filename, "w");

                    fwrite($fh, $text);

                    if (is_multisite() == 1)
                    {
                        wp_enqueue_style('custom-breakpoint' . $item['_id'], WP_CONTENT_DIR . '/uploads/sites/' . get_current_blog_id() . '/akd-essentials/post-' . $item['_id'] . '.css', true, true);
                    }
                    else
                    {
                        wp_enqueue_style('custom-breakpoint' . $item['_id'], content_url() . '/uploads/akd-essentials/post-' . $item['_id'] . '.css', true, true);
                    }
                    fclose($fh);

                }

            }

        }
        , 11);
    }

    /**
     * Include Files
     *
     * Load required plugin core files.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function includes()
    {

        require_once (__DIR__ . '/widgets/blog-post.php');

    }

    public function register_widgets()
    {

        // Include plugin files
        $this->includes();
        \Elementor\Plugin::instance()
            ->widgets_manager
            ->register_widget_type(new \AKD_Blog_Posts_Widget());

    }

    static function register_cats($elements_manager)
    {

        $elements_manager->add_category('akd-essentials', ['title' => esc_html__('AKD Essentials', 'akd') , 'icon' => 'fa fa-plug', ]);

    }

    protected function register_callbacks()
    {
        add_filter('akd_elementor_global', array(
            $this,
            'akd_elementor_global'
        ));
    }

    public function akd_elementor_global()
    {
        $kit = Plugin::$instance
            ->kits_manager
            ->get_active_kit();
        $old_settings = $kit->get_meta(PageManager::META_KEY);
        if (!$old_settings)
        {
            $old_settings = [];
        }
        $new_settings = json_decode(file_get_contents(get_template_directory() . '/demo/site-settings.json') , true);
        $new_settings = $new_settings['settings'];
        if ($old_settings)
        {
            if (isset($old_settings['custom_colors']))
            {
                $new_settings['custom_colors'] = array_merge($old_settings['custom_colors'], $new_settings['custom_colors']);
            }
            if (isset($old_settings['custom_typography']))
            {
                $new_settings['custom_typography'] = array_merge($old_settings['custom_typography'], $new_settings['custom_typography']);
            }
        }
        $new_settings = array_replace_recursive($old_settings, $new_settings);
        $kit->save(['settings' => $new_settings]);
    }
}
AKD_Essentials::instance();