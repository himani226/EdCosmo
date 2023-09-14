<?php
/**
 * Upgrade theme to the PRO version
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0.41
 */


// Add buttons, tabs and form to the 'Theme panel' screen
//--------------------------------------------------------------------


// Add table 'Free vs PRO' to the 'General' section
if ( ! function_exists( 'yolox_pro_add_section_to_about' ) ) {
	add_action( 'trx_addons_action_theme_panel_section_end', 'yolox_pro_add_section_to_about', 10, 2 );
	function yolox_pro_add_section_to_about( $tab_id, $theme_info ) {
		if ( 'general' !== $tab_id ) {
			return;
		}
		?>
		<div class="yolox_theme_panel_table_free_vs_pro">
			<div class="yolox_theme_panel_table_row yolox_theme_panel_table_head">
				<div class="yolox_theme_panel_table_info">
					&nbsp;
				</div>
				<div class="yolox_theme_panel_table_check">
					<?php esc_html_e( 'Free version', 'yolox' ); ?>
				</div>
				<div class="yolox_theme_panel_table_check">
					<?php esc_html_e( 'PRO version', 'yolox' ); ?>
				</div>
			</div>
			<div class="yolox_theme_panel_table_row">
				<div class="yolox_theme_panel_table_info">
					<h2 class="yolox_theme_panel_table_info_title">
						<?php esc_html_e( 'Mobile friendly', 'yolox' ); ?>
					</h2>
					<div class="yolox_theme_panel_table_info_description">
						<?php esc_html_e( 'Responsive layout. Looks great on any device.', 'yolox' ); ?>
					</div>
				</div>
				<div class="yolox_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
				<div class="yolox_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
			</div>
			<div class="yolox_theme_panel_table_row">
				<div class="yolox_theme_panel_table_info">
					<h2 class="yolox_theme_panel_table_info_title">
						<?php esc_html_e( 'Built-in posts slider', 'yolox' ); ?>
					</h2>
					<div class="yolox_theme_panel_table_info_description">
						<?php esc_html_e( 'Allows you to add beautiful slides using the built-in shortcode/widget "Slider" with swipe gestures support.', 'yolox' ); ?>
					</div>
				</div>
				<div class="yolox_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
				<div class="yolox_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
			</div>
			<?php
			// Revolution slider
			if ( isset( $theme_info['theme_plugins']['revslider'] ) ) {
				?>
				<div class="yolox_theme_panel_table_row">
					<div class="yolox_theme_panel_table_info">
						<h2 class="yolox_theme_panel_table_info_title">
							<?php esc_html_e( 'Revolution Slider Compatibility', 'yolox' ); ?>
						</h2>
						<div class="yolox_theme_panel_table_info_description">
							<?php esc_html_e( 'Our built-in shortcode/widget "Slider" is able to work not only with posts, but also with slides created  in "Revolution Slider".', 'yolox' ); ?>
						</div>
					</div>
					<div class="yolox_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
					<div class="yolox_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
				</div>
				<?php
			}
			if ( isset( $theme_info['theme_plugins']['siteorigin-panels'] ) ) {
				?>
				<div class="yolox_theme_panel_table_row">
					<div class="yolox_theme_panel_table_info">
						<h2 class="yolox_theme_panel_table_info_title">
							<?php esc_html_e( 'SiteOrigin Panels (free PageBuilder)', 'yolox' ); ?>
						</h2>
						<div class="yolox_theme_panel_table_info_description">
							<?php esc_html_e( 'Full integration with a nice free page builder "SiteOrigin Panels".', 'yolox' ); ?>
						</div>
					</div>
					<div class="yolox_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
					<div class="yolox_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
				</div>
				<div class="yolox_theme_panel_table_row">
					<div class="yolox_theme_panel_table_info">
						<h2 class="yolox_theme_panel_table_info_title">
							<?php esc_html_e( 'Additional widgets pack', 'yolox' ); ?>
						</h2>
						<div class="yolox_theme_panel_table_info_description">
							<?php esc_html_e( 'A number of useful widgets to create beautiful homepages and other sections of your website with SiteOrigin Panels.', 'yolox' ); ?>
						</div>
					</div>
					<div class="yolox_theme_panel_table_check"><i class="dashicons dashicons-no"></i></div>
					<div class="yolox_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
				</div>
				<?php
			}
			if ( isset( $theme_info['theme_plugins']['elementor'] ) ) {
				?>
				<div class="yolox_theme_panel_table_row">
					<div class="yolox_theme_panel_table_info">
						<h2 class="yolox_theme_panel_table_info_title">
							<?php esc_html_e( 'Elementor (free PageBuilder)', 'yolox' ); ?>
						</h2>
						<div class="yolox_theme_panel_table_info_description">
							<?php esc_html_e( 'Full integration with a nice free page builder "Elementor".', 'yolox' ); ?>
						</div>
					</div>
					<div class="yolox_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
					<div class="yolox_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
				</div>
				<?php
			}
			if ( isset( $theme_info['theme_plugins']['js_composer'] ) ) {
				?>
				<div class="yolox_theme_panel_table_row">
					<div class="yolox_theme_panel_table_info">
						<h2 class="yolox_theme_panel_table_info_title">
							<?php esc_html_e( 'WPBakery PageBuilder', 'yolox' ); ?>
						</h2>
						<div class="yolox_theme_panel_table_info_description">
							<?php esc_html_e( 'Full integration with a very popular page builder "WPBakery PageBuilder". A number of useful shortcodes and widgets to create beautiful homepages and other sections of your website.', 'yolox' ); ?>
						</div>
					</div>
					<div class="yolox_theme_panel_table_check"><i class="dashicons dashicons-no"></i></div>
					<div class="yolox_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
				</div>
				<div class="yolox_theme_panel_table_row">
					<div class="yolox_theme_panel_table_info">
						<h2 class="yolox_theme_panel_table_info_title">
							<?php esc_html_e( 'Additional shortcodes pack', 'yolox' ); ?>
						</h2>
						<div class="yolox_theme_panel_table_info_description">
							<?php esc_html_e( 'A number of useful shortcodes to create beautiful homepages and other sections of your website with WPBakery PageBuilder.', 'yolox' ); ?>
						</div>
					</div>
					<div class="yolox_theme_panel_table_check"><i class="dashicons dashicons-no"></i></div>
					<div class="yolox_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
				</div>
				<?php
			}
			?>
			<div class="yolox_theme_panel_table_row">
				<div class="yolox_theme_panel_table_info">
					<h2 class="yolox_theme_panel_table_info_title">
						<?php esc_html_e( 'Headers and Footers builder', 'yolox' ); ?>
					</h2>
					<div class="yolox_theme_panel_table_info_description">
						<?php esc_html_e( 'Powerful visual builder of headers and footers! No manual code editing - use all the advantages of drag-and-drop technology.', 'yolox' ); ?>
					</div>
				</div>
				<div class="yolox_theme_panel_table_check"><i class="dashicons dashicons-no"></i></div>
				<div class="yolox_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
			</div>
			<?php
			if ( isset( $theme_info['theme_plugins']['easy-digital-downloads'] ) ) {
				?>
				<div class="yolox_theme_panel_table_row">
					<div class="yolox_theme_panel_table_info">
						<h2 class="yolox_theme_panel_table_info_title">
							<?php esc_html_e( 'Easy Digital Downloads Compatibility', 'yolox' ); ?>
						</h2>
						<div class="yolox_theme_panel_table_info_description">
							<?php esc_html_e( 'Ready for digital e-commerce. You can build an online digital store with this theme.', 'yolox' ); ?>
						</div>
					</div>
					<div class="yolox_theme_panel_table_check"><i class="dashicons dashicons-no"></i></div>
					<div class="yolox_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
				</div>
				<?php
			}
			?>
			<div class="yolox_theme_panel_table_row">
				<div class="yolox_theme_panel_table_info">
					<h2 class="yolox_theme_panel_table_info_title">
						<?php esc_html_e( 'Many other popular plugins compatibility', 'yolox' ); ?>
					</h2>
					<div class="yolox_theme_panel_table_info_description">
						<?php esc_html_e( 'PRO version is compatible (was tested and has built-in support) with many popular plugins.', 'yolox' ); ?>
					</div>
				</div>
				<div class="yolox_theme_panel_table_check"><i class="dashicons dashicons-no"></i></div>
				<div class="yolox_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
			</div>
			<div class="yolox_theme_panel_table_row">
				<div class="yolox_theme_panel_table_info">
					<h2 class="yolox_theme_panel_table_info_title">
						<?php esc_html_e( 'Support', 'yolox' ); ?>
					</h2>
					<div class="yolox_theme_panel_table_info_description">
						<?php esc_html_e( 'Our premium support is going to take care of any problems, in case there will be any of course.', 'yolox' ); ?>
					</div>
				</div>
				<div class="yolox_theme_panel_table_check"><i class="dashicons dashicons-no"></i></div>
				<div class="yolox_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
			</div>
			<div class="yolox_theme_panel_table_row">
				<div class="yolox_theme_panel_table_info">&nbsp;</div>
				<div class="yolox_theme_panel_table_check">
					<a href="#" target="_blank" class="trx_addons_classic_block_link trx_addons_pro_link button button-action">
						<?php esc_html_e( 'Get PRO version', 'yolox' ); ?>
					</a>
				</div>
			</div>
		</div>
		<?php
	}
}


