<?php 

namespace PixelPath\TopMessagePlugin\Classes;

use PixelPath\TopMessagePlugin\Interfaces\HookContent;

//check if SimpleMSG class exist
if(!class_exists('SimpleMSG')) {

    //create SimpleMSG class
    class SimpleMSG implements HookContent {

        //variables value set in SettingsPage
        public function __construct(public string $content = "Welcome on our page", public string $bgColor = "#FFFFFF", public string $textColor = "#000000", public string $isVisible = "false")
        {
        
            add_action('wp_head', array($this, 'hook_msg'));
        }

        //callback function for add action hook wp_head - render text div
        public function hook_msg() {
            if(esc_html($this->isVisible) === "true") {
                ob_start();  // start output buffering    
            ?>
                <div class="pixelpath-msg" style="background-color: <?php echo esc_attr($this->bgColor); ?>">
                    <p class="pixelpath-text" style="color: <?php echo esc_attr($this->textColor); ?>">
                        <?php echo esc_html($this->content); ?>
                    </p>
                </div>            
            <?php    
            echo ob_get_clean(); // get output and clean the buffer
            }
        }

    }
}


?>