@php
    use App\Models\Program;
@endphp

<p><strong>Personal Information</strong></p>

<div class="mb-3 row">
    <label class="col-3">First name</label>
    <div class="col-9">{{ $app->data['first_name'] }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Middle name</label>
    <div class="col-9">{{ $app->data['middle_name'] ?? '–' }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Last name</label>
    <div class="col-9">{{ $app->data['last_name'] }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Date of birth</label>
    <div class="col-9">{{ $app->data['birth_date'] }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Place of birth</label>
    <div class="col-9">{{ $app->data['birth_place'] }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Nationality</label>
    <div class="col-9">{{ $app->data['nationality'] }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Desired Program of Study (first priority)</label>
    <div class="col-9">{{ Program::where('id', $app->data['program_01'])->first()->name }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Desired Program of Study (second priority)</label>
    <div class="col-9">{{ Program::where('id', $app->data['program_02'])->first()->name }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Desired Program of Study (third priority)</label>
    <div class="col-9">{{ Program::where('id', $app->data['program_03'])->first()->name }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Native language</label>
    <div class="col-9">{{ $app->data['native_lang'] }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Gender</label>
    <div class="col-9">{{ $app->data['gender'] }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Home phone number</label>
    <div class="col-9">{{ isset($app->data['home_phone_code']) && isset($app->data['home_phone']) ? ($app->data['home_phone_code'] . '-' . $app->data['home_phone']) : '–' }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Mobile phone number (for WhatsApp, Telegram or Viber)</label>
    <div class="col-9">{{ $app->data['mobile_phone_code'] . '-' . $app->data['mobile_phone'] }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">A color passport-style photo</label>
    <div class="col-9">
        @if ($app->data['photo'])
            <img src="{{ \Illuminate\Support\Facades\Storage::url($app->data['photo']) }}" alt="photo"
                 width="200"><br>
            <a class="color-blue" target="_blank"
               href="{{ \Illuminate\Support\Facades\Storage::url($app->data['photo']) }}">See file here</a>
        @else
            <span>–</span>
        @endif
    </div>
</div>

<p>Planned enrollment time: degree programs start only in the fall, but non-degree exchange students may enter in either
    the fall or spring semester.</p>

<div class="mb-3 row">
    <label class="col-3">Year</label>
    <div class="col-9">{{ $app->data['year'] }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Do you need University housing?</label>
    <div class="col-9">{{ $app->data['housing'] }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Why you would like to enroll at NUST MISIS?</label>
    <div class="col-9">{{ $app->data['why_enroll'] }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Where and how did you learn about NUST MISIS International Master’s Programs?</label>
    <div class="col-9">
        @isset($app->data['source'])
            @foreach($app->data['source'] as $item)
                - {{ $item }}<br>
            @endforeach
        @endisset
        @isset($app->data['source_other'])
            - Other: {{ $app->data['source_other'] }}
        @endisset
    </div>
</div>

<hr>
<p><strong>Education</strong></p>

<p>Previous Educational Institution</p>

<div class="mb-3 row">
    <label class="col-3">Institution</label>
    <div class="col-9">{{ $app->data['institution'] }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">City / Country</label>
    <div class="col-9">{{ $app->data['city_country'] }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Year (from-to)</label>
    <div class="col-9">{{ $app->data['year_from_to'] }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Field of study</label>
    <div class="col-9">{{ $app->data['field_of_study'] }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Degree title</label>
    <div class="col-9">{{ $app->data['degree_title'] }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">GPA (Received / Max)</label>
    <div class="col-9">{{ $app->data['gpa'] }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Bachelor or previous educational diploma scan</label>
    <div class="col-9">
        <a class="color-blue" href="{{ \Illuminate\Support\Facades\Storage::url($app->data['diploma']) }}"
           target="_blank">See file here</a>
    </div>
</div>

<div class="mb-3 row">
    <label class="col-3">Bachelor or previous educational transcripts scan</label>
    <div class="col-9">
        <a class="color-blue" href="{{ \Illuminate\Support\Facades\Storage::url($app->data['transcripts']) }}"
           target="_blank">See file here</a>
    </div>
</div>

<div class="mb-3 row">
    <label class="col-3">Distinctions, honors, awards, and achievements</label>
    <div class="col-9">{{ $app->data['achievements'] ?? '–' }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Scans of documents related to other achievements</label>
    @if (isset($app->data['achievements_doc']))
        <div class="col-9">
            <a class="color-blue" href="{{ \Illuminate\Support\Facades\Storage::url($app->data['achievements_doc']) }}"
               target="_blank">See file here</a>
        </div>
    @else
        <div class="col-9">–</div>
    @endif
</div>

<p>English language proficiency</p>

<div class="mb-3 row">
    <label class="col-3">Speaking</label>
    <div class="col-9">{{ $app->data['speaking'] ?? '–' }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Reading</label>
    <div class="col-9">{{ $app->data['reading'] ?? '–' }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Writing</label>
    <div class="col-9">{{ $app->data['writing'] ?? '–' }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Statement of Purpose (1-2 pages)</label>
    @if (isset($app->data['sop']))
        <div class="col-9">
            <a class="color-blue" href="{{ \Illuminate\Support\Facades\Storage::url($app->data['sop']) }}"
               target="_blank">See file here</a>
        </div>
    @else
        <div class="col-9">–</div>
    @endif
</div>

<div class="mb-3 row">
    <label class="col-3">CV</label>
    @if (isset($app->data['cv']))
        <div class="col-9">
            <a class="color-blue" href="{{ \Illuminate\Support\Facades\Storage::url($app->data['cv']) }}"
               target="_blank">See file here</a>
        </div>
    @else
        <div class="col-9">–</div>
    @endif
</div>

<div class="mb-3 row">
    <label class="col-3">Recommendation Letter #1</label>
    @if (isset($app->data['rl1']))
        <div class="col-9">
            <a class="color-blue" href="{{ \Illuminate\Support\Facades\Storage::url($app->data['rl1']) }}"
               target="_blank">See file here</a>
        </div>
    @else
        <div class="col-9">–</div>
    @endif
</div>

<div class="mb-3 row">
    <label class="col-3">Recommendation Letter #2</label>
    @if (isset($app->data['rl2']))
        <div class="col-9">
            <a class="color-blue" href="{{ \Illuminate\Support\Facades\Storage::url($app->data['rl2']) }}"
               target="_blank">See file here</a>
        </div>
    @else
        <div class="col-9">–</div>
    @endif
</div>

<hr>

<p><strong>Visa Requirements</strong></p>

<div class="mb-3 row">
    <label class="col-3">Citizenship</label>
    <div class="col-9">{{ $app->data['citizenship'] }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Second citizenship</label>
    <div class="col-9">{{ $app->data['citizenship2'] ?? '–' }}</div>
</div>

<p>Place of permanent residence:</p>

<div class="mb-3 row">
    <label class="col-3">City</label>
    <div class="col-9">{{ $app->data['per_city'] }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">State / Province</label>
    <div class="col-9">{{ $app->data['per_state'] }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Country</label>
    <div class="col-9">{{ $app->data['per_country'] }}</div>
</div>

<p>Passport:</p>

<div class="mb-3 row">
    <label class="col-3">Country of issue</label>
    <div class="col-9">{{ $app->data['pass_country'] }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Passport number</label>
    <div class="col-9">{{ $app->data['pass_number'] }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Date of issue</label>
    <div class="col-9">{{ $app->data['pass_from'] }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Valid until</label>
    <div class="col-9">{{ $app->data['pass_to'] }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Scanned copy of passport biographical page</label>
    <div class="col-9">
        <a class="color-blue" href="{{ \Illuminate\Support\Facades\Storage::url($app->data['pass_scan']) }}"
           target="_blank">See file here</a>
    </div>
</div>

<hr>
<p><strong>Embassy</strong></p>
<p>Russian Embassy or Consulate where you plan to obtain your visa</p>

<div class="mb-3 row">
    <label class="col-3">City</label>
    <div class="col-9">{{ $app->data['embassy_city'] }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">State / Province</label>
    <div class="col-9">{{ $app->data['embassy_state'] }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Country</label>
    <div class="col-9">{{ $app->data['embassy_country'] }}</div>
</div>

<div class="mb-3 row">
    <label class="col-3">Additional information</label>
    <div class="col-9">{{ $app->data['add_info'] ?? '–' }}</div>
</div>

