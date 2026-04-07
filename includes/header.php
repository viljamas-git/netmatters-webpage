<!--
HEADER PARTIAL GUIDE
- Renders the primary desktop/mobile header controls shared by all pages.
- Includes search, support/contact calls-to-action, and hamburger triggers.
- Keeps branding and navigation entry points consistent across templates.
-->
<!-- Main site shell: wraps all visible page content separate from overlays like cookie prompt and sidebar. -->
<div class="mc-website">
<div class="mc-head">
<!-- Primary header: desktop brand area with phone shortcut, CTAs, search, and menu trigger. -->
<header id="mc-mainHeader">
	<div class="mc-header-inner">
		<!-- Shared width-constrained container that keeps content aligned to the global grid. -->
	<div class="mc-container">
			<div class="mc-header-row">
				<div class="mc-header-logo">
					<a href="index.php"><img src="img/f-logo.png" alt="Netmatters Logo"></a>
				</div>
				<div class="mc-hidden-mobile">
					<a class="mc-mobile" href="#"> <span class="mc-icon-phone_in_talk"></span></a>
				</div>
				<div class="mc-header-buttons">
				<div class="mc-contact">
					<a class="mc-header-btn mc-button-support" href="#"><span class="mc-icon-mouse"></span>Support</a>
					<a class="mc-header-btn mc-button-contact" href="contact-us.php"><span class="mc-icon-paperplane"></span>Contact</a>
					<form class="mc-search" method="GET" action="#" accept-charset="UTF-8">
						<label class="mc-s1" for="mc-search-input" >Search:</label>
						<input id="mc-search-input" class="mc-form-search" placeholder="Search..." name="keyword" type="text">
						<button id="mc-search-submit" class="mc-search-submit" type="submit">
							<span class="mc-icon-search" aria-hidden="true"></span>
						</button>
					</form>
					<button id="mc-hamburger" class="mc-button-hamburger" type="button">
						<span class="mc-hamburger-box">
                            <span id="mc-hamburger-inner" class="mc-hamburger-inner"></span>
                        </span>
					</button>
				</div>
				</div>
			</div>
			<div class="mc-mobile-contact">
				<form class="mc-mobile-search" method="GET" action="#" accept-charset="UTF-8">
						<label class="mc-hidden-label" for="mc-mobile-input" >Search:</label>
						<input id="mc-mobile-input" class="mc-mobile-form-search" placeholder="Search..." name="keyword" type="text">
						<button id="mc-mobile-submit" class="mc-mobile-submit" type="submit">
							<span class="mc-icon-search" aria-hidden="true"></span>
						</button>
				</form>
			</div>
		</div>
	</div>
