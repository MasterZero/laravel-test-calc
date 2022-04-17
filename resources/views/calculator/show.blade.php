<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Calculator</title>


        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <header>
            <div class="collapse bg-dark" id="navbarHeader">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-md-7 py-4">
                            <h4 class="text-white">About</h4>
                            <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
                        </div>
                        <div class="col-sm-4 offset-md-1 py-4">
                            <h4 class="text-white">Contact</h4>
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-white">Follow on Twitter</a></li>
                                <li><a href="#" class="text-white">Like on Facebook</a></li>
                                <li><a href="#" class="text-white">Email me</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar navbar-dark bg-dark shadow-sm">
                <div class="container">
                    <a href="#" class="navbar-brand d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                        <strong>Album</strong>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>
        </header>

        <main>
            <section class="py-5 text-center container">
                <div class="row py-lg-5">
                    <div class="col-lg-6 col-md-8 mx-auto">

                        <h1 class="fw-light">Hello, Lorem Ipsum</h1>

                        <form id="calc-form" method="GET" class="container" action="{{ route('api.calculate') }}">

                            <div class="row g-2 mb-2">
                                <div class="col-md form-floating">
                                    <input type="text" id="amount" name="amount" class="form-control" placeholder="10000" />
                                    <label class="form-label" for="amount">Amount</label>
                                </div>
                                <div class="col-md form-floating">
                                    <input type="text" id="month" name="month" class="form-control" placeholder="1" />
                                    <label class="form-label" for="month">Month</label>
                                </div>
                                <div class="col-md form-floating">
                                    <input type="text" id="year" name="year" class="form-control" placeholder="2022" />
                                    <label class="form-label" for="year">Year</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-md form-floating">
                                    <input type="text" id="should_work" name="should_work" class="form-control" placeholder="22" />
                                    <label class="form-label" for="should_work">Days should work</label>
                                </div>
                                <div class="col-md form-floating">
                                    <input type="text" id="actually_work" name="actually_work" class="form-control" placeholder="20" />
                                    <label class="form-label" for="actually_work">Actually days work</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-md form-check">
                                    <input class="form-check-input" type="checkbox" name="mzp" value="true" id="mzp">
                                    <label class="form-check-label float-start" for="mzp">has "МЗП"</label>
                                </div>
                                <div class="col-md form-check">
                                    <input class="form-check-input" type="checkbox" value="true" name="pensioner" id="pensioner">
                                    <label class="form-check-label float-start" for="pensioner">is pensioner</label>
                                </div>
                                <div class="col-md">
                                    <select class="form-select" name="disability" aria-label="Default select example">
                                        <option disabled>Disability</option>
                                        <option value="0">Disability - no</option>
                                        <option value="1">Disability - 1 group</option>
                                        <option value="2">Disability - 2 group</option>
                                        <option value="3">Disability - 3 group</option>
                                    </select>
                                </div>
                            </div>

                            <button type="button" id="calculate-button" class="btn btn-primary my-2">calculate</button>
                            <button type="button" id="save-button" class="btn btn-primary my-2">calculate & save</button>
                        </form>


                        <div class=" visually-hidden">
                            <textarea class="form-control" id="textAreaResult" rows="10" readonly></textarea>
                        </div>



                    </div>
                </div>
            </section>


        </main>

        <footer class="text-muted py-5">
            <div class="container">
                <p class="float-end mb-1">
                    <a href="#">Back to top</a>
                </p>
                <p class="mb-1">Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
                <p class="mb-0">New to Bootstrap? <a href="/">Visit the homepage</a> or read our <a href="/docs/5.0/getting-started/introduction/">getting started guide</a>.</p>
            </div>
        </footer>



        <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>
