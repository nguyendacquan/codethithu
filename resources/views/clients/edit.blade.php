@extends('layouts.client')


@section('content')
    <form action="{{ route('music.update', $music->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="name">Ten</label>
        <input type="text" name="name" value="{{ $music->name }}"> <br>
        <label for="Image">Image</label>
        <input type="file" name="profile_picture" value="{{ $music->profile_picture }}"> <br>
        <img width="150px" src="{{ url('storage/', $music->profile_picture) }}" alt="">
        <label for="">Date</label>
        <input type="text" name="birth_date" value="{{ $music->birth_date }}"><br>
        <label for="">dung cu</label>
        <input type="text" name="instrument" value="{{ $music->instrument }}"><br>
        <label for="">link</label>
        <input type="text" name="biography" value="{{ $music->biography }}"><br>
        <button class="btn btn-secondary" type="submit">
            Them
        </button>

    </form>
@endsection
