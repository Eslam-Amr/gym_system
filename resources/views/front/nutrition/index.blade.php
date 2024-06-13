@extends('front.home.master')
@section('content')
    {{-- @dd($plan) --}}
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
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @for ($i = 0; $i < count($plan); $i++)
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $i }}"
                    class="active" aria-current="true" aria-label="Slide 1">{{ $i + 1 }}</button>
            @endfor
            {{-- <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2">2</button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3">3</button> --}}
        </div>
        <div class="carousel-inner">
            {{-- @dd($plan) --}}
            {{-- @foreach ($plan as $singlePlan) --}}
            @for ($i=0;$i<count($plan);$i++)
@if ($i==0)
<div class="carousel-item active">
    @else
        <div class="carousel-item">
                @endif
                <div class="container">
                        <div class="col-12">
                            <div class="row">
                                <h2>{{ $plan[$i]['date'] }}</h2>
                                {{-- @dd($singlePlan['meal']) --}}
                                @foreach ($plan[$i]['meal'] as $name=>$items)
                                <div class="col-4 py-5">
                                    <h2>{{ $name }}</h2>
                                    @foreach ($items as $item)
                                    {{-- @dd($meal) --}}
                                    {{ $item }}
                                    @endforeach
                                    </div>
                                    @endforeach
                                    </div>
                                    </div>
                                    </div>
                                    {{-- <img src="..." class="d-block w-100" alt="..."> --}}
                                    {{-- <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque dignissimos suscipit qui quam dolores quo minima ex adipisci facere corrupti, libero amet illo nostrum impedit necessitatibus dicta dolore quisquam? Officiis itaque commodi nesciunt odit voluptates magni perferendis non eaque fugiat, ipsam dolorem sint recusandae laudantium amet beatae nihil? Error, facilis hic ab minus eius atque praesentium, omnis consectetur illum nostrum, architecto aliquam molestiae blanditiis officia optio id sunt recusandae! Numquam eos beatae voluptate aperiam quis corporis nisi nulla quidem animi cumque modi nostrum natus praesentium nam error, quae laborum iste a qui illo ullam unde! Quibusdam eaque eum doloremque voluptatem.</h2> --}}
                                    </div>
                                @endfor
            {{-- @endforeach --}}
            {{-- <div class="carousel-item active">
                <img src="..." class="d-block w-100" alt="...">
            </div> --}}
            {{--
      <div class="carousel-item">
        <img src="..." class="d-block w-100" alt="...">
      </div> --}}
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
@endsection

{{-- <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1">1</button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2">2</button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3">3</button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="..." class="d-block w-100" alt="...">
          <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque dignissimos suscipit qui quam dolores quo minima ex adipisci facere corrupti, libero amet illo nostrum impedit necessitatibus dicta dolore quisquam? Officiis itaque commodi nesciunt odit voluptates magni perferendis non eaque fugiat, ipsam dolorem sint recusandae laudantium amet beatae nihil? Error, facilis hic ab minus eius atque praesentium, omnis consectetur illum nostrum, architecto aliquam molestiae blanditiis officia optio id sunt recusandae! Numquam eos beatae voluptate aperiam quis corporis nisi nulla quidem animi cumque modi nostrum natus praesentium nam error, quae laborum iste a qui illo ullam unde! Quibusdam eaque eum doloremque voluptatem.</h2>
        </div>
        <div class="carousel-item">
          <img src="..." class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="..." class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div> --}}
