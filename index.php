<?php
// Load the shared PDO connection so this page can initialise and query the news content table.
require __DIR__ . '/includes/connection.php';

// Ensure the homepage news table exists before attempting to seed/query records.
$pdo->exec(
	"CREATE TABLE IF NOT EXISTS news_posts (
		id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		category_label VARCHAR(50) NOT NULL,
		category_class VARCHAR(100) NOT NULL,
		article_class VARCHAR(100) NOT NULL,
		title_class VARCHAR(100) DEFAULT NULL,
		button_class VARCHAR(100) NOT NULL,
		image_path VARCHAR(255) NOT NULL,
		image_alt VARCHAR(255) NOT NULL,
		title VARCHAR(255) NOT NULL,
		excerpt TEXT NOT NULL,
		author_name VARCHAR(150) NOT NULL,
		author_image_path VARCHAR(255) NOT NULL,
		author_image_alt VARCHAR(255) NOT NULL,
		published_at DATE NOT NULL,
		display_order INT UNSIGNED NOT NULL DEFAULT 0
	)"
);

// Check whether the table is empty so we only insert starter content once.
$newsPostCount = (int) $pdo->query("SELECT COUNT(*) FROM news_posts")->fetchColumn();

// Populate three default cards that mirror the static design when the database is first created.
if ($newsPostCount === 0) {
	$seedNewsPosts = [
		[
			'category_label' => 'Insights',
			'category_class' => 'mc-insights',
			'article_class' => 'mc-article-bespoke',
			'title_class' => null,
			'button_class' => 'mc-news-btn-orange',
			'image_path' => 'img/how-much-could-vKZG.png',
			'image_alt' => 'Increase Exit Value With Bespoke Software',
			'title' => 'How Much Could Bespoke Software Add To Your E...',
			'excerpt' => "If you're a Managing Director or Senior Manager preparing your business for exit, you know that incr...",
			'author_name' => 'Netmatters',
			'author_image_path' => 'img/netmatters-ltd-VXAv.png',
			'author_image_alt' => 'Netmatters',
			'published_at' => '2025-06-27',
			'display_order' => 1,
		],
		[
			'category_label' => 'Insights',
			'category_class' => 'mc-insights',
			'article_class' => 'mc-article-ai',
			'title_class' => null,
			'button_class' => 'mc-news-btn-orange',
			'image_path' => 'img/how-can-ai-L9M0.png',
			'image_alt' => 'Article: AI Integration For Businesses',
			'title' => 'How can AI Benefit My Business?',
			'excerpt' => 'The idea of integrating AI into your business operations may seem daunting, but there are undeniable...',
			'author_name' => 'Netmatters',
			'author_image_path' => 'img/netmatters-ltd-VXAv.png',
			'author_image_alt' => 'Netmatters',
			'published_at' => '2025-06-26',
			'display_order' => 2,
		],
		[
			'category_label' => 'careers',
			'category_class' => 'mc-insights-it-tech',
			'article_class' => 'mc-article-technician',
			'title_class' => 'mc-firstline',
			'button_class' => 'mc-news-btn-blue',
			'image_path' => 'img/1st-line-technician-1QNr.png',
			'image_alt' => 'We Are Hiring: 1st Line Technician',
			'title' => '1st Line Technician',
			'excerpt' => 'Salary Range £25,000 -£29,000 + Pension Hours 40 hours per week, Monday - Friday Location Wymondham,...',
			'author_name' => 'Bethany Shakespeare',
			'author_image_path' => 'img/bethany-shakespeare-F6Iu.jpg',
			'author_image_alt' => 'Bethany Shakespeare',
			'published_at' => '2025-06-20',
			'display_order' => 3,
		],
	];

	$insertNewsPost = $pdo->prepare(
		"INSERT INTO news_posts (
			category_label, category_class, article_class, title_class, button_class,
			image_path, image_alt, title, excerpt, author_name, author_image_path,
			author_image_alt, published_at, display_order
		) VALUES (
			:category_label, :category_class, :article_class, :title_class, :button_class,
			:image_path, :image_alt, :title, :excerpt, :author_name, :author_image_path,
			:author_image_alt, :published_at, :display_order
		)"
	);

	// Insert each seed row using the prepared statement so values are bound safely.
	foreach ($seedNewsPosts as $newsPost) {
		$insertNewsPost->execute($newsPost);
	}
}

