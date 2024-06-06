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
    <div class="container">
        <div class="col-md-12 col-lg-12">
            <div class="card shadow">
                <div class="card-header">
                    <strong class="card-title">Recent Data</strong>
                    <a class="float-right small text-muted" href="#!">View all</a>
                </div>
                <div class="card-body my-n2">
                    <table class="table table-striped table-hover table-borderless">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>title</th>
                                <th>price</th>
                                <th>duration</th>
                                <th>date</th>
                                <th>to</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($userHistorys) > 0)
                                @for ($i = 0; $i < count($userHistorys); $i++)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $userHistorys[$i]->program->title }}</td>
                                        <td><x-display-price-after-discount price="{{ $userHistorys[$i]->program->price }}"
                                                discount="{{ $userHistorys[$i]->program->discount }}" /></td>
                                        <td>{{ $userHistorys[$i]->program->duration }}</td>
                                        <td>{{ $userHistorys[$i]->program->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $userHistorys[$i]->to }}</td>
                                    </tr>
                                @endfor
                            @else
                                <tr>
                                    <td colspan="100%">

                                        <h2 class="alret alert-danger">No History Yet </h2>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- <tr>
    <td>2786</td>
    <td>Leblanc, Yoshio V.</td>
    <td>287-8300 Nisl. St.</td>
    <td>04/05/2019</td>
    <td>
        <div class="dropdown">
            <button class="btn btn-sm dropdown-toggle more-vertical" type="button"
                id="dr2" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <span class="text-muted sr-only">Action</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr2">
                <a class="dropdown-item" href="#">Edit</a>
                <a class="dropdown-item" href="#">Remove</a>
                <a class="dropdown-item" href="#">Assign</a>
            </div>
        </div>
    </td>
</tr>
<tr>
    <td>2747</td>
    <td>Hester, Nissim L.</td>
    <td>4577 Cras St.</td>
    <td>04/06/2019</td>
    <td>
        <div class="dropdown">
            <button class="btn btn-sm dropdown-toggle more-vertical" type="button"
                id="dr3" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <span class="text-muted sr-only">Action</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr3">
                <a class="dropdown-item" href="#">Edit</a>
                <a class="dropdown-item" href="#">Remove</a>
                <a class="dropdown-item" href="#">Assign</a>
            </div>
        </div>
    </td>
</tr>
<tr>
    <td>2639</td>
    <td>Gardner, Leigh S.</td>
    <td>P.O. Box 228, 7512 Lectus Ave</td>
    <td>04/08/2019</td>
    <td>
        <div class="dropdown">
            <button class="btn btn-sm dropdown-toggle more-vertical" type="button"
                id="dr4" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <span class="text-muted sr-only">Action</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr4">
                <a class="dropdown-item" href="#">Edit</a>
                <a class="dropdown-item" href="#">Remove</a>
                <a class="dropdown-item" href="#">Assign</a>
            </div>
        </div>
    </td>
</tr>
<tr>
    <td>2238</td>
    <td>Higgins, Uriah L.</td>
    <td>Ap #377-5357 Sed Road</td>
    <td>04/01/2019</td>
    <td>
        <div class="dropdown">
            <button class="btn btn-sm dropdown-toggle more-vertical" type="button"
                id="dr5" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <span class="text-muted sr-only">Action</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr5">
                <a class="dropdown-item" href="#">Edit</a>
                <a class="dropdown-item" href="#">Remove</a>
                <a class="dropdown-item" href="#">Assign</a>
            </div>
        </div>
    </td>
</tr> --}}
