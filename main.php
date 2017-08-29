<?php
	
	require_once ( "libs/database.class.php" );
	require_once ( "libs/utility.class.php" );
	require_once ( "libs/header.class.php" );
	require_once ( "libs/footer.class.php" );
	
	$db     = new Database();
	$util   = new Utility();
	$header = new Header();
	$footer = new Footer();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Cache-control" content="no-cache">
	<?php
		$content
			= "maufutsal, marketplace futsal, maufutsal indonesia, reservasi lapangan, turnamen futsal, turnamen, indonesia";
		
		$author     = "Saldinata Bobby Ardani";
		$author_dec = "Maufutsal Developer - 2017";
		$title      = "Maufutsal Indonesia";
		$fav_path   = "images/favicon.png";
		
		$header -> setKeyword ( $content );
		$header -> setAuthorInfo ( $author , $author_dec );
		$header -> setTitle ( $title );
		$header -> setFavicon ( $fav_path );
		
		echo $header -> getTitle ();
		echo $header -> getMetaInformation ();
		echo $header -> getKeyword ();
		echo $header -> getAuthorInfo ();
		echo $header -> getXUACimpatible ();
		echo $header -> getFavicon ();
		echo $header -> getStyleLink ();
	?>
</head>
<body>

<div class="sportsmagazine-main-wrapper">

    <header id="sportsmagazine-headers" class="sportsmagazine-header-one">
    

        <?php include ("components/navigation.php"); ?>
    </header>
    
    
    <div class="sportsmagazine-subheader">
        <span class="subheader-transparent"></span>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Fixtures</h1>
                </div>
                <div class="col-md-12">
                    <ul class="sportsmagazine-breadcrumb">
                        <li><a href="index-2.html">Home</a></li>
                        <li>Fixtures</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--// SubHeader \\-->

    <!--// Main Content \\-->
    <div class="sportsmagazine-main-content">

        <!--// Main Section \\-->
        <div class="sportsmagazine-main-section sportsmagazine-fixture-listfull">
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <div class="sportsmagazine-fixture sportsmagazine-fixture-list">
                            <ul class="row">
                                <li class="col-md-12">
                                    <div class="sportsmagazine-fixture-wrap">
                                        <div class="sportsmagazine-teams-match">
                                            <div class="sportsmagazine-first-team">
                                                <figure><img src="extra-images/team-match-img1.png" alt=""></figure>
                                                <div class="sportsmagazine-first-team-info">
                                                    <h6><a href="404.html">Yorkshire</a></h6>
                                                    <span>Bepop Institute</span>
                                                </div>
                                            </div>
                                            <div class="sportsmagazine-match-view">
                                                <h5>Pool Match # 1</h5>
                                                <span>VS</span>
                                            </div>
                                            <div class="sportsmagazine-second-team">
                                                <figure><img src="extra-images/team-match-img2.png" alt=""></figure>
                                                <div class="sportsmagazine-second-team-info">
                                                    <h6><a href="404.html">Sharks Club</a></h6>
                                                    <span>Marine College</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sportsmagazine-buy-ticket">
                                            <div class="sportsmagazine-buy-ticket-text">
                                                <h5>Country Durham, UK</h5>
                                                <time datetime="2008-02-14 20:00">August 21st, 2017
                                                    <span>@ 9:00 PM</span></time>
                                            </div>
                                            <a href="404.html" class="ticket-buy-btn">Buy Ticket</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-md-12">
                                    <div class="sportsmagazine-fixture-wrap">
                                        <div class="sportsmagazine-teams-match">
                                            <div class="sportsmagazine-first-team">
                                                <figure><img src="extra-images/team-match-img3.png" alt=""></figure>
                                                <div class="sportsmagazine-first-team-info">
                                                    <h6><a href="404.html">Yorkshire</a></h6>
                                                    <span>Bepop Institute</span>
                                                </div>
                                            </div>
                                            <div class="sportsmagazine-match-view">
                                                <h5>Pool Match # 2</h5>
                                                <span>VS</span>
                                            </div>
                                            <div class="sportsmagazine-second-team">
                                                <figure><img src="extra-images/team-match-img4.png" alt=""></figure>
                                                <div class="sportsmagazine-second-team-info">
                                                    <h6><a href="404.html">Sharks Club</a></h6>
                                                    <span>Marine College</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sportsmagazine-buy-ticket">
                                            <div class="sportsmagazine-buy-ticket-text">
                                                <h5>Country Durham, UK</h5>
                                                <time datetime="2008-02-14 20:00">August 21st, 2017
                                                    <span>@ 9:00 PM</span></time>
                                            </div>
                                            <a href="404.html" class="ticket-buy-btn">Buy Ticket</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-md-12">
                                    <div class="sportsmagazine-fixture-wrap">
                                        <div class="sportsmagazine-teams-match">
                                            <div class="sportsmagazine-first-team">
                                                <figure><img src="extra-images/team-match-img2.png" alt=""></figure>
                                                <div class="sportsmagazine-first-team-info">
                                                    <h6><a href="404.html">Yorkshire</a></h6>
                                                    <span>Bepop Institute</span>
                                                </div>
                                            </div>
                                            <div class="sportsmagazine-match-view">
                                                <h5>Pool Match # 3</h5>
                                                <span>VS</span>
                                            </div>
                                            <div class="sportsmagazine-second-team">
                                                <figure><img src="extra-images/team-match-img3.png" alt=""></figure>
                                                <div class="sportsmagazine-second-team-info">
                                                    <h6><a href="404.html">Sharks Club</a></h6>
                                                    <span>Marine College</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sportsmagazine-buy-ticket">
                                            <div class="sportsmagazine-buy-ticket-text">
                                                <h5>Country Durham, UK</h5>
                                                <time datetime="2008-02-14 20:00">August 21st, 2017
                                                    <span>@ 9:00 PM</span></time>
                                            </div>
                                            <a href="404.html" class="ticket-buy-btn">Buy Ticket</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-md-12">
                                    <div class="sportsmagazine-fixture-wrap">
                                        <div class="sportsmagazine-teams-match">
                                            <div class="sportsmagazine-first-team">
                                                <figure><img src="extra-images/team-match-img4.png" alt=""></figure>
                                                <div class="sportsmagazine-first-team-info">
                                                    <h6><a href="404.html">Yorkshire</a></h6>
                                                    <span>Bepop Institute</span>
                                                </div>
                                            </div>
                                            <div class="sportsmagazine-match-view">
                                                <h5>Pool Match # 4</h5>
                                                <span>VS</span>
                                            </div>
                                            <div class="sportsmagazine-second-team">
                                                <figure><img src="extra-images/team-match-img1.png" alt=""></figure>
                                                <div class="sportsmagazine-second-team-info">
                                                    <h6><a href="404.html">Sharks Club</a></h6>
                                                    <span>Marine College</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sportsmagazine-buy-ticket">
                                            <div class="sportsmagazine-buy-ticket-text">
                                                <h5>Country Durham, UK</h5>
                                                <time datetime="2008-02-14 20:00">August 21st, 2017
                                                    <span>@ 9:00 PM</span></time>
                                            </div>
                                            <a href="404.html" class="ticket-buy-btn">Buy Ticket</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-md-12">
                                    <div class="sportsmagazine-fixture-wrap">
                                        <div class="sportsmagazine-teams-match">
                                            <div class="sportsmagazine-first-team">
                                                <figure><img src="extra-images/team-match-img3.png" alt=""></figure>
                                                <div class="sportsmagazine-first-team-info">
                                                    <h6><a href="404.html">Yorkshire</a></h6>
                                                    <span>Bepop Institute</span>
                                                </div>
                                            </div>
                                            <div class="sportsmagazine-match-view">
                                                <h5>Pool Match # 5</h5>
                                                <span>VS</span>
                                            </div>
                                            <div class="sportsmagazine-second-team">
                                                <figure><img src="extra-images/team-match-img2.png" alt=""></figure>
                                                <div class="sportsmagazine-second-team-info">
                                                    <h6><a href="404.html">Sharks Club</a></h6>
                                                    <span>Marine College</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sportsmagazine-buy-ticket">
                                            <div class="sportsmagazine-buy-ticket-text">
                                                <h5>Country Durham, UK</h5>
                                                <time datetime="2008-02-14 20:00">August 21st, 2017
                                                    <span>@ 9:00 PM</span></time>
                                            </div>
                                            <a href="404.html" class="ticket-buy-btn">Buy Ticket</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-md-12">
                                    <div class="sportsmagazine-fixture-wrap">
                                        <div class="sportsmagazine-teams-match">
                                            <div class="sportsmagazine-first-team">
                                                <figure><img src="extra-images/team-match-img4.png" alt=""></figure>
                                                <div class="sportsmagazine-first-team-info">
                                                    <h6><a href="404.html">Yorkshire</a></h6>
                                                    <span>Bepop Institute</span>
                                                </div>
                                            </div>
                                            <div class="sportsmagazine-match-view">
                                                <h5>Pool Match # 6</h5>
                                                <span>VS</span>
                                            </div>
                                            <div class="sportsmagazine-second-team">
                                                <figure><img src="extra-images/team-match-img3.png" alt=""></figure>
                                                <div class="sportsmagazine-second-team-info">
                                                    <h6><a href="404.html">Sharks Club</a></h6>
                                                    <span>Marine College</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sportsmagazine-buy-ticket">
                                            <div class="sportsmagazine-buy-ticket-text">
                                                <h5>Country Durham, UK</h5>
                                                <time datetime="2008-02-14 20:00">August 21st, 2017
                                                    <span>@ 9:00 PM</span></time>
                                            </div>
                                            <a href="404.html" class="ticket-buy-btn">Buy Ticket</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-md-12">
                                    <div class="sportsmagazine-fixture-wrap">
                                        <div class="sportsmagazine-teams-match">
                                            <div class="sportsmagazine-first-team">
                                                <figure><img src="extra-images/team-match-img1.png" alt=""></figure>
                                                <div class="sportsmagazine-first-team-info">
                                                    <h6><a href="404.html">Yorkshire</a></h6>
                                                    <span>Bepop Institute</span>
                                                </div>
                                            </div>
                                            <div class="sportsmagazine-match-view">
                                                <h5>Pool Match # 7</h5>
                                                <span>VS</span>
                                            </div>
                                            <div class="sportsmagazine-second-team">
                                                <figure><img src="extra-images/team-match-img2.png" alt=""></figure>
                                                <div class="sportsmagazine-second-team-info">
                                                    <h6><a href="404.html">Sharks Club</a></h6>
                                                    <span>Marine College</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sportsmagazine-buy-ticket">
                                            <div class="sportsmagazine-buy-ticket-text">
                                                <h5>Country Durham, UK</h5>
                                                <time datetime="2008-02-14 20:00">August 21st, 2017
                                                    <span>@ 9:00 PM</span></time>
                                            </div>
                                            <a href="404.html" class="ticket-buy-btn">Buy Ticket</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-md-12">
                                    <div class="sportsmagazine-fixture-wrap">
                                        <div class="sportsmagazine-teams-match">
                                            <div class="sportsmagazine-first-team">
                                                <figure><img src="extra-images/team-match-img2.png" alt=""></figure>
                                                <div class="sportsmagazine-first-team-info">
                                                    <h6><a href="404.html">Yorkshire</a></h6>
                                                    <span>Bepop Institute</span>
                                                </div>
                                            </div>
                                            <div class="sportsmagazine-match-view">
                                                <h5>Pool Match # 8</h5>
                                                <span>VS</span>
                                            </div>
                                            <div class="sportsmagazine-second-team">
                                                <figure><img src="extra-images/team-match-img1.png" alt=""></figure>
                                                <div class="sportsmagazine-second-team-info">
                                                    <h6><a href="404.html">Sharks Club</a></h6>
                                                    <span>Marine College</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sportsmagazine-buy-ticket">
                                            <div class="sportsmagazine-buy-ticket-text">
                                                <h5>Country Durham, UK</h5>
                                                <time datetime="2008-02-14 20:00">August 21st, 2017
                                                    <span>@ 9:00 PM</span></time>
                                            </div>
                                            <a href="404.html" class="ticket-buy-btn">Buy Ticket</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!--// Pagination \\-->
                        <div class="sportsmagazine-pagination">
                            <ul class="page-numbers">
                                <li><a class="previous page-numbers" href="404.html"><span aria-label="Next"><i
                                                    class="fa fa-angle-left"></i></span></a></li>
                                <li><span class="page-numbers current">1</span></li>
                                <li><a class="page-numbers" href="404.html">2</a></li>
                                <li><a class="page-numbers" href="404.html">3</a></li>
                                <li><a class="page-numbers" href="404.html">4</a></li>
                                <li><a class="next page-numbers" href="404.html"><span aria-label="Next"><i
                                                    class="fa fa-angle-right"></i></span></a></li>
                            </ul>
                        </div>
                        <!--// Pagination \\-->
                    </div>


                </div>
            </div>
        </div>
    </div>
    
    <?php require_once ("components/footer.php") ?>

    <div class="clearfix"></div>