// Fetch the three most relevant records for display in the latest-news component.
$newsPostsStmt = $pdo->query(
	"SELECT
		category_label,
		category_class,
		article_class,
		title_class,
		button_class,
		image_path,
		image_alt,
		title,
		excerpt,
		author_name,
		author_image_path,
		author_image_alt,
		published_at
	FROM news_posts
	ORDER BY display_order ASC, published_at DESC
	LIMIT 3"
);
$newsPosts = $newsPostsStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Include shared document shell, overlay components, and primary navigation structure. -->
<?php include __DIR__ . '/includes/head.php'; ?>
<?php include __DIR__ . '/includes/cookies.php'; ?>
<?php include __DIR__ . '/includes/menu.php'; ?>
<?php include __DIR__ . '/includes/header.php'; ?>
</div>
<div class="mc-banner">
	<div class="mc-banner-slide mc-banner1">
		<div class="mc-content"> 
			<!-- Shared width-constrained container that keeps content aligned to the global grid. -->
	<div class="mc-container">
				<h1>
			 	The East Of England's Leading Technology Company
				</h1>
				<p>
				Performance-driven digital and technology services <br>
				with complete transparency.
				</p>
				<a class="mc-button-banner mc-company-button" href="#"> Why Choose Us? <span class="mc-icon-arrow-right"></span></a>
			</div>
		</div>
	</div>
	<div class="mc-banner-slide mc-banner2 is-hidden-for-now">
		<div class="mc-content"> 
			<!-- Shared width-constrained container that keeps content aligned to the global grid. -->
	<div class="mc-container">
				<h1>
			 	Bespoke Software
				</h1>
				<p>
				Delivering expert bespoke software<br>
				solutions across a range of industries.
				</p>
				<a class="mc-button-banner mc-bespoke-button" href="#"> Find Out More <span class="mc-icon-arrow-right"></span></a>
			</div>
		</div>
	</div>
	<div class="mc-banner-slide mc-banner3 is-hidden-for-now">
		<div class="mc-content"> 
			<!-- Shared width-constrained container that keeps content aligned to the global grid. -->
	<div class="mc-container">
				<h1>
			 	IT Support
				</h1>
				<p>
				Fast and cost-effective IT support<br>
				services for your business
				</p>
				<a class="mc-button-banner mc-itsupport-button" href="#"> Find Out More <span class="mc-icon-arrow-right"></span></a>
			</div>
		</div>
	</div>
	<div class="mc-banner-slide mc-banner4 is-hidden-for-now">
		<div class="mc-content"> 
			<!-- Shared width-constrained container that keeps content aligned to the global grid. -->
	<div class="mc-container">
				<h1>
			 	Digital Marketing
				</h1>
				<p>
				Generating your new business through <br>
				results-driven marketing activities.
				</p>
				<a class="mc-button-banner mc-digitalmarketing-button" href="#"> Find Out More <span class="mc-icon-arrow-right"></span></a>
			</div>
		</div>
	</div>
	<div class="mc-banner-slide mc-banner5 is-hidden-for-now">
		<div class="mc-content"> 
			<!-- Shared width-constrained container that keeps content aligned to the global grid. -->
	<div class="mc-container">
				<h1>
			 	Telecoms Services
				</h1>
				<p>
				A new approach to connectivity, see<br>
				how we can help your business.
				</p>
				<a class="mc-button-banner mc-telecomservices-button" href="#"> Find Out More <span class="mc-icon-arrow-right"></span></a>
			</div>
		</div>
	</div>
	<div class="mc-banner-slide mc-banner6 is-hidden-for-now">
		<div class="mc-content"> 
			<!-- Shared width-constrained container that keeps content aligned to the global grid. -->
	<div class="mc-container">
				<h1>
			 	Web Design
				</h1>
				<p>
				For businesses looking to make a strong <br>
				and effective first impression.
				</p>
				<a class="mc-button-banner mc-webdesign-button" href="#"> Find Out More <span class="mc-icon-arrow-right"></span></a>
			</div>
		</div>
	</div>
	<div class="mc-banner-slide mc-banner7 is-hidden-for-now">
		<div class="mc-content"> 
			<!-- Shared width-constrained container that keeps content aligned to the global grid. -->
	<div class="mc-container">
				<h1>
			 	Cyber Security
				</h1>
				<p>
				Keeping businesses and their customers <br>
				sensitive information protected.
				</p>
				<a class="mc-button-banner mc-cybersecurity-button" href="#"> Find Out More <span class="mc-icon-arrow-right"></span></a>
			</div>
		</div>
	</div>
