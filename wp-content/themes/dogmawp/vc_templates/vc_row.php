<?php
$output = $el_class = '';
extract(shortcode_atts(array(
	'el_class' => '',
	'row_type' => 'row',
	'use_as_box' => '',
	'type' => 'full_width',
	'anchor' => '',
	'text_align2' => '',
	'in_content_menu'=>'',
	'content_menu_title' => '',
	'content_menu_icon' => '',
	'video' => '',
	'video_overlay' => '',
	'video_overlay_image' => '',
	'quoverlay' => '',
	'quconlayout' => '',
	'qutitle' => '',
	'qusubtitle' => '',
	'qubackstyle' => '',
	'video_webm' => '',
	'video_mp4' => '',
	'video_ogv' => '',
	'video_image' => '',
	'background_color' => '',
	'section_height' => '',
    'parallax_speed' => '1',
	'background_image' => '',
	'border_color' => '',
	'padding_top' => '',
	'padding_bottom' => '',
	'side_padding' => '',
	'text_align' => 'left',
	'more_button_label' =>'More Facts',
	'less_button_label'=>'Less Facts',
	'button_position'=>'center',
	'color'=>'',
	'hover_color'=>'',
	'content_background_color' => '',
	'css_animation'=>'',
	'transition_delay'=>'',
	'halfshadow'=>'',
	'shadow_wr_color'=>'',

), $atts));

wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);



if($type == "grid"){
	$css_class_type =  " grid_section";
} else {
	$css_class_type =  "";
}

if($type == "grid"){
	$css_class_type_inner =  " section_inner";
} else {
	$css_class_type_inner =  " full_section_inner";
}

$css_class_video =  "";
if($video == "show_video"){
	$css_class_video =  " video_section";
}

$css_class_quoverlay =  "";
if($quoverlay == "qu_ov_def"){
	$css_class_quoverlay =  " qu-default";
}
 else if ($quoverlay == "qu_ov_dark"){
	$css_class_quoverlay =  "block-bg-banner";
}

 else if ($quoverlay == "qu_ov_light"){
	$css_class_quoverlay =  "light-overlay";
}

$css_class_qugrilayout =  "";
if($quconlayout == "qu_full_width"){
	$css_class_qugrilayout =  "wr-container";
}
 else if ($quconlayout == "qu_grid"){
	$css_class_qugrilayout =  "container";
}

$css_class_qugrirow =  "";
if($quconlayout == "qu_full_width"){
	$css_class_qugrirow =  "qu-ful-width-section-row";
}
 else if ($quconlayout == "qu_grid"){
	$css_class_qugrirow =  "row";
}
else{
$css_class_qugrirow =  "row no-margin";
}

$css_show_wr_shadow_color =  "";
if($shadow_wr_color != ''){
$css_show_wr_shadow_color =  'style="background-color:'.$shadow_wr_color.'"';
} 
$css_show_wr_shadow =  "";
if($halfshadow == "yes"){
$css_show_wr_shadow =  '<div class="bg-50-l" '.$css_show_wr_shadow_color.'></div>';
} 





$css_class_in_content_menu =  "";
if($in_content_menu == "in_content_menu"){
	$css_class_in_content_menu =  " in_content_menu";
}

$_image ="";
if($background_image != '' || $background_image != ' ') { 
	$_image = wp_get_attachment_image_src( $background_image, 'full');
}

$overlay_image ="";
if($video_overlay_image != '' && $video_overlay_image != ' ') { 
	$overlay_image = wp_get_attachment_image_src( $video_overlay_image, 'full');
}

if($css_animation != ""){
	$clsss_css_animation =  "  " . $css_animation;
} else {
	$clsss_css_animation =  "";
}
$delay = "";
if($transition_delay != ""){
	$delay = " style='transition-delay:" . $transition_delay . "ms; animation-delay:" . $transition_delay . "ms; -webkit-animation-delay: " . $transition_delay . "ms'";
}
$anchor_id = "";
if($anchor != ""){
	$anchor_id = ' data-q_id="#'.$anchor.'"';
}

$menu_title = "";
if($content_menu_title != ""){
	$menu_title = ' data-q_title="'.$content_menu_title.'"';
}

$menu_icon = "";
if($content_menu_icon != ""){
	$menu_icon = ' data-q_icon="'.$content_menu_icon.'"';
}

$use_row_as_box_class="";
if($use_as_box == 'use_row_as_box'){
	$use_row_as_box_class = ' use_row_as_box';
}