</div>


<!-- LoginModal -->
<div class="loginmodal modal fade" id="loginModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="sportsmagazine-login-box">
            <a href="#" data-dismiss="modal" class="sportsmagazine-login-close sportsmagazine-color"><i
                        class="icon-uniF106"></i></a>
            <h4>Login To Your Account</h4>
            <form>
                <input type="text" value="Enter username*"
                       onblur="if(this.value == '') { this.value ='Enter username*' }"
                       onfocus="if(this.value =='Enter username*') { this.value = '' }">
                <input type="password" value="Password*" onblur="if(this.value == '') { this.value ='Password*' }"
                       onfocus="if(this.value =='Password*') { this.value = '' }">
                <a href="#" class="sportsmagazine-colorhover">Forget Password?</a>
                <div class="clearfix"></div>
                <label><input type="submit" value="Sign In"
                              class="sportsmagazine-bordercolor sportsmagazine-color"></label>
            </form>
            <h4>Try Our Socials Also</h4>
            <ul class="login-network">
                <li><a href="#"><i class="fa fa-facebook-square"></i> Facebook</a></li>
                <li class="sportsmagazine-twitter"><a href="#"><i class="fa fa-twitter-square"></i> Twitter</a></li>
                <li class="sportsmagazine-google-plus"><a href="#"><i class="fa fa-google-plus-square"></i> Google+</a>
                </li>
            </ul>
            <p>Not A Member Yet ? <a href="#" class="sportsmagazine-color">Sign - Up Now !</a></p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<!-- SignupModal -->
