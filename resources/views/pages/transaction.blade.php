@extends('main')

@section('title', '| Transfer')

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
                                        Transactions
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row m-t-" id="deposit">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Narration</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse($transactions as $transaction)

                                        <tr>
                                            <td>{{ $transaction->narration }}</td>
                                            <td>{{ $transaction->type }}</td>
                                            <td>₦{{ $transaction->amount }}</td>
                                            <td>{{ date('M j, Y - H:i', strtotime($transaction->updated_at)) }}</td>
                                        </tr>

                                        @empty
                                            <div>No transactions found</div>

                                    @endforelse
                                </tbody>
                            </table>

                            <div class="offset-5 text-center">
                                {!! $transactions->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
