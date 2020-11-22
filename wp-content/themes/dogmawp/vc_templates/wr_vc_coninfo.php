<?php

$args = array(
		'class'=>'',
		'title'=>'',
		'deatils'=>'',
		'url'=>'',
		'target'=>'',
		
		
);

extract(shortcode_atts($args, $atts));

$html = '';

    $html .= '<li><span>'.$title.' </span>';
    $html .= '<a href="'.$url.'" target="'.$target.'" >'.$deatils.'</a>';
    $html .= '</li>';
    


echo $html;