<div class="loginmodal modal fade" id="signupModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="sportsmagazine-login-box">
            <a href="#" data-dismiss="modal" class="sportsmagazine-login-close sportsmagazine-color"><i
                        class="icon-uniF106"></i></a>
            <h4>Sign Up Now</h4>
            <form>
                <input type="text" value="Enter username*"
                       onblur="if(this.value == '') { this.value ='Enter username*' }"
                       onfocus="if(this.value =='Enter username*') { this.value = '' }">
                <input type="text" value="Type your password*"
                       onblur="if(this.value == '') { this.value ='Type your password*' }"
                       onfocus="if(this.value =='Type your password*') { this.value = '' }">
                <input type="text" value="Confirm your password*"
                       onblur="if(this.value == '') { this.value ='Confirm your password*' }"
                       onfocus="if(this.value =='Confirm your password*') { this.value = '' }">
                <a href="#" class="sportsmagazine-colorhover">Forget Password?</a>
                <div class="clearfix"></div>
                <label><input type="submit" value="Sign Up"
                              class="sportsmagazine-bordercolor sportsmagazine-color"></label>
            </form>
            <h4>Try Our Socials Also</h4>
            <ul class="login-network">
                <li><a href="#"><i class="fa fa-facebook-square"></i> Facebook</a></li>
                <li class="sportsmagazine-twitter"><a href="#"><i class="fa fa-twitter-square"></i> Twitter</a></li>
                <li class="sportsmagazine-google-plus"><a href="#"><i class="fa fa-google-plus-square"></i> Google+</a>
                </li>
            </ul>
            <p>Not A Member Yet ? <a href="#" class="sportsmagazine-color">Login - Now !</a></p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<?php echo $footer -> getAllScript (); ?>

</body>
</html>