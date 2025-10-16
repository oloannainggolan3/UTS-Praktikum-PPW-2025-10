<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Polling Online</title>
    <style>
        body { font-family: Arial; background: #f5f5f5; margin: 40px; }
        .container { max-width: 500px; margin: auto; background: white; padding: 25px; border-radius: 10px; box-shadow: 0 3px 6px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #333; }
        form { margin-top: 20px; }
        label { display: block; margin-bottom: 10px; }
        button { background: #3498db; border: none; color: white; padding: 10px; width: 100%; border-radius: 5px; cursor: pointer; }
        button:hover { background: #2980b9; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background: #eee; }
        .reset { background: #e74c3c; margin-top: 10px; }
        .alert { padding: 10px; background: #dff0d8; color: #3c763d; border-radius: 5px; margin-bottom: 15px; }
    </style>
</head>
<body>
<div class="container">
    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <h2>{{ $poll->question }}</h2>
    <form method="POST" action="{{ route('vote') }}">
        @csrf
        @foreach($poll->options as $option)
            <label>
                <input type="radio" name="option_id" value="{{ $option->id }}"> {{ $option->option_text }}
            </label>
        @endforeach
        <button type="submit">Kirim Suara</button>
    </form>

    <h3 style="text-align:center;margin-top:30px;">Hasil Polling</h3>
    <table>
        <tr>
            <th>Opsi</th>
            <th>Jumlah Suara</th>
        </tr>
        @foreach($poll->options as $option)
            <tr>
                <td>{{ $option->option_text }}</td>
                <td>{{ $option->votes }}</td>
            </tr>
        @endforeach
    </table>

    <form method="POST" action="{{ route('reset') }}">
        @csrf
        <button type="submit" class="reset">Reset Voting</button>
    </form>
</div>
</body>
</html>
