<?php
	
	/*Getting Contact Info Data*/
	$query             = "SELECT * FROM tbl_web_contact_info";
	$contact_info_data = $db -> getValue ( $query );
	
	/*Getting Copyright*/
	$query               = "SELECT * FROM tbl_web_copyright";
	$copyright_info_data = $db -> getValue ( $query );

?>

<footer id="sportsmagazine-footer" class="sportsmagazine-footer-one">
    <div class="sportsmagazine-footer-widget">
        <div class="container">
            <div class="row">
                <aside class="col-md-6 widget widget_contact_info">
                    <a href="index-2.html" class="footer-logo"><img src="images/logo-1.png" alt=""></a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elUt ac malesuada ante.Sed gravida, ur
                        quis tempus sollicitudin, tellus urna</p>
                    <ul class="sportsmagazine-social-network">
                        <li><a href="https://www.facebook.com/"
                               class="sportsmagazine-colorhover fa fa-facebook-official"></a></li>
                        <li><a href="https://twitter.com/login"
                               class="sportsmagazine-colorhover fa fa-twitter-square"></a></li>
                        <li><a href="https://pk.linkedin.com/"
                               class="sportsmagazine-colorhover fa fa-linkedin-square"></a></li>
                        <li><a href="https://plus.google.com/"
                               class="sportsmagazine-colorhover fa fa-google-plus-square"></a></li>
                    </ul>
                </aside>

                <aside class="col-md-3 widget widget_twitter">
                    <div class="footer-widget-title" style="margin-bottom:20px;"><h2>Link Terkait</h2></div>
                    <ul>
                        <li style="margin-bottom : 0px;">
                            <a href="#">Reservasi</a>
                        </li>
                        <li style="margin-bottom : 0px;">
                            <a href="#">Turnament</a>
                        </li>
                    </ul>
                </aside>


                <aside class="col-md-3 widget widget_twitter">
                    <div class="footer-widget-title" style="margin-bottom:20px;"><h2>Informasi Kontak</h2></div>
                    <ul>
                        <li style="margin-bottom : 0px;">
                            <a href="#"><?php echo $contact_info_data[ 'address' ] ?></a>
                        </li>
                        <li style="margin-bottom : 0px;">
                            <a href="#"><?php echo $contact_info_data[ 'phone' ] ?></a>
                        </li>
                        <li style="margin-bottom : 0px;">
                            <a href="#"><?php echo $contact_info_data[ 'email' ] ?></a>
                        </li>
                    </ul>
                </aside>

            </div>
        </div>
        <a href="#" class="sportsmagazine-back-top"><i class="fa fa-angle-up"></i></a>
    </div>

    <div class="sportsmagazine-copyright">
        <div class="container">
            <div class="row">
                <aside class="col-md-6 sportsmagazine-copyright-left">
                    <p>©
                        <?php echo $copyright_info_data['year'] ?>, All Right Reserved - by
                        <a href="index-2.html"><?php echo $copyright_info_data['copyright_name'] ?></a>
                    </p>
                </aside>
                <aside class="col-md-6 sportsmagazine-copyright-right">
                    <ul class="sportsmagazine-copyright-link">
                        <li><a href="#" class="sportsmagazine-colorhover">Kebijakan Privasi</a></li>
                        <li><a href="#" class="sportsmagazine-colorhover">Privacy Policy</a></li>
                    </ul>
                </aside>
            </div>
        </div>
    </div>
</footer>