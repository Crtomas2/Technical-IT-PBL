@props(['disabled' => false, 'options' => []])


<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm']) !!}>
    @foreach($options as $key => $option)
        <option value="{{ $option }}">{{ $key }}</option>
    @endforeach
</select>

