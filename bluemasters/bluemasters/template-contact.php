<?php
/*
Template Name: Contact
*/
?>

<?php 
//Getting theme options
$options = get_option('bluemasters_theme_options'); //Get theme options
$myEmail = $options['git_email'];
$myName = $options['git_name'];
$mySite = get_bloginfo('name');


//If the form is submitted
if(isset($_POST['submitted'])) {
	//Check to see if the honeypot captcha field was filled in
	if(trim($_POST['checking']) !== '') {
		$captchaError = true;
	} else {
		
		//Check to make sure that the name field is not empty
		if(trim($_POST['contactName']) === '') {
			$nameError = 'You forgot to enter your name.';
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}

		//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['email']) === '')  {
			$emailError = 'You forgot to enter your email address.';
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+.[A-Z]{2,4}$", trim($_POST['email']))) {
			$emailError = 'You entered an invalid email address.';
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
		
		//Check to make sure that the subject field is not empty
		if(trim($_POST['mySubject']) === '') {
			$subjectError = 'You forgot to enter the subject.';
			$hasError = true;
		} else {
			$mySubject = trim($_POST['mySubject']);
		}
 
		//Check to make sure comments were entered 
		if(trim($_POST['comments']) === '') {
			$commentError = 'You forgot to enter your comments.';
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}
	}
	//If there is no error, send the email
	if(!isset($hasError)) {
		$subject = 'Contact Submission from ' . $name . ' about '. $mySubject;
		$sendCopy = trim($_POST['sendCopy']);
		$body = 'Name: ' . $name . ' \nEmail: ' . $email . ' \nComments: ' . $comments;
		$headers = 'From: ' . $mySite . ' <'.$myEmail.'>' . "rn" . 'Reply-To: ' . $email;
 
		mail($myEmail, $subject, $body, $headers);

		if($sendCopy == true) {
			$subject = 'You emailed '.$myName;
			$headers = 'From: '.$myName.'<'.$myEmail.'>';
			mail($email, $subject, $body, $headers);
		}

		$emailSent = true;
	}
} ?>

<?php function bm_contact_page_head() { 
	$options = get_option('bluemasters_theme_options');
	$myAddress = $options['git_address'];?>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/script/contact-form.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
			/* <![CDATA[ */ 
			function initialize() {  
				var address = "<?php echo $myAddress; ?>";
				var geocoder = new google.maps.Geocoder();      
				var myOptions = {
					zoom: 15,
					scrollwheel: false,
					mapTypeId: google.maps.MapTypeId.ROADMAP
    			}
				var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
				if (geocoder) {
					geocoder.geocode( { 'address': address}, function(results, status) {
						if (status == google.maps.GeocoderStatus.OK) {
							if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
								map.setCenter(results[0].geometry.location); 
								var info = new google.maps.InfoWindow({
									content: address,
                  					size: new google.maps.Size(100,30)
                				});
			            		var marker = new google.maps.Marker({
            						position: results[0].geometry.location,
									map: map,
									title: address
        	    				}); 
								google.maps.event.addListener(marker, 'click', function() {
                					info.open(map,marker);
            					});

            				} else {
            					alert("No results found");
          					}
	        			} else {
    	      				alert("Geocode was not successful for the following reason: " + status);
        				}
      				});
	    		}
			}
			/* ]]> */
		</script>
<?php } add_action('wp_head', 'bm_contact_page_head'); ?>

<?php get_header(); ?>
		<!-- Starts Pages -->
		<div id="wrap">
			<div id="sheet">
				<div class="main-content">
					<div class="main-title">
                    	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    	<div class="left" style="margin-right: 15px;"><img src="<?php bloginfo('template_directory') ?>/img/cell.png" alt="bub" /></div>
						<div class="left"><?php the_title(); ?></div>
						<div class="clear"></div>
					</div>
					<!-- Begin of blog post -->
						<div class="content">
							<div class="post" style="margin-bottom: 40px;">
                                <?php
									 
									//If the email was sent, show a thank you message
									//Otherwise show form
									if(isset($emailSent) && $emailSent == true) {
								?>
 									<div class="thanks">
  										<h1>Thanks, <?=$name;?></h1>
  										<p>Your email was successfully sent. We will be in touch soon.</p>
 									</div>

								<?php } else { ?>
                                	<?php if(isset($hasError) || isset($captchaError)) { ?>
										<p class="error">
											There was an error submitting the form.
    									<p>
   									<?php } ?>
                                    <?php the_content(); ?>
 
   									<form action="<?php the_permalink(); ?>" id="contact_form" method="post">
                                    		<div id="map_wrap">
                                            	<p class="map">Our Location:</p> 
												<div id="map_canvas"></div>
                                            </div>
                                            	<p>
													<label for="contactName">* Your Name:</label><br />
													<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="requiredField" />
													<?php if($nameError != '') { ?>
														<span class="error"><?=$nameError;?></span> 
													<?php } ?>
                	                            </p>
 
												<p>
													<label for="email">* Email Adress:</label><br />
													<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="requiredField email" />
													<?php if($emailError != '') { ?>
														<span class="error"><?=$emailError;?></span>
													<?php } ?>
												</p>
                                            
	                                            <p>
													<label for="subject">* Subject:</label><br />
													<input type="text" name="mySubject" id="mySubject" value="<?php if(isset($_POST['mySubject']))  echo $_POST['mySubject'];?>" class="requiredField mySubject" />
													<?php if($emailError != '') { ?>
														<span class="error"><?=$mySubjectError;?></span>
													<?php } ?>
												</p>
	                                                                                       
											<p class="textarea clear">
												<label for="commentsText">* Your Message:</label><br />
												<textarea name="comments" id="commentsText" rows="20" cols="30" class="requiredField">
													<?php if(isset($_POST['comments'])) { 
														if(function_exists('stripslashes')) { 
															echo stripslashes($_POST['comments']); 
														} else {
															echo $_POST['comments']; 
														}
													} ?></textarea>
												<?php if($commentError != '') { ?>
													<span class="error"><?=$commentError;?></span> 
												<?php } ?>
											</p>
											<p class="buttons left">
												<input type="checkbox" name="sendCopy" id="sendCopy" value="true" <?php if(isset($_POST['sendCopy']) && $_POST['sendCopy'] == true) echo ' checked="checked"'; ?> />
												<label for="sendCopy">Send a copy of this email to yourself</label><br />
                                                * This are required fields
											</p>

											<p class="screenReader">
												<label for="checking" class="screenReader">If you want to submit this form, do not enter anything in this field</label>
												<input type="text" name="checking" id="checking" class="screenReader" value="<?php if(isset($_POST['checking']))  echo $_POST['checking'];?>" />
											</p>
                                            
                                            <p class="buttons right">
												<input type="hidden" name="submitted" id="submitted" value="true" />
												<button type="submit">Send Message</button>
											</p>											 
   									</form>
                                <?php } ?>
                                
							</div>
							<div class="clear"></div>
						</div>

					<?php endwhile; else: ?>

						<p>Sorry, no posts matched your criteria.</p>

					<?php endif; ?>
				</div>
		<!-- Ends posts listing a.k.a. The Blog -->
<?php get_sidebar('contact'); ?>
<?php get_footer(); ?>