@extends('layouts.client')



@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('music.create') }}"><button class="btn btn-success">Them</button></a>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Ten</th>
                <th>Anh</th>
                <th>Ngay Thang</th>
                <th>Dung cụ</th>
                <th>Link</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listMusic as $item)
                <tr>

                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td><img width="150px" src="{{ url('storage/', $item->profile_picture) }}" alt="Image Product"></td>
                    <td>{{ $item->birth_date }}</td>
                    <td>{{ $item->instrument }}</td>
                    <td>{{ $item->biography }}</td>
                    <td>
                        <a href="{{ route('music.edit', $item->id) }}" class="btn btn-warning">Edit</a>

                        <form action="{{ route('music.destroy', $item->id) }}" method="post"
                            onsubmit="return confirm('Delete ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>

                    </td>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
