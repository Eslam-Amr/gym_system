@extends('admin.master')
@section('title', __('keywords.edit_nutrition'))
@section('content')
    {{-- @dump($nutrition) --}}
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">

                <h2 class="h5 page-title">{{ __('keywords.edit_nutrition') }}</h2>

                <div class="row">
                    <!-- simple table -->
                    <div class="col-12 my-4">

                        <div class="card shadow">
                            <div class="card-body">
                                <form action="{{ route('admin.nutritions.update', $nutrition) }}" method="POST" id="mealForm"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">

                                        <div class="col-md-12">
                                            <x-form-label filed="date" />
                                            <label
                                            class="form-control">{{ $plan['date'] }}</label>

                                            <input type="hidden" name="date" id="date"
                                            value="{{ $plan['date'] }}">
                                            {{-- @dd($plan) --}}
                                            {{-- @if ($subscribe->nutrition->plan == '[]')
                                                <label
                                                    class="form-control">{{ $subscribe->created_at->format('Y-d-m') }}</label>

                                                <input type="hidden" name="date" id="date"
                                                    value="{{ $subscribe->created_at->format('Y-d-m') }}">
                                                <x-input-error :messages="$errors->get('date')" class="mt-2" />
                                            @else
                                                @php
                                                    $plan = json_decode($subscribe->nutrition->plan, true);

                                                @endphp

                                                <label
                                                    class="form-control">{{ date('Y-m-d', strtotime($plan[count($plan) - 1]['date'] . ' +1 day')) }}</label>

                                                <input type="hidden" name="date" id="date"
                                                    value="{{ date('Y-m-d', strtotime($plan[count($plan) - 1]['date'] . ' +1 day')) }}">
                                                <x-input-error :messages="$errors->get('date')" class="mt-2" />
                                                    @endif --}}
                                                    </div>




                                        <div id="mealContainer">
                                            <!-- Initial Meal Box with Items -->
                                            {{-- <div class="meal-box  mt-3">
                                                <label for="mealField0">{{ __('keywords.meal') }}</label>
                                                <input type="text" id="mealField0" name="meals[0][name]"
                                                    class="form-control" placeholder="{{ __('keywords.meal') }}">
                                                <x-input-error :messages="$errors->get('meals.0.name')" class="mt-2" />
                                                <div class="items-container mt-3" id="itemsContainer0">
                                                    <div class="item-box">
                                                        <label for="itemField0_0">{{ __('keywords.item') }}</label>
                                                        <input type="text" id="itemField0_0" name="meals[0][items][0]"
                                                            class="form-control" placeholder="{{ __('keywords.item') }}">
                                                        <x-input-error :messages="$errors->get('meals.0.items.0')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-secondary btn-sm addItemButton mt-2"
                                                    data-meal-index="0">Add Item</button>
                                            </div> --}}
                                        </div>
                                        <x-input-error :messages="$errors->get('meals[0][name]')" class="mt-2" />
                                        <x-input-error :messages="$errors->get('meals[0][items][0]')" class="mt-2" />
                                        <!-- Button to Add Meal -->
                                        <button
                                            style="margin-left: 15px; padding: 5px; width: 30px; height: 30px; font-size: 16px;"
                                            class="btn btn-primary mt-3 btn-sm" type="button" id="addMealButton">+</button>

                                        <!-- Hidden input to hold the fields data -->
                                        <input type="hidden" id="fieldsInput" name="fields">






