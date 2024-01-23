<x-front-layout title="Two Factor Authentication">

    <!-- Start Account Login Area -->
    <div class="account-login section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                        <form class="card login-form" action="{{ route('two-factor.enable') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="title">
                                    <h3>Two Factor Authentication</h3>
                                    <p>You can login using your social media account or email address.</p>
                                </div>


                                <div class="button">
                                    <button class="btn" type="submit">Enable</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Account Login Area -->

    </x-front-layout>