// Add button 'Get PRO Version' to the 'About theme' screen
if ( ! function_exists( 'yolox_pro_add_button' ) ) {
	remove_action('trx_addons_action_theme_panel_activation_form', 'trx_addons_theme_panel_activation_form');
	add_action( 'trx_addons_action_theme_panel_activation_form', 'yolox_pro_add_button', 10, 2 );
	function yolox_pro_add_button( $tab_id, $theme_info ) {
		if ( 'general' !== $tab_id ) {
			return;
		}
		?>
		<a href="#" class="yolox_pro_link button button-action"><?php esc_html_e( 'Get PRO version', 'yolox' ); ?></a>
		<?php
	}
}


// Show form
if ( ! function_exists( 'yolox_pro_add_form' ) ) {
	add_action( 'trx_addons_action_theme_panel_activation_form', 'yolox_pro_add_form', 12, 2 );
	function yolox_pro_add_form( $tab_id, $theme_info ) {
		if ( 'general' !== $tab_id ) {
			return;
		}
		?>
		<div class="yolox_pro_form_wrap">
			<div class="yolox_pro_form">
				<span class="yolox_pro_close"><?php esc_html_e( 'Close', 'yolox' ); ?></span>
				<h2 class="yolox_pro_title">
				<?php
					echo esc_html(
						sprintf(
							// Translators: Add theme name and version to the 'Upgrade to PRO' message
							__( 'Upgrade %1$s Free v.%2$s to PRO', 'yolox' ),
							$theme_info['theme_name'],
							$theme_info['theme_version']
						)
					);
				?>
				</h2>
				<div class="yolox_pro_fields">
					<div class="yolox_pro_field yolox_pro_step1">
						<h3 class="yolox_pro_step_title"><?php esc_html_e( 'Step 1', 'yolox' ); ?></h3>
						<a href="<?php echo esc_url( yolox_storage_get( 'theme_download_url' ) ); ?>" target="_blank" class="yolox_pro_link_get">
											<?php
											esc_html_e( 'Get PRO License Key', 'yolox' );
											?>
						</a>
					</div>
					<div class="yolox_pro_field yolox_pro_step2">
						<h3 class="yolox_pro_step_title"><?php esc_html_e( 'Step 2', 'yolox' ); ?></h3>
						<label><span class="yolox_pro_label"><?php esc_html_e( 'Paste License Key here:', 'yolox' ); ?></span>
							<input type="text" class="yolox_pro_key" value="" placeholder="<?php esc_attr_e( 'License Key', 'yolox' ); ?>">
						</label>
						<a href="#" class="button button-action yolox_pro_upgrade" disabled="disabled">
						<?php
							esc_html_e( 'Upgrade to PRO Version', 'yolox' );
						?>
						</a>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}


// Add messages to the admin script for both - 'About' screen and Customizer
if ( ! function_exists( 'yolox_pro_add_messages' ) ) {
	add_filter( 'yolox_filter_localize_script_admin', 'yolox_pro_add_messages' );
	function yolox_pro_add_messages( $vars ) {
		$vars['msg_get_pro_error']    = esc_html__( 'Error getting data from the update server!', 'yolox' );
		$vars['msg_get_pro_upgrader'] = esc_html__( 'Upgrade details:', 'yolox' );
		$vars['msg_get_pro_success']  = esc_html__( 'Theme upgraded successfully! Now you have the PRO version!', 'yolox' );
		return $vars;
	}
}



// Create control for Customizer
//--------------------------------------------------------------------

// Theme init priorities:
// 3 - add/remove Theme Options elements
if ( ! function_exists( 'yolox_pro_theme_setup3' ) ) {
	add_action( 'after_setup_theme', 'yolox_pro_theme_setup3', 3 );
	function yolox_pro_theme_setup3() {

		// Add section "Get PRO Version" if current theme is free
		// ------------------------------------------------------
		yolox_storage_set_array_before(
			'options', 'title_tagline', array(
				'pro_section' => array(
					'title'    => esc_html__( 'Get PRO Version', 'yolox' ),
					'desc'     => '',
					'priority' => 5,
					'type'     => 'section',
				),
				'pro_version' => array(
					'title'   => esc_html__( 'Upgrade to the PRO Version', 'yolox' ),
					'desc'    => wp_kses_data( __( 'Get the PRO License Key and paste it to the field below to upgrade current theme to the PRO Version', 'yolox' ) ),
					'std'     => '',
					'refresh' => false,
					'type'    => 'get_pro_version',
				),
			)
		);
	}
}


// Register custom controls for the customizer
if ( ! function_exists( 'yolox_pro_customizer_custom_controls' ) ) {
	add_action( 'customize_register', 'yolox_pro_customizer_custom_controls' );
	function yolox_pro_customizer_custom_controls( $wp_customize ) {
		class Yolox_Customize_Get_Pro_Version_Control extends WP_Customize_Control {
			public $type = 'get_pro_version';

			public function render_content() {
				?>
				<div class="customize-control-wrap">
				<?php
				if ( ! empty( $this->label ) ) {
					?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<?php
				}
				if ( ! empty( $this->description ) ) {
					?>
					<span class="customize-control-description description"><?php yolox_show_layout( $this->description ); ?></span>
					<?php
				}
				?>
				<span class="customize-control-field-wrap">
					<?php
					$theme = wp_get_theme();
					yolox_pro_add_form( 'general', array(
						'theme_name' => $theme->name,
						'theme_version' => $theme->version,
						)
					);
					?>
				</span></div>
				<?php
			}
		}
	}
}


// Register custom controls for the customizer
if ( ! function_exists( 'yolox_pro_customizer_register_controls' ) ) {
	add_filter( 'yolox_filter_register_customizer_control', 'yolox_pro_customizer_register_controls', 10, 7 );
	function yolox_pro_customizer_register_controls( $result, $wp_customize, $id, $section, $priority, $transport, $opt ) {

		if ( 'get_pro_version' == $opt['type'] ) {
			$wp_customize->add_setting(
				$id, array(
					'default'           => yolox_get_theme_option( $id ),
					'sanitize_callback' => ! empty( $opt['sanitize'] )
												? $opt['sanitize']
												: 'wp_kses_post',
					'transport'         => $transport,
				)
			);

			$wp_customize->add_control(
				new Yolox_Customize_Get_Pro_Version_Control(
					$wp_customize, $id, array(
						'label'           => $opt['title'],
						'description'     => $opt['desc'],
						'section'         => esc_attr( $section ),
						'priority'        => $priority,
						'active_callback' => ! empty( $opt['active_callback'] ) ? $opt['active_callback'] : '',
					)
				)
			);

			$result = true;
		}

		return $result;
	}
}



// Upgrade theme to PRO version
//--------------------------------------------------------------------

// AJAX callback - validate key and get PRO version
if ( ! function_exists( 'yolox_pro_get_pro_version_callback' ) ) {
	add_action( 'wp_ajax_yolox_get_pro_version', 'yolox_pro_get_pro_version_callback' );
	function yolox_pro_get_pro_version_callback() {
		if ( ! wp_verify_nonce( yolox_get_value_gp( 'nonce' ), admin_url( 'admin-ajax.php' ) ) || ! current_user_can( 'manage_options' ) ) {
			wp_die();
		}

		$response = array(
			'error' => '',
			'data'  => '',
		);

		$key = yolox_get_value_gp( 'license_key' );

		if ( ! empty( $key ) ) {
			$theme_slug = get_option( 'template' );
			$theme_name = wp_get_theme()->name;
			// Translators: Add the key and theme slug to the link
			$upgrade_url = sprintf(
				yolox_get_protocol() . '://upgrade.themerex.net/upgrade.php?key=%1$s&src=%2$s&theme_slug=%3$s&theme_name=%4$s',
				urlencode( $key ),
				urlencode( yolox_storage_get( 'theme_pro_key' ) ),
				urlencode( $theme_slug ),
				urlencode( $theme_name )
			);
			$result      = function_exists( 'trx_addons_fgc' ) ? trx_addons_fgc( $upgrade_url ) : yolox_fgc( $upgrade_url );
			if ( substr( $result, 0, 5 ) == 'a:2:{' && substr( $result, -1, 1 ) == '}' ) {
				try {
					// JSON is bad working with big data:
										// Use serialization instead:
					$result = yolox_unserialize( $result );
				} catch ( Exception $e ) {
					$result = array(
						'error' => esc_html__( 'Unrecognized server answer!', 'yolox' ),
						'data'  => '',
					);
				}
				if ( isset( $result['error'] ) && isset( $result['data'] ) ) {
					if ( substr( $result['data'], 0, 2 ) == 'PK' ) {
						$tmp_name = 'tmp-' . rand() . '.zip';
						$tmp      = wp_upload_bits( $tmp_name, null, $result['data'] );
						if ( $tmp['error'] ) {
							$response['error'] = esc_html__( 'Problem with save upgrade file to the folder with uploads', 'yolox' );
						} else {
							if ( file_exists( $tmp['file'] ) ) {
								ob_start();
								// Upgrade theme
								$response['error'] .= yolox_pro_upgrade_theme( $theme_slug, $tmp['file'] );
								// Remove uploaded archive
								unlink( $tmp['file'] );
								// Upgrade plugin
								$plugin      = 'yolox';
								$plugin_path = yolox_get_file_dir( "plugins/{$plugin}/{$plugin}.zip" );
								if ( ! empty( $plugin_path ) ) {
									$response['error'] .= yolox_pro_upgrade_plugin( $plugin, $plugin_path );
								}
								$log = ob_get_contents();
								ob_end_clean();
								// Mark theme as activated
								update_option( sprintf( 'trx_addons_theme_%s_activated', $theme_slug), 1);
							} else {
								$response['error'] = esc_html__( 'Uploaded file with upgrade package not available', 'yolox' );
							}
						}
					} else {
						$response['error'] = ! empty( $result['error'] )
														? $result['error']
														: esc_html__( 'Package with upgrade is corrupt', 'yolox' );
					}
				} else {
					$response['error'] = esc_html__( 'Incorrect server answer', 'yolox' );
				}
			} else {
				$response['error'] = esc_html__( 'Unrecognized server answer format:', 'yolox' ) . strlen( $result ) . ' "' . substr( $result, 0, 100 ) . '...' . substr( $result, -100 ) . '"';
			}
		} else {
			$response['error'] = esc_html__( 'Entered key is not valid!', 'yolox' );
		}

		echo json_encode( $response );
		wp_die();
	}
}


// Upgrade theme from uploaded file
if ( ! function_exists( 'yolox_pro_upgrade_theme' ) ) {
	function yolox_pro_upgrade_theme( $theme_slug, $path ) {

		$msg = '';

		$theme = wp_get_theme();

		// Load WordPress Upgrader
		if ( ! class_exists( 'Theme_Upgrader', false ) ) {
			require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
		}

		// Prep variables for Theme_Installer_Skin class
		$extra         = array();
		$extra['slug'] = $theme_slug;   // Needed for potentially renaming of directory name
		$source        = $path;
		$api           = null;

		$url = add_query_arg(
			array(
				'action' => 'update-theme',
				'theme'  => urlencode( $theme_slug ),
			),
			'update.php'
		);

		// Create Skin
		$skin_args = array(
			'type'  => 'upload',
			'title' => '',
			'url'   => esc_url_raw( $url ),
			'nonce' => 'update-theme_' . $theme_slug,
			'theme' => $path,
			'api'   => $api,
			'extra' => array(
				'slug' => $theme_slug,
			),
		);
		$skin      = new Theme_Upgrader_Skin( $skin_args );

		// Create a new instance of Theme_Upgrader
		$upgrader = new Theme_Upgrader( $skin );

		// Inject our info into the update transient
		$repo_updates = get_site_transient( 'update_themes' );
		if ( ! is_object( $repo_updates ) ) {
			$repo_updates = new stdClass;
		}
		if ( empty( $repo_updates->response[ $theme_slug ] ) ) {
			$repo_updates->response[ $theme_slug ] = array();
		}
		$repo_updates->response[ $theme_slug ]['slug']        = $theme_slug;
		$repo_updates->response[ $theme_slug ]['theme']       = $theme_slug;
		$repo_updates->response[ $theme_slug ]['new_version'] = $theme->version;
		$repo_updates->response[ $theme_slug ]['package']     = $path;
		$repo_updates->response[ $theme_slug ]['url']         = $path;
		set_site_transient( 'update_themes', $repo_updates );

		// Upgrade theme
		$upgrader->upgrade( $theme_slug );

		return $msg;
	}
}


// Upgrade plugin from uploaded file
if ( ! function_exists( 'yolox_pro_upgrade_plugin' ) ) {
	function yolox_pro_upgrade_plugin( $plugin_slug, $path ) {

		$msg = '';

		// Load plugin utilities
		if ( ! function_exists( 'get_plugin_data' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		// Detect plugin path
		$plugin_base = "{$plugin_slug}/{$plugin_slug}.php";
		$plugin_path = trailingslashit( WP_PLUGIN_DIR ) . $plugin_base;

		// If not installed - exit
		if ( ! file_exists( $plugin_path ) ) {
			return '';
		}

		// Get plugin info
		$plugin_data = get_plugin_data( $plugin_path );
		$tmp         = explode( '.', $plugin_data['Version'] );
		$tmp[ count( $tmp ) - 1 ]++;
		$plugin_data['Version'] = implode( '.', $tmp );

		// Load WordPress Upgrader
		if ( ! class_exists( 'Plugin_Upgrader', false ) ) {
			require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
		}

		// Prep variables for Plugin_Installer_Skin class
		$extra         = array();
		$extra['slug'] = $plugin_slug;  // Needed for potentially renaming of directory name
		$source        = $path;
		$api           = null;

		$url = add_query_arg(
			array(
				'action' => 'update-plugin',
				'theme'  => urlencode( $plugin_slug ),
			),
			'update.php'
		);

		// Create Skin
		$skin_args = array(
			'type'  => 'upload',
			'title' => '',
			'url'   => esc_url_raw( $url ),
			'nonce' => 'update-plugin_' . $plugin_slug,
			'theme' => $path,
			'api'   => $api,
			'extra' => array(
				'slug' => $plugin_slug,
			),
		);
		$skin      = new Plugin_Upgrader_Skin( $skin_args );

		// Create a new instance of Theme_Upgrader
		$upgrader = new Plugin_Upgrader( $skin );

		// Inject our info into the update transient
		$repo_updates = get_site_transient( 'update_plugins' );
		if ( ! is_object( $repo_updates ) ) {
			$repo_updates = new stdClass;
		}
		if ( empty( $repo_updates->response[ $plugin_base ] ) ) {
			$repo_updates->response[ $plugin_base ] = new stdClass;
		}
		$repo_updates->response[ $plugin_base ]->slug        = $plugin_slug;
		$repo_updates->response[ $plugin_base ]->plugin      = $plugin_base;
		$repo_updates->response[ $plugin_base ]->new_version = $plugin_data['Version'];
		$repo_updates->response[ $plugin_base ]->package     = $path;
		$repo_updates->response[ $plugin_base ]->url         = $path;
		set_site_transient( 'update_plugins', $repo_updates );

		// Upgrade plugin
		$upgrader->upgrade( $plugin_base );

		// Activate plugin
		if ( is_plugin_inactive( $plugin_base ) ) {
			$result = activate_plugin( $plugin_base );
			if ( is_wp_error( $result ) ) {
				$msg = esc_html__( 'Error with plugin activation. Try to manually activate in the Plugins menu', 'yolox' );
			}
		}

		return $msg;
	}
}
