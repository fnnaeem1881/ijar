<!DOCTYPE html>
<html lang="en">
@php
    $settings=settings();
    $user=\App\Models\User::find(1);
    \App::setLocale($user->lang);
@endphp

<head>
    <!-- Required meta tags-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{env('APP_NAME')}}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="author" content="{{!empty($settings['app_name'])?$settings['app_name']:env('APP_NAME')}}">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>IJar - @yield('page-title')</title>
    
    <!-- SEO Meta Tags -->
    <meta name="title" content="{{$settings['meta_seo_title'] ?? 'IJar - Smart Property Management System'}}">
    <meta name="keywords" content="{{$settings['meta_seo_keyword'] ?? 'property management, real estate, tenant management, landlord software'}}">
    <meta name="description" content="{{$settings['meta_seo_description'] ?? 'Streamline your property management with IJar - The all-in-one solution for landlords and property managers'}}">
    
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:title" content="IJar - Smart Property Management System">
    <meta property="og:description" content="Streamline your property management with IJar - The all-in-one solution for landlords and property managers">
    <meta property="og:image" content="{{asset(Storage::url('upload/seo')).'/'.$settings['meta_seo_image'] ?? ''}}">
    
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:title" content="IJar - Smart Property Management System">
    <meta property="twitter:description" content="Streamline your property management with IJar - The all-in-one solution for landlords and property managers">
    <meta property="twitter:image" content="{{asset(Storage::url('upload/seo')).'/'.$settings['meta_seo_image'] ?? ''}}">
    
    <!-- Favicon -->
    <link rel="icon" href="{{asset(Storage::url('upload/logo')).'/'.$settings['company_favicon'] ?? ''}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset(Storage::url('upload/logo')).'/'.$settings['company_favicon'] ?? ''}}" type="image/x-icon">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- CSS -->
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #7209b7;
            --accent: #f72585;
            --dark: #1a1a2e;
            --light: #f8f9fa;
            --gray: #6c757d;
            --success: #4cc9f0;
            --border-radius: 12px;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--dark);
            overflow-x: hidden;
        }
        
        h1, h2, h3, h4, h5 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            line-height: 1.2;
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 32px;
            border-radius: var(--border-radius);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }
        
        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
        }
        
        .btn-outline:hover {
            background: var(--primary);
            color: white;
        }
        
        /* Header */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            z-index: 1000;
            padding: 20px 0;
            transition: var(--transition);
        }
        
        .header.scrolled {
            box-shadow: var(--shadow);
            padding: 15px 0;
        }
        
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 28px;
            font-weight: 800;
            color: var(--primary);
            text-decoration: none;
        }
        
        .logo span {
            color: var(--secondary);
        }
        
        .nav-menu {
            display: flex;
            gap: 40px;
            align-items: center;
        }
        
        .nav-menu a {
            text-decoration: none;
            color: var(--dark);
            font-weight: 500;
            transition: var(--transition);
        }
        
        .nav-menu a:hover {
            color: var(--primary);
        }
        
        .nav-buttons {
            display: flex;
            gap: 15px;
        }
        
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: var(--dark);
            cursor: pointer;
        }
        
        /* Hero Section */
        .hero {
            padding: 160px 0 100px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            position: relative;
            overflow: hidden;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            clip-path: polygon(25% 0%, 100% 0%, 100% 100%, 0% 100%);
            opacity: 0.1;
        }
        
        .hero-content {
            max-width: 600px;
        }
        
        .hero h1 {
            font-size: 56px;
            margin-bottom: 20px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .hero p {
            font-size: 18px;
            color: var(--gray);
            margin-bottom: 40px;
            max-width: 500px;
        }
        
        .hero-buttons {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .hero-image {
            position: absolute;
            right: 50px;
            top: 50%;
            transform: translateY(-50%);
            width: 45%;
        }
        
        /* Features Section */
        .section {
            padding: 100px 0;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }
        
        .section-title h2 {
            font-size: 42px;
            margin-bottom: 15px;
        }
        
        .section-title p {
            color: var(--gray);
            font-size: 18px;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .feature-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 40px 30px;
            box-shadow: var(--shadow);
            transition: var(--transition);
            text-align: center;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
        }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: white;
            font-size: 32px;
        }
        
        .feature-card h3 {
            font-size: 22px;
            margin-bottom: 15px;
        }
        
        .feature-card p {
            color: var(--gray);
        }
        
        /* Dashboard Preview */
        .dashboard-preview {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: white;
            padding: 100px 0;
            border-radius: 40px;
            margin: 50px 0;
            position: relative;
            overflow: hidden;
        }
        
        .dashboard-preview::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: radial-gradient(circle, rgba(67, 97, 238, 0.1) 0%, transparent 70%);
        }
        
        .dashboard-image {
            max-width: 800px;
            margin: 0 auto;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }
        
        /* Testimonials */
        .testimonials {
            background: var(--light);
        }
        
        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .testimonial-card {
            background: white;
            padding: 30px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
        }
        
        .testimonial-text {
            font-style: italic;
            margin-bottom: 20px;
            color: var(--gray);
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        
        /* CTA Section */
        .cta {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            text-align: center;
            padding: 80px 0;
            border-radius: 40px;
            margin: 50px 0;
        }
        
        .cta h2 {
            font-size: 42px;
            margin-bottom: 20px;
        }
        
        .cta p {
            font-size: 18px;
            margin-bottom: 40px;
            opacity: 0.9;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .cta .btn {
            background: white;
            color: var(--primary);
            font-weight: 600;
        }
        
        .cta .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        /* Footer */
        .footer {
            background: var(--dark);
            color: white;
            padding: 60px 0 30px;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }
        
        .footer-section h3 {
            font-size: 20px;
            margin-bottom: 20px;
            color: white;
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 10px;
        }
        
        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: var(--transition);
        }
        
        .footer-links a:hover {
            color: white;
        }
        
        .copyright {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.6);
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .hero {
                padding: 140px 0 80px;
            }
            
            .hero h1 {
                font-size: 48px;
            }
            
            .hero-image {
                position: relative;
                right: 0;
                top: 0;
                transform: none;
                width: 100%;
                margin-top: 50px;
            }
            
            .nav-menu {
                position: fixed;
                top: 0;
                right: -100%;
                width: 300px;
                height: 100vh;
                background: white;
                flex-direction: column;
                padding: 80px 40px;
                transition: var(--transition);
                box-shadow: var(--shadow);
            }
            
            .nav-menu.active {
                right: 0;
            }
            
            .mobile-menu-btn {
                display: block;
            }
        }
        
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 36px;
            }
            
            .section {
                padding: 60px 0;
            }
            
            .section-title h2 {
                font-size: 32px;
            }
            
            .hero-buttons {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header" id="header">
        <div class="container header-container">
            <a href="#" class="logo">I<span>Jar</span></a>
            
            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <i class="fas fa-bars"></i>
            </button>
            
            <nav class="nav-menu" id="navMenu">
                <a href="#features">{{__('Features')}}</a>
                <a href="#dashboard">{{__('Dashboard')}}</a>
                <a href="#testimonials">{{__('Testimonials')}}</a>
                <a href="#faq">{{__('FAQs')}}</a>
                
                <div class="nav-buttons">
                    @if($settings['register_page']=='on')
                        <a href="{{route('register')}}" class="btn btn-outline">{{__('Get Started')}}</a>
                    @endif
                    <a href="{{route('login')}}" class="btn btn-primary">{{__('Login')}}</a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>{{__('Simplify Property Management with IJar')}}</h1>
                <p>{{__('Streamline your rental properties, automate tasks, and grow your real estate business with our all-in-one property management platform. Designed for landlords who want efficiency without complexity.')}}</p>
                <div class="hero-buttons">
                    <a href="{{route('register')}}" class="btn btn-primary">
                        <i class="fas fa-rocket"></i> {{__('Start Free Trial')}}
                    </a>
                    <a href="#features" class="btn btn-outline">
                        <i class="fas fa-play-circle"></i> {{__('Watch Demo')}}
                    </a>
                </div>
            </div>
            <div class="hero-image">
                <img src="{{ asset('assets/images/landing/1.png') }}" alt="IJar Dashboard" style="width: 100%; border-radius: 20px; box-shadow: var(--shadow);">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="section" id="features">
        <div class="container">
            <div class="section-title">
                <h2>{{__('Everything You Need in One Platform')}}</h2>
                <p>{{__('Powerful features that simplify property management and help you save time')}}</p>
            </div>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <h3>{{__('Property Management')}}</h3>
                    <p>{{__('Track all your properties, manage leases, and handle maintenance requests from one dashboard.')}}</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>{{__('Tenant Portal')}}</h3>
                    <p>{{__('Provide tenants with self-service options for rent payments, maintenance requests, and communication.')}}</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
<h3>{{__('Automated Invoicing')}}</h3>
                    <p>{{__('Automatically generate invoices, track payments, and send reminders to ensure timely collections.')}}</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>{{__('Financial Reports')}}</h3>
                    <p>{{__('Get detailed insights into your property performance, expenses, and profitability with smart analytics.')}}</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <h3>{{__('Maintenance Tracking')}}</h3>
                    <p>{{__('Streamline maintenance requests, assign tasks to vendors, and track completion status in real-time.')}}</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>{{__('Secure & Compliant')}}</h3>
                    <p>{{__('Bank-level security and compliance features to protect your data and ensure regulatory requirements.')}}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Dashboard Preview -->
    <section class="dashboard-preview" id="dashboard">
        <div class="container">
            <div class="section-title" style="color: white;">
                <h2>{{__('Smart Dashboard Overview')}}</h2>
                <p>{{__('Get a complete view of your property portfolio with our intuitive dashboard')}}</p>
            </div>
            
            <div class="dashboard-image">
                <img src="{{ asset('assets/images/landing/1.png') }}" alt="IJar Dashboard" style="width: 100%; display: block;">
            </div>
            
            <div class="features-grid" style="margin-top: 60px;">
                <div class="feature-card" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); color: white;">
                    <div class="feature-icon" style="background: rgba(255, 255, 255, 0.2);">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3>{{__('Real-time Updates')}}</h3>
                    <p>{{__('Get instant notifications and updates on all property activities')}}</p>
                </div>
                
                <div class="feature-card" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); color: white;">
                    <div class="feature-icon" style="background: rgba(255, 255, 255, 0.2);">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3>{{__('Mobile Friendly')}}</h3>
                    <p>{{__('Manage your properties on-the-go with our mobile-responsive design')}}</p>
                </div>
                
                <div class="feature-card" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); color: white;">
                    <div class="feature-icon" style="background: rgba(255, 255, 255, 0.2);">
                        <i class="fas fa-sync"></i>
                    </div>
                    <h3>{{__('Auto Sync')}}</h3>
                    <p>{{__('Automatic synchronization across all devices and team members')}}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="section testimonials" id="testimonials">
        <div class="container">
            <div class="section-title">
                <h2>{{__('Trusted by Property Managers')}}</h2>
                <p>{{__('See what our customers say about their experience with IJar')}}</p>
            </div>
            
            <div class="testimonial-grid">
                <div class="testimonial-card">
                    <div class="testimonial-text">
                        "IJar transformed how we manage our 50+ properties. The automation features saved us 20 hours per week!"
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">SR</div>
                        <div>
                            <h4>Sarah Johnson</h4>
                            <p>Property Manager, Urban Living</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <div class="testimonial-text">
                        "The tenant portal reduced our communication workload by 60%. Best investment we made this year."
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">MR</div>
                        <div>
                            <h4>Michael Roberts</h4>
                            <p>Landlord, Premium Properties</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <div class="testimonial-text">
                        "As a small landlord, IJar gave me enterprise-level tools at an affordable price. Highly recommended!"
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">ED</div>
                        <div>
                            <h4>Emma Davis</h4>
                            <p>Independent Landlord</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <h2>{{__('Ready to Transform Your Property Management?')}}</h2>
            <p>{{__('Join thousands of property managers who trust IJar to streamline their operations and grow their business.')}}</p>
            <a href="{{route('register')}}" class="btn">
                <i class="fas fa-calendar-check"></i> {{__('Start Your Free Trial')}}
            </a>
            <p style="margin-top: 20px; font-size: 14px;">{{__('No credit card required • 14-day free trial • Cancel anytime')}}</p>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="section" id="faq">
        <div class="container">
            <div class="section-title">
                <h2>{{__('Frequently Asked Questions')}}</h2>
                <p>{{__('Find answers to common questions about IJar')}}</p>
            </div>
            
            <div style="max-width: 800px; margin: 0 auto;">
                <div class="faq-item" style="margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 20px;">
                    <h3 style="margin-bottom: 10px;">{{__('Is there a free trial available?')}}</h3>
                    <p style="color: var(--gray);">{{__('Yes, we offer a 14-day free trial with full access to all features. No credit card required to start.')}}</p>
                </div>
                
                <div class="faq-item" style="margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 20px;">
                    <h3 style="margin-bottom: 10px;">{{__('Can I manage multiple properties?')}}</h3>
                    <p style="color: var(--gray);">{{__('Absolutely! IJar supports unlimited properties, tenants, and units in all our plans.')}}</p>
                </div>
                
                <div class="faq-item" style="margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 20px;">
                    <h3 style="margin-bottom: 10px;">{{__('Do you provide customer support?')}}</h3>
                    <p style="color: var(--gray);">{{__('We offer 24/7 email support and live chat during business hours. Priority support is available in higher plans.')}}</p>
                </div>
                
                <div class="faq-item" style="margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 20px;">
                    <h3 style="margin-bottom: 10px;">{{__('Is my data secure?')}}</h3>
                    <p style="color: var(--gray);">{{__('We use bank-level encryption and security protocols. Your data is backed up daily and stored securely.')}}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <a href="#" class="logo" style="color: white; margin-bottom: 20px; display: inline-block;">I<span>Jar</span></a>
                    <p style="color: rgba(255, 255, 255, 0.7); margin-bottom: 20px;">{{__('Streamlining property management for modern landlords and property managers.')}}</p>
                </div>
                
                <div class="footer-section">
                    <h3>{{__('Product')}}</h3>
                    <ul class="footer-links">
                        <li><a href="#features">{{__('Features')}}</a></li>
                        <li><a href="#dashboard">{{__('Dashboard')}}</a></li>
                        <li><a href="#">{{__('Mobile App')}}</a></li>
                        <li><a href="#">{{__('Updates')}}</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>{{__('Company')}}</h3>
                    <ul class="footer-links">
                        <li><a href="#">{{__('About Us')}}</a></li>
                        <li><a href="#">{{__('Careers')}}</a></li>
                        <li><a href="#">{{__('Blog')}}</a></li>
                        <li><a href="#">{{__('Contact')}}</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>{{__('Connect')}}</h3>
                    <ul class="footer-links">
                        <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
                        <li><a href="#"><i class="fab fa-linkedin"></i> LinkedIn</a></li>
                        <li><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="copyright">
                <p>{{__('Copyright')}} © {{date('Y')}} IJar. {{__('All rights reserved.')}}</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.getElementById('header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Mobile menu toggle
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            document.getElementById('navMenu').classList.toggle('active');
            this.innerHTML = this.innerHTML.includes('bars') ? 
                '<i class="fas fa-times"></i>' : 
                '<i class="fas fa-bars"></i>';
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const navMenu = document.getElementById('navMenu');
            const menuBtn = document.getElementById('mobileMenuBtn');
            
            if (!navMenu.contains(event.target) && !menuBtn.contains(event.target)) {
                navMenu.classList.remove('active');
                menuBtn.innerHTML = '<i class="fas fa-bars"></i>';
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                    
                    // Close mobile menu after clicking
                    document.getElementById('navMenu').classList.remove('active');
                    document.getElementById('mobileMenuBtn').innerHTML = '<i class="fas fa-bars"></i>';
                }
            });
        });

        // Add animation on scroll
        function animateOnScroll() {
            const elements = document.querySelectorAll('.feature-card, .testimonial-card');
            
            elements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                
                if (elementTop < windowHeight - 100) {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }
            });
        }

        // Set initial state for animation
        document.querySelectorAll('.feature-card, .testimonial-card').forEach(element => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(20px)';
            element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        });

        // Trigger animation on load and scroll
        window.addEventListener('load', animateOnScroll);
        window.addEventListener('scroll', animateOnScroll);
    </script>
</body>
</html>