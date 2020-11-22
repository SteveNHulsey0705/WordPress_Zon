
 <!--  Navigation --> 
                    <div class="nav-overlay"></div>
                    <div class="nav-inner isDown">
                        <nav>
                            <ul class="wr-menu">
                                <?php

										$defaults = array(
													'theme_location'  => 'top-menu',
													'menu'            => 'nav',
													'container'       => '',
													'container_class' => '',
													'menu_class'      => 'navbar-main-menu',
													'menu_id'         => '',
													'echo'            => true,
													'fallback_cb'     => 'wp_page_menu',
													'before'          => '',
													'after'           => '',
													'link_before'     => '',
													'link_after'      => '',
													'items_wrap'      => '%3$s',
													'depth'           => 0,
													
														);
								if(has_nav_menu('top-menu')) {
														wp_nav_menu( $defaults );
								}
										  else {
											echo '<li><a>No menu assigned!</a></li>';
										  }
														?>
                            </ul>
                        </nav>
                    </div>
                    <!--  Navigation end --> 