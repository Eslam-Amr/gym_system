@extends('admin.master')
@section('title', __('keywords.features'))
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between mb-3">
                    <h2 class="h5 page-title">{{ __('keywords.features') }}</h2>
                    <div class="page-title-right">

                        <x-action-button href="{{ route('admin.features.create') }}" type="create" />
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
                                            <th>{{ __('keywords.title') }}</th>
                                            <th width="10%">{{ __('keywords.icon') }}</th>
                                            <th width="15%">{{ __('keywords.actions') }}</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($features) > 0)
                                            @foreach ($features as $key => $feature)
                                                <tr>
                                                    <td>{{ $features->firstItem() + $loop->index }}</td>
                                                    <td>{{ $feature->title }}</td>
                                                    <td>
                                                        {{ $feature->icon }}
                                                        {{-- <i class="{{ $feature->icon }} fa-2x"></i> --}}
                                                    </td>
                                                    <td>

                                                        <x-action-button href="{{ route('admin.features.edit', $feature) }}"
                                                            type="edit" />
                                                        <x-action-button href="{{ route('admin.features.show', $feature) }}"
                                                        type="show" />
                                                        {{--
                                                            <form class="d-inline" id="deleteForm-{{ $feature->id }}"
                                                                action="{{ route('admin.features.destroy', $feature) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-sm btn-danger"
                                                                onclick="confirmDelete({{ $feature->id }})">

                                                                <i class="fe fe-trash-2 fa-2x"></i>
                                                            </button>
                                                        </form> --}}
                                                        <x-delete-button href="{{ route('admin.features.destroy', $feature) }}"
                                                        id="{{ $feature->id }}" />
                                                    </td>


                                                </tr>
                                            @endforeach
                                        @else
                                            <x-empty-alert />
                                        @endif

                                    </tbody>
                                </table>
                                {{ $features->links() }}
                            </div>
                        </div>
                    </div> <!-- simple table -->
                    <!-- Bordered table -->

                </div> <!-- end section -->

            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->

    {{-- <div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Notifications</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="list-group list-group-flush my-n3">
                        <div class="list-group-item bg-transparent">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="fe fe-box fe-24"></span>
                                </div>
                                <div class="col">
                                    <small><strong>Package has uploaded successfull</strong></small>
                                    <div class="my-0 text-muted small">Package is zipped and uploaded</div>
                                    <small class="badge badge-pill badge-light text-muted">1m ago</small>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item bg-transparent">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="fe fe-download fe-24"></span>
                                </div>
                                <div class="col">
                                    <small><strong>Widgets are updated successfull</strong></small>
                                    <div class="my-0 text-muted small">Just create new layout Index, form, table</div>
                                    <small class="badge badge-pill badge-light text-muted">2m ago</small>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item bg-transparent">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="fe fe-inbox fe-24"></span>
                                </div>
                                <div class="col">
                                    <small><strong>Notifications have been sent</strong></small>
                                    <div class="my-0 text-muted small">Fusce dapibus, tellus ac cursus commodo</div>
                                    <small class="badge badge-pill badge-light text-muted">30m ago</small>
                                </div>
                            </div> <!-- / .row -->
                        </div>
                        <div class="list-group-item bg-transparent">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="fe fe-link fe-24"></span>
                                </div>
                                <div class="col">
                                    <small><strong>Link was attached to menu</strong></small>
                                    <div class="my-0 text-muted small">New layout has been attached to the menu</div>
                                    <small class="badge badge-pill badge-light text-muted">1h ago</small>
                                </div>
                            </div>
                        </div> <!-- / .row -->
                    </div> <!-- / .list-group -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Clear All</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-shortcut modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Shortcuts</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-5">
                    <div class="row align-items-center">
                        <div class="col-6 text-center">
                            <div class="squircle bg-success justify-content-center">
                                <i class="fe fe-cpu fe-32 align-self-center text-white"></i>
                            </div>
                            <p>Control area</p>
                        </div>
                        <div class="col-6 text-center">
                            <div class="squircle bg-primary justify-content-center">
                                <i class="fe fe-activity fe-32 align-self-center text-white"></i>
                            </div>
                            <p>Activity</p>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-6 text-center">
                            <div class="squircle bg-primary justify-content-center">
                                <i class="fe fe-droplet fe-32 align-self-center text-white"></i>
                            </div>
                            <p>Droplet</p>
                        </div>
                        <div class="col-6 text-center">
                            <div class="squircle bg-primary justify-content-center">
                                <i class="fe fe-upload-cloud fe-32 align-self-center text-white"></i>
                            </div>
                            <p>Upload</p>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-6 text-center">
                            <div class="squircle bg-primary justify-content-center">
                                <i class="fe fe-users fe-32 align-self-center text-white"></i>
                            </div>
                            <p>Users</p>
                        </div>
                        <div class="col-6 text-center">
                            <div class="squircle bg-primary justify-content-center">
                                <i class="fe fe-settings fe-32 align-self-center text-white"></i>
                            </div>
                            <p>Settings</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
