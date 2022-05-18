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
        @if($user->app)
            @switch ($user->app->verified)
                @case(2)
                    <p style="font-size: 25px;"><strong>Application status:</strong> rejected.</p>
                    <p>Reason for rejection: {!! $user->app->comment !!}</p>
                    <p>Your application has been rejected. Please proceed to change your responses according to the Admission Officer's comment above. If you have changed your mind about applying to MISiS, you can <a href="/app/delete" class="color-blue">delete your application</a>.</p>
                    @break
            @endswitch
        @endif
        <hr>
        <p>Note that you after sending the application, it will get a check status (pending, accepted, rejected). You will be able to come back later and fix some of your responses if the application is rejected. If you have any questions please contact us via chat.</p>
        <form class="row mx-20p" method="POST" enctype="multipart/form-data">
            @csrf

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
                    <input class="form-control" type="text" id="fn" name="first_name" required
                           value="{{ old('first_name') ?: ($user->app ? $user->app->data['first_name'] : $user->first_name) }}">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="mn" class="col-3 col-form-label">Middle name</label>
                <div class="col-9">
                    <input class="form-control" type="text" name="middle_name" id="ln"
                           value="{{ old('middle_name') ?: ($user->app ? $user->app->data['middle_name'] : $user->middle_name) }}">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="ln" class="col-3 col-form-label">Last name <span>*</span></label>
                <div class="col-9">
                    <input class="form-control" type="text" name="last_name" id="mn" required
                           value="{{ old('last_name') ?: ($user->app ? $user->app->data['last_name'] : $user->last_name) }}">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="birth-date" class="col-3 col-form-label">Date of birth <span>*</span></label>
                <div class="col-9">
                    <input type="date" id="birth-date" class="form-control">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="birth-place" class="col-3 col-form-label">Place of birth <span>*</span></label>
                <div class="col-9">
                    <select class="form-select" id="birth-place">
                        <option selected disabled value="">Choose...</option>
                        <option>...</option>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="nationality" class="col-3 col-form-label">Nationality <span>*</span></label>
                <div class="col-9">
                    <input class="form-control" type="text" name="nationality" id="nationality" required
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
                            <option {{ (old('program_01') == $program->id || ($user->app && $user->app->data['program_01'] == $program->id)) ? ' selected ' : '' }}
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
                            <option {{ (old('program_02') == $program->id || ($user->app && $user->app->data['program_02'] == $program->id)) ? ' selected ' : '' }}
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
                                {{ (old('program_03') == $program->id || ($user->app && $user->app->data['program_03'] == $program->id)) ? ' selected ' : '' }}
                                value="{{ $program->id }}">{{ $program->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="native-lang" class="col-3 col-form-label">Native language <span>*</span></label>
                <div class="col-9">
                    <input type="text" id="native-lang" class="form-control">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="gender" class="col-3 col-form-label">Gender <span>*</span></label>
                <div class="col-9">
                    <select class="form-select" id="gender">
                        <option selected disabled value="">Choose...</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
            </div>

            <p class="mt-3">Home phone number</p>
            <div class="mb-3 row">
                <label for="home-phone-code" class="col-3 col-form-label">Country code</label>
                <div class="col-2">
                    <input type="text" id="home-phone-code" class="form-control">
                </div>
                <label for="home-phone" class="col-3 col-form-label">Phone number</label>
                <div class="col-4">
                    <input type="text" id="home-phone" class="form-control">
                </div>
            </div>

            <p class="mt-3">Mobile phone number (for WhatsApp, Telegram or Viber) <span>*</span></p>
            <div class="mb-3 row">
                <label for="mobile-phone-code" class="col-3 col-form-label">Country code</label>
                <div class="col-2">
                    <input type="text" id="mobile-phone-code" class="form-control">
                </div>
                <label for="mobile-phone" class="col-3 col-form-label">Phone number</label>
                <div class="col-4">
                    <input type="text" id="mobile-phone" class="form-control">
                </div>
            </div>

            <div class="mb-3 mt-3 row">
                <label for="photo" class="col-3 col-form-label">A color passport-style photo</label>
                <div class="col-9">
                    <input class="form-control" type="file" id="photo"
                           name="photo" value="{{ old('photo') }}" accept="image/jpeg">
                    @if($user->app && isset($user->app->data['photo']))
                        <div class="mt-2 mb-2">
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($user->app->data['photo']) }}" alt="" width="200">
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
                    <input type="text" id="year" class="form-control" value="2022, Fall semester">
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-5 col-form-label">Do you need University housing? <span>*</span></label>
                <div class="col-7">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="housing" id="housing-yes" value="yes">
                        <label class="form-check-label" for="housing-yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="housing" id="housing-no" value="no">
                        <label class="form-check-label" for="housing-no">No</label>
                    </div>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="why-enroll" class="col-3 col-form-label">Briefly tell us why you would like to enroll at NUST MISIS <span>*</span></label>
                <div class="col-9">
                    <textarea class="form-control" id="why-enroll" rows="3"></textarea>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-3 col-form-label">Where and how did you learn about NUST MISIS International Master’s Programs? We highly appreciate your effort to share this information with us <span>*</span></label>
                <div class="col-9 mt-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="masterstudies">
                        <label class="form-check-label" for="masterstudies">
                            masterstudies.com
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="masterportals">
                        <label class="form-check-label" for="masterportals">
                            masterportals.com
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="topuniversities">
                        <label class="form-check-label" for="topuniversities">
                            topuniversities.com
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="postgrad">
                        <label class="form-check-label" for="postgrad">
                            postgrad.com
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="misis">
                        <label class="form-check-label" for="misis">
                            NUST MISIS website
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="student">
                        <label class="form-check-label" for="student">
                            Current student
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="studyinrussia">
                        <label class="form-check-label" for="studyinrussia">
                            StudyInRussia.ru
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input mt-2" type="checkbox" value="" id="other">
                        <label class="form-check-label" for="other" style="width: 100%;">
                            <input type="text" class="form-control" placeholder="Other">
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
                    <input type="text" id="institution" class="form-control">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="city-country" class="col-3 col-form-label">City / Country <span>*</span></label>
                <div class="col-9">
                    <input type="text" id="city-country" class="form-control">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="year-from-to" class="col-3 col-form-label">Year (from-to) <span>*</span></label>
                <div class="col-9">
                    <input type="text" id="year-from-to" class="form-control">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="field-of-study" class="col-3 col-form-label">Field of study <span>*</span></label>
                <div class="col-9">
                    <input type="text" id="field-of-study" class="form-control">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="degree-title" class="col-3 col-form-label">Degree title <span>*</span></label>
                <div class="col-9">
                    <input type="text" id="degree-title" class="form-control">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="gpa" class="col-3 col-form-label">GPA (Received / Max) <span>*</span></label>
                <div class="col-9">
                    <input type="text" id="gpa" class="form-control">
                </div>
            </div>

            <div class="mb-3 mt-3 row">
                <label for="diploma" class="col-3 col-form-label">Bachelor or previous educational diploma scan <span>*</span></label>
                <div class="col-9">
                    <input class="form-control" type="file" id="diploma" name="diploma" value="{{ old('diploma') }}" accept="application/pdf">
                    @if ($user->app)
                        <div class="mt-2 mb-2">See file <a href="{{ \Illuminate\Support\Facades\Storage::url($user->app->data['diploma']) }}" target="_blank">here</a>.</div>
                        <input type="hidden" name="diploma_old" value="{{ $user->app->data['diploma'] }}">
                    @endif
                </div>
                <p style="font-size: 12px; margin-bottom: 0">A single pdf file, 20 Mb max (see e.g. https://online2pdf.com).</p>
            </div>

            <div class="mb-3 mt-3 row">
                <label for="transcripts" class="col-3 col-form-label">Bachelor or previous educational transcripts scan <span>*</span></label>
                <div class="col-9">
                    <input class="form-control" type="file" id="transcripts">
                </div>
                <p style="font-size: 12px; margin-bottom: 0">A single pdf file, 20 Mb max (see e.g. https://online2pdf.com).</p>
            </div>

            <div class="mb-3 row">
                <label for="achievements" class="col-3 col-form-label">Please indicate your distinctions, honors, awards, and achievements</label>
                <div class="col-9">
                    <textarea class="form-control" id="achievements" rows="3"></textarea>
                </div>
            </div>

            <div class="mb-3 mt-3 row">
                <label for="achievements-doc" class="col-3 col-form-label">Scans of documents related to other achievements</label>
                <div class="col-9">
                    <input class="form-control" type="file" id="achievements-doc">
                </div>
                <p style="font-size: 12px; margin-bottom: 0">A single pdf file, 20 Mb max (see e.g. https://online2pdf.com).</p>
            </div>

            <p>Please rate your English language proficiency</p>

            <div class="mb-3 row">
                <label class="col-3 col-form-label py-0">Speaking</label>
                <div class="col-9">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="speaking" id="s-fluent" value="yes">
                        <label class="form-check-label" for="s-fluent">Fluent</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="speaking" id="s-good" value="no">
                        <label class="form-check-label" for="s-good">Good</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="speaking" id="s-fair" value="no">
                        <label class="form-check-label" for="s-fair">Fair</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="speaking" id="s-poor" value="no">
                        <label class="form-check-label" for="s-poor">Poor</label>
                    </div>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-3 col-form-label py-0">Reading</label>
                <div class="col-9">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="reading" id="r-fluent" value="yes">
                        <label class="form-check-label" for="r-fluent">Fluent</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="reading" id="r-good" value="no">
                        <label class="form-check-label" for="r-good">Good</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="reading" id="r-fair" value="no">
                        <label class="form-check-label" for="r-fair">Fair</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="reading" id="r-poor" value="no">
                        <label class="form-check-label" for="r-poor">Poor</label>
                    </div>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-3 col-form-label py-0">Writing</label>
                <div class="col-9">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="writing" id="w-fluent" value="yes">
                        <label class="form-check-label" for="w-fluent">Fluent</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="writing" id="w-good" value="no">
                        <label class="form-check-label" for="w-good">Good</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="writing" id="w-fair" value="no">
                        <label class="form-check-label" for="w-fair">Fair</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="writing" id="w-poor" value="no">
                        <label class="form-check-label" for="w-poor">Poor</label>
                    </div>
                </div>
            </div>

            <div class="mb-3 mt-3 row">
                <label for="sop" class="col-3 col-form-label">Statement of Purpose (1-2 pages)</label>
                <div class="col-9">
                    <input class="form-control" type="file" id="sop">
                </div>
                <p style="font-size: 12px; margin-bottom: 0">A single pdf file, 20 Mb max (see e.g. https://online2pdf.com).</p>
            </div>

            <div class="mb-3 mt-3 row">
                <label for="cv" class="col-3 col-form-label">CV</label>
                <div class="col-9">
                    <input class="form-control" type="file" id="cv">
                </div>
                <p style="font-size: 12px; margin-bottom: 0" class="mt-1">A single pdf file, 20 Mb max (see e.g. https://online2pdf.com).</p>
            </div>

            <div class="mb-3 mt-3 row">
                <label for="rl1" class="col-3 col-form-label">Recommendation Letter #1</label>
                <div class="col-9">
                    <input class="form-control" type="file" id="rl1">
                </div>
                <p style="font-size: 12px; margin-bottom: 0">A single pdf file, 20 Mb max (see e.g. https://online2pdf.com).</p>
            </div>

            <div class="mb-3 mt-3 row">
                <label for="rl2" class="col-3 col-form-label">Recommendation Letter #2</label>
                <div class="col-9">
                    <input class="form-control" type="file" id="rl2">
                </div>
                <p style="font-size: 12px; margin-bottom: 0">A single pdf file, 20 Mb max (see e.g. https://online2pdf.com).</p>
            </div>

            <hr>
            <p><strong>Visa Requirements</strong></p>
            <p>Please note that according to the Russian Federal Migration Service and the Ministry of Foreign Affairs requirements in order to get student visa for the 2022 Admission year your passport expiration date should be no earlier than 1 June 2024. If your passport expires before that you need to extend its validity before the July 2022 for NUST MISIS to prepare official Invitation Letter.</p>

            <div class="mb-3 row">
                <label for="citizenship" class="col-3 col-form-label">Citizenship <span>*</span></label>
                <div class="col-9">
                    <select class="form-select" id="citizenship">
                        <option selected disabled value="">Choose...</option>
                        <option>...</option>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="citizenship2" class="col-3 col-form-label">Second citizenship</label>
                <div class="col-9">
                    <select class="form-select" id="citizenship2">
                        <option selected disabled value="">Choose...</option>
                        <option>...</option>
                    </select>
                </div>
            </div>

            <hr>
            <p>Place of permanent residence</p>

            <div class="mb-3 row">
                <label for="per-city" class="col-3 col-form-label">City <span>*</span></label>
                <div class="col-9">
                    <input type="text" id="per-city" class="form-control">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="per-state" class="col-3 col-form-label">State / Province <span>*</span></label>
                <div class="col-9">
                    <input type="text" id="per-state" class="form-control">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="per-country" class="col-3 col-form-label">Country <span>*</span></label>
                <div class="col-9">
                    <select class="form-select" id="per-country">
                        <option selected disabled value="">Choose...</option>
                        <option>...</option>
                    </select>
                </div>
            </div>

            <hr>
            <p>Passport</p>

            <div class="mb-3 row">
                <label for="pass-country" class="col-3 col-form-label">Country of issue <span>*</span></label>
                <div class="col-9">
                    <select class="form-select" id="pass-country">
                        <option selected disabled value="">Choose...</option>
                        <option>...</option>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="pass-number" class="col-3 col-form-label">Passport number <span>*</span></label>
                <div class="col-9">
                    <input type="text" id="pass-number" class="form-control">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="pass-from" class="col-3 col-form-label">Date of issue <span>*</span></label>
                <div class="col-9">
                    <input type="date" id="pass-from" class="form-control">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="pass-to" class="col-3 col-form-label">Valid until <span>*</span></label>
                <div class="col-9">
                    <input type="date" id="pass-to" class="form-control">
                </div>
            </div>

            <div class="mb-3 mt-3 row">
                <label for="pass-scan" class="col-3 col-form-label">Scanned copy of passport biographical page <span>*</span></label>
                <div class="col-9">
                    <input class="form-control" type="file" id="pass-scan">
                </div>
                <p style="font-size: 12px; margin-bottom: 0">A single pdf file, 20 Mb max (see e.g. https://online2pdf.com).</p>
            </div>

            <hr>
            <p><strong>Embassy</strong></p>
            <p>Russian Embassy or Consulate where you plan to obtain your visa: (please indicate a country and city that have a Russian Embassy or Consulate)</p>

            <div class="mb-3 row">
                <label for="embassy-city" class="col-3 col-form-label">City <span>*</span></label>
                <div class="col-9">
                    <input type="text" id="embassy-city" class="form-control">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="embassy-state" class="col-3 col-form-label">State / Province <span>*</span></label>
                <div class="col-9">
                    <input type="text" id="embassy-state" class="form-control">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="embassy-country" class="col-3 col-form-label">Country <span>*</span></label>
                <div class="col-9">
                    <select class="form-select" id="embassy-country">
                        <option selected disabled value="">Choose...</option>
                        <option>...</option>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="add-info" class="col-3 col-form-label">Additional information</label>
                <div class="col-9">
                    <textarea class="form-control" id="add-info" rows="3"></textarea>
                </div>
            </div>

            <p>By pressing submit button bellow I confirm the following.</p>
            <p>I declare that all the answers to this application are complete and accurate to the best of my knowledge including the information on my academic background. I have been informed on the regulations of admission to the University and on the tuition fee. I am prepared to timely cover the expenses of studying and living in the Russian Federation. I am aware that failure to report complete and accurate information may invalidate my application and may result in the invalidity of a degree obtained if admitted.</p>

            <div class="row mt-3">
                <div class="col-5"></div>
                <button class="btn btn-all-blue col-2" type="submit">Submit</button>
            </div>

        </form>
        <div style="margin-bottom: 100px;"></div>
    </div>
</main>
</body>
</html>