<script>
     document.addEventListener('DOMContentLoaded', function() {
        const maxMeals = 10;
        const maxItems = 15;
        let mealCount = 0;

        const mealsData = @json($plan['meal']);

        function addItemBox(itemsContainer, mealIndex, itemValue = '') {
            const itemCount = itemsContainer.querySelectorAll('.item-box').length;
            if (itemCount < maxItems) {
                const newItemBox = document.createElement('div');
                newItemBox.classList.add('item-box');

                const newItemLabel = document.createElement('label');
                const newItemFieldId = `itemField${mealIndex}_${itemCount}`;
                newItemLabel.setAttribute('for', newItemFieldId);
                newItemLabel.textContent = "{{ __('keywords.item') }}";

                const newItemInput = document.createElement('input');
                newItemInput.type = 'text';
                newItemInput.id = newItemFieldId;
                newItemInput.name = `meals[${mealIndex}][items][${itemCount}]`;
                newItemInput.classList.add('form-control');
                newItemInput.placeholder = "{{ __('keywords.item') }}";
                newItemInput.value = itemValue;

                const newItemError = document.createElement('x-input-error');
                newItemError.classList.add('mt-2');

                newItemBox.appendChild(newItemLabel);
                newItemBox.appendChild(newItemInput);
                newItemBox.appendChild(newItemError);
                itemsContainer.appendChild(newItemBox);
            } else {
                alert('Maximum of 15 items per meal reached');
            }
        }

        function addMealBox(mealName = '', items = []) {
            if (mealCount < maxMeals) {
                const newMealDiv = document.createElement('div');
                newMealDiv.classList.add('meal-box', 'mt-3');

                const newMealLabel = document.createElement('label');
                const newMealFieldId = `mealField${mealCount}`;
                newMealLabel.setAttribute('for', newMealFieldId);
                newMealLabel.textContent = "{{ __('keywords.meal') }}";

                const newMealInput = document.createElement('input');
                newMealInput.type = 'text';
                newMealInput.id = newMealFieldId;
                newMealInput.name = `meals[${mealCount}][name]`;
                newMealInput.classList.add('form-control');
                newMealInput.placeholder = "{{ __('keywords.meal') }}";
                newMealInput.value = mealName;

                const newMealError = document.createElement('x-input-error');
                newMealError.classList.add('mt-2');

                newMealDiv.appendChild(newMealLabel);
                newMealDiv.appendChild(newMealInput);
                newMealDiv.appendChild(newMealError);

                // Add video input field for the meal
                const newVideoLabel = document.createElement('label');
                const newVideoFieldId = `videoField${mealCount}`;
                newVideoLabel.setAttribute('for', newVideoFieldId);
                newVideoLabel.textContent = "Video";

                const newVideoInput = document.createElement('input');
                newVideoInput.type = 'file';
                newVideoInput.id = newVideoFieldId;
                newVideoInput.name = `meals[${mealCount}][video]`;
                newVideoInput.classList.add('form-control-file', 'mt-2');
                newVideoInput.accept = 'video/*';

                // newMealDiv.appendChild(newVideoLabel);
                // newMealDiv.appendChild(newVideoInput);

                // Add image input field for the meal
                const newImageLabel = document.createElement('label');
                const newImageFieldId = `imageField${mealCount}`;
                newImageLabel.setAttribute('for', newImageFieldId);
                newImageLabel.textContent = "Image";

                const newImageInput = document.createElement('input');
                newImageInput.type = 'file';
                newImageInput.id = newImageFieldId;
                newImageInput.name = `meals[${mealCount}][image]`;
                newImageInput.classList.add('form-control-file', 'mt-2');
                newImageInput.accept = 'image/*';

                // newMealDiv.appendChild(newImageLabel);
                // newMealDiv.appendChild(newImageInput);

                // Create container for items
                const newItemsContainer = document.createElement('div');
                newItemsContainer.classList.add('items-container', 'mt-3');
                newItemsContainer.id = `itemsContainer${mealCount}`;

                newMealDiv.appendChild(newItemsContainer);

                items.forEach((item) => {
                    addItemBox(newItemsContainer, mealCount, item);
                });

                const addItemButton = document.createElement('button');
                addItemButton.type = 'button';
                addItemButton.classList.add('btn', 'btn-secondary', 'btn-sm', 'addItemButton', 'mt-2');
                addItemButton.textContent = 'Add Item';
                addItemButton.setAttribute('data-meal-index', mealCount);
                addItemButton.addEventListener('click', function() {
                    addItemBox(newItemsContainer, mealCount);
                });

                newMealDiv.appendChild(addItemButton);

                document.getElementById('mealContainer').appendChild(newMealDiv);

                mealCount++;
            } else {
                alert('Maximum of 10 meals reached');
            }
        }

        for (const mealName in mealsData) {
            addMealBox(mealName, mealsData[mealName]);
        }

        document.getElementById('addMealButton').addEventListener('click', () => addMealBox());

        document.getElementById('mealForm').addEventListener('submit', function(event) {
            const fields = {};
            document.querySelectorAll('.meal-box').forEach((mealBox, mealIndex) => {
                const mealNameInput = mealBox.querySelector(`input[name="meals[${mealIndex}][name]"]`);
                const mealName = mealNameInput ? mealNameInput.value : '';
                const items = [];
                mealBox.querySelectorAll('.item-box input').forEach((itemInput, itemIndex) => {
                    items.push(itemInput.value);
                });
                fields[mealName] = items;
            });

            const fieldsInput = document.getElementById('fieldsInput');
            fieldsInput.value = JSON.stringify(fields);
        });
    });
