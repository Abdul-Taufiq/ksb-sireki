<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <h2>Example</h2>
    <pre>{{ $text }}</pre>
    <br>
    <h4>Soal</h4>
    @foreach ($data as $item)
        <form action="" id="{{ $item->id }}">
            <div style="margin-bottom: 20px;">
                <p><strong>{{ $loop->iteration }}. {{ $item->soal }}</strong></p>

                {{-- tanpa Shuffle --}}
                {{-- @php
                $options = json_decode($item->pilihan_ganda, true);
                $labels = range('A', 'Z'); // maksimal 26 pilihan
                @endphp --}}

                {{-- dengan Shuffle --}}
                @php
                    $options = json_decode($item->pilihan_ganda, true);
                    shuffle($options); // 🔀 acak urutan pilihan
                    $labels = range('A', 'Z');
                @endphp


                @foreach ($options as $index => $pilihan)
                    <input type="radio" style="margin: 5px;" name="jawaban_{{ $item->id }}"
                        value="{{ $pilihan }}">{{ $labels[$index] }}. {{ $pilihan }}
                @endforeach

                {{-- @if ($item->jawaban)
                    <p><em>Jawaban benar: {{ $item->jawaban }}</em></p>
                @endif --}}
            </div>
            <button>Submit</button>
            <hr>

        </form>
    @endforeach



    <br><br><br>
    <form action="{{ route('example-store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Name:</label>
        <input type="file" name="word_file" accept=".doc,.docx" required>
        <br><br>
        <button type="submit">Submit</button>

    </form>






</body>

</html>