</div>
<div class="mc-middle">
	<div class="mc-section">
	<!-- Shared width-constrained container that keeps content aligned to the global grid. -->
	<div class="mc-container">
		<div class="mc-services-list">
			<div class="mc-services-row">
				<div class="mc-services-header">
					<h2>Our Services</h2>
					<h1><a href="#">View Our Work <em class="mc-icon-arrow-right"></em></a></h1>
				</div>
				<div class="mc-services-gridbox">
					<div id="mc-panel1" class="mc-services-panel">
						<a href="#" class="mc-panel-CD">
							<span class="mc-icon1">
								<span class="mc-icon-laptop"></span>
							</span>
							<h2>Consultancy & Development</h2>
							<p>Bespoke software solutions & consultancy for all your business needs including integrations and reporting.</p>
							<span class="mc-button-container">
								<span class="mc-button-CD">
									Read More
								</span>
							</span>
						</a>
					</div>
					<div id="mc-panel2" class="mc-services-panel">
						<a href="#" class="mc-panel-IT">
							<span class="mc-icon1">
								<span class="mc-icon-display"></span>
							</span>
							<h2>IT Support</h2>
							<p>Fully managed IT support and consultancy packages tailored to meet your exact business needs.</p>
							<span class="mc-button-container">
								<span class="mc-button-IT">
									Read More
								</span>
							</span>
						</a>
					</div>
					<div id="mc-panel3" class="mc-services-panel">
						<a href="#" class="mc-panel-DM">
							<span class="mc-icon1">
								<span class="mc-icon-bar-graph"></span>
							</span>
							<h2>Digital Marketing</h2>
							<p>Driven brand awareness & ROI through creative digital marketing campagins.</p>
							<span class="mc-button-container">
								<span class="mc-button-DM">
									Read More
								</span>
							</span>
						</a>
					</div>
					<div id="mc-panel4" class="mc-services-panel">
						<a href="#" class="mc-panel-TS">
							<span class="mc-icon1">
									<span class="mc-icon-phone_in_talk"></span>
							</span>
							<h2>Telecoms Services</h2>
							<p>Bussiness Telephony solutions including mobile & connectivity solutions.</p>
							<span class="mc-button-container">
								<span class="mc-button-TS">
									Read More
								</span>
							</span>
						</a>
					</div>
					<div id="mc-panel5" class="mc-services-panel">
						<a href="#" class="mc-panel-WD">
							<span class="mc-icon1">
								<span class="mc-icon-code"></span>
							</span>
							<h2>Web Design</h2>
							<p>User-centric design for bussinesses looking to make a lasting impression.</p>
							<span class="mc-button-container">
								<span class="mc-button-WD">
									Read More
								</span>
							</span>
						</a>
					</div>
					<div id="mc-panel6" class="mc-services-panel">
						<a href="#" class="mc-panel-CS">
							<span class="mc-icon1">
							<span class="mc-icon-security"></span>
							</span>
							<h2>Cyber Security</h2>
							<p>Prevention, testing, consultancy & breach management services.</p>
							<span class="mc-button-container">
								<span class="mc-button-CS">
									Read More
								</span>
							</span>
						</a>
					</div>
					<div id="mc-panel7" class="mc-services-panel">
						<a href="#" class="mc-panel-DT">
							<span class="mc-icon1">
								<span class="mc-icon-school"></span>
							</span>
							<h2>Developer Training</h2>
							<p>Web design & software training courses desgined to secure a job in tech.</p>
							<span class="mc-button-container">
								<span class="mc-button-DT">
									Read More
								</span>
							</span>
							</a>
					</div>
				</div>
					<div class="mc-hidden-view-work">
						<h3><a href="#">View Our Work <em class="mc-icon-arrow-right"></em></a></h3>
					</div>
				</div>
			</div>
		</div>
	</div>
