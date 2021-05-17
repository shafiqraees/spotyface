<?php

namespace Fir\Views;

/**
 * The view class which generates the views
 */
class View
{
    /**
     * The current URL path (route) array to be passed to the controllers
     * @var array
     */
    public $url;
    /**
     * The site metadata
     * @var array   An array containing various metadata attributes
     *              Array Map: Metadata => Mixed(Values)
     */
    public $metadata;
    /**
     * The site settings from the `settings` DB table
     * @var array
     */
    protected $settings;
    /**
     * The language array
     * @var array
     */
    protected $lang;

    public function __construct($settings, $language, $url, $currency, $theme_details)
    {
        $this->settings = $settings;
        $this->lang = $language;
        $this->url = $url;
		
        // Set the site currency code
        $this->currency = $currency;
		
        // Theme details
        $this->theme_details = $theme_details;
    }

    /**
     * @param    array $data The data to be passed to the view template
     * @param    string $view The file path / name of the view
     * @return    string
     */
    public function render($data = null, $view = null)
    {
        /**
         * Start the output buffer
         * This is needed to create the template inheritance
         */
        ob_start();

        // Do not use %_once as some of the template files may need to be called multiple times
        require(sprintf('%s/../../%s/%s/%s/views/%s.php', __DIR__, PUBLIC_PATH, THEME_PATH, $this->settings['theme'], $view));

        return ob_get_clean();
    }

    /**
     * @return string
     */
    public function message()
    {
        $messages = null;

        // If a message exists
        if (isset($_SESSION['message'])) {
            // Render the message
            foreach ($_SESSION['message'] as $key => $value) {
                $data['message'] = ['type' => $value[0], 'content' => $value[1]];
                $messages .= $this->render($data, 'shared/message');
            }
        }

        // Remove the message
        unset($_SESSION['message']);

        return $messages;
    }

    /**
     * @return string
     */
    public function validation()
    {
	   //return isset($_SESSION['errors']) ? $errors = $_SESSION['errors'] : "";
        $errors = null;

        // If a message exists
        if (isset($_SESSION['errors'])) {
            // Render the message
            foreach ($_SESSION['errors'] as $key => $value) {
                $data['error'] = ['type' => $value[0], 'content' => $value[1]];
                $errors .= $this->render($data, 'shared/error');
            }
        }

        // Remove the message
        unset($_SESSION['errors']);

        return $errors;
    }

    /**
     * @return string
     */
    public function token()
    {
        $data['token_id'] = $_SESSION['token_id'];
        return $this->render($data, 'shared/token');
    }

    /**
     * @return string
     */
    public function docTitle()
    {
        // If the controller/method has additional title information
        if (isset($this->metadata['title'])) {
            $title = implode(' - ', $this->metadata['title']) . ' - ' . $this->settings['title'];
        } else {
            $title = $this->settings['title'];
        }
        return $title;
    }

    /**
     * @return string
     */
    public function siteUrl()
    {
        return URL_PATH;
    }

    /**
     * @return string
     */
    public function themePath()
    {
        return THEME_PATH;
    }

    /**
     * @return string
     */
    public function theme()
    {
        return $this->settings['theme'];
    }

    /**
     * @return string
     */
    public function publicPath()
    {
        return PUBLIC_PATH;
    }

    /**
     * @return string
     */
    public function uploadsPath()
    {
        return UPLOADS_PATH;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function cookie($key)
    {
        return $_COOKIE[$key];
    }

    /**
     * @param $key
     * @return mixed
     */
    public function siteSettings($key)
    {
        return $this->settings[$key];
    }

    /**
     * @param $key
     * @return mixed
     */
    public function lang($key)
    {
        return $this->lang[$key];
    }

    /**
     * @return string - currency code
     */
    public function currency()
    {
        return $this->currency;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function theme_details($key)
    {
        return $this->theme_details[$key];
    }
	
    /**
     * @return string
     */
    public function freelancer_url()
    {
        return FREELANCER_URL;
    }
	
	
    /**
     * @return string
     */
    public function freelancers_url()
    {
        return FREELANCERS_URL;
    }
	
    /**
     * @return string
     */
    public function freelancer_name()
    {
        return FREELANCER;
    }
	
    /**
     * @return string
     */
    public function freelancer_name_plural()
    {
        return FREELANCERS;
    }	
	
    /**
     * @return string
     */
    public function client_url()
    {
        return CLIENT_URL;
    }
    /**
     * @return string
     */
    public function clients_url()
    {
        return CLIENTS_URL;
    }
	
    /**
     * @return string
     */
    public function client_name()
    {
        return CLIENT;
    }	
	
    /**
     * @return string
     */
    public function client_name_plural()
    {
        return CLIENTS;
    }
}