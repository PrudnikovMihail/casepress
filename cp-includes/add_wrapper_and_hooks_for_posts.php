<?php

function add_hooks_for_postmeta_cp($content){
	ob_start();
    ?>
    <div class="entry_wrapper_cp">
        <div class="content_before_wrapper_cp">
            <?php  
                remove_filter( 'the_content', 'wpautop' );
                remove_filter( 'the_excerpt', 'wpautop' );
                do_action('content_before_wrapper_cp'); 
                //apply_filters( 'the_content', 'wpautop', $content );
                //apply_filters( 'the_excerpt', 'wpautop', $content);            
            ?>
        </div>
        <div class="content_wrapper_cp">
            <?php echo wpautop($content); ?>
        </div>
        <div class="content_after_wrapper_cp">
            <?php  do_action('content_after_wrapper_cp'); ?>
        </div>
    </div>
    <?php
	$html = ob_get_contents();
	ob_get_clean();
    
	return $html;
}
add_filter('the_excerpt', 'add_hooks_for_postmeta_cp', 9, 2);
add_filter('the_content', 'add_hooks_for_postmeta_cp', 9, 2);


function add_hook_for_sections_cp(){
	do_action('cp_entry_sections');
}
add_action('content_after_wrapper_cp', 'add_hook_for_sections_cp');

//Добавляем секцию с мета данными для всех типов постов
function add_top_section_metadata_to_post() {
?>
	<div class="metadata_top_cp">
        <?php do_action('add_metadata_to_post_cp') ?>
    </div>
<?php
}  add_action('content_before_wrapper_cp', 'add_top_section_metadata_to_post');