<div class="mc-partners">
	<div class="mc-section">
		<div class="mc-sliding-imgs">
			<div class="mc-sliding-list">
				<div class="mc-sliding-img-box">
					<img src="img/partners/cyber-essentials-colour.jpg" alt="">
				</div>
				<div class="mc-sliding-img-box">
					<img src="img/partners/google-partner.jpg" alt="">
				</div>
				<div class="mc-sliding-img-box">
					<img src="img/partners/GBC-colour.png" alt="">
				</div>
				<div class="mc-sliding-img-box">
					<img src="img/partners/norfolk_prohelp.png" alt="">
				</div>
				<div class="mc-sliding-img-box">
					<img src="img/partners/investing-in-future-growth.jpg" alt="">
				</div>
				<div class="mc-sliding-img-box">
					<img src="img/partners/norfolk-carbon-charter.jpg" alt="">
				</div>
				<div class="mc-sliding-img-box">
					<img src="img/partners/PPC_logo.jpg" alt="">
				</div>
				<div class="mc-sliding-img-box">
					<img src="img/partners/princess-royal-training.png" alt="">
				</div>
				<div class="mc-sliding-img-box">
					<img src="img/partners/future-50.jpg" alt="">
				</div>
				<div class="mc-sliding-img-box">
					<img src="img/partners/qms.png" alt="">
				</div>
				<div class="mc-sliding-img-box">
					<img src="img/partners/iso-27001.png" alt="">
				</div>
				<div class="mc-sliding-img-box">
					<img src="img/partners/skills-of-tomorrow.jpg" alt="">
				</div>
			</div>
		</div>
	</div>
</div>
<div class="mc-about-us">
	<div class="mc-section">
	<!-- Shared width-constrained container that keeps content aligned to the global grid. -->
	<div class="mc-container">
		<div class="mc-about-row">
			<div class="mc-about-info">
				<h2><strong>Welcome To Netmatters</strong></h2>
				<p><strong>Netmatters is a leading <a href="#">Bespoke Software</a>, <a href="#">IT Support</a>, 
					and <a href="#">Digital Marketing</a> company based in the East of England 
					with offices in <a href="#">Cambridge</a>, <a href="#">Wymondham</a>, and <a href="#">Great Yarmouth</a>.</strong>
				</p>
				<p>
					We aren't tied into contracts with third-party providers, 
					so you know that our recommendations for your business are based purely with one benefit in mind: 
					to help improve your business with the most appropriate solutions.
				</p>
				<p>
					We pride ourselves on being an ethical business and have a unique business offering and cost model
					 that ensures you get the most from our relationship in an upfront manner.
				</p>
				<div class="mc-about-buttons"> 
					<a class="mc-aboutus-btn mc-button-about" href="#">
						Why Choose Us? <em class="mc-icon-arrow-right"></em>
					</a>
					<a class="mc-aboutus-btn mc-button-about"> 
						Our Culture <em class="mc-icon-arrow-right"></em>
					</a>
				</div>
			</div>
			<div class="mc-about-info">
				<h2><strong>What Our Clients Think</strong></h2>
				<div class="mc-star-rating">
					<div class="mc-icon-star-full"></div>
					<div class="mc-icon-star-full"></div>
					<div class="mc-icon-star-full"></div>
					<div class="mc-icon-star-full"></div>
					<div class="mc-icon-star-full"></div>
				</div>
				<p class="mc-quote">
					Netmatters stood out from the start. Great guys and very easy to work with. Both the build and digital marketing teams are clearly skilled 
					-they know their stuff! They delivered a website to our (high!) 
					expectations and went over and above to ensure we were satisfied clients 
					- and we are!
				</p>
				<p class="mc-quote-author">
					Eleanor Bishop, Head of Marketing - <a href="#">Ashcroft Partnership LLP</a>
				</p>
				<div class="mc-review-buttons"> 
					<a class="mc-aboutus-btn mc-button-about-google"> 
						Google Reviews <em class="mc-icon-arrow-right"></em>
					</a>
					<a class="mc-aboutus-btn mc-button-about-trustpilot"> 
						TrustPilot Reviews <em class="mc-icon-arrow-right"></em>
					</a>
				</div>
			</div>
		</div>
		</div>
	</div>
