<?php
/**
*
*
*
 * Allow shortcodes in widgets
 * @since v1.0
 */
add_filter('widget_text', 'do_shortcode');




// Text Box
if(! function_exists('wr_txtbox_img_shortcode')){
	function wr_txtbox_img_shortcode($atts, $content = null){
		extract(shortcode_atts( array(
			'class'=>'',
			'id'=>'',
			'title'=>'',
			'image'=>'',
			'imgposition'=>'',
			
			
			
					

			), $atts) );
			if(is_numeric($image)) {
            $service_image = wp_get_attachment_url( $image );
        }else {
            $service_image = $image;
        }

		$html ='';
		$img_po ='';
		$con_po ='';
		if($imgposition == "st1"){
		$img_po .='lft-img';
		$con_po .='rft-info';
		}
		else{
		$img_po .='rft-img';
		$con_po .='lft-info';
		}
		
		$html .= '<div class="services-item">';
		$html .= '<div class="serv-img '.$img_po.'">';
		$html .= '<div class="bg" style="background-image:url('.$service_image.')"></div>';
		$html .= '</div>';
		$html .= '<div class="services-box-info '.$con_po.'">';
		$html .= '<h4>'.$title.'</h4>';
		$html .= do_shortcode($content);
		$html .= '</div>';
		$html .= '</div>';
		
				
		return $html ;
	}
	add_shortcode('wr_text_block', 'wr_txtbox_img_shortcode');
}


// Text Box
if(! function_exists('wr_about_shortcode')){
	function wr_about_shortcode($atts, $content = null){
		extract(shortcode_atts( array(
			'class'=>'',
			'id'=>'',
			'title'=>'',
			'image'=>'',
			'buttontext'=>'',
			'buttonurl'=>'',
			'urltype'=>'',
			
			
			
			
					

			), $atts) );
			if(is_numeric($image)) {
            $about_image = wp_get_attachment_url( $image );
        }else {
            $about_image = $image;
        }
		

		$html ='';
		$ajaxclass ='';
		
		if($urltype == "st2"){
		$ajaxclass .= 'ajaxnot';
		}
		else{
		$ajaxclass .= 'ajax';
		}
		$html .= '<div class="fixed-column">';
		$html .= '<div class="bg" style="background-image:url('.$about_image.')" ></div>';
		$html .= '</div>';
		$html .= '<div class="wrapper-inner wr-about-cotainer">';
		$html .= '<div class="align-content">';
		$html .= '<section>';
		$html .= '<div class="container small-container">';
		$html .= '<h3 class="dec-text">'.$title.'</h3>';
		$html .= '<p>';
		$html .= do_shortcode($content);
		$html .= '</p>';
		if($buttonurl != '') {
		$html .= '<a href="'.$buttonurl.'" class="'.$ajaxclass.' btn anim-button   trans-btn   transition  fl-l" target="_blank"><span>'.$buttontext.'</span><i class="fa fa-eye"></i></a>';
		}
		$html .= '</div>';
		$html .= '</section>';
		$html .= '</div>';
		$html .= '</div>';
		
				
		return $html ;
	}
	add_shortcode('wr_about', 'wr_about_shortcode');
}

