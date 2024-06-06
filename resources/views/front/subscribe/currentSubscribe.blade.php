@extends('front.home.master')
@section('content')
    {{-- <br>
<br>
<br>
<br>
<br>
<br>
<br>
<br> --}}
    <br>
    <br>
    <br>
    <br>
    <br>

    <br>
    <br>
    <br>
    <br>
    <br>
    {{-- @dd($subscription->program) --}}
    <section class="price-area pt-100" id="plan">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-60 col-lg-8">
                    <div class="title text-center">
                        <h1 class="mb-10">Choose the Perfect Plan for you</h1>
                        <p>Who are in extremely love with eco friendly system.</p>
                    </div>
                </div>
            </div>
            <div class="row col-12">
                <div class="container">

                    <div class="col-lg-10">
                        <div class="single-price">
                            @if (isset($subscription)&&isset($daysLeft))
                            <div class="top-sec d-flex justify-content-between">

                                <div class="top-left">
                                    <h4>{{ $subscription->program->title }}</h4>
                                    <p>{{ $subscription->program->slogan }}</p>
                                </div>
                                <div class="top-right">
                                    <h4 style="text-decoration: line-through">EGP{{ $subscription->program->price }} </h4>
                                    <h6>{{ $subscription->program->discount }}%</h6>
                                    <x-display-price-after-discount price="{{ $subscription->program->price }}"
                                        discount="{{ $subscription->program->discount }}" />

                                </div>
                            </div>
                            <div class="bottom-sec">

                                <p>
days left to end subscription {{ $daysLeft }} days
                                </p>
                            </div>
                            <div class="end-sec">
                                <ul>
                                    @foreach ($subscription->program->benfits as $benfit)
                                        <li>
                                            {{ $benfit->benfit }}
                                        </li>
                                    @endforeach

                                </ul>



                            </div>
                        </div>
@else
<div class="col-12">
    <h1 class="alert alert-danger">You are not subscribed to any program</h1>

</div>
                        @endif

                    </div>


                </div>
            </div>
        </div>
    </section>
@endsection
