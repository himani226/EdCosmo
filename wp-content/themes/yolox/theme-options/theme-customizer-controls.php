<?php
/**
 * Theme customizer: Custom controls
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0.31
 */


// 'info' field
//--------------------------------------------------------------------
class Yolox_Customize_Info_Control extends WP_Customize_Control {
	public $type = 'info';

	public function render_content() {
		?><div class="customize-control-wrap">
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
		</div>
		<?php
	}
}


// 'hidden' field
//--------------------------------------------------------------------
class Yolox_Customize_Hidden_Control extends WP_Customize_Control {
	public $type = 'hidden';

	public function render_content() {
		?>
		<input type="hidden" name="_customize-hidden-<?php echo esc_attr( $this->id ); ?>" value=""
			<?php
			$this->link();
			if ( ! empty( $this->input_attrs['var_name'] ) ) {
				echo ' data-var_name="' . esc_attr( $this->input_attrs['var_name'] ) . '"';
			}
			?>
		>
		<?php
		// We need to fire action 'admin_print_footer_scripts' if this is a last option
		if ( 'last_option' == $this->id && yolox_storage_get( 'need_footer_scripts', false ) ) {
			yolox_storage_set( 'need_footer_scripts', false );
			do_action( 'admin_print_footer_scripts' );
		}
	}
}


// 'button' field
//--------------------------------------------------------------------
class Yolox_Customize_Button_Control extends WP_Customize_Control {
	public $type = 'button';

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
			if ( ! empty( $this->input_attrs['link'] ) ) {
				?>
				<a href="<?php echo esc_url( $this->input_attrs['link'] ); ?>" target="_blank"
					<?php
					if ( ! empty( $this->input_attrs['class'] ) ) {
						echo ' class="' . esc_attr( $this->input_attrs['class'] ) . '"';
					}
					?>
				>
					<?php
					echo esc_html( $this->input_attrs['caption'] );
					?>
				</a>
				<?php
			} elseif ( ! empty( $this->input_attrs['action'] ) ) {
				?>
				<input type="button" 
					<?php
					if ( ! empty( $this->input_attrs['class'] ) ) {
						echo ' class="' . esc_attr( $this->input_attrs['class'] ) . '"';
					}
					?>
					name="_customize-button-<?php echo esc_attr( $this->id ); ?>" 
					value="<?php echo esc_attr( $this->input_attrs['caption'] ); ?>"
					data-action="<?php echo esc_attr( $this->input_attrs['action'] ); ?>"
				>
				<?php
			}
			?>
		</div>
		<?php
	}
}


// 'switch' field
//--------------------------------------------------------------------
class Yolox_Customize_Switch_Control extends WP_Customize_Control {
	public $type = 'switch';

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
			if ( is_array( $this->choices ) && count( $this->choices ) > 0 ) {
				foreach ( $this->choices as $k => $v ) {
					?>
					<label><input type="radio" name="_customize-radio-<?php echo esc_attr( $this->id ); ?>" 
						<?php
						$this->link();
						if ( ! empty( $this->input_attrs['var_name'] ) ) {
							echo ' data-var_name="' . esc_attr( $this->input_attrs['var_name'] ) . '"';
						}
						if ( ( '#' . $k ) == ( '#' . $this->input_attrs['value'] ) ) {
							echo ' checked="checked"';
						}
						?>
						value="<?php echo esc_attr( $k ); ?>"
					>
						<?php
						echo esc_html( $v );
						?>
					</label>
					<?php
				}
			}
			?>
		</div>
		<?php
	}
}


// 'icon' field
//--------------------------------------------------------------------
class Yolox_Customize_Icon_Control extends WP_Customize_Control {
	public $type = 'icon';

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
			<span class="customize-control-field-wrap"><input type="text" 
				<?php
				$this->link();
				if ( ! empty( $this->input_attrs['var_name'] ) ) {
					echo ' data-var_name="' . esc_attr( $this->input_attrs['var_name'] ) . '"';
				}
				?>
			/>
				<?php
				yolox_show_layout(
					yolox_show_custom_field(
						'_customize-icon-selector-' . esc_attr( $this->id ),
						array(
							'type'   => 'icons',
							'button' => true,
							'icons'  => true,
						),
						$this->input_attrs['value']
					)
				);
				?>
			</span>
		</div>
		<?php
	}
}


