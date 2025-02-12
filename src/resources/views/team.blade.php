@extends('template')
@section('title', 'Team - Pulsetracker')
@section('content')
    <div class="container mt-5">
        
        <div class="row justify-content-center" style="margin-top: 15%;">
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="card bg-dark">
                    <img src="{{ url('assets/img/LAGGOUNE-Walid.png') }}" 
                         class="card-img-top rounded-circle mx-auto d-block img-fluid"
                         style="-webkit-filter: grayscale(100%); filter: grayscale(100%); width: 300px; height: 300px; object-fit: cover; max-width: 100%; height: auto;"
                         alt="Founder - LAGGOUNE Walid">
                    <div class="card-body bg-dark">
                        <p class="card-text text-center">LAGGOUNE Walid</p>
                        <p class="fs-6 card-text text-center">Founder - Backend developer - Mobile radio networks engineer</p>
                        <p class="fs-6 text-center">
                            <a href="https://x.com/laggwalid">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                                    <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                                </svg>
                            </a>&nbsp;
                            <a href="https://www.linkedin.com/in/walid-laggoune-295ab824a/">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                                    <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
                                </svg>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="card bg-dark">
                    <img src="{{ url('assets/img/George-Theodoropoulos.jpeg') }}" 
                         class="card-img-top rounded-circle mx-auto d-block img-fluid"
                         style="-webkit-filter: grayscale(100%); filter: grayscale(100%); width: 300px; height: 300px; object-fit: cover; max-width: 100%; height: auto;"
                         alt="Cofounder - George Theodoropoulos">
                    <div class="card-body bg-dark">
                        <p class="card-text text-center">George Theodoropoulos</p>
                        <p class="fs-6 card-text text-center">Cofounder - Sales and marketing - Physician</p>
                        <p class="fs-6 text-center">
                            <a href="https://x.com/GeorgeT24827718">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                                    <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                                </svg>
                            </a>&nbsp;
                            <a href="https://www.linkedin.com/in/george-theodoropoulos-274b8834b/">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                                    <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
                                </svg>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col">
                <section class="our-story py-5">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <h1 class="display-4 text-center mb-5">Our Story: Building Pulsetracker</h1>
                
                                <div class="story-section mb-5">
                                    <h2 class="h3 mb-3">The Spark: A Developer's Dilemma</h2>
                                    <p class="lead">Hi, I'm <strong>Lagggoune Walid</strong>, founder of Pulsetracker. In 2024, while working on a location-based project, I needed to integrate real-time location tracking into an existing mobile app & backend. The goal was straightforward: create a scalable backend that could handle live location updates and display them seamlessly in a dashboard.</p>
                                </div>
                
                                <div class="story-section mb-5">
                                    <h2 class="h3 mb-3">The Struggle: Why Reinvent the Wheel?</h2>
                                    <p class="lead">Existing services fell short. A few niche tools claimed to offer real-time tracking, but they were clunky, restrictive, and anything but developer-first. Most locked users into their proprietary dashboards, making it impossible to visualize data in <em>our</em> system or retain full ownership of the data. I felt trapped:</p>
                                    <ul class="mb-4 ">
                                        <li class="lead"><strong>No flexibility:</strong> Tools demanded we use <em>their</em> UI, not ours.</li>
                                        <li class="lead"><strong>Hidden complexity:</strong> "Simple" APIs required hours of wrestling with docs.</li>
                                        <li class="lead"><strong>Scalability fears:</strong> Solutions buckled under heavy loads or charged exorbitantly to scale.</li>
                                    </ul>
                                </div>
                
                                <div class="story-section mb-5">
                                    <h2 class="h3 mb-3">The Breakthrough: Coding the Solution Ourselves</h2>
                                    <p class="lead">So, we built it.</p>
                                    <p class="lead">Pulsetracker was born from a simple vision: <strong>Empower developers to integrate real-time location tracking in hours—not weeks—without sacrificing control or scalability.</strong> We stripped away the complexity, focusing on three pillars:</p>
                                    <div class="row mt-4">
                                        <div class="col-md-4 mb-4">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <h5 class="card-title">Developer-First Design</h5>
                                                    <p class="card-text">APIs that work the way developers think, with clean documentation and straightforward integration.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <h5 class="card-title">Your Dashboard, Your Rules</h5>
                                                    <p class="card-text">See live updates in <em>your</em> UI and store data in <em>your</em> database—no lock-in.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <h5 class="card-title">Scale Fearlessly</h5>
                                                    <p class="card-text">Pulsetracker architected to handle millions of updates, so you focus on building features, not infrastructure.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                
                                <div class="story-section mb-5">
                                    <h2 class="h3 mb-3">The Mission: More Than Just Code</h2>
                                    <p class="lead">Today, Pulsetracker isn’t just a tool—it’s a response to the frustrations we faced as developers. Our goal is to turn location tracking from a hurdle into a superpower. Whether you’re building a delivery app, a fitness platform, or a fleet management system, Pulsetracker exists so you can:</p>
                                    <div class="row mt-4">
                                        <div class="col-md-4 mb-4">
                                            <div class="text-center">
                                                <span class="h1">🚀</span>
                                                <h5>Launch Faster</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <div class="text-center">
                                                <span class="h1">🎨</span>
                                                <h5>Stay in Control</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <div class="text-center">
                                                <span class="h1">📈</span>
                                                <h5>Scale Effortlessly</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                
                                <div class="cta-section text-center py-5">
                                    <p class="lead mb-4">Pulsetracker is the tool I wish I’d had. Let’s make building the future a little easier, together.</p>
                                    <p class="text-muted mb-4">— Lagggoune Walid<br><em>Founder, Pulsetracker</em></p>
                                    <div class="d-flex justify-content-center gap-3">
                                        <a href="{{url('signup')}}" class="btn btn-primary btn-lg">Start Your Story</a>
                                        <a href="https://docs.pulsestracker.com" class="btn btn-outline-primary btn-lg">Read Developer Docs</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