if($row_type == 'row') {
	$output .= '<div '.$anchor_id.' '.$menu_title.' '.$menu_icon.' class="row '  . $css_class_type . $css_class_in_content_menu . $css_class_video . $use_row_as_box_class . '"';
	if($background_color != "" || $border_color != "" || $padding_top != "" || $padding_bottom != "" || $text_align != "" || $_image != ""){
			$output .= " style='";
				if($background_color != ""){
					$output .="background-color:".$background_color.";";
				}
				if($_image != ""){
					$output .="background-image:url(".$_image[0].");";
				}
				if($border_color != ""){
					if($use_as_box == 'use_row_as_box') {
						$output .=" border: 1px solid ".$border_color.";";
					}else {
						$output .=" border-bottom: 1px solid ".$border_color.";";
					}
				}
				if($padding_top != ""){
					$output .=" padding-top:".$padding_top."px;";
				}
				if($padding_bottom != ""){
					$output .=" padding-bottom:".$padding_bottom."px;";
				}
				$output .= ' text-align:' . $text_align . ';';
				$output.="'";
		}
	$output.=">";
	if($video == "show_video"){
		$v_image = wp_get_attachment_url($video_image);
		$v_overlay_image = wp_get_attachment_url($video_overlay_image);
		
		$output .= '<div class="mobile-video-image" style="background-image: url('.$v_image.')"></div><div class="video-overlay';
								if($video_overlay == "show_video_overlay"){
									$output .= ' active';
								}
								$output .= '"';
								$output .= ($overlay_image !== '' && $overlay_image !== ' ') ? " style='background-image:url(" . $overlay_image[0] . ");'" : '';
								$output .= '></div><div class="video-wrap">
									
									<video class="video" width="1920" height="800" poster="'.$v_image.'" controls="controls" preload="auto" loop autoplay muted>';
											if(!empty($video_webm)) { $output .= '<source type="video/webm" src="'.$video_webm.'">'; }
											if(!empty($video_mp4)) { $output .= '<source type="video/mp4" src="'.$video_mp4.'">'; }
											if(!empty($video_ogv)) { $output .= '<source type="video/ogg" src="'. $video_ogv.'">'; }
										 $output .='<object width="320" height="240" type="application/x-shockwave-flash" data="'.get_template_directory_uri().'/js/flashmediaelement.swf">
													<param name="movie" value="'.get_template_directory_uri().'/js/flashmediaelement.swf" />
													<param name="flashvars" value="controls=true&file='.$video_mp4.'" />
													<img src="'.$v_image.'" width="1920" height="800" title="No video playback capabilities" alt="Video thumb" />
											</object>
									</video>		
							</div>';
	}
	$output .= '<div class="' . $css_class_type_inner . ' clearfix"';
	if($side_padding != ""){
			$output .= " style='padding: 0% ".$side_padding."%'";
		}
	$output .= '>';
	if($type == "grid"){
		$output .= "<div class='section_inner_margin clearfix'>";
	}
	if($row_type == "row" && $css_animation != ""){
		$output .= '<div class="'. $clsss_css_animation .'"><div'. $delay .'>';
	}
}
else if($row_type == 'qubackcolor'){
    $output .='<div '.$anchor_id.' class="wr_row_fluid '.$css_class_in_content_menu.'" style = "background-color:'.$qubackstyle.';background-size: cover;background-position: center center;';
	$output .= ($background_image !== '' || $background_image !== ' ') ? " background-image:url('" . $_image[0] . "');" : "";
    $output .= '"';
    $output .= '>';
	$output .='<div class="'.$css_class_qugrilayout.' '.$text_align2.' clearfix" style="';
	if($padding_top != ""){
					$output .=" padding-top:".$padding_top."px;";
				}
				if($padding_bottom != ""){
					$output .=" padding-bottom:".$padding_bottom."px;";
				}
	
	$output .='">';
	

}

else if($row_type == 'wrisotope'){
    $output .='<div '.$anchor_id.' class="wr_row_fluid '.$css_class_in_content_menu.'" style = "background-color:'.$qubackstyle.';background-size: cover;background-position: center center;';
	$output .= ($background_image !== '' || $background_image !== ' ') ? " background-image:url('" . $_image[0] . "');" : "";
    $output .= '"';
    $output .= '>';
	$output .='<div class="container clearfix" style="';
	if($padding_top != ""){
					$output .=" padding-top:".$padding_top."px;";
				}
				if($padding_bottom != ""){
					$output .=" padding-bottom:".$padding_bottom."px;";
				}
	
	$output .='">';
	$output .='<div class="break"></div>';
	$output .='<div class="isotope-container wr-iso-main">';
	

}



 else if($row_type == 'content_menu'){
    $output .= '<nav class="content_menu"';
    if($background_color != ""){
        $output .= " style='background-color:".$background_color.";'";
    }
    $output .= '>';
    $output .= "<div class='nav_select_menu clearfix'><div class='nav_select_button'><i class='fa fa-bars'></i></div></div>";
}
if($row_type != 'content_menu'){
	$output .= wpb_js_remove_wpautop($content);
}
if($row_type == 'row') {
	if($css_animation != "") { 
		$output .= '</div></div>';
	}
		if($type == "grid"){
			$output .= "</div>";
		}
		$output .= '</div>';


	$output .= '</div><div class="break"></div>'.$this->endBlockComment('row');
}elseif($row_type == 'qubackcolor'){
	$output .= '</div><div class="big-break"></div></div>'.$this->endBlockComment('row');
}
elseif($row_type == 'wrisotope'){
	$output .= '</div></div><div class="big-break"></div></div>'.$this->endBlockComment('row');
}
else if($row_type == 'content_menu'){
	$output .= '</nav>';
}
echo $output;