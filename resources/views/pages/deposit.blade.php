@extends('main')

@section('title', '| Deposit')

@section('content')

    <div class="page-wrapper">

        <!-- PAGE CONTAINER-->
        <div class="page-container">

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">
                                        Deposit
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-" id="deposit">
                            <form action="{{ route('pay') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" value="{{ $user->name }}" class="form-input" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" name="email" value="{{ $user->email }}" class="form-input" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="text" name="amount" class="form-input" />
                                </div>

                                <input type="hidden" name="currency" value="NGN" />
                                <input type="hidden" name="country" value="NG" />

                                <div class="form-group">
                                    <button class="form-button" name="submit" type="submit">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>
    </div>

    <style>

        a {
            text-decoration: none;
        }

        #deposit {
            margin-top: 10px;
            margin-left: 320px;
        }

        .login-form {
            width: 350px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 2rem;
            background: #ffffff;
        }

        .form-input {
            background: #fafafa;
            border: 1px solid #eeeeee;
            padding: 12px;
            width: 100%;
            outline: none;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-button {
            background: #69d2e7;
            border: 1px solid #ddd;
            color: #ffffff;
            padding: 10px;
            width: 100%;
            text-transform: uppercase;
            cursor: pointer;
            transition: .5s ease;
        }

        .form-button:hover {
            background: #1899c4;
            border-radius: 30px;
        }

    </style>

    <script type="text/javascript">

        const isNumber = evt => {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            return !(charCode > 31 && (charCode < 48 || charCode > 57));
        }

    </script>

@endsection