</div>
<div class="mc-news">
	<!-- Shared width-constrained container that keeps content aligned to the global grid. -->
	<div class="mc-container">
		<div class="mc-news-header">
			<h2><strong>Latest News</strong></h2>
			<h3><a href="#">View All <strong><em class="mc-icon-arrow-right"></em></strong></a></h3>
		</div>
			<div class="mc-news-row">
				<?php foreach ($newsPosts as $newsPost): ?>
					<div class="mc-news-article">
						<a href="#" class="<?php echo htmlspecialchars($newsPost['article_class']); ?>">
							<div class="mc-article-img">
								<span class="<?php echo htmlspecialchars($newsPost['category_class']); ?>">
									<?php echo htmlspecialchars($newsPost['category_label']); ?>
								</span>
								<span class="mc-article-img-box">
									<img
										src="<?php echo htmlspecialchars($newsPost['image_path']); ?>"
										alt="<?php echo htmlspecialchars($newsPost['image_alt']); ?>"
									>
								</span>
							</div>
							<div class="mc-article-description">
								<h3<?php echo $newsPost['title_class'] ? ' class="' . htmlspecialchars($newsPost['title_class']) . '"' : ''; ?>>
									<?php echo htmlspecialchars($newsPost['title']); ?>
								</h3>
								<p>
									<?php echo htmlspecialchars($newsPost['excerpt']); ?>
								</p>
								<span class="mc-news-btn <?php echo htmlspecialchars($newsPost['button_class']); ?>">
									Read More
								</span>
								<div class="mc-article-author">
									<div class="mc-article-author-img">
										<img
											src="<?php echo htmlspecialchars($newsPost['author_image_path']); ?>"
											alt="<?php echo htmlspecialchars($newsPost['author_image_alt']); ?>"
										>
									</div>
									<div class="mc-article-author-name">
										<strong>Posted by <?php echo htmlspecialchars($newsPost['author_name']); ?></strong>
										<br>
										<?php echo (new DateTime($newsPost['published_at']))->format('jS F Y'); ?>
									</div>
								</div>
							</div>
						</a>
					</div>
				<?php endforeach; ?>
			</div>		
		<div class="mc-hidden-view-all">
			<h3><a href="#">View All <strong><em class="mc-icon-arrow-right"></em></strong></a></h3>
		</div>
	</div>
