@extends('admin.master')
@section('title', __('keywords.services'))
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between mb-3">
                    <h2 class="h5 page-title">{{ __('keywords.services') }}</h2>
                    <div class="page-title-right">

                        {{-- <x-action-button href="{{ route('admin.services.create') }}" type="create" /> --}}
                    </div>
                </div>
                <div class="row">
                    <!-- simple table -->
                    <div class="col-12 my-4">


                        <div class="card shadow">
                            <div class="card-body">
                                <x-success-alert />
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            {{-- <th>{{ __('keywords.name') }}</th> --}}
                                            <th>{{ __('keywords.customerName') }}</th>
                                            <th>{{ __('keywords.program') }}</th>
                                            <th>{{ __('keywords.duration') }}</th>
                                            <th>{{ __('keywords.from') }}</th>
                                            <th>{{ __('keywords.to') }}</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($subscribers) > 0)
                                            @foreach ($subscribers as $key => $subscriber)
                                                <tr>
                                                    <td>{{ $subscribers->firstItem() + $loop->index }}</td>
                                                    <td>{{ $subscriber->user->name }}</td>
                                                    <td>{{ $subscriber->program->title }}</td>
                                                    <td>{{ $subscriber->program->duration }}</td>
                                                    <td>{{ $subscriber->created_at->format('Y-m-d') }}</td>
                                                    <td>{{ $subscriber->to }}</td>
                                              </td>


                                                </tr>
                                            @endforeach
                                        @else
                                            <x-empty-alert />
                                        @endif
                                    </tbody>
                                </table>
                                {{ $subscribers->links() }}
                            </div>
                        </div>
                    </div> <!-- simple table -->
                    <!-- Bordered table -->

                </div> <!-- end section -->

            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->

@endsection
