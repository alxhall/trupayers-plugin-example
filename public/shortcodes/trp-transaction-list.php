<?php

/**
 * Shortcode for displaying list of transactions.
 *
 * @link       http://www.spinit.se
 * @since      1.0.0
 *
 */

class Trupayers_Customer_Portal_Shortcode_Transaction_List {

    /**
	 * The instance of the helpers class.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
    private $api_wrapper;

    /**
	 * The instance of the templates helper class.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
    private $templates;

    /**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
		$this->version = $version;
        $this->templates = new Trupayers_Customer_Portal_Template_Loader;

        $this->api_wrapper = new Trupayers_Customer_Portal_Api_Wrapper($this->plugin_name, $this->version);
    }

	/**
	 * @since    1.0.0
	 */
	public function register() {
        add_shortcode('trp_transaction_list', [$this, 'add_shortcode']);
    }

    /**
     * Loads the template and passes context data
     */
    protected function render_template($template_vars) {
        ob_start();
        $this->templates
            ->set_template_data( $template_vars, 'context' )
            ->get_template_part( 'transaction', 'list' );

        return ob_get_clean();
    }


    /**
     * The shortcode function
     *
     * @param [type] $atts
     * @return void
     */
    public function add_shortcode( $atts ) {

        $args = shortcode_atts([
            'arg1' => '',
            'arg2' => '',
        ], $atts, 'trp_transaction_list' );

        $template_vars = [
            'caption' => 'Hello world', 
            'body' => 'Body text'
        ];

        $html = $this->render_template($template_vars);

        return $html;

    }
}