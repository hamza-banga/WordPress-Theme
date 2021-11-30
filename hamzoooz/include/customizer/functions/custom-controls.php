<?php
/**
 * Custom Controls for the Customizer
 *
 * @package Merlin
 */


/**
 * Make sure that custom controls are only defined in the Customizer
 */
if ( class_exists( 'WP_Customize_Control' ) ) :

	/**
	 * Displays a bold label text. Used to create headlines for radio buttons and description sections.
	 *
	 */
	class Merlin_Customize_Header_Control extends WP_Customize_Control {

		public function render_content() {  ?>

			<label>
				<span class="customize-control-title"><?php echo wp_kses_post( $this->label ); ?></span>
			</label>

			<?php
		}
	}

	/**
	 * Displays a description text in gray italic font
	 *
	 */
	class Merlin_Customize_Description_Control extends WP_Customize_Control {

		public function render_content() {  ?>

			<span class="description"><?php echo wp_kses_post( $this->label ); ?></span>

			<?php
		}
	}

	/**
	 * Creates a category dropdown control for the Customizer
	 *
	 */
	class Merlin_Customize_Category_Dropdown_Control extends WP_Customize_Control {

		public function render_content() {

			$categories = get_categories( array( 'hide_empty' => false ) );

			if( !empty( $categories ) ) : ?>

					<label>

						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

						<select <?php $this->link(); ?>>
							<option value="0"><?php esc_html_e( 'All Categories', 'merlin' ); ?></option>
						<?php
							foreach ( $categories as $category ) :

								printf(	'<option value="%s" %s>%s</option>',
									$category->term_id,
									selected( $this->value(), $category->term_id, false ),
									$category->name . ' (' . $category->count . ')'
								);

							endforeach;
						?>
						</select>

					</label>

				<?php
			endif;

		}

	}

	/**
	 * Displays the upgrade teasers in thhe Pro Version / More Features section.
	 *
	 */
	class Merlin_Customize_Upgrade_Control extends WP_Customize_Control {

		public function render_content() {  ?>

			<div class="upgrade-pro-version">

				<span class="customize-control-title"><?php esc_html_e( 'Pro Version Add-on', 'merlin' ); ?></span>

				<span class="textfield">
					<?php printf( esc_html__( 'Purchase the %s Pro Add-on and get additional features and advanced customization options.', 'merlin' ), 'Merlin' ); ?>
				</span>

				<p>
					<a href="<?php echo esc_url( __( 'https://themezee.com/addons/merlin-pro/', 'merlin' ) ); ?>?utm_source=customizer&utm_medium=button&utm_campaign=merlin&utm_content=pro-version" target="_blank" class="button button-secondary">
						<?php printf( esc_html__( 'Learn more about %s Pro', 'merlin' ), 'Merlin' ); ?>
					</a>
				</p>

			</div>

			<div class="upgrade-plugins">

				<span class="customize-control-title"><?php esc_html_e( 'Recommended Plugins', 'merlin' ); ?></span>

				<span class="textfield">
					<?php esc_html_e( 'Extend the functionality of your WordPress website with our free and easy to use plugins.', 'merlin' ); ?>
				</span>

				<p>
					<a href="<?php echo admin_url( 'plugin-install.php?tab=search&type=author&s=themezee' ); ?>" class="button button-secondary">
						<?php esc_html_e( 'Install Plugins', 'merlin' ); ?>
					</a>
				</p>

			</div>

			<?php
    }
	}

endif;
