<div class="page-content">
    <div class="page-header">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Dashboard</h2>
        </div>
    </div>

    <section class="no-padding-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="block text-center">
                        <h3>
                            Welcome,
                            <strong>{{ Auth::user()->name }}</strong>
                        </h3>

                        <p class="text-muted mt-2">
                            You are logged in as
                            <strong>{{ Auth::user()->usertype ?? 'User' }}</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer__block block no-margin-bottom">
            <div class="container-fluid text-center">
                <p class="no-margin-bottom">
                    {{ date('Y') }} &copy; Your Company
                </p>
            </div>
        </div>
    </footer>
</div>
