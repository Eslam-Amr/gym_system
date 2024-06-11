@extends('admin.master')
@section('title', __('keywords.add_new_nutrition'))
@section('content')
    {{-- @dump($nutrition) --}}
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">

                <h2 class="h5 page-title">{{ __('keywords.add_new_nutrition') }}</h2>

                <div class="row">
                    <!-- simple table -->
                    <div class="col-12 my-4">


                        <div class="card shadow">
                            <div class="card-body">
                                <form action="{{ route('admin.nutritions.store', $nutrition) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            {{-- <label for="example-title">{{ __("keywords.title") }}</label> --}}
                                            <x-form-label filed="date" />
                                            <input type="date" id="date" name="date" class="form-control"
                                                placeholder="{{ __('keywords.date') }}">
                                            <x-input-error :messages="$errors->get('date')" class="mt-2" />

                                        </div>
                                        <div class="col-md-6">
                                            <x-form-label filed="icon" />

                                            <input type="text" id="example-icon" name="icon" class="form-control"
                                                placeholder="{{ __('keywords.icon') }}">
                                            <x-input-error :messages="$errors->get('icon')" class="mt-2" />

                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <x-form-label filed="description" />

                                            <textarea id="example-description" name="description" class="form-control"
                                                placeholder="{{ __('keywords.description') }}"></textarea>
                                            <x-input-error :messages="$errors->get('description')" class="mt-2" />

                                        </div>
                                        <div id="mealContainer" class="col-12">
                                            <!-- Initial Meal Box with Items -->
                                            <div class="meal-box col-md-12 mt-3">
                                                <label for="mealField0">{{ __('keywords.meal') }}</label>
                                                <input type="text" id="mealField0" name="meals[0][name]" class="form-control" placeholder="{{ __('keywords.meal') }}">
                                                <x-input-error :messages="$errors->get('mealField0')" class="mt-2" />
                                                <div class="items-container mt-3" id="itemsContainer0">
                                                    <div class="item-box">
                                                        <label for="itemField0_0">{{ __('keywords.item') }}</label>
                                                        <input type="text" id="itemField0_0" name="meals[0][items][]" class="form-control" placeholder="{{ __('keywords.item') }}">
                                                        <x-input-error :messages="$errors->get('itemField0_0')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-secondary btn-sm addItemButton mt-2" data-meal-index="0">Add Item</button>
                                            </div>
                                        </div>
                                        <!-- Buttons to Add Meal -->
                                        <button style="margin-left: 15px; padding: 5px; width: 30px; height: 30px; font-size: 16px;" class="btn btn-primary mt-3 btn-sm" type="button" id="addMealButton">+</button>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function () {
                                                const maxMeals = 10;
                                                const maxItems = 15;
                                                let mealCount = 1;

                                                // Function to add new item box within a meal
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
                                                        newItemInput.name = `meals[${mealIndex}][items][]`;
                                                        newItemInput.classList.add('form-control');
                                                        newItemInput.placeholder = "{{ __('keywords.item') }}";
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

                                                // Function to add a new meal box
                                                function addMealBox() {
                                                    if (mealCount < maxMeals) {
                                                        const newMealDiv = document.createElement('div');
                                                        newMealDiv.classList.add('meal-box', 'col-md-12', 'mt-3');

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

                                                        const newItemsContainer = document.createElement('div');
                                                        newItemsContainer.classList.add('items-container', 'mt-3');
                                                        newItemsContainer.id = `itemsContainer${mealCount}`;

                                                        addItemBox(newItemsContainer, mealCount);

                                                        newMealDiv.appendChild(newMealLabel);
                                                        newMealDiv.appendChild(newMealInput);
                                                        newMealDiv.appendChild(newMealError);
                                                        newMealDiv.appendChild(newItemsContainer);

                                                        const addItemButton = document.createElement('button');
                                                        addItemButton.type = 'button';
                                                        addItemButton.classList.add('btn', 'btn-secondary', 'btn-sm', 'addItemButton', 'mt-2');
                                                        addItemButton.textContent = 'Add Item';
                                                        addItemButton.setAttribute('data-meal-index', mealCount);
                                                        addItemButton.addEventListener('click', function () {
                                                            addItemBox(newItemsContainer, mealCount);
                                                        });

                                                        newMealDiv.appendChild(addItemButton);
                                                        document.getElementById('mealContainer').appendChild(newMealDiv);
                                                        mealCount++;
                                                    } else {
                                                        alert('Maximum of 10 meals reached');
                                                    }
                                                }

                                                document.getElementById('addMealButton').addEventListener('click', addMealBox);

                                                // Add item functionality for the initial meal
                                                document.querySelector('.addItemButton').addEventListener('click', function () {
                                                    const mealIndex = this.getAttribute('data-meal-index');
                                                    const itemsContainer = document.getElementById(`itemsContainer${mealIndex}`);
                                                    addItemBox(itemsContainer, mealIndex);
                                                });

                                                document.getElementById('submitButton').addEventListener('click', function (event) {
                                                    event.preventDefault();
                                                    const fields = [];
                                                    document.querySelectorAll('.meal-box').forEach((mealBox, mealIndex) => {
                                                        const mealNameInput = mealBox.querySelector(`input[name="meals[${mealIndex}][name]"]`);
                                                        const mealName = mealNameInput ? mealNameInput.value : '';
                                                        const items = [];
                                                        mealBox.querySelectorAll('.item-box input').forEach(itemInput => {
                                                            items.push(itemInput.value);
                                                        });
                                                        fields.push({ name: mealName, items });
                                                    });

                                                    console.log(fields);
                                                });
                                            });
                                        </script>

                                        {{-- <div id="mealContainer" class="col-12">
                                            <!-- Initial Meal Box with Items -->
                                            <div class="meal-box col-md-12 mt-3">
                                                <label for="mealField0">{{ __('keywords.meal') }}</label>
                                                <input type="text" id="mealField0" name="meals[0][name]" class="form-control" placeholder="{{ __('keywords.meal') }}">
                                                <x-input-error :messages="$errors->get('mealField0')" class="mt-2" />
                                                <div class="items-container mt-3" id="itemsContainer0">
                                                    <div class="item-box">
                                                        <label for="itemField0_0">{{ __('keywords.item') }}</label>
                                                        <input type="text" id="itemField0_0" name="meals[0][items][]" class="form-control" placeholder="{{ __('keywords.item') }}">
                                                        <x-input-error :messages="$errors->get('itemField0_0')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-secondary btn-sm addItemButton mt-2" data-meal-index="0">Add Item</button>
                                            </div>
                                        </div>
                                        <!-- Buttons to Add Meal -->
                                        <button style="margin-left: 15px; padding: 5px; width: 30px; height: 30px; font-size: 16px;" class="btn btn-primary mt-3 btn-sm" type="button" id="addMealButton">+</button>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function () {
                                                const maxMeals = 10;
                                                const maxItems = 15;
                                                let mealCount = 1;

                                                // Function to add new item box within a meal
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
                                                        newItemInput.name = `meals[${mealIndex}][items][]`;
                                                        newItemInput.classList.add('form-control');
                                                        newItemInput.placeholder = "{{ __('keywords.item') }}";
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

                                                // Function to add a new meal box
                                                function addMealBox() {
                                                    if (mealCount < maxMeals) {
                                                        const newMealDiv = document.createElement('div');
                                                        newMealDiv.classList.add('meal-box', 'col-md-12', 'mt-3');

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

                                                        const newItemsContainer = document.createElement('div');
                                                        newItemsContainer.classList.add('items-container', 'mt-3');
                                                        newItemsContainer.id = `itemsContainer${mealCount}`;

                                                        addItemBox(newItemsContainer, mealCount);

                                                        newMealDiv.appendChild(newMealLabel);
                                                        newMealDiv.appendChild(newMealInput);
                                                        newMealDiv.appendChild(newMealError);
                                                        newMealDiv.appendChild(newItemsContainer);

                                                        const addItemButton = document.createElement('button');
                                                        addItemButton.type = 'button';
                                                        addItemButton.classList.add('btn', 'btn-secondary', 'btn-sm', 'addItemButton', 'mt-2');
                                                        addItemButton.textContent = 'Add Item';
                                                        addItemButton.setAttribute('data-meal-index', mealCount);
                                                        addItemButton.addEventListener('click', function () {
                                                            addItemBox(newItemsContainer, mealCount);
                                                        });

                                                        newMealDiv.appendChild(addItemButton);
                                                        document.getElementById('mealContainer').appendChild(newMealDiv);
                                                        mealCount++;
                                                    } else {
                                                        alert('Maximum of 10 meals reached');
                                                    }
                                                }

                                                document.getElementById('addMealButton').addEventListener('click', addMealBox);

                                                // Add item functionality for the initial meal
                                                document.querySelector('.addItemButton').addEventListener('click', function () {
                                                    const mealIndex = this.getAttribute('data-meal-index');
                                                    const itemsContainer = document.getElementById(`itemsContainer${mealIndex}`);
                                                    addItemBox(itemsContainer, mealIndex);
                                                });

                                                document.getElementById('submitButton').addEventListener('click', function (event) {
                                                    event.preventDefault();
                                                    const fields = [];
                                                    document.querySelectorAll('.meal-box').forEach((mealBox, mealIndex) => {
                                                        const mealNameInput = mealBox.querySelector(`input[name="meals[${mealIndex}][name]"]`);
                                                        const mealName = mealNameInput ? mealNameInput.value : '';
                                                        const items = [];
                                                        mealBox.querySelectorAll('.item-box input').forEach(itemInput => {
                                                            items.push(itemInput.value);
                                                        });
                                                        fields.push({ name: mealName, items });
                                                    });

                                                    console.log(fields);
                                                });
                                            });
                                        </script> --}}

                                        {{-- <div id="mealContainer" class="col-12">
                                            <!-- Initial Meal Box with Items -->
                                            <div class="meal-box col-md-12 mt-3">
                                                <label for="mealField0">{{ __('keywords.meal') }}</label>
                                                <input type="text" id="mealField0" name="meals[0][name]" class="form-control" placeholder="{{ __('keywords.meal') }}">
                                                <x-input-error :messages="$errors->get('mealField0')" class="mt-2" />
                                                <div class="items-container mt-3" id="itemsContainer0">
                                                    <div class="item-box">
                                                        <label for="itemField0_0">{{ __('keywords.item') }}</label>
                                                        <input type="text" id="itemField0_0" name="meals[0][items][]" class="form-control" placeholder="{{ __('keywords.item') }}">
                                                        <x-input-error :messages="$errors->get('itemField0_0')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-secondary btn-sm addItemButton mt-2" data-meal-index="0">Add Item</button>
                                            </div>
                                        </div>
                                        <!-- Buttons to Add Meal -->
                                        <button style="margin-left: 15px; padding: 5px; width: 30px; height: 30px; font-size: 16px;" class="btn btn-primary mt-3 btn-sm" type="button" id="addMealButton">+</button>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function () {
                                                const maxMeals = 10;
                                                const maxItems = 15;
                                                let mealCount = 1;

                                                // Function to add new item box within a meal
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
                                                        newItemInput.name = `meals[${mealIndex}][items][]`;
                                                        newItemInput.classList.add('form-control');
                                                        newItemInput.placeholder = "{{ __('keywords.item') }}";
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

                                                // Function to add a new meal box
                                                function addMealBox() {
                                                    if (mealCount < maxMeals) {
                                                        const newMealDiv = document.createElement('div');
                                                        newMealDiv.classList.add('meal-box', 'col-md-12', 'mt-3');

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

                                                        const newItemsContainer = document.createElement('div');
                                                        newItemsContainer.classList.add('items-container', 'mt-3');
                                                        newItemsContainer.id = `itemsContainer${mealCount}`;

                                                        addItemBox(newItemsContainer, mealCount);

                                                        newMealDiv.appendChild(newMealLabel);
                                                        newMealDiv.appendChild(newMealInput);
                                                        newMealDiv.appendChild(newMealError);
                                                        newMealDiv.appendChild(newItemsContainer);

                                                        const addItemButton = document.createElement('button');
                                                        addItemButton.type = 'button';
                                                        addItemButton.classList.add('btn', 'btn-secondary', 'btn-sm', 'addItemButton', 'mt-2');
                                                        addItemButton.textContent = 'Add Item';
                                                        addItemButton.setAttribute('data-meal-index', mealCount);
                                                        addItemButton.addEventListener('click', function () {
                                                            addItemBox(newItemsContainer, mealCount);
                                                        });

                                                        newMealDiv.appendChild(addItemButton);
                                                        document.getElementById('mealContainer').appendChild(newMealDiv);
                                                        mealCount++;
                                                    } else {
                                                        alert('Maximum of 10 meals reached');
                                                    }
                                                }

                                                document.getElementById('addMealButton').addEventListener('click', addMealBox);

                                                // Add item functionality for the initial meal
                                                document.querySelector('.addItemButton').addEventListener('click', function () {
                                                    const mealIndex = this.getAttribute('data-meal-index');
                                                    const itemsContainer = document.getElementById(`itemsContainer${mealIndex}`);
                                                    addItemBox(itemsContainer, mealIndex);
                                                });

                                                document.getElementById('submitButton').addEventListener('click', function (event) {
                                                    event.preventDefault();
                                                    const fields = [];
                                                    document.querySelectorAll('.meal-box').forEach((mealBox, mealIndex) => {
                                                        const meal = mealBox.querySelector(`input[name="meals[${mealIndex}][name]"]`).value;
                                                        const items = [];
                                                        mealBox.querySelectorAll('.item-box input').forEach(itemInput => {
                                                            items.push(itemInput.value);
                                                        });
                                                        fields.push({ meal, items });
                                                    });

                                                    console.log(fields);
                                                });
                                            });
                                        </script> --}}

                                        {{-- <div id="mealContainer" class="col-12">
                                            <!-- Initial Meal Box with Items -->
                                            <div class="meal-box col-md-12 mt-3">
                                                <label for="mealField0">{{ __('keywords.meal') }}</label>
                                                <input type="text" id="mealField0" name="meals[0][name]" class="form-control" placeholder="{{ __('keywords.meal') }}">
                                                <x-input-error :messages="$errors->get('mealField0')" class="mt-2" />
                                                <div class="items-container mt-3">
                                                    <div class="item-box">
                                                        <label for="itemField0_0">{{ __('keywords.item') }}</label>
                                                        <input type="text" id="itemField0_0" name="meals[0][items][]" class="form-control" placeholder="{{ __('keywords.item') }}">
                                                        <x-input-error :messages="$errors->get('itemField0_0')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-secondary btn-sm addItemButton mt-2">Add Item</button>
                                            </div>
                                        </div>
                                        <!-- Buttons to Add Meal -->
                                        <button style="margin-left: 15px; padding: 5px; width: 30px; height: 30px; font-size: 16px;" class="btn btn-primary mt-3 btn-sm" type="button" id="addMealButton">+</button>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function () {
                                                const maxMeals = 10;
                                                const maxItems = 15;
                                                let mealCount = 1;

                                                // Function to add new item box within a meal
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
                                                        newItemInput.name = `meals[${mealIndex}][items][]`;
                                                        newItemInput.classList.add('form-control');
                                                        newItemInput.placeholder = "{{ __('keywords.item') }}";
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

                                                // Function to add a new meal box
                                                function addMealBox() {
                                                    if (mealCount < maxMeals) {
                                                        const newMealDiv = document.createElement('div');
                                                        newMealDiv.classList.add('meal-box', 'col-md-12', 'mt-3');

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

                                                        const newItemsContainer = document.createElement('div');
                                                        newItemsContainer.classList.add('items-container', 'mt-3');

                                                        addItemBox(newItemsContainer, mealCount);

                                                        newMealDiv.appendChild(newMealLabel);
                                                        newMealDiv.appendChild(newMealInput);
                                                        newMealDiv.appendChild(newMealError);
                                                        newMealDiv.appendChild(newItemsContainer);

                                                        const addItemButton = document.createElement('button');
                                                        addItemButton.type = 'button';
                                                        addItemButton.classList.add('btn', 'btn-secondary', 'btn-sm', 'addItemButton', 'mt-2');
                                                        addItemButton.textContent = 'Add Item';
                                                        addItemButton.addEventListener('click', function () {
                                                            addItemBox(newItemsContainer, mealCount);
                                                        });

                                                        newMealDiv.appendChild(addItemButton);
                                                        document.getElementById('mealContainer').appendChild(newMealDiv);
                                                        mealCount++;
                                                    } else {
                                                        alert('Maximum of 10 meals reached');
                                                    }
                                                }

                                                document.getElementById('addMealButton').addEventListener('click', addMealBox);

                                                // Add item functionality for the initial meal
                                                document.querySelector('.addItemButton').addEventListener('click', function () {
                                                    const itemsContainer = this.previousElementSibling;
                                                    addItemBox(itemsContainer, 0);
                                                });

                                                document.getElementById('submitButton').addEventListener('click', function (event) {
                                                    event.preventDefault();
                                                    const fields = [];
                                                    document.querySelectorAll('.meal-box').forEach((mealBox, mealIndex) => {
                                                        const meal = mealBox.querySelector(`input[name="meals[${mealIndex}][name]"]`).value;
                                                        const items = [];
                                                        mealBox.querySelectorAll('.item-box input').forEach(itemInput => {
                                                            items.push(itemInput.value);
                                                        });
                                                        fields.push({ meal, items });
                                                    });

                                                    console.log(fields);
                                                });
                                            });
                                        </script> --}}

                                        {{-- <div id="mealContainer" class="col-12">
                                            <!-- Initial Meal Box with Items -->
                                            <div class="meal-box col-md-12 mt-3">
                                                <label for="mealField0">{{ __('keywords.meal') }}</label>
                                                <input type="text" id="mealField0" name="meals[0][name]" class="form-control" placeholder="{{ __('keywords.meal') }}">
                                                <x-input-error :messages="$errors->get('mealField0')" class="mt-2" />
                                                <div class="items-container mt-3">
                                                    <div class="item-box">
                                                        <label for="itemField0_0">{{ __('keywords.item') }}</label>
                                                        <input type="text" id="itemField0_0" name="meals[0][items][]" class="form-control" placeholder="{{ __('keywords.item') }}">
                                                        <x-input-error :messages="$errors->get('itemField0_0')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-secondary btn-sm addItemButton mt-2">Add Item</button>
                                            </div>
                                        </div>
                                        <!-- Buttons to Add Meal -->
                                        <button style="margin-left: 15px; padding: 5px; width: 30px; height: 30px; font-size: 16px;" class="btn btn-primary mt-3 btn-sm" type="button" id="addMealButton">+</button>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function () {
                                                const maxMeals = 10;
                                                const maxItems = 15;
                                                let mealCount = 1;

                                                document.getElementById('addMealButton').addEventListener('click', function () {
                                                    if (mealCount < maxMeals) {
                                                        // Create a new div for the meal
                                                        const newMealDiv = document.createElement('div');
                                                        newMealDiv.classList.add('meal-box', 'col-md-12', 'mt-3');

                                                        // Create a new label for the meal input
                                                        const newMealLabel = document.createElement('label');
                                                        const newMealFieldId = `mealField${mealCount}`;
                                                        newMealLabel.setAttribute('for', newMealFieldId);
                                                        newMealLabel.textContent = "{{ __('keywords.meal') }}";

                                                        // Create a new meal input element
                                                        const newMealInput = document.createElement('input');
                                                        newMealInput.type = 'text';
                                                        newMealInput.id = newMealFieldId;
                                                        newMealInput.name = `meals[${mealCount}][name]`;
                                                        newMealInput.classList.add('form-control');
                                                        newMealInput.placeholder = "{{ __('keywords.meal') }}";

                                                        // Create a new x-input-error component for the meal
                                                        const newMealError = document.createElement('x-input-error');
                                                        newMealError.classList.add('mt-2');

                                                        // Create a container for the items
                                                        const newItemsContainer = document.createElement('div');
                                                        newItemsContainer.classList.add('items-container', 'mt-3');

                                                        // Create the first item box
                                                        const newItemBox = document.createElement('div');
                                                        newItemBox.classList.add('item-box');
                                                        const newItemLabel = document.createElement('label');
                                                        const newItemFieldId = `itemField${mealCount}_0`;
                                                        newItemLabel.setAttribute('for', newItemFieldId);
                                                        newItemLabel.textContent = "{{ __('keywords.item') }}";
                                                        const newItemInput = document.createElement('input');
                                                        newItemInput.type = 'text';
                                                        newItemInput.id = newItemFieldId;
                                                        newItemInput.name = `meals[${mealCount}][items][]`;
                                                        newItemInput.classList.add('form-control');
                                                        newItemInput.placeholder = "{{ __('keywords.item') }}";
                                                        const newItemError = document.createElement('x-input-error');
                                                        newItemError.classList.add('mt-2');
                                                        newItemBox.appendChild(newItemLabel);
                                                        newItemBox.appendChild(newItemInput);
                                                        newItemBox.appendChild(newItemError);

                                                        // Append the item box to the items container
                                                        newItemsContainer.appendChild(newItemBox);

                                                        // Append the new elements to the new meal div
                                                        newMealDiv.appendChild(newMealLabel);
                                                        newMealDiv.appendChild(newMealInput);
                                                        newMealDiv.appendChild(newMealError);
                                                        newMealDiv.appendChild(newItemsContainer);

                                                        // Create the Add Item button for this meal
                                                        const addItemButton = document.createElement('button');
                                                        addItemButton.type = 'button';
                                                        addItemButton.classList.add('btn', 'btn-secondary', 'btn-sm', 'addItemButton', 'mt-2');
                                                        addItemButton.textContent = 'Add Item';
                                                        addItemButton.addEventListener('click', function () {
                                                            const itemCount = newItemsContainer.querySelectorAll('.item-box').length;
                                                            if (itemCount < maxItems) {
                                                                const newItemBox = document.createElement('div');
                                                                newItemBox.classList.add('item-box');
                                                                const newItemLabel = document.createElement('label');
                                                                const newItemFieldId = `itemField${mealCount}_${itemCount}`;
                                                                newItemLabel.setAttribute('for', newItemFieldId);
                                                                newItemLabel.textContent = "{{ __('keywords.item') }}";
                                                                const newItemInput = document.createElement('input');
                                                                newItemInput.type = 'text';
                                                                newItemInput.id = newItemFieldId;
                                                                newItemInput.name = `meals[${mealCount}][items][]`;
                                                                newItemInput.classList.add('form-control');
                                                                newItemInput.placeholder = "{{ __('keywords.item') }}";
                                                                const newItemError = document.createElement('x-input-error');
                                                                newItemError.classList.add('mt-2');
                                                                newItemBox.appendChild(newItemLabel);
                                                                newItemBox.appendChild(newItemInput);
                                                                newItemBox.appendChild(newItemError);
                                                                newItemsContainer.appendChild(newItemBox);
                                                            } else {
                                                                alert('Maximum of 15 items per meal reached');
                                                            }
                                                        });

                                                        newMealDiv.appendChild(addItemButton);

                                                        // Append the new meal div to the meal container
                                                        document.getElementById('mealContainer').appendChild(newMealDiv);

                                                        mealCount++;
                                                    } else {
                                                        alert('Maximum of 10 meals reached');
                                                    }
                                                });

                                                document.getElementById('submitButton').addEventListener('click', function (event) {
                                                    // Prevent form submission for demonstration purpose
                                                    event.preventDefault();

                                                    // Collect the field values
                                                    const fields = [];
                                                    document.querySelectorAll('.meal-box').forEach((mealBox, mealIndex) => {
                                                        const meal = mealBox.querySelector('input[name^="meals["]').value;
                                                        const items = [];
                                                        mealBox.querySelectorAll('.item-box input').forEach(itemInput => {
                                                            items.push(itemInput.value);
                                                        });
                                                        fields.push({ meal, items });
                                                    });

                                                    // Log the collected fields for demonstration purpose
                                                    console.log(fields);

                                                    // Now you can send the 'fields' array to your backend using AJAX or include it in a form submission
                                                });
                                            });
                                        </script> --}}

                                        {{-- <div class="col-md-12 mt-3">
                                            <label for="initialField">{{ __('keywords.meal') }}</label>
                                            <input type="text" id="initialField" name="fields[]" class="form-control"
                                                placeholder="{{ __('keywords.meal') }}">
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
                                                        newLabel.textContent = "{{ __('keywords.meal') }}";

                                                        // Create a new input element
                                                        const newInput = document.createElement('input');
                                                        newInput.type = 'text';
                                                        newInput.id = newFieldId;
                                                        newInput.name = 'fields[]'; // Changed to 'fields[]'
                                                        newInput.classList.add('form-control');
                                                        newInput.placeholder = "{{ __('keywords.meal') }}";
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
                                                        alert('Maximum of 10 meal reached');
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
                                    </div> --}}
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
