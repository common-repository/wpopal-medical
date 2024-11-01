<?php 
	global $medical, $post; 
 	
	$categories = $medical->getCategoryTax();
	$departments = $medical->getDepartmentTax();
?>
<div class="entry-content">
	<div class="row">
		<div class="wp-col-lg-4 wp-col-md-12 doctor_info">
			<div class="medical-box">
				<div class="medical-image">
					<?php the_post_thumbnail('full'); ?>
				</div>
				<h3 class="box-heading margin-top-0"><?php the_title(); ?></h3>
				<div class="medical-categories info">
					<?php foreach( $departments as $department ) :
						$namect = $department->name.',';
						if ($department === end($departments) || count($departments) == 1){
							$namect = $department->name;
						}?>
						<a href="<?php echo esc_url( get_term_link($department->term_id, 'opalmedical_department_doctor') );?>" class="departments-link"><span><?php echo trim( $namect ); ?></span> </a>
					<?php endforeach; ?>
				</div>
			</div>

			<div class="medical-box">
				<h4><?php esc_html_e( 'Personal info', 'opal-medical' ); ?></h4>
				<ul>
					<li>
                        <span>
                            <?php esc_html_e( 'Phone', 'opal-medical' ); ?>:
                        </span>
						<span>
							<?php if( $medical->getMetaboxValue('phone') ) : ?>
								<?php echo esc_attr( $medical->getMetaboxValue('phone') );?>
							<?php endif; ?>
						</span>
					</li>
					<li>
                        <span>
                            <?php esc_html_e( 'Office', 'opal-medical' ); ?>:
                        </span>
						<span>
							<?php if( $medical->getMetaboxValue('office') ) : ?>
								<?php echo esc_attr( $medical->getMetaboxValue('office') );?>
							<?php endif; ?>
						</span>
					</li>
                    <li>
                        <span>
                            <?php esc_html_e( 'Email', 'opal-medical' ); ?>:
                        </span>
						<span>
							<?php if( $medical->getMetaboxValue('email') ) : ?>
								<?php echo sanitize_email( $medical->getMetaboxValue('email') );?>
							<?php endif; ?>
						</span>
					</li>
                    <li>
                        <span>
                            <?php esc_html_e( 'Social', 'opal-medical' ); ?>:
                        </span>
						<?php echo Opalmedical_Template_Loader::get_template_part('single-medical/social'); ?>	
					</li>
				</ul>
			</div>
			<?php
				$departments_notice = get_theme_mod('opalmedical_departments_notice');
				if($departments_notice): ?>
					
				<div class="medical-box">
					<?php echo trim($departments_notice); ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="wp-col-lg-8 wp-col-md-12 doctor_content">
			<div class="medical-detail">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</div><!-- .entry-content -->