@extends('admin.master')
@section('title', __('keywords.settings'))
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">

                <h2 class="h5 page-title">{{ __('keywords.settings') }}</h2>

                <div class="row">
                    <!-- simple table -->
                    <div class="col-12 my-4">


                        <div class="card shadow">
                            <div class="card-body">
                                <x-success-alert />
                                <form action="{{ route('admin.settings.update', $setting) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <x-form-label filed="address" />

                                            <input type="text" id="example-address" name="address"
                                                value="{{ $setting->address }}" class="form-control"
                                                placeholder="{{ __('keywords.address') }}">
                                            <x-input-error :messages="$errors->get('address')" class="mt-2" />

                                        </div>
                                        <div class="col-md-6">
                                            <x-form-label filed="phone" />

                                            <input type="text" id="example-phone" name="phone"
                                                value="{{ $setting->phone }}" class="form-control"
                                                placeholder="{{ __('keywords.phone') }}">
                                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />

                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <x-form-label filed="email" />

                                            <input type="email" id="example-email" name="email"
                                                value="{{ $setting->email }}" class="form-control"
                                                placeholder="{{ __('keywords.email') }}">
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <x-form-label filed="facebook" />

                                            <input type="url" id="example-facebook" name="facebook"
                                                value="{{ $setting->facebook }}" class="form-control"
                                                placeholder="{{ __('keywords.facebook') }}">
                                            <x-input-error :messages="$errors->get('facebook')" class="mt-2" />

                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <x-form-label filed="linkedin" />

                                            <input type="url" id="example-linkedin" name="linkedin"
                                                value="{{ $setting->linkedin }}" class="form-control"
                                                placeholder="{{ __('keywords.linkedin') }}">
                                            <x-input-error :messages="$errors->get('linkedin')" class="mt-2" />

                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <x-form-label filed="twitter" />

                                            <input type="url" id="example-twitter" name="twitter"
                                                value="{{ $setting->twitter }}" class="form-control"
                                                placeholder="{{ __('keywords.twitter') }}">
                                            <x-input-error :messages="$errors->get('twitter')" class="mt-2" />

                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <x-form-label filed="instagram" />

                                            <input type="url" id="example-instagram" name="instagram"
                                                value="{{ $setting->instagram }}" class="form-control"
                                                placeholder="{{ __('keywords.instagram') }}">
                                            <x-input-error :messages="$errors->get('instagram')" class="mt-2" />

                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <x-form-label filed="youtube" />

                                            <input type="url" id="example-youtube" name="youtube"
                                                value="{{ $setting->youtube }}" class="form-control"
                                                placeholder="{{ __('keywords.youtube') }}">
                                            <x-input-error :messages="$errors->get('youtube')" class="mt-2" />

                                        </div>

                                    </div>
                                    <x-submit-button />

                                </form>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                    <!-- Bordered table -->

                </div> <!-- end section -->

            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
    <div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel"
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
    </div>
@endsection
