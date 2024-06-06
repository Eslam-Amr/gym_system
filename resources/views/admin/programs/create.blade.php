@extends('admin.master')
@section('title', __('keywords.add_new_program'))
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">

                <h2 class="h5 page-title">{{ __('keywords.add_new_program') }}</h2>

                <div class="row">
                    <!-- simple table -->
                    <div class="col-12 my-4">


                        <div class="card shadow">
                            <div class="card-body">
                                <form action="{{ route('admin.programs.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mt-3">
                                            {{-- <label for="example-title">{{ __("keywords.title") }}</label> --}}
                                            <x-form-label filed="title" />
                                            <input type="text" id="title" name="title" class="form-control"
                                                placeholder="{{ __('keywords.title') }}">
                                            <x-input-error :messages="$errors->get('title')" class="mt-2" />

                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <x-form-label filed="slogan" />

                                            <input type="text" id="slogan" name="slogan" class="form-control"
                                                placeholder="{{ __('keywords.slogan') }}">
                                            <x-input-error :messages="$errors->get('slogan')" class="mt-2" />

                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <x-form-label filed="durationInMonth" />

                                            <input min="0" max="12" type="number" id="durationInMonth"
                                                name="duration" class="form-control"
                                                placeholder="{{ __('keywords.durationInMonth') }}">
                                            <x-input-error :messages="$errors->get('duration')" class="mt-2" />

                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="limit">{{ __('keywords.limitOFClinent') }}</label>

                                            <input min="0" max="12" type="number" id="limit"
                                                name="limit" class="form-control"
                                                placeholder="{{ __('keywords.limitOFClinent') }}">
                                            <x-input-error :messages="$errors->get('limit')" class="mt-2" />

                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <x-form-label filed="price" />

                                            <input min="0" type="number" id="price" name="price"
                                                class="form-control" placeholder="{{ __('keywords.price') }}">
                                            <x-input-error :messages="$errors->get('price')" class="mt-2" />

                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <x-form-label filed="discount" />

                                            <input min="0" max="100" type="number" id="discount"
                                                name="discount" class="form-control"
                                                placeholder="{{ __('keywords.discount') }}">
                                            <x-input-error :messages="$errors->get('discount')" class="mt-2" />

                                        </div>

                                        <x-price-after-discount />
                                        <div class="col-md-12 mt-3">
                                            <label for="initialField">{{ __('keywords.Benfit') }}</label>
                                            <input type="text" id="initialField" name="fields[]" class="form-control"
                                                placeholder="{{ __('keywords.Benfit') }}">
                                            <x-input-error :messages="$errors->get('initialField')" class="mt-2" />
                                        </div>
                                        <div class="col-12">
                                            <div class="row" id="additionalFields"></div>
                                        </div>
                                        <button
                                            style="margin-left: 15px; padding: 5px; width: 30px; height: 30px; font-size: 16px;"
                                            class="btn btn-primary mt-3 btn-sm" type="button" id="addButton">+</button>


                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const maxFields = 10;
                                                let fieldCount = 1; // Initial field is already present

                                                document.getElementById('addButton').addEventListener('click', function() {
                                                    if (fieldCount < maxFields) {
                                                        // Create a new div with the same structure
                                                        const newFieldDiv = document.createElement('div');
                                                        newFieldDiv.classList.add('col-md-6', 'mt-3');

                                                        // Create a new label element
                                                        const newLabel = document.createElement('label');
                                                        const newFieldId = `additionalField${fieldCount + 1}`;
                                                        newLabel.setAttribute('for', newFieldId);
                                                        newLabel.textContent = "{{ __('keywords.Benfit') }}";

                                                        // Create a new input element
                                                        const newInput = document.createElement('input');
                                                        newInput.type = 'text';
                                                        newInput.id = newFieldId;
                                                        newInput.name = 'fields[]'; // Changed to 'fields[]'
                                                        newInput.classList.add('form-control');
                                                        newInput.placeholder = "{{ __('keywords.Benfit') }}";
                                                        // newInput.required = true; // Set as required

                                                        // Create a new x-input-error component
                                                        const newError = document.createElement('x-input-error');
                                                        newError.classList.add('mt-2');

                                                        // Append the new elements to the newFieldDiv
                                                        newFieldDiv.appendChild(newLabel);
                                                        newFieldDiv.appendChild(newInput);
                                                        newFieldDiv.appendChild(newError);

                                                        // Append the newFieldDiv to the additionalFields container
                                                        document.getElementById('additionalFields').appendChild(newFieldDiv);

                                                        fieldCount++;
                                                    } else {
                                                        alert('Maximum of 10 fields reached');
                                                    }
                                                });

                                                document.getElementById('submitButton').addEventListener('click', function(event) {
                                                    // Prevent form submission for demonstration purpose
                                                    event.preventDefault();

                                                    // Collect the field values
                                                    const fields = [];
                                                    const inputs = document.querySelectorAll('input[name="fields[]"]');
                                                    inputs.forEach(input => {
                                                        fields.push({
                                                            [input.id]: input.value
                                                        });
                                                    });

                                                    // Log the collected fields for demonstration purpose
                                                    console.log(fields);

                                                    // Now you can send the 'fields' array to your backend using AJAX or include it in a form submission
                                                });
                                            });
                                        </script>

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
