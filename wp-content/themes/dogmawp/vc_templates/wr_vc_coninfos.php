<?php

$args = array(
    	'title'=>'',
    	'contf'=>'',
    	'wrtext'=>'',
    	'buttontext'=>'',
);

$html = "";

extract(shortcode_atts($args, $atts));

$html .= '<div class="wrapper-inner">';
$html .= '<div class="align-content">';
$html .= '<section>';
$html .= '<div class="container small-container">';
$html .= '<h3 class="dec-text">'.$title.'</h3>';
$html .= '<p>'.$wrtext.'</p>';
$html .= '<ul class="contact-list">';
$html .= do_shortcode($content);
$html .= '</ul>';
if($contf != '') {
$html .= '<a href="#" class=" btn anim-button   trans-btn   transition  fl-l showform"><span>'.$buttontext.'</span><i class="fa fa-eye"></i></a>';
}
$html .= '</div>';
$html .= '</section>';
$html .= '</div>';

$html .= '<div class="contact-form-holder">';
$html .= '<div class="close-contact"></div>';
$html .= '<div class="align-content">';
$html .= '<section>';
$html .= '<div id="contact-form">';
$html .= '<div id="message"></div>';
$html .= do_shortcode('[contact-form-7 id="'.$contf.'" title="Contact form 1"]');
$html .= '</div>';
$html .= '</section>';
$html .= '</div>';
$html .= '</div>';

$html .= '</div>';
$html .= '<div class="fixed-column">
          <div class="map-box">
          <div  id="map-canvas"></div>
          </div>
          </div>';

echo $html;