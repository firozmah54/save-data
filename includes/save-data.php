<?php 

class Wedevs_Fm_Save_Post{
    public function __construct(){
       
        add_action('add_meta_boxes', [$this, 'register_meta_box']);

        add_action('save_post', [$this, 'save_meta_box_data'], 10, 2);
        wp_register_style('wedevs-style', plugins_url('assets/css/firoz.css', __FILE__));

    }

    public function register_meta_box(){
        wp_enqueue_style('wedevs-style');
        add_meta_box(
            'wedevs-meta-box', //unique id
            'Wedevs Meta Box', //title
            [$this, 'wedevs_meta_box_callback'], //callback function
            'post', //post type
            'normal', //context ('normal', 'side', 'advanced')
            'high' //priority
        );
    }

    public function wedevs_meta_box_callback($post){
        $meta_value = get_post_meta($post->ID, '_custom_meta_key', true);

        wp_nonce_field('wedevs_meta_box_nonce', 'my_box_nonce');

        ?>
        <label for="wedevs-meta-box">Meta Field</label>
        <input type="text" name="wedevs-meta-box" id="wedevs-meta-box" value="<?php echo esc_attr( $meta_value);?>">
        <?php 

    }

    /**
     * save meta in box field of post 
     */

    public function save_meta_box_data($post_id, $post){

        if($post->post_type !== 'post'){
            return;
         }

         if(!isset($_POST['wedevs-meta-box'])){
            return;
         }

         if(!wp_verify_nonce($_POST['my_box_nonce'], 'wedevs_meta_box_nonce')){
            return;
         }
         
         if(isset($_POST['wedevs-meta-box'])){

            $meta_value= sanitize_text_field($_POST['wedevs-meta-box']);

            update_post_meta($post_id, '_custom_meta_key',$meta_value );
         }
}
    
         
}
