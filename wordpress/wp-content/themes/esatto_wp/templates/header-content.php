<!-- NavBar container -->
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<!-- NavBar Title -->
			<a class="brand" data-toggle="collapse" data-target=".nav-collapse"><span class="sosa">m</span>Menu</a>
			<div class="nav-collapse collapse navbar-responsive-collapse">
				<!-- NavBar section list -->
				<?php
                    if( has_nav_menu( 'primary' ) ) {
                        $menu = spyropress_get_nav_menu(
                            'primary', array(
                                'menu_id' => 'nav',
                                'menu_class' => 'nav nav-main pull-left',
                                'container' => false,
                                'echo' => false
                            )
                        );
                        $url = is_front_page() ? '#' : home_url('/#');
                        echo str_replace( '#HOME_URL#', $url, $menu );
                    }
                ?>
				<!-- NavBar right list -->
                <?php
                    if( has_nav_menu( 'tertiary' ) ) {
                        $menu = spyropress_get_nav_menu(              
                            'tertiary', array(                        
                                'menu_class' => 'nav nav-divider pull-left',
                                'container' => false,                 
                                'echo' => false                       
                            )                                         
                        );                                            
                        $url = is_front_page() ? '#' : home_url('/#');
                        echo str_replace( '#HOME_URL#', $url, $menu );
                    }
                ?>
				<?php if( !get_setting( 'search_box' ) ) {
				    get_search_form();
				}
                
                $socials = get_setting_array( 'socials' );
                if( !empty( $socials ) ) {
                    echo '<!-- NavBar social --><ul class="nav social-nav pull-right">';
                    foreach( $socials as $item ) {
                        echo '<li><a href="' . $item['link'] . '"><span class="sosa">&#x' . $item['network'] . ';</span></a></li>';
                    }
                    
                    echo '</ul>';
                }
                ?>
				<!-- NavBar Blog list -->
                <?php
                    if( has_nav_menu( 'secondary' ) ) {
                        $menu = spyropress_get_nav_menu(
                            'secondary', array(
                                'menu_class' => 'nav nav-divider-right pull-right',
                                'container' => false,
                                'echo' => false
                            )
                        );
                        $url = is_front_page() ? '#' : home_url('/#');
                        echo str_replace( '#HOME_URL#', $url, $menu );
                    }
                ?>
			</div>
		</div>
	</div>
</div>