</header>
<!-- Primary services navigation: top-level categories with large flyout sub-navigation panels. -->
<nav>
	<!-- Shared width-constrained container that keeps content aligned to the global grid. -->
	<div class="mc-container">
		<ul class="mc-main-nav">
			<li class="mc-consultancy mc-main-nav-item"><a href="#" class="mc-CD mc-nav-item"><span class="mc-icon-laptop mc-nav-icon"></span><small>Consultancy&nbsp;&amp;</small> Development</a>
				<div class="mc-sub-nav-CD mc-sub-nav">
					<!-- Shared width-constrained container that keeps content aligned to the global grid. -->
	<div class="mc-container">
						<ul class="mc-sub-nav-list">
							<li class="mc-sub-nav-title"> Our Consultancy & Development Services</li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-cogs"></span>
								</span>
								<span  class="mc-link-text">Bespoke CRM</span>
							</a></li>
								<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
									<span class="mc-link-icon">
										<span class="mc-icon-briefcase"></span>
									</span>
								<span  class="mc-link-text">Business Automation</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-random"></span>
								</span>
								<span  class="mc-link-text">Software Integration</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-mobile"></span>
								</span>
								<span  class="mc-link-text">Mobile App Development</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-folder-open"></span>
								</span>
								<span  class="mc-link-text">Bespoke Databases</span></a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-tab"></span>
								</span>
								<span  class="mc-link-text">Sharepoint Development</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-download"></span>
								</span>
								<span  class="mc-link-text">Operational Systems</span></a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-users"></span>
								</span>
								<span  class="mc-link-text">Business Central Implementation</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-laptop1"></span>
								</span>
								<span  class="mc-link-text">Internet of Things (IoT) Software</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-cloud"></span>
								</span>
								<span  class="mc-link-text">Intranet Development</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-cloud-download"></span>
								</span>
								<span  class="mc-link-text">Customer Portal Development</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-globe"></span>
								</span>
								<span  class="mc-link-text">Reporting Hub</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-handshake-o"></span>
								</span>
								<span  class="mc-link-text">SAP S/4HANA Management</span>
							</a></li>
						</ul>
					</div>
				</div>
			</li>
			<li class="mc-itsupport mc-main-nav-item"><a href="#" class="mc-ITS mc-nav-item"><span class="mc-icon-display mc-nav-icon"></span><small>IT</small> Support</a>
				<div class="mc-sub-nav-ITS mc-sub-nav">
					<!-- Shared width-constrained container that keeps content aligned to the global grid. -->
	<div class="mc-container">
						<ul class="mc-sub-nav-list">
							<li class="mc-sub-nav-title">Our IT Support Services</li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-headphones"></span>
								</span>
								<span  class="mc-link-text">Managed IT Support</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-briefcase"></span>
								</span>
								<span  class="mc-link-text">Business IT Support</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-laptop1"></span>
								</span>
								<span  class="mc-link-text">Office 365 for Business</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-school"></span>
								</span>
								<span  class="mc-link-text">IT Consultancy</span></a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-cloud"></span>
								</span>
								<span  class="mc-link-text">Cloud Service Provider</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-drive"></span>
								</span>
								<span  class="mc-link-text">Data Backup & Disater Recovery</span>
							</a></li>
						</ul>
					</div>
				</div>
			</li>
			<li class="mc-digital mc-main-nav-item"><a href="#" class="mc-DM mc-nav-item"><span class="mc-icon-bar-graph mc-nav-icon"></span><small>Digital</small> Marketing</a>
				<div class="mc-sub-nav-DM mc-sub-nav">
					<!-- Shared width-constrained container that keeps content aligned to the global grid. -->
	<div class="mc-container">
						<ul class="mc-sub-nav-list">
							<li class="mc-sub-nav-title">Our Digital Marketing Services</li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-search"></span>
								</span>
								<span  class="mc-link-text">Search Engine Optimisation (SEO)</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-money"></span>
								</span>
								<span  class="mc-link-text">Pay Per Click Advertising (PPC)</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-trending_up"></span>
								</span>
								<span  class="mc-link-text">Conversion Rate Optimisation (CRO)</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-envelope-o"></span>
								</span>
								<span class="mc-link-text">Email Marketing</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-users"></span>
								</span>
								<span  class="mc-link-text">Social Media Marketing</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-edit-pencil"></span>
								</span>
								<span  class="mc-link-text">Content Marketing</span>
							</a></li>
						</ul>
					</div>
				</div>
			</li>
			<li class="mc-telecoms mc-main-nav-item"><a href="#" class="mc-TS mc-nav-item"><span class="mc-icon-phone_in_talk mc-nav-icon"></span><small>Telecoms</small> Services</a>
				<div class="mc-sub-nav-TS mc-sub-nav">
					<!-- Shared width-constrained container that keeps content aligned to the global grid. -->
	<div class="mc-container">
						<ul class="mc-sub-nav-list">
							<li class="mc-sub-nav-title">Our Telecom Services</li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-ticket"></span>
								</span>
								<span  class="mc-link-text">Business Mobile</span></a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-phone"></span>
								</span>
								<span  class="mc-link-text">Phone System Health Check</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-phone-square"></span>
								</span>
								<span  class="mc-link-text">Business Phone Systems</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-dashboard"></span>
								</span>
								<span  class="mc-link-text">Business connectivity</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-handshake-o"></span>
								</span>
								<span  class="mc-link-text">Telecoms Bill Review</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-phone_in_talk"></span>
								</span>
								<span  class="mc-link-text">3CX Systems</span>
							</a></li>
						</ul>
					</div>
				</div>
			</li>
			<li class="mc-webdesign mc-main-nav-item"><a href="#" class="mc-WD mc-nav-item"><span class="mc-icon-code mc-nav-icon"></span><small>Web</small> Design</a>
				<div class="mc-sub-nav-WD mc-sub-nav">
					<!-- Shared width-constrained container that keeps content aligned to the global grid. -->
	<div class="mc-container">
						<ul class="mc-sub-nav-list">
							<li class="mc-sub-nav-title">Our Web Design Services</li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-edit-pencil"></span>
								</span>
								<span class="mc-link-text" >Bespoke Website Design</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-shopping-cart"></span>
								</span>
								<span  class="mc-link-text">eCommerce Website Design</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-desktop"></span>
								</span>
								<span class="mc-link-text" >Pay Monthly Websites</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-bullhorn"></span>
								</span>
								<span class="mc-link-text" >Branding & Design</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-mobile"></span>
								</span>
								<span class="mc-link-text" >Mobile App Development</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-cloud"></span>
								</span>
								<span class="mc-link-text" >Web Hosting</span>
							</a></li>
						</ul>
					</div> 
				</div>
			</li>
			<li class="mc-cyber mc-main-nav-item"><a href="#" class="mc-CS mc-nav-item"><span class="mc-icon-security mc-nav-icon"></span><small>Cyber</small> Security</a>
				<div class="mc-sub-nav-CS mc-sub-nav">
					<!-- Shared width-constrained container that keeps content aligned to the global grid. -->
	<div class="mc-container">
						<ul class="mc-sub-nav-list">
							<li class="mc-sub-nav-title">Our Cyber Security Services</li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-clipboard"></span>
								</span>
								<span class="mc-link-text" >Cyber Security Assessment</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-clock"></span>
								</span>
								<span class="mc-link-text" >Cyber Security Management</span>
							</a></li>
								<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-flask"></span>
								</span>
								<span class="mc-link-text" >Cyber Penetration Testing</span>
							</a></li>
								<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
									<span class="mc-link-icon">
										<span class="mc-icon-school"></span>
									</span>
								<span class="mc-link-text" >Cyber Essentials Certification</span>
							</a></li>
								<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
									<span class="mc-link-icon">
										<span class="mc-icon-security"></span>
									</span>
								<span class="mc-link-text" >PCI Compliance</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-lock"></span>
								</span>
								<span class="mc-link-text" >Hacking Prevention</span>
							</a></li>
						</ul>
					</div>
				</div>
			</li>
			<li class="mc-developer mc-main-nav-item"><a href="#" class="mc-DC mc-nav-item"><span class="mc-icon-school mc-nav-icon"></span><small>Developer</small> Course</a>
				<div class="mc-sub-nav-DC mc-sub-nav">
					<!-- Shared width-constrained container that keeps content aligned to the global grid. -->
	<div class="mc-container">
						<ul class="mc-sub-nav-list">
							<li class="mc-sub-nav-title">Our Developer Course Services</li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-laptop1"></span>
								</span>
								<span class="mc-link-text" >Train For A Career In Tech</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-code"></span>
								</span>
								<span class="mc-link-text" >Skills Bootcamp</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-question-circle"></span>
								</span>
								<span class="mc-link-text" >Scion Scheme Frequently Asked Questions</span>
							</a></li>
							<!-- Individual service destination inside a mega-menu list. -->
							<li class="mc-sub-nav-link"><a href="#">
								<span class="mc-link-icon">
									<span class="mc-icon-handshake-o"></span>
								</span>
								<span class="mc-link-text" >Scion Collaborators</span>
							</a></li>
						</ul>
					</div>
				</div>
			</li>
		</ul>
	</div>
</nav>
