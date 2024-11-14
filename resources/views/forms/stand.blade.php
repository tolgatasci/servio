<x-service-apply-layout>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .form-container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .form-table {
            width: 100%;
            border-collapse: collapse;
        }

        .form-table th,
        .form-table td {
            padding: 12px;
            border: 1px solid #ddd;
            vertical-align: middle;
        }

        .form-table th {
            background-color: #f9f9f9;
            text-align: left;
            font-weight: normal;
            color: #444;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="number"],
        textarea,
        select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            margin-top: 5px;
            box-sizing: border-box;
        }

        input[type="text"]:disabled {
            background-color: #e9ecef;
        }

        .file-upload-container {
            position: relative;
            width: 100%;
            height: 150px;
            border: 2px dashed #4CAF50;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .file-upload-container:hover {
            background-color: #f9f9f9;
        }

        .file-upload-container p {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #888;
            font-size: 16px;
        }

        .uploaded-files {
            margin-top: 10px;
        }

        .uploaded-files p {
            margin: 5px 0;
            font-size: 14px;
            color: #333;
        }

        .hall-layout {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            justify-items: center;
        }

        .hall-layout label {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            width: 100%;
            max-width: 120px;
        }

        .hall-layout input[type="radio"] {
            display: none;
        }

        .hall-layout img {
            width: 100%;
            max-width: 80px;
            height: auto;
            margin-bottom: 5px;
            border: 2px solid transparent;
            border-radius: 4px;
            transition: border 0.3s, filter 0.3s;
        }

        .hall-layout input[type="radio"]:checked + img {
            border: 2px solid #4CAF50;
            filter: brightness(0.8);
        }

        .hall-layout label:hover img {
            filter: brightness(0.9);
        }

        .radio-container {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .radio-container label {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        input[type="radio"] {
            display: none;
        }

        input[type="radio"] + .custom-radio {
            width: 20px;
            height: 20px;
            border: 2px solid #444;
            border-radius: 50%;
            display: inline-block;
            position: relative;
            margin-right: 10px;
            transition: background-color 0.3s, border-color 0.3s;
        }

        input[type="radio"]:checked + .custom-radio {
            border-color: #4CAF50;
            background-color: #4CAF50;
        }

        input[type="radio"]:checked + .custom-radio::after {
            content: "";
            width: 8px;
            height: 8px;
            background-color: white;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            width: 100%;
            font-size: 16px;
            margin-top: 20px;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-table th, .form-table td {
                display: block;
                width: 100%;
                text-align: left;
                box-sizing: border-box;
            }
            .hall-layout label {
                display:inline-block;
                margin-left: auto;
                margin-right: auto;
                clear: both;
                text-align: center;
                float: none;
            }
            .hall-layout label span
            {
                text-align: center;
                display: block;
            }
            .form-table th {
                font-size: 16px;
            }

            input[type="text"], input[type="email"], input[type="date"], input[type="number"], textarea, select {
                width: 100%;
                font-size: 14px;
            }

            button[type="submit"] {
                padding: 10px;
            }

            .file-upload-container {
                height: 100px;
            }

            .file-upload-container p {
                font-size: 14px;
            }
        }

        #file-upload{
            display:none;
        }
        .form-table input.is-invalid,
        .form-table textarea.is-invalid,
        .form-table select.is-invalid {
            border-color: #dc3545;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
            color: #dc3545;
        }
    </style>
    </head>
    <body>
    <div class="form-container">
        <h2>{{ __('Exhibition Briefing Form') }}</h2>
        <x-validation-errors class="errors" />
        @if(session('success'))
            <div class="alert alert-success">
                <div class="lh-1">
                    <h1 class="h6 mb-0 text-white lh-1">{{ session('success') }}</h1>
                </div>
            </div>
        @endif

        <form action="{{ route('private.form.stand', $serviceId) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <table class="form-table">
                <tr>
                    <th>{{ __('Company Logo') }}</th>
                    <td>
                        <input type="file" name="company_logo" id="company_logo"
                               class="@error('company_logo') is-invalid @enderror"
                               multiple accept="image/png, image/jpeg">
                        @error('company_logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>

                <tr>
                    <th>{{ __('Exhibition Name') }}</th>
                    <td>
                        <input type="text" name="fuar_name"
                               class="@error('fuar_name') is-invalid @enderror"
                               placeholder="{{ __('Enter exhibition name') }}"
                               value="{{ old('fuar_name') }}" required>
                        @error('fuar_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>

                <tr>
                    <th>{{ __('Stand Setup Duration (Hours)') }}</th>
                    <td>
                        <input type="number" name="stant_sure"
                               class="@error('stant_sure') is-invalid @enderror"
                               placeholder="{{ __('Enter duration in hours') }}"
                               value="{{ old('stant_sure') }}" required>
                        @error('stant_sure')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>

                <tr>
                    <th>{{ __('Exhibition Location and Date') }}</th>
                    <td>
                        <div class="radio-container">
                            <label>
                                <input type="text" name="fuar_yer"
                                       class="@error('fuar_yer') is-invalid @enderror"
                                       placeholder="{{ __('Enter location') }}"
                                       value="{{ old('fuar_yer') }}" required>
                                @error('fuar_yer')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </label>

                            <label>
                                <input type="date" name="fuar_date"
                                       class="@error('fuar_date') is-invalid @enderror"
                                       value="{{ old('fuar_date', date('Y-m-d')) }}" required>
                                @error('fuar_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>{{ __('Company Name') }}</th>
                    <td>
                        <input type="text" name="company_name"
                               class="@error('company_name') is-invalid @enderror"
                               placeholder="{{ __('Enter company name') }}"
                               value="{{ old('company_name') }}" required>
                        @error('company_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>

                <tr>
                    <th>{{ __('Company Address') }}</th>
                    <td>
                        <input type="text" name="company_address"
                               class="@error('company_address') is-invalid @enderror"
                               placeholder="{{ __('Enter company address') }}"
                               value="{{ old('company_address') }}" required>
                        @error('company_address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>

                <tr>
                    <th>{{ __('Phone/Fax') }}</th>
                    <td>
                        <input type="text" name="phone_fax"
                               class="@error('phone_fax') is-invalid @enderror"
                               placeholder="{{ __('Enter phone or fax number') }}"
                               value="{{ old('phone_fax') }}" required>
                        @error('phone_fax')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>

                <tr>
                    <th>{{ __('Website') }}</th>
                    <td>
                        <input type="text" name="web"
                               class="@error('web') is-invalid @enderror"
                               placeholder="{{ __('Enter website URL') }}"
                               value="{{ old('web') }}">
                        @error('web')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>

                <tr>
                    <th>{{ __('Email Address') }}</th>
                    <td>
                        <input type="email" name="email"
                               class="@error('email') is-invalid @enderror"
                               placeholder="{{ __('Enter email address') }}"
                               value="{{ old('email') }}" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>

                <tr>
                    <th>{{ __('Contact Person') }}</th>
                    <td>
                        <input type="text" name="contact_person"
                               class="@error('contact_person') is-invalid @enderror"
                               placeholder="{{ __('Enter contact person name') }}"
                               value="{{ old('contact_person') }}" required>
                        @error('contact_person')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>

                <tr>
                    <th>{{ __('Stand Location') }}</th>
                    <td>
                        <input type="text" name="stand_place"
                               class="@error('stand_place') is-invalid @enderror"
                               placeholder="{{ __('Enter stand location') }}"
                               value="{{ old('stand_place') }}" required>
                        @error('stand_place')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>

                <tr>
                    <th>{{ __('Hall and Open Sides') }}</th>
                    <td class="hall-layout">
                        <label>
                            <input type="radio" name="offene_seiten" value="1"
                                    {{ old('offene_seiten', '1') == '1' ? 'checked' : '' }}>
                            <img src="https://via.placeholder.com/100?text=1+Side" alt="{{ __('1 Open Side') }}">
                            <span>{{ __('1 Side') }}</span>
                        </label>
                        <label>
                            <input type="radio" name="offene_seiten" value="2"
                                    {{ old('offene_seiten') == '2' ? 'checked' : '' }}>
                            <img src="https://via.placeholder.com/100?text=2+Sides" alt="{{ __('2 Open Sides') }}">
                            <span>{{ __('2 Sides') }}</span>
                        </label>
                        <label>
                            <input type="radio" name="offene_seiten" value="3"
                                    {{ old('offene_seiten') == '3' ? 'checked' : '' }}>
                            <img src="https://via.placeholder.com/100?text=3+Sides" alt="{{ __('3 Open Sides') }}">
                            <span>{{ __('3 Sides') }}</span>
                        </label>
                        <label>
                            <input type="radio" name="offene_seiten" value="4"
                                    {{ old('offene_seiten') == '4' ? 'checked' : '' }}>
                            <img src="https://via.placeholder.com/100?text=4+Sides" alt="{{ __('4 Open Sides') }}">
                            <span>{{ __('4 Sides') }}</span>
                        </label>
                    </td>
                </tr>

                <tr>
                    <th>{{ __('Floor Plan') }}</th>
                    <td>
                        <div class="checkbox-container">
                            <label>
                                <input type="checkbox" id="hallenplan" name="hallenplan"
                                        {{ old('hallenplan') ? 'checked' : '' }}>
                                <span>{{ __('I want a floor plan') }}</span>
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>{{ __('Stand Model') }}</th>
                    <td>
                        <input type="text" name="standmodel"
                               class="@error('standmodel') is-invalid @enderror"
                               placeholder="{{ __('Enter stand model') }}"
                               value="{{ old('standmodel') }}" required>
                        @error('standmodel')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>

                <tr>
                    <th>{{ __('Two Story') }}</th>
                    <td>
                        <div class="radio-container">
                            <label>
                                <input type="radio" id="zweistockig-evet" name="zweistockig" value="evet"
                                       {{ old('zweistockig') == 'evet' ? 'checked' : '' }}
                                       onchange="toggleInput('zweistockig')">
                                <span class="custom-radio"></span>
                                <span>{{ __('Yes') }}</span>
                            </label>
                            <label>
                                <input type="radio" id="zweistockig-hayir" name="zweistockig" value="hayir"
                                       {{ old('zweistockig', 'hayir') == 'hayir' ? 'checked' : '' }}
                                       onchange="toggleInput('zweistockig')">
                                <span class="custom-radio"></span>
                                <span>{{ __('No') }}</span>
                            </label>
                            <label>
                                <span>{{ __('Details') }}:</span>
                                <input type="text" id="zweistockig-input" name="zweistockig_input"
                                       class="@error('zweistockig_input') is-invalid @enderror"
                                       placeholder="{{ __('Enter details') }}"
                                       value="{{ old('zweistockig_input') }}"
                                       disabled>
                                @error('zweistockig_input')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>{{ __('Meeting Room') }}</th>
                    <td>
                        <div class="radio-container">
                            <label>
                                <input type="radio" id="besprechungsraum-evet" name="besprechungsraum" value="evet"
                                       {{ old('besprechungsraum') == 'evet' ? 'checked' : '' }}
                                       onchange="toggleInput('besprechungsraum')">
                                <span class="custom-radio"></span>
                                <span>{{ __('Yes') }}</span>
                            </label>
                            <label>
                                <input type="radio" id="besprechungsraum-hayir" name="besprechungsraum" value="hayir"
                                       {{ old('besprechungsraum', 'hayir') == 'hayir' ? 'checked' : '' }}
                                       onchange="toggleInput('besprechungsraum')">
                                <span class="custom-radio"></span>
                                <span>{{ __('No') }}</span>
                            </label>
                            <label>
                                <span>{{ __('Details') }}:</span>
                                <input type="text" id="besprechungsraum-input" name="besprechungsraum_wunsch"
                                       class="@error('besprechungsraum_wunsch') is-invalid @enderror"
                                       placeholder="{{ __('Enter details') }}"
                                       value="{{ old('besprechungsraum_wunsch') }}"
                                       disabled>
                                @error('besprechungsraum_wunsch')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>{{ __('Storage Room') }}</th>
                    <td>
                        <div class="radio-container">
                            <label>
                                <input type="radio" id="lagerraum-evet" name="lagerraum" value="evet"
                                       {{ old('lagerraum') == 'evet' ? 'checked' : '' }}
                                       onchange="toggleInput('lagerraum')">
                                <span class="custom-radio"></span>
                                <span>{{ __('Yes') }}</span>
                            </label>
                            <label>
                                <input type="radio" id="lagerraum-hayir" name="lagerraum" value="hayir"
                                       {{ old('lagerraum', 'hayir') == 'hayir' ? 'checked' : '' }}
                                       onchange="toggleInput('lagerraum')">
                                <span class="custom-radio"></span>
                                <span>{{ __('No') }}</span>
                            </label>
                            <label>
                                <span>{{ __('Details') }}:</span>
                                <input type="text" id="lagerraum-input" name="lagerraum_wunsch"
                                       class="@error('lagerraum_wunsch') is-invalid @enderror"
                                       placeholder="{{ __('Enter details') }}"
                                       value="{{ old('lagerraum_wunsch') }}"
                                       disabled>
                                @error('lagerraum_wunsch')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>{{ __('Floor Type') }}</th>
                    <td>
                        <div class="radio-container">
                            <label>
                                <input type="radio" id="zemin-teppich" name="zemin" value="teppich"
                                        {{ old('zemin') == 'teppich' ? 'checked' : '' }}>
                                <span class="custom-radio"></span>
                                <span>{{ __('Carpet') }}</span>
                            </label>
                            <label>
                                <input type="radio" id="zemin-laminat" name="zemin" value="laminat"
                                        {{ old('zemin') == 'laminat' ? 'checked' : '' }}>
                                <span class="custom-radio"></span>
                                <span>{{ __('Laminate') }}</span>
                            </label>
                            <label>
                                <input type="radio" id="zemin-dekorspan" name="zemin" value="dekorspan"
                                        {{ old('zemin') == 'dekorspan' ? 'checked' : '' }}>
                                <span class="custom-radio"></span>
                                <span>{{ __('Decorative Panel') }}</span>
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>{{ __('Stand Style') }}</th>
                    <td>
                        <div class="radio-container">
                            <label>
                                <input type="radio" id="stant_still-evet" name="stant_still" value="evet"
                                       {{ old('stant_still') == 'evet' ? 'checked' : '' }}
                                       onchange="toggleInput('stant_still')">
                                <span class="custom-radio"></span>
                                <span>{{ __('Yes') }}</span>
                            </label>
                            <label>
                                <input type="radio" id="stant_still-hayir" name="stant_still" value="hayir"
                                       {{ old('stant_still', 'hayir') == 'hayir' ? 'checked' : '' }}
                                       onchange="toggleInput('stant_still')">
                                <span class="custom-radio"></span>
                                <span>{{ __('No') }}</span>
                            </label>
                            <label>
                                <span>{{ __('Description') }}:</span>
                                <input type="text" id="stant_still-input" name="stant_still_input"
                                       class="@error('stant_still_input') is-invalid @enderror"
                                       placeholder="{{ __('Enter description') }}"
                                       value="{{ old('stant_still_input') }}"
                                       disabled>
                                @error('stant_still_input')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>{{ __('Info Desk') }}</th>
                    <td>
                        <div class="radio-container">
                            <label>
                                <input type="radio" id="info_masa-evet" name="info_masa" value="evet"
                                       {{ old('info_masa') == 'evet' ? 'checked' : '' }}
                                       onchange="toggleInput('info_masa')">
                                <span class="custom-radio"></span>
                                <span>{{ __('Yes') }}</span>
                            </label>
                            <label>
                                <input type="radio" id="info_masa-hayir" name="info_masa" value="hayir"
                                       {{ old('info_masa', 'hayir') == 'hayir' ? 'checked' : '' }}
                                       onchange="toggleInput('info_masa')">
                                <span class="custom-radio"></span>
                                <span>{{ __('No') }}</span>
                            </label>
                            <label>
                                <span>{{ __('Description') }}:</span>
                                <input type="text" id="info_masa-input" name="info_masa_input"
                                       class="@error('info_masa_input') is-invalid @enderror"
                                       placeholder="{{ __('Enter description') }}"
                                       value="{{ old('info_masa_input') }}"
                                       disabled>
                                @error('info_masa_input')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>{{ __('Bar') }}</th>
                    <td>
                        <div class="radio-container">
                            <label>
                                <input type="radio" id="bar-evet" name="bar" value="evet"
                                       {{ old('bar') == 'evet' ? 'checked' : '' }}
                                       onchange="toggleInput('bar')">
                                <span class="custom-radio"></span>
                                <span>{{ __('Yes') }}</span>
                            </label>
                            <label>
                                <input type="radio" id="bar-hayir" name="bar" value="hayir"
                                       {{ old('bar', 'hayir') == 'hayir' ? 'checked' : '' }}
                                       onchange="toggleInput('bar')">
                                <span class="custom-radio"></span>
                                <span>{{ __('No') }}</span>
                            </label>
                            <label>
                                <span>{{ __('Description') }}:</span>
                                <input type="text" id="bar-input" name="bar_input"
                                       class="@error('bar_input') is-invalid @enderror"
                                       placeholder="{{ __('Enter description') }}"
                                       value="{{ old('bar_input') }}"
                                       disabled>
                                @error('bar_input')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>{{ __('Tables') }}</th>
                    <td>
                        <div class="radio-container">
                            <label>
                                <input type="radio" id="masalar-evet" name="masalar" value="evet"
                                       {{ old('masalar') == 'evet' ? 'checked' : '' }}
                                       onchange="toggleInput('masalar')">
                                <span class="custom-radio"></span>
                                <span>{{ __('Yes') }}</span>
                            </label>
                            <label>
                                <input type="radio" id="masalar-hayir" name="masalar" value="hayir"
                                       {{ old('masalar', 'hayir') == 'hayir' ? 'checked' : '' }}
                                       onchange="toggleInput('masalar')">
                                <span class="custom-radio"></span>
                                <span>{{ __('No') }}</span>
                            </label>
                            <label>
                                <span>{{ __('Quantity') }}:</span>
                                <input type="number" id="masalar-input" name="masalar_input"
                                       class="@error('masalar_input') is-invalid @enderror"
                                       placeholder="{{ __('Enter quantity') }}"
                                       value="{{ old('masalar_input') }}"
                                       disabled>
                                @error('masalar_input')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>{{ __('Chairs') }}</th>
                    <td>
                        <div class="radio-container">
                            <label>
                                <input type="radio" id="sandalyeler-evet" name="sandalyeler" value="evet"
                                       {{ old('sandalyeler') == 'evet' ? 'checked' : '' }}
                                       onchange="toggleInput('sandalyeler')">
                                <span class="custom-radio"></span>
                                <span>{{ __('Yes') }}</span>
                            </label>
                            <label>
                                <input type="radio" id="sandalyeler-hayir" name="sandalyeler" value="hayir"
                                       {{ old('sandalyeler', 'hayir') == 'hayir' ? 'checked' : '' }}
                                       onchange="toggleInput('sandalyeler')">
                                <span class="custom-radio"></span>
                                <span>{{ __('No') }}</span>
                            </label>
                            <label>
                                <span>{{ __('Quantity') }}:</span>
                                <input type="number" id="sandalyeler-input" name="sandalyeler_input"
                                       class="@error('sandalyeler_input') is-invalid @enderror"
                                       placeholder="{{ __('Enter quantity') }}"
                                       value="{{ old('sandalyeler_input') }}"
                                       disabled>
                                @error('sandalyeler_input')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>{{ __('Bar Stools') }}</th>
                    <td>
                        <div class="radio-container">
                            <label>
                                <input type="radio" id="bar_taburesi-evet" name="bar_taburesi" value="evet"
                                       {{ old('bar_taburesi') == 'evet' ? 'checked' : '' }}
                                       onchange="toggleInput('bar_taburesi')">
                                <span class="custom-radio"></span>
                                <span>{{ __('Yes') }}</span>
                            </label>
                            <label>
                                <input type="radio" id="bar_taburesi-hayir" name="bar_taburesi" value="hayir"
                                       {{ old('bar_taburesi', 'hayir') == 'hayir' ? 'checked' : '' }}
                                       onchange="toggleInput('bar_taburesi')">
                                <span class="custom-radio"></span>
                                <span>{{ __('No') }}</span>
                            </label>
                            <label>
                                <span>{{ __('Quantity') }}:</span>
                                <input type="number" id="bar_taburesi-input" name="bar_taburesi_input"
                                       class="@error('bar_taburesi_input') is-invalid @enderror"
                                       placeholder="{{ __('Enter quantity') }}"
                                       value="{{ old('bar_taburesi_input') }}"
                                       disabled>
                                @error('bar_taburesi_input')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>{{ __('Digital Printing') }}</th>
                    <td>
                        <div class="radio-container">
                            <label>
                                <input type="radio" id="dijital_baski-evet" name="dijital_baski" value="evet"
                                       {{ old('dijital_baski') == 'evet' ? 'checked' : '' }}
                                       onchange="toggleInput('dijital_baski')">
                                <span class="custom-radio"></span>
                                <span>{{ __('Yes') }}</span>
                            </label>
                            <label>
                                <input type="radio" id="dijital_baski-hayir" name="dijital_baski" value="hayir"
                                       {{ old('dijital_baski', 'hayir') == 'hayir' ? 'checked' : '' }}
                                       onchange="toggleInput('dijital_baski')">
                                <span class="custom-radio"></span>
                                <span>{{ __('No') }}</span>
                            </label>
                            <label>
                                <span>{{ __('Description') }}:</span>
                                <input type="text" id="dijital_baski-input" name="dijital_baski_input"
                                       class="@error('dijital_baski_input') is-invalid @enderror"
                                       placeholder="{{ __('Enter description') }}"
                                       value="{{ old('dijital_baski_input') }}"
                                       disabled>
                                @error('dijital_baski_input')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>{{ __('TV') }}</th>
                    <td>
                        <div class="radio-container">
                            <label>
                                <input type="radio" id="tv-evet" name="tv" value="evet"
                                       {{ old('tv') == 'evet' ? 'checked' : '' }}
                                       onchange="toggleInput('tv')">
                                <span class="custom-radio"></span>
                                <span>{{ __('Yes') }}</span>
                            </label>
                            <label>
                                <input type="radio" id="tv-hayir" name="tv" value="hayir"
                                       {{ old('tv', 'hayir') == 'hayir' ? 'checked' : '' }}
                                       onchange="toggleInput('tv')">
                                <span class="custom-radio"></span>
                                <span>{{ __('No') }}</span>
                            </label>
                            <label>
                                <span>{{ __('Description') }}:</span>
                                <input type="text" id="tv-input" name="tv_input"
                                       class="@error('tv_input') is-invalid @enderror"
                                       placeholder="{{ __('Enter description') }}"
                                       value="{{ old('tv_input') }}"
                                       disabled>
                                @error('tv_input')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>{{ __('Refrigerator') }}</th>
                    <td>
                        <div class="radio-container">
                            <label>
                                <input type="radio" id="buzdolabi-evet" name="buzdolabi" value="evet"
                                       {{ old('buzdolabi') == 'evet' ? 'checked' : '' }}
                                       onchange="toggleInput('buzdolabi')">
                                <span class="custom-radio"></span>
                                <span>{{ __('Yes') }}</span>
                            </label>
                            <label>
                                <input type="radio" id="buzdolabi-hayir" name="buzdolabi" value="hayir"
                                       {{ old('buzdolabi', 'hayir') == 'hayir' ? 'checked' : '' }}
                                       onchange="toggleInput('buzdolabi')">
                                <span class="custom-radio"></span>
                                <span>{{ __('No') }}</span>
                            </label>
                            <label>
                                <span>{{ __('Description') }}:</span>
                                <input type="text" id="buzdolabi-input" name="buzdolabi_input"
                                       class="@error('buzdolabi_input') is-invalid @enderror"
                                       placeholder="{{ __('Enter description') }}"
                                       value="{{ old('buzdolabi_input') }}"
                                       disabled>
                                @error('buzdolabi_input')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>{{ __('Sink') }}</th>
                    <td>
                        <div class="radio-container">
                            <label>
                                <input type="radio" id="evye-evet" name="evye" value="evet"
                                       {{ old('evye') == 'evet' ? 'checked' : '' }}
                                       onchange="toggleInput('evye')">
                                <span class="custom-radio"></span>
                                <span>{{ __('Yes') }}</span>
                            </label>
                            <label>
                                <input type="radio" id="evye-hayir" name="evye" value="hayir"
                                       {{ old('evye', 'hayir') == 'hayir' ? 'checked' : '' }}
                                       onchange="toggleInput('evye')">
                                <span class="custom-radio"></span>
                                <span>{{ __('No') }}</span>
                            </label>
                            RG

                            Copy
                            <tr>
                                <th>{{ __('Sink') }}</th>
                                <td>
                                    <div class="radio-container">
                                        <label>
                                            <input type="radio" id="evye-evet" name="evye" value="evet"
                                                   {{ old('evye') == 'evet' ? 'checked' : '' }}
                                                   onchange="toggleInput('evye')">
                                            <span class="custom-radio"></span>
                                            <span>{{ __('Yes') }}</span>
                                        </label>
                                        <label>
                                            <input type="radio" id="evye-hayir" name="evye" value="hayir"
                                                   {{ old('evye', 'hayir') == 'hayir' ? 'checked' : '' }}
                                                   onchange="toggleInput('evye')">
                                            <span class="custom-radio"></span>
                                            <span>{{ __('No') }}</span>
                                        </label>
                                        <label>

                                            burda kaldın

                                            Devam ediyorum:

                                            html

                                            Copy
                                            <label>
                                                <span>{{ __('Description') }}:</span>
                                                <input type="text" id="evye-input" name="evye_input"
                                                       class="@error('evye_input') is-invalid @enderror"
                                                       placeholder="{{ __('Enter description') }}"
                                                       value="{{ old('evye_input') }}"
                                                       disabled>
                                                @error('evye_input')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </label>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th>{{ __('Planned Budget') }}</th>
                                <td>
                                    <input type="number" name="budget"
                                           class="@error('budget') is-invalid @enderror"
                                           placeholder="{{ __('Enter planned budget') }}"
                                           value="{{ old('budget') }}" required>
                                    @error('budget')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>

                            <tr>
                                <th>{{ __('Products to be Exhibited') }}</th>
                                <td>
        <textarea name="produkte"
                  class="@error('produkte') is-invalid @enderror"
                  placeholder="{{ __('Enter products to be exhibited') }}"
                  rows="4">{{ old('produkte') }}</textarea>
                                    @error('produkte')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>

                            <tr>
                                <th>{{ __('Other Requests') }}</th>
                                <td>
        <textarea name="weitere_wuensche"
                  class="@error('weitere_wuensche') is-invalid @enderror"
                  placeholder="{{ __('Enter other requests') }}"
                  rows="4">{{ old('weitere_wuensche') }}</textarea>
                                    @error('weitere_wuensche')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>

                            <tr>
                                <th>{{ __('File Upload') }}</th>
                                <td>
                                    <div class="file-upload-container" id="file-upload-container">
                                        <p>{{ __('Drag your files here or click to upload') }}</p>
                                        <input type="file" name="uploads[]" id="file-upload"
                                               class="@error('uploads') is-invalid @enderror"
                                               multiple
                                               accept="application/pdf, application/vnd.ms-excel, image/png, image/jpeg">
                                        @error('uploads')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="uploaded-files" id="uploaded-files"></div>
                                </td>
                            </tr>
            </table>

            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        </form>
    </div>

    <script>
        function toggleInput(model) {
            const evetRadio = document.getElementById(model+'-evet');
            const inputField = document.getElementById(model+'-input');

            if (evetRadio.checked) {
                inputField.disabled = false;
                inputField.focus();
            } else {
                inputField.disabled = true;
                inputField.value = '';
            }
        }

        const fileUploadContainer = document.getElementById('file-upload-container');
        const fileUploadInput = document.getElementById('file-upload');
        const uploadedFilesDiv = document.getElementById('uploaded-files');

        fileUploadContainer.addEventListener('click', () => {
            fileUploadInput.click();
        });

        fileUploadInput.addEventListener('change', handleFiles);

        function handleFiles() {
            const files = fileUploadInput.files;
            uploadedFilesDiv.innerHTML = '';

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const fileElement = document.createElement('p');
                fileElement.textContent = file.name;
                uploadedFilesDiv.appendChild(fileElement);
            }
        }

        // Drag and drop functionality
        fileUploadContainer.addEventListener('dragover', (e) => {
            e.preventDefault();
            fileUploadContainer.style.backgroundColor = "#e6ffe6";
        });

        fileUploadContainer.addEventListener('dragleave', (e) => {
            e.preventDefault();
            fileUploadContainer.style.backgroundColor = "#fff";
        });

        fileUploadContainer.addEventListener('drop', (e) => {
            e.preventDefault();
            fileUploadContainer.style.backgroundColor = "#fff";
            fileUploadInput.files = e.dataTransfer.files;
            handleFiles();
        });

        // Initialize all toggle inputs on page load
        document.addEventListener('DOMContentLoaded', function() {
            const radioInputs = document.querySelectorAll('input[type="radio"]');
            radioInputs.forEach(radio => {
                if (radio.checked && radio.id.endsWith('-evet')) {
                    const model = radio.id.replace('-evet', '');
                    toggleInput(model);
                }
            });
        });
    </script>



</x-service-apply-layout>