// 'checklist' field
//--------------------------------------------------------------------
class Yolox_Customize_Checklist_Control extends WP_Customize_Control {
	public $type = 'checklist';

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
			<span class="customize-control-field-wrap"><input type="hidden" 
				<?php
				$this->link();
				if ( ! empty( $this->input_attrs['var_name'] ) ) {
					echo ' data-var_name="' . esc_attr( $this->input_attrs['var_name'] ) . '"';
				}
				?>
			/>
				<?php
				yolox_show_layout(
					yolox_show_custom_field(
						'_customize-checklist-' . esc_attr( $this->id ),
						array_merge(
							$this->input_attrs, array(
								'options' => $this->choices,
							)
						),
						$this->input_attrs['value']
					)
				);
				?>
			</span>
		</div>
		<?php
	}
}


// 'scheme_editor' field
//--------------------------------------------------------------------
class Yolox_Customize_Scheme_Editor_Control extends WP_Customize_Control {
	public $type = 'scheme_editor';

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
			<span class="customize-control-field-wrap"><input type="hidden" 
				<?php
				$this->link();
				if ( ! empty( $this->input_attrs['var_name'] ) ) {
					echo ' data-var_name="' . esc_attr( $this->input_attrs['var_name'] ) . '"';
				}
				?>
			/>
				<?php
				yolox_show_layout(
					yolox_show_custom_field(
						'_customize-scheme-editor-' . esc_attr( $this->id ),
						$this->input_attrs,
						yolox_unserialize( $this->input_attrs['value'] )
					)
				);
				?>
			</span>
		</div>
		<?php
	}
}


// 'text_editor' field
//--------------------------------------------------------------------
class Yolox_Customize_Text_Editor_Control extends WP_Customize_Control {
	public $type = 'text_editor';

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
			<span class="customize-control-field-wrap"><input type="hidden" 
				<?php
				$this->link();
				if ( ! empty( $this->input_attrs['var_name'] ) ) {
					echo ' data-var_name="' . esc_attr( $this->input_attrs['var_name'] ) . '"';
				}
				?>
				value="<?php echo esc_textarea( $this->value() ); ?>"
			/>
				<?php
				yolox_show_layout(
					yolox_show_custom_field(
						'_customize-text-editor-' . esc_attr( $this->id ),
						$this->input_attrs,
						$this->input_attrs['value']
					)
				);
				?>
			</span>
		</div>
		<?php
		// We need to fire action 'admin_print_footer_scripts' when the last option is render
		yolox_storage_set( 'need_footer_scripts', true );
	}
}



// 'range' field
//--------------------------------------------------------------------
class Yolox_Customize_Range_Control extends WP_Customize_Control {
	public $type = 'range';

	public function render_content() {
		$show_value = ! isset( $this->input_attrs['show_value'] ) || $this->input_attrs['show_value'];
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
			<span class="customize-control-field-wrap"><input type="<?php echo ! $show_value ? 'hidden' : 'text'; ?>" 
				<?php
				$this->link();
				if ( $show_value ) {
					echo ' class="yolox_range_slider_value"';
				}
				if ( ! empty( $this->input_attrs['var_name'] ) ) {
					echo ' data-var_name="' . esc_attr( $this->input_attrs['var_name'] ) . '"';
				}
				?>
			/>
				<?php
				yolox_show_layout(
					yolox_show_custom_field(
						'_customize-range-' . esc_attr( $this->id ),
						$this->input_attrs,
						$this->input_attrs['value']
					)
				);
				?>
			</span>
		</div>
		<?php
	}
}
