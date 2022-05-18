<option value>Choose...</option>
@foreach(\App\Services\Countries::LIST as $country)
    <option {{ ($selected ?? '') == $country ? ' selected ' : '' }}
            value="{{ $country }}">{{ $country }}</option>
@endforeach
