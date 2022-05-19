<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./static/css/base.css">
    <link rel="icon" href="./static/img/favicon.ico">
    <title>MISIS – English-medium Master’s Programs</title>
    <style type="text/css">
        span {
            color: red;
        }
    </style>
</head>
<body>
<main>

    <!-- Хедер в лк, с разделами -->

    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4">
            <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0">
                <img height="80" src="./static/img/logo-eng-small.png" alt="logo-eng">
            </a>
            @include('_elements.dashboard_menu')
        </header>
    </div>

    <!-- Заявка -->

    <div class="container">
        <div class="container h1-conteiner">
            <h1>Application</h1>
        </div>
        <hr>
        <p>Note that you after sending the application, it will get a check status (pending, accepted, rejected). You will be able to come back later and fix some of your responses if the application is rejected. If you have any questions please contact us via chat.</p>
        @if(is_null($user->app) || ($user->app && $user->app->verified == 2))
            <form class="row mx-20p" method="POST" enctype="multipart/form-data">
                @csrf

                @if($user->app && $user->app->verified == 2)
                    <hr>
                    <p style="font-size: 25px;"><strong>Application status:</strong> rejected.</p>
                    <p>Reason for rejection: {!! $user->app->comment ?: '-' !!}</p>
                    <p>Your application has been rejected. Please proceed to change your responses according to the Admission Officer's comment above. If you have changed your mind about applying to MISiS, you can <a href="/app/delete" class="color-blue">delete your application</a>.</p>
                    <hr>
                @endif

                @if ($errors->any())
                    <div style="text-align: left;">
                        <ul class="list-group list-group-flush mb-3">
                            @foreach ($errors->all() as $error)
                                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <hr>

                <p><strong>Personal Information</strong></p>

                <div class="mb-3 row">
                    <label for="fn" class="col-3 col-form-label">First name <span>*</span></label>
                    <div class="col-9">
                        <input class="form-control" type="text" id="fn" name="first_name" required readonly
                               value="{{ old('first_name') ?: ($user->app ? $user->app->data['first_name'] : $user->first_name) }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="mn" class="col-3 col-form-label">Middle name</label>
                    <div class="col-9">
                        <input class="form-control" type="text" id="ln" name="middle_name" readonly
                               value="{{ old('middle_name') ?: ($user->app ? $user->app->data['middle_name'] : ($user->middle_name ?: '')) }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="ln" class="col-3 col-form-label">Last name <span>*</span></label>
                    <div class="col-9">
                        <input class="form-control" type="text" id="mn" name="last_name" required readonly
                               value="{{ old('last_name') ?: ($user->app ? $user->app->data['last_name'] : $user->last_name) }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="birth_date" class="col-3 col-form-label">Date of birth <span>*</span></label>
                    <div class="col-9">
                        <input class="form-control" type="date" id="birth_date" name="birth_date" required
                               value="{{ old('birth_date') ?: ($user->app ? $user->app->data['birth_date'] : '') }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="birth_place" class="col-3 col-form-label">Place of birth <span>*</span></label>
                    <div class="col-9">
                        <select class="form-select" id="birth_place" name="birth_place" required>
                            @include('_elements.countries', ['selected' => old('birth_place') ?: ($user->app ? $user->app->data['birth_place'] : '')])
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="nationality" class="col-3 col-form-label">Nationality <span>*</span></label>
                    <div class="col-9">
                        <input class="form-control" type="text" id="nationality" name="nationality" required
                               value="{{ old('nationality') ?: ($user->app ? $user->app->data['nationality'] : '') }}">
                    </div>
                </div>

                <hr>
                <p><strong>IMPORTANT NOTE:</strong> We also offer our applicants to choose two more programs from the list of Master’s programs available. This is for you to be backed up in case of tough competition rates at the admission or if student group is not formed up to your first-priority program.</p>
                <hr>

                <div class="mb-3 row">
                    <label for="program_01" class="col-3 col-form-label">Desired Program of Study (first priority) <span>*</span></label>
                    <div class="col-9">
                        <select class="form-select" id="program_01" name="program_01" required>
                            <option value>Choose...</option>
                            @foreach ($programs as $program)
                                <option {{ ((old('program_01') ?: ($user->app ? $user->app->data['program_01'] : '')) == $program->id) ? ' selected ' : '' }}
                                        value="{{ $program->id }}">{{ $program->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="program_02" class="col-3 col-form-label">Desired Program of Study (second priority) <span>*</span></label>
                    <div class="col-9">
                        <select class="form-select" id="program_02" name="program_02" required>
                            <option value>Choose...</option>
                            @foreach ($programs as $program)
                                <option {{ ((old('program_02') ?: ($user->app ? $user->app->data['program_02'] : '')) == $program->id) ? ' selected ' : '' }}
                                        value="{{ $program->id }}">{{ $program->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="program3" class="col-3 col-form-label">Desired Program of Study (third priority) <span>*</span></label>
                    <div class="col-9">
                        <select class="form-select" id="program_03" name="program_03" required>
                            <option value>Choose...</option>
                            @foreach ($programs as $program)
                                <option
                                    {{ ((old('program_03') ?: ($user->app ? $user->app->data['program_03'] : '')) == $program->id) ? ' selected ' : '' }}
                                    value="{{ $program->id }}">{{ $program->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="native_lang" class="col-3 col-form-label">Native language <span>*</span></label>
                    <div class="col-9">
                        <input type="text" id="native_lang" class="form-control" name="native_lang" required
                               value="{{ old('native_lang') ?: ($user->app && $user->app->data['native_lang'] ? $user->app->data['native_lang'] : '') }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="gender" class="col-3 col-form-label">Gender <span>*</span></label>
                    <div class="col-9">
                        <select class="form-select" id="gender" name="gender" required>
                            <option value>Choose...</option>
                            <option {{ ((old('gender') ?: ($user->app ? $user->app->data['gender'] : '')) == 'Male') ? ' selected ' : '' }}
                                    value="Male">Male</option>
                            <option {{ ((old('gender') ?: ($user->app ? $user->app->data['gender'] : '')) == 'Female') ? ' selected ' : '' }}
                                    value="Female">Female</option>
                        </select>
                    </div>
                </div>

                <p class="mt-3">Home phone number</p>
                <div class="mb-3 row">
                    <label for="home_phone_code" class="col-3 col-form-label">Country code</label>
                    <div class="col-2">
                        <input type="text" id="home_phone_code" class="form-control"
                               placeholder="+" name="home_phone_code"
                               value="{{ old('home_phone_code') ?: ($user->app && $user->app->data['home_phone_code'] ? $user->app->data['home_phone_code'] : '') }}">
                    </div>
                    <label for="home_phone" class="col-3 col-form-label">Phone number</label>
                    <div class="col-4">
                        <input type="text" id="home_phone" class="form-control" name="home_phone"
                               value="{{ old('home_phone') ?: ($user->app && $user->app->data['home_phone'] ? $user->app->data['home_phone'] : '') }}">
                    </div>
                </div>

                <p class="mt-3">Mobile phone number (for WhatsApp, Telegram or Viber) <span>*</span></p>
                <div class="mb-3 row">
                    <label for="mobile_phone_code" class="col-3 col-form-label">Country code</label>
                    <div class="col-2">
                        <input type="text" id="mobile_phone_code" class="form-control"
                               placeholder="+" name="mobile_phone_code" required
                               value="{{ old('mobile_phone_code') ?: ($user->app ? $user->app->data['mobile_phone_code'] : '') }}">
                    </div>
                    <label for="mobile_phone" class="col-3 col-form-label">Phone number</label>
                    <div class="col-4">
                        <input type="text" id="mobile_phone" class="form-control" name="mobile_phone" required
                               value="{{ old('mobile_phone') ?: ($user->app ? $user->app->data['mobile_phone'] : '') }}">
                    </div>
                </div>

                <div class="mb-3 mt-3 row">
                    <label for="photo" class="col-3 col-form-label">A color passport-style photo</label>
                    <div class="col-9">
                        <input class="form-control" type="file" id="photo"
                               name="photo" value="{{ old('photo') }}" accept="image/jpeg">
                        @if ($user->app && isset($user->app->data['photo']))
                            <div class="mt-2 mb-2">
                                <a href="{{ \Illuminate\Support\Facades\Storage::url($user->app->data['photo']) }}" target="_blank">
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($user->app->data['photo']) }}" alt="" width="200">
                                </a>
                                <br>
                                See file <a class="color-blue" href="{{ \Illuminate\Support\Facades\Storage::url($user->app->data['photo']) }}" target="_blank">here</a>.
                                <input type="hidden" name="photo_old" value="{{ $user->app->data['photo'] }}">
                            </div>
                        @endif
                    </div>
                    <p style="font-size: 12px; margin-bottom: 0">A single JPEG (!!!) file: jpeg or jpg. 5 Mb max. The photograph must be in jpeg or jpg format because the Ministry of Education and Science of the Russian Federation online system does not allow us to submit photos in pdf format.</p>
                </div>

                <p>Planned enrollment time: degree programs start only in the fall, but non-degree exchange students may enter in either the fall or spring semester.</p>

                <div class="mb-3 row">
                    <label for="year" class="col-3 col-form-label">Year <span>*</span></label>
                    <div class="col-9">
                        <input type="text" id="year" class="form-control"
                               placeholder="2022, Fall semester" name="year" required
                               value="{{ old('year') ?: ($user->app ? $user->app->data['year'] : '2022, Fall semester') }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-5 col-form-label">Do you need University housing? <span>*</span></label>
                    <div class="col-7">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="housing" id="housing_yes" value="yes"
                                   required{{ ((old('housing') ?: ($user->app ? $user->app->data['housing'] : '')) == 'yes') ? ' checked ' : '' }}>
                            <label class="form-check-label" for="housing_yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="housing" id="housing_no" value="no"
                                   required{{ ((old('housing') ?: ($user->app ? $user->app->data['housing'] : 'no')) == 'no') ? ' checked ' : '' }}>
                            <label class="form-check-label" for="housing_no">No</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="why_enroll" class="col-3 col-form-label">Briefly tell us why you would like to enroll at NUST MISIS <span>*</span></label>
                    <div class="col-9">
                        <textarea class="form-control" rows="3" id="why_enroll" name="why_enroll" required
                        >{{ old('why_enroll') ?: ($user->app ? $user->app->data['why_enroll'] : '') }}</textarea>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-3 col-form-label">Where and how did you learn about NUST MISIS International Master’s Programs? We highly appreciate your effort to share this information with us <span>*</span></label>
                    <div class="col-9 mt-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="masterstudies"
                                   {{ in_array('masterstudies.com', old('source') ?: ($user->app ? $user->app->data['source'] : [])) ? ' checked' : '' }}
                                   name="source[]" value="masterstudies.com">
                            <label class="form-check-label" for="masterstudies">
                                masterstudies.com
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="masterportals"
                                   {{ in_array('masterportals.com', old('source') ?: ($user->app ? $user->app->data['source'] : [])) ? ' checked' : '' }}
                                   name="source[]" value="masterportals.com">
                            <label class="form-check-label" for="masterportals">
                                masterportals.com
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="topuniversities"
                                   {{ in_array('topuniversities.com', old('source') ?: ($user->app ? $user->app->data['source'] : [])) ? ' checked' : '' }}
                                   name="source[]" value="topuniversities.com">
                            <label class="form-check-label" for="topuniversities">
                                topuniversities.com
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="postgrad"
                                   {{ in_array('postgrad.com', old('source') ?: ($user->app ? $user->app->data['source'] : [])) ? ' checked' : '' }}
                                   name="source[]" value="postgrad.com">
                            <label class="form-check-label" for="postgrad">
                                postgrad.com
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="misis"
                                   {{ in_array('NUST MISIS website', old('source') ?: ($user->app ? $user->app->data['source'] : [])) ? ' checked' : '' }}
                                   name="source[]" value="NUST MISIS website">
                            <label class="form-check-label" for="misis">
                                NUST MISIS website
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="student"
                                   {{ in_array('Current student', old('source') ?: ($user->app ? $user->app->data['source'] : [])) ? ' checked' : '' }}
                                   name="source[]" value="Current student">
                            <label class="form-check-label" for="student">
                                Current student
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="studyinrussia"
                                   {{ in_array('StudyInRussia.ru', old('source') ?: ($user->app ? $user->app->data['source'] : [])) ? ' checked' : '' }}
                                   name="source[]" value="StudyInRussia.ru">
                            <label class="form-check-label" for="studyinrussia">
                                StudyInRussia.ru
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input mt-2" type="checkbox" id="other"
                                   {{ in_array('Other', old('source') ?: ($user->app ? $user->app->data['source'] : [])) ? ' checked' : '' }}
                                   name="source[]" value="Other">
                            <label class="form-check-label" for="other" style="width: 100%;">
                                <input type="text" class="form-control" placeholder="Other"
                                       name="source_other"
                                       value="{{ old('source_other') ?: ($user->app ? $user->app->data['source_other'] : '') }}">
                            </label>
                        </div>
                    </div>
                </div>

                <hr>
                <p><strong>Education</strong></p>

                <p>Previous Educational Institution</p>

                <div class="mb-3 row">
                    <label for="institution" class="col-3 col-form-label">Institution <span>*</span></label>
                    <div class="col-9">
                        <input type="text" id="institution" class="form-control" name="institution" required
                               value="{{ old('institution') ?: ($user->app ? $user->app->data['institution'] : '') }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="city_country" class="col-3 col-form-label">City / Country <span>*</span></label>
                    <div class="col-9">
                        <input type="text" id="city_country" class="form-control" name="city_country" required
                               value="{{ old('city_country') ?: ($user->app ? $user->app->data['city_country'] : '') }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="year_from_to" class="col-3 col-form-label">Year (from-to) <span>*</span></label>
                    <div class="col-9">
                        <input type="text" id="year_from_to" class="form-control" name="year_from_to" required
                               value="{{ old('year_from_to') ?: ($user->app ? $user->app->data['year_from_to'] : '') }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="field_of_study" class="col-3 col-form-label">Field of study <span>*</span></label>
                    <div class="col-9">
                        <input type="text" id="field_of_study" class="form-control" name="field_of_study" required
                               value="{{ old('field_of_study') ?: ($user->app ? $user->app->data['field_of_study'] : '') }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="degree_title" class="col-3 col-form-label">Degree title <span>*</span></label>
                    <div class="col-9">
                        <input type="text" id="degree_title" class="form-control" name="degree_title" required
                               value="{{ old('degree_title') ?: ($user->app ? $user->app->data['degree_title'] : '') }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="gpa" class="col-3 col-form-label">GPA (Received / Max) <span>*</span></label>
                    <div class="col-9">
                        <input type="text" id="gpa" class="form-control" name="gpa" required
                               value="{{ old('gpa') ?: ($user->app ? $user->app->data['gpa'] : '') }}">
                    </div>
                </div>

                <div class="mb-3 mt-3 row">
                    <label for="diploma" class="col-3 col-form-label">Bachelor or previous educational diploma scan <span>*</span></label>
                    <div class="col-9">
                        <input class="form-control" type="file" id="diploma"
                               name="diploma" value="{{ old('diploma') }}" accept="application/pdf">
                        @if ($user->app)
                            <div class="mt-2 mb-2">See file <a class="color-blue" href="{{ \Illuminate\Support\Facades\Storage::url($user->app->data['diploma']) }}" target="_blank">here</a>.</div>
                            <input type="hidden" name="diploma_old" value="{{ $user->app->data['diploma'] }}">
                        @endif
                    </div>
                    <p style="font-size: 12px; margin-bottom: 0">A single pdf file, 20 Mb max (see e.g. https://online2pdf.com).</p>
                </div>

                <div class="mb-3 mt-3 row">
                    <label for="transcripts" class="col-3 col-form-label">Bachelor or previous educational transcripts scan <span>*</span></label>
                    <div class="col-9">
                        <input class="form-control" type="file" id="transcripts" name="transcripts" value="{{ old('transcripts') }}" accept="application/pdf">
                        @if ($user->app)
                            <div class="mt-2 mb-2">See file <a class="color-blue" href="{{ \Illuminate\Support\Facades\Storage::url($user->app->data['transcripts']) }}" target="_blank">here</a>.</div>
                            <input type="hidden" name="transcripts_old" value="{{ $user->app->data['transcripts'] }}">
                        @endif
                    </div>
                    <p style="font-size: 12px; margin-bottom: 0">A single pdf file, 20 Mb max (see e.g. https://online2pdf.com).</p>
                </div>

                <div class="mb-3 row">
                    <label for="achievements" class="col-3 col-form-label">Please indicate your distinctions, honors, awards, and achievements</label>
                    <div class="col-9">
                        <textarea class="form-control" rows="3" id="achievements" name="achievements"
                        >{{ old('achievements') ?: ($user->app ? $user->app->data['achievements'] : '') }}</textarea>
                    </div>
                </div>

                <div class="mb-3 mt-3 row">
                    <label for="achievements_doc" class="col-3 col-form-label">Scans of documents related to other achievements</label>
                    <div class="col-9">
                        <input class="form-control" type="file" id="achievements_doc"
                               name="achievements_doc" value="{{ old('achievements_doc') }}" accept="application/pdf">
                        @if ($user->app && isset($user->app->data['achievements_doc']))
                            <div class="mt-2 mb-2">See file <a class="color-blue" href="{{ \Illuminate\Support\Facades\Storage::url($user->app->data['achievements_doc']) }}" target="_blank">here</a>.</div>
                            <input type="hidden" name="achievements_doc_old" value="{{ $user->app->data['achievements_doc'] }}">
                        @endif
                    </div>
                    <p style="font-size: 12px; margin-bottom: 0">A single pdf file, 20 Mb max (see e.g. https://online2pdf.com).</p>
                </div>

                <p>Please rate your English language proficiency</p>

                <div class="mb-3 row">
                    <label class="col-3 col-form-label py-0">Speaking</label>
                    <div class="col-9">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="speaking" id="s-fluent"
                                   value="Fluent"{{ ((old('speaking') ?: (($user->app && isset($user->app->data['speaking'])) ? $user->app->data['speaking'] : '')) == 'Fluent') ? ' checked ' : '' }}>
                            <label class="form-check-label" for="s-fluent">Fluent</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="speaking" id="s-good"
                                   value="Good"{{ ((old('speaking') ?: (($user->app && isset($user->app->data['speaking'])) ? $user->app->data['speaking'] : '')) == 'Good') ? ' checked ' : '' }}>
                            <label class="form-check-label" for="s-good">Good</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="speaking" id="s-fair"
                                   value="Fair"{{ ((old('speaking') ?: (($user->app && isset($user->app->data['speaking'])) ? $user->app->data['speaking'] : '')) == 'Fair') ? ' checked ' : '' }}>
                            <label class="form-check-label" for="s-fair">Fair</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="speaking" id="s-poor"
                                   value="Poor"{{ ((old('speaking') ?: (($user->app && isset($user->app->data['speaking'])) ? $user->app->data['speaking'] : '')) == 'Fair') ? ' checked ' : '' }}>
                            <label class="form-check-label" for="s-poor">Poor</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-3 col-form-label py-0">Reading</label>
                    <div class="col-9">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="reading" id="r-fluent"
                                   value="Fluent"{{ ((old('reading') ?: (($user->app && isset($user->app->data['reading'])) ? $user->app->data['reading'] : '')) == 'Fluent') ? ' checked ' : '' }}>
                            <label class="form-check-label" for="r-fluent">Fluent</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="reading" id="r-good"
                                   value="Good"{{ ((old('reading') ?: (($user->app && isset($user->app->data['reading'])) ? $user->app->data['reading'] : '')) == 'Good') ? ' checked ' : '' }}>
                            <label class="form-check-label" for="r-good">Good</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="reading" id="r-fair"
                                   value="Fair"{{ ((old('reading') ?: (($user->app && isset($user->app->data['reading'])) ? $user->app->data['reading'] : '')) == 'Fair') ? ' checked ' : '' }}>
                            <label class="form-check-label" for="r-fair">Fair</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="reading" id="r-poor"
                                   value="Poor"{{ ((old('reading') ?: (($user->app && isset($user->app->data['reading'])) ? $user->app->data['reading'] : '')) == 'Poor') ? ' checked ' : '' }}>
                            <label class="form-check-label" for="r-poor">Poor</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-3 col-form-label py-0">Writing</label>
                    <div class="col-9">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="writing" id="w-fluent"
                                   value="Fluent"{{ ((old('writing') ?: (($user->app && isset($user->app->data['writing'])) ? $user->app->data['writing'] : '')) == 'Fluent') ? ' checked ' : '' }}>
                            <label class="form-check-label" for="w-fluent">Fluent</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="writing" id="w-good"
                                   value="Good"{{ ((old('writing') ?: (($user->app && isset($user->app->data['writing'])) ? $user->app->data['writing'] : '')) == 'Good') ? ' checked ' : '' }}>
                            <label class="form-check-label" for="w-good">Good</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="writing" id="w-fair"
                                   value="Fair"{{ ((old('writing') ?: (($user->app && isset($user->app->data['writing'])) ? $user->app->data['writing'] : '')) == 'Fair') ? ' checked ' : '' }}>
                            <label class="form-check-label" for="w-fair">Fair</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="writing" id="w-poor"
                                   value="Poor"{{ ((old('writing') ?: (($user->app && isset($user->app->data['writing'])) ? $user->app->data['writing'] : '')) == 'Poor') ? ' checked ' : '' }}>
                            <label class="form-check-label" for="w-poor">Poor</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3 mt-3 row">
                    <label for="sop" class="col-3 col-form-label">Statement of Purpose (1-2 pages)</label>
                    <div class="col-9">
                        <input class="form-control" type="file" id="sop"
                               name="sop" value="{{ old('sop') }}" accept="application/pdf">
                        @if ($user->app && isset($user->app->data['sop']))
                            <div class="mt-2 mb-2">See file <a class="color-blue" href="{{ \Illuminate\Support\Facades\Storage::url($user->app->data['sop']) }}" target="_blank">here</a>.</div>
                            <input type="hidden" name="sop_old" value="{{ $user->app->data['sop'] }}">
                        @endif
                    </div>
                    <p style="font-size: 12px; margin-bottom: 0">A single pdf file, 20 Mb max (see e.g. https://online2pdf.com).</p>
                </div>

                <div class="mb-3 mt-3 row">
                    <label for="cv" class="col-3 col-form-label">CV</label>
                    <div class="col-9">
                        <input class="form-control" type="file" id="cv"
                               name="cv" value="{{ old('cv') }}" accept="application/pdf">
                        @if ($user->app && isset($user->app->data['cv']))
                            <div class="mt-2 mb-2">See file <a class="color-blue" href="{{ \Illuminate\Support\Facades\Storage::url($user->app->data['cv']) }}" target="_blank">here</a>.</div>
                            <input type="hidden" name="cv_old" value="{{ $user->app->data['cv'] }}">
                        @endif
                    </div>
                    <p style="font-size: 12px; margin-bottom: 0" class="mt-1">A single pdf file, 20 Mb max (see e.g. https://online2pdf.com).</p>
                </div>

                <div class="mb-3 mt-3 row">
                    <label for="rl1" class="col-3 col-form-label">Recommendation Letter #1</label>
                    <div class="col-9">
                        <input class="form-control" type="file" id="rl1"
                               name="rl1" value="{{ old('rl1') }}" accept="application/pdf">
                        @if ($user->app && isset($user->app->data['rl1']))
                            <div class="mt-2 mb-2">See file <a class="color-blue" href="{{ \Illuminate\Support\Facades\Storage::url($user->app->data['rl1']) }}" target="_blank">here</a>.</div>
                            <input type="hidden" name="rl1_old" value="{{ $user->app->data['rl1'] }}">
                        @endif
                    </div>
                    <p style="font-size: 12px; margin-bottom: 0">A single pdf file, 20 Mb max (see e.g. https://online2pdf.com).</p>
                </div>

                <div class="mb-3 mt-3 row">
                    <label for="rl2" class="col-3 col-form-label">Recommendation Letter #2</label>
                    <div class="col-9">
                        <input class="form-control" type="file" id="rl2"
                               name="rl2" value="{{ old('rl2') }}" accept="application/pdf">
                        @if ($user->app && isset($user->app->data['rl2']))
                            <div class="mt-2 mb-2">See file <a class="color-blue" href="{{ \Illuminate\Support\Facades\Storage::url($user->app->data['rl2']) }}" target="_blank">here</a>.</div>
                            <input type="hidden" name="rl2_old" value="{{ $user->app->data['rl2'] }}">
                        @endif
                    </div>
                    <p style="font-size: 12px; margin-bottom: 0">A single pdf file, 20 Mb max (see e.g. https://online2pdf.com).</p>
                </div>

                <hr>
                <p><strong>Visa Requirements</strong></p>
                <p>Please note that according to the Russian Federal Migration Service and the Ministry of Foreign Affairs requirements in order to get student visa for the 2022 Admission year your passport expiration date should be no earlier than 1 June 2024. If your passport expires before that you need to extend its validity before the July 2022 for NUST MISIS to prepare official Invitation Letter.</p>

                <div class="mb-3 row">
                    <label for="citizenship" class="col-3 col-form-label">Citizenship <span>*</span></label>
                    <div class="col-9">
                        <select class="form-select" id="citizenship" name="citizenship" required>
                            @include('_elements.countries', ['selected' => old('citizenship') ?: ($user->app ? $user->app->data['citizenship'] : '')])
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="citizenship2" class="col-3 col-form-label">Second citizenship</label>
                    <div class="col-9">
                        <select class="form-select" id="citizenship2" name="citizenship2">
                            @include('_elements.countries', ['selected' => old('citizenship2') ?: ($user->app ? $user->app->data['citizenship2'] : '')])
                        </select>
                    </div>
                </div>

                <hr>
                <p>Place of permanent residence</p>

                <div class="mb-3 row">
                    <label for="per_city" class="col-3 col-form-label">City <span>*</span></label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="per_city" name="per_city" required
                               value="{{ old('per_city') ?: ($user->app ? $user->app->data['per_city'] : '') }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="per_state" class="col-3 col-form-label">State / Province <span>*</span></label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="per_state" name="per_state" required
                               value="{{ old('per_state') ?: ($user->app ? $user->app->data['per_state'] : '') }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="per_country" class="col-3 col-form-label">Country <span>*</span></label>
                    <div class="col-9">
                        <select class="form-select" id="per_country" name="per_country" required>
                            @include('_elements.countries', ['selected' => old('per_country') ?: ($user->app ? $user->app->data['per_country'] : '')])
                        </select>
                    </div>
                </div>

                <hr>
                <p>Passport</p>

                <div class="mb-3 row">
                    <label for="pass_country" class="col-3 col-form-label">Country of issue <span>*</span></label>
                    <div class="col-9">
                        <select class="form-select" id="pass_country" name="pass_country" required>
                            @include('_elements.countries', ['selected' => old('pass_country') ?: ($user->app ? $user->app->data['pass_country'] : '')])
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="pass_number" class="col-3 col-form-label">Passport number <span>*</span></label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="pass_number" name="pass_number" required
                               value="{{ old('pass_number') ?: ($user->app ? $user->app->data['pass_number'] : '') }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="pass_from" class="col-3 col-form-label">Date of issue <span>*</span></label>
                    <div class="col-9">
                        <input type="date" class="form-control" id="pass_from" name="pass_from" required
                               value="{{ old('pass_from') ?: ($user->app ? $user->app->data['pass_from'] : '') }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="pass_to" class="col-3 col-form-label">Valid until <span>*</span></label>
                    <div class="col-9">
                        <input type="date" class="form-control" id="pass_to" name="pass_to" required
                               value="{{ old('pass_to') ?: ($user->app ? $user->app->data['pass_to'] : '') }}">
                    </div>
                </div>

                <div class="mb-3 mt-3 row">
                    <label for="pass_scan" class="col-3 col-form-label">Scanned copy of passport biographical page <span>*</span></label>
                    <div class="col-9">
                        <input class="form-control" type="file" id="pass_scan"
                               name="pass_scan" value="{{ old('pass_scan') }}" accept="application/pdf">
                        @if ($user->app)
                            <div class="mt-2 mb-2">See file <a class="color-blue" href="{{ \Illuminate\Support\Facades\Storage::url($user->app->data['pass_scan']) }}" target="_blank">here</a>.</div>
                            <input type="hidden" name="pass_scan_old" value="{{ $user->app->data['pass_scan'] }}">
                        @endif
                    </div>
                    <p style="font-size: 12px; margin-bottom: 0">A single pdf file, 20 Mb max (see e.g. https://online2pdf.com).</p>
                </div>

                <hr>
                <p><strong>Embassy</strong></p>
                <p>Russian Embassy or Consulate where you plan to obtain your visa: (please indicate a country and city that have a Russian Embassy or Consulate)</p>

                <div class="mb-3 row">
                    <label for="embassy_city" class="col-3 col-form-label">City <span>*</span></label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="embassy_city" name="embassy_city" required
                               value="{{ old('embassy_city') ?: ($user->app ? $user->app->data['embassy_city'] : '') }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="embassy_state" class="col-3 col-form-label">State / Province <span>*</span></label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="embassy_state" name="embassy_state" required
                               value="{{ old('embassy_state') ?: ($user->app ? $user->app->data['embassy_state'] : '') }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="embassy_country" class="col-3 col-form-label">Country <span>*</span></label>
                    <div class="col-9">
                        <select class="form-select" id="embassy_country" name="embassy_country" required>
                            @include('_elements.countries', ['selected' => old('embassy_country') ?: ($user->app ? $user->app->data['embassy_country'] : '')])
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="add_info" class="col-3 col-form-label">Additional information</label>
                    <div class="col-9">
                        <textarea class="form-control" rows="3" id="add_info" name="add_info"
                        >{{ old('add_info') ?: ($user->app ? $user->app->data['add_info'] : '') }}</textarea>
                    </div>
                </div>

                <p>By pressing submit button bellow I confirm the following.</p>
                <p>I declare that all the answers to this application are complete and accurate to the best of my knowledge including the information on my academic background. I have been informed on the regulations of admission to the University and on the tuition fee. I am prepared to timely cover the expenses of studying and living in the Russian Federation. I am aware that failure to report complete and accurate information may invalidate my application and may result in the invalidity of a degree obtained if admitted.</p>

                <div class="row mt-3">
                    <div class="col-5"></div>
                    <button class="btn btn-all-blue col-2">Submit</button>
                </div>

            </form>
        @else
            <div class="mx-20p">
                @switch($user->app->verified)
                    @case (0)
                        <hr>
                        <p style="font-size: 25px;"><strong>Application status:</strong> pending.</p>
                        <p>Please wait for the application to be checked by an Admissions Officer. If you have changed your mind about applying to MISiS, you can <a href="/app/delete" class="color-blue">delete your application</a>.</p>
                        <hr>
                        @break
                    @case (1)
                        <hr>
                        <p style="font-size: 25px;"><strong>Application status:</strong> accepted.</p>
                        <p>Your application has been accepted. Please proceed to <a href="/interview" class="color-blue">book an interview</a>. If you have changed your mind about applying to MISiS, you can <a href="/app/delete" class="color-blue">delete your application</a>.</p>
                        <hr>
                        @break
                @endswitch
                @include('_elements.app', ['app' => $user->app])
            </div>
        @endif
        <div style="margin-bottom: 100px;"></div>
    </div>
</main>
@include('_elements.chat')
</body>
</html>