</div>
<div class="mc-clients">
	<div class="mc-section">
		<div class="mc-sliding-imgs">
			<div class="mc-sliding-list">
				<div class="mc-sliding-img-box">
					<div class="mc-logo-tooltip">
					<div class="mc-logo-description">
						<h3>Sweetzy
						</h3>
						<p>
							Sweetzy are an online sweets retailer, based in Wymondham.
						</p>
						<a href="#" class="mc-tooltip-button mc-logo-buttonG">
							View Our Case Study<em class="mc-icon-arrow-right"></em>
						</a>
						<div class="mc-arrow"></div>
					</div>
					</div>
					<img src="img/clients/sweetzy_logo.png" alt="">
				</div>
				<div class="mc-sliding-img-box">
					<div class="mc-logo-tooltip">
					<div class="mc-logo-description">
						<h3>Howes Percival
						</h3>
						<div class="mc-arrow"></div>
					</div></div>
					<img src="img/clients/howespercivallogo.png" alt="">
				</div>
				<div class="mc-sliding-img-box">
					<div class="mc-logo-tooltip">
					<div class="mc-logo-description">
						<h3>GDST
						</h3>
						<p>
							The <a href="#">Girls' Day School Trust (GDST)</a> is the UK's leading family of 25 independant girls' schools.
						</p>
						<a href="#" class="mc-tooltip-button mc-logo-buttonG">
							View Our Case Study<em class="mc-icon-arrow-right"></em>
						</a>
						<div class="mc-arrow"></div>
					</div></div>
					<img src="img/clients/girls_day_school_trust_logob.png" alt="">
				</div>
				<div class="mc-sliding-img-box">
					<div class="mc-logo-tooltip">
					<div class="mc-logo-description">
						<h3>Ashcroft Partnership LLP
						</h3>
						<p>
                        Originally founded in 2006 as Ashcroft Anthony, they became Ashcroft Partnership LLP in 2020 and
                        are one of the top chartered accountancy firms in Cambridge, advising entrepreneurs and
                        families.
						</p>
						<a href="#" class="mc-tooltip-button mc-logo-buttonP">
							View Our Case Study<em class="mc-icon-arrow-right"></em>
						</a>
						<div class="mc-arrow"></div>
					</div></div>
					<img src="img/clients/ashcroftlogo_landscape_goldblack_DP60P-small.png" alt="">
				</div>
				<div class="mc-sliding-img-box">
					<div class="mc-logo-tooltip">
					<div class="mc-logo-description">
						<h3>One Traveller
						</h3>
						<p>
							<a href="#" target="_blank">One Traveller</a>, 
							founded in 2007, is a leading provider of solo holidays for over 50s.                    
						</p>
						<a href="#" class="mc-tooltip-button mc-logo-buttonP">
							View Our Case Study<em class="mc-icon-arrow-right"></em>
						</a>
						<div class="mc-arrow"></div>
					</div>
					</div>
					<img src="img/clients/onetravellerlogo_white_figuire.png" alt="">
				</div>
				<div class="mc-sliding-img-box">
					<div class="mc-logo-tooltip">
					<div class="mc-logo-description">
						<h3>Searles Leisure Resort
						</h3>
						<p>
                        Searles Leisure Resort, on the beautiful North Norfolk coast, is an award-winning UK holiday
                        resort for families.
						</p>
						<a href="#" class="mc-tooltip-button mc-logo-buttonG">
							View Our Case Study<em class="mc-icon-arrow-right"></em>
						</a>
						<div class="mc-arrow"></div>
					</div>
					</div>
					<img src="img/clients/searles_logo.jpg" alt="">
				</div>
				<div class="mc-sliding-img-box">
					<div class="mc-logo-tooltip">
					<div class="mc-logo-description">
						<h3>Busseys
						</h3>
						<p>
							One of the UK's leading Ford dealerships.
						</p>
						<div class="mc-arrow"></div>
					</div>
					</div>
					<img src="img/clients/busseys_logo.png" alt="">
				</div>
				<div class="mc-sliding-img-box">
					<div class="mc-logo-tooltip">
					<div class="mc-logo-description">
						<h3>Crane Garden Buildings
						</h3>
						<p>
                        Leading manufacturer and supplier of high-end garden rooms, summerhouses, workshops and sheds in
                        the UK.
						</p>
						<div class="mc-arrow"></div>
					</div></div>
					<img src="img/clients/crane_logo.png" alt="">
				</div>
				<div class="mc-sliding-img-box">
					<div class="mc-logo-tooltip">
					<div class="mc-logo-description">
						<h3>Black Swan Care Group
						</h3>
						<p>
                        Black Swan Care Group own and manage 21 high-quality care and residential homes with a focus on
                        putting the needs of their residents first.
						</p>
						<a href="#" class="mc-tooltip-button mc-logo-buttonO">
							View Our Case Study<em class="mc-icon-arrow-right"></em>
						</a>
						<div class="mc-arrow"></div>
					</div>
					</div>
					<img src="img/clients/black_swan_logo.png" alt="">
				</div>
				<div class="mc-sliding-img-box">
					<div class="mc-logo-tooltip">
					<div class="mc-logo-description">
						<h3 class="xupes-title">Xupes
							</h3>						
						<div class="mc-arrow"></div>
					</div>
					</div>
					<img src="img/clients/xupes_logo.png" alt="">
				</div>
				<div class="mc-sliding-img-box">
					<div class="mc-logo-tooltip">
					<div class="mc-logo-description">
						<h3>Beat
						</h3>
						<p>
							The UK's eating disorder charity founded in 1989.
						</p>
						<div class="mc-arrow"></div>
					</div></div>
					<img src="img/clients/beat_logo.png" alt="">
				</div>
				<div class="mc-sliding-img-box">
					<div class="mc-logo-tooltip">
					<div class="mc-logo-description">
						<h3>Survey Solutions
						</h3>
						<div class="mc-arrow"></div>
					</div>
					</div>
					<img src="img/clients/survey_solutions_logo.png" alt="">
				</div>
				<div class="mc-sliding-img-box">
					<div class="mc-logo-tooltip">
					<div class="mc-logo-description">
						<h3>Girl Guiding Angelia
						</h3>
						<p>
                        Girl Guiding Anglia is part of Girlguiding, the UK's leading charity for girls and young women in
                        the UK.
						</p>
						<a href="#" class="mc-tooltip-button mc-logo-buttonB">
							View Our Case Study<em class="mc-icon-arrow-right"></em>
						</a>
						<div class="mc-arrow"></div>
					</div>
					</div>
					<img src="img/clients/girl_guides_anglia.png" alt="">
				</div>
			</div>
		</div>
	</div>
</div>
</div> 
<!-- Footer: partner logos, quick links, contact details, social links, and legal/compliance information. -->
<?php include __DIR__ . '/includes/footer.php'; ?>
