<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h3>{{ $soal->soal }}</h3>

    @php
        $options = json_decode($soal->pilihan_ganda, true);
        shuffle($options);
        $labels = range('A', 'Z');
    @endphp

    <form method="POST" action="{{ route('quiz.submit') }}">
        @csrf

        @foreach ($options as $i => $option)
            <div>
                <label>
                    <input type="radio" name="jawaban" value="{{ $option }}"
                        {{ $jawaban === $option ? 'checked' : '' }}>
                    {{ $labels[$i] }}. {{ $option }}
                </label>
            </div>
        @endforeach

        <div style="margin-top: 20px;">
            @if ($index > 0)
                <button type="submit" name="prev">Kembali</button>
            @endif

            <button type="submit" name="next">Next</button>
        </div>
    </form>
</body>

</html>