</script>


                                        {{-- <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const maxMeals = 10;
                                                const maxItems = 15;
                                                let mealCount = 1;

                                                function addItemBox(itemsContainer, mealIndex) {
                                                    const itemCount = itemsContainer.querySelectorAll('.item-box').length;
                                                    if (itemCount < maxItems) {
                                                        const newItemBox = document.createElement('div');
                                                        newItemBox.classList.add('item-box');

                                                        const newItemLabel = document.createElement('label');
                                                        const newItemFieldId = `itemField${mealIndex}_${itemCount}`;
                                                        newItemLabel.setAttribute('for', newItemFieldId);
                                                        newItemLabel.textContent = "{{ __('keywords.item') }}";

                                                        const newItemInput = document.createElement('input');
                                                        newItemInput.type = 'text';
                                                        newItemInput.id = newItemFieldId;
                                                        newItemInput.name = `meals[${mealIndex}][items][${itemCount}]`;
                                                        newItemInput.classList.add('form-control');
                                                        newItemInput.placeholder = "{{ __('keywords.item') }}";

                                                        const newItemError = document.createElement('x-input-error');
                                                        newItemError.classList.add('mt-2');
                                                        // newItemError.setAttribute(':message',"$errors->get('meals[itemCount][name]')")
                                                        // newItemError.setAttribute(':message', "$errors->get('meals[" + itemCount + "][name]')");

                                                        newItemBox.appendChild(newItemLabel);
                                                        newItemBox.appendChild(newItemInput);
                                                        newItemBox.appendChild(newItemError);
                                                        itemsContainer.appendChild(newItemBox);
                                                    } else {
                                                        alert('Maximum of 15 items per meal reached');
                                                    }
                                                }



                                                function addMealBox() {
                                                    if (mealCount < maxMeals) {
                                                        const newMealDiv = document.createElement('div');
                                                        newMealDiv.classList.add('meal-box', 'mt-3');

                                                        const newMealLabel = document.createElement('label');
                                                        const newMealFieldId = `mealField${mealCount}`;
                                                        newMealLabel.setAttribute('for', newMealFieldId);
                                                        newMealLabel.textContent = "{{ __('keywords.meal') }}";

                                                        const newMealInput = document.createElement('input');
                                                        newMealInput.type = 'text';
                                                        newMealInput.id = newMealFieldId;
                                                        newMealInput.name = `meals[${mealCount}][name]`;
                                                        newMealInput.classList.add('form-control');
                                                        newMealInput.placeholder = "{{ __('keywords.meal') }}";

                                                        const newMealError = document.createElement('x-input-error');
                                                        newMealError.classList.add('mt-2');

                                                        // Append meal label, input, and error message
                                                        newMealDiv.appendChild(newMealLabel);
                                                        newMealDiv.appendChild(newMealInput);
                                                        newMealDiv.appendChild(newMealError);

                                                        // Add video input field for the meal
                                                        const newVideoLabel = document.createElement('label');
                                                        const newVideoFieldId = `videoField${mealCount}`;
                                                        newVideoLabel.setAttribute('for', newVideoFieldId);
                                                        newVideoLabel.textContent = "Video";

                                                        const newVideoInput = document.createElement('input');
                                                        newVideoInput.type = 'file';
                                                        newVideoInput.id = newVideoFieldId;
                                                        newVideoInput.name = `meals[${mealCount}][video]`;
                                                        newVideoInput.classList.add('form-control-file', 'mt-2');
                                                        newVideoInput.accept = 'video/*';

                                                        // Add image input field for the meal
                                                        const newImageLabel = document.createElement('label');
                                                        const newImageFieldId = `imageField${mealCount}`;
                                                        newImageLabel.setAttribute('for', newImageFieldId);
                                                        newImageLabel.textContent = "Image";

                                                        const newImageInput = document.createElement('input');
                                                        newImageInput.type = 'file';
                                                        newImageInput.id = newImageFieldId;
                                                        newImageInput.name = `meals[${mealCount}][image]`;
                                                        newImageInput.classList.add('form-control-file', 'mt-2');
                                                        newImageInput.accept = 'image/*';


                                                        // Create container for items
                                                        const newItemsContainer = document.createElement('div');
                                                        newItemsContainer.classList.add('items-container', 'mt-3');
                                                        newItemsContainer.id = `itemsContainer${mealCount}`;

                                                        // Append container for items
                                                        newMealDiv.appendChild(newItemsContainer);

                                                        // Add item functionality for the initial meal
                                                        const addItemButton = document.createElement('button');
                                                        addItemButton.type = 'button';
                                                        addItemButton.classList.add('btn', 'btn-secondary', 'btn-sm', 'addItemButton', 'mt-2');
                                                        addItemButton.textContent = 'Add Item';
                                                        addItemButton.setAttribute('data-meal-index', mealCount);
                                                        addItemButton.addEventListener('click', function() {
                                                            addItemBox(newItemsContainer, mealCount);
                                                        });

                                                        // Append add item button
                                                        newMealDiv.appendChild(addItemButton);

                                                        // Append new meal to container
                                                        document.getElementById('mealContainer').appendChild(newMealDiv);

                                                        mealCount++;
                                                    } else {
                                                        alert('Maximum of 10 meals reached');
                                                    }
                                                }

                                                document.getElementById('addMealButton').addEventListener('click', addMealBox);

                                                // Add item functionality for the initial meal
                                                document.querySelector('.addItemButton').addEventListener('click', function() {
                                                    const mealIndex = this.getAttribute('data-meal-index');
                                                    const itemsContainer = document.getElementById(`itemsContainer${mealIndex}`);
                                                    addItemBox(itemsContainer, mealIndex);
                                                });

                                                document.getElementById('mealForm').addEventListener('submit', function(event) {
                                                    const fields = {};
                                                    document.querySelectorAll('.meal-box').forEach((mealBox, mealIndex) => {
                                                        const mealNameInput = mealBox.querySelector(
                                                            `input[name="meals[${mealIndex}][name]"]`);
                                                        const mealName = mealNameInput ? mealNameInput.value : '';
                                                        const items = [];
                                                        mealBox.querySelectorAll('.item-box input').forEach((itemInput, itemIndex) => {
                                                            items.push(itemInput.value);
                                                        });
                                                        fields[mealName] = items;
                                                    });

                                                    // Update the hidden input field with the JSON stringified data
                                                    const fieldsInput = document.getElementById('fieldsInput');
                                                    fieldsInput.value = JSON.stringify(fields);
                                                });
                                            });
                                        </script> --}}


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
