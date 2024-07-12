<x-default-layout>
    <link rel="stylesheet" href="{{ asset('assets/css/web-scraper.css') }}">
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Pricing Plans</title>
            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
            <style>
                .pricing-section {
                    padding: 40px 0;
                }
                .card-pricing {
                    border: 1px solid #e1e1e1;
                    border-radius: 10px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                }
                .card-pricing .card-body {
                    padding: 30px;
                }
                .card-pricing .card-title {
                    margin-bottom: 20px;
                    font-size: 24px;
                    font-weight: bold;
                }
                .card-pricing .price {
                    font-size: 36px;
                    font-weight: bold;
                    margin: 20px 0;
                }
                .card-pricing .features li {
                    margin-bottom: 10px;
                }
                .btn-select {
                    margin-top: 20px;
                    padding: 10px 30px;
                    font-size: 16px;
                }
            </style>
        </head>
        <body>
            <div class="container pricing-section">
                <h2 class="text-center mb-4">Choose Your Plan</h2>
                <p class="text-center mb-4">If you need more info about our pricing, please check <a href="#">Pricing Guidelines</a>.</p>
                <div class="text-center mb-4">
                    <button class="btn btn-outline-primary">Monthly</button>
                    <button class="btn btn-outline-primary">Annual</button>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card card-pricing">
                            <div class="card-body text-center">
                                <h5 class="card-title">Startup</h5>
                                <p>Optimal for 10+ team size and new startup</p>
                                <div class="price">$39 <small>/ Mon</small></div>
                                <ul class="list-unstyled features">
                                    <li>Up to {{ config('quotas.quota1') }} Monthly Searches <span class="text-success">&#10003;</span></li>
                                </ul>
                                <button class="btn btn-primary btn-select">Select</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card card-pricing">
                            <div class="card-body text-center">
                                <h5 class="card-title">Advanced</h5>
                                <p>Optimal for 100+ team size and grown company</p>
                                <div class="price">$339 <small>/ Mon</small></div>
                                <ul class="list-unstyled features">
                                    <li>Up to {{ config('quotas.quota2') }} Monthly Searches <span class="text-success">&#10003;</span></li>
                                </ul>
                                <button class="btn btn-primary btn-select">Select</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card card-pricing">
                            <div class="card-body text-center">
                                <h5 class="card-title">Enterprise</h5>
                                <p>Optimal for 1000+ team and enterprise</p>
                                <div class="price">Contact Us</div>
                                <ul class="list-unstyled features">
                                    <li>Up to 10 Active Users <span class="text-success">&#10003;</span></li>
                                    <li>Up to 30 Project Integrations <span class="text-success">&#10003;</span></li>
                                    <li>Analytics Module <span class="text-success">&#10003;</span></li>
                                    <li>Finance Module <span class="text-success">&#10003;</span></li>
                                    <li>Accounting Module <span class="text-success">&#10003;</span></li>
                                    <li>Network Platform <span class="text-success">&#10003;</span></li>
                                    <li>Unlimited Cloud Space <span class="text-success">&#10003;</span></li>
                                </ul>
                                <button class="btn btn-primary btn-select">Select</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
    </html>

</x-default-layout>