@extends('layouts.client')


@section('content')
    <form action="{{ route('music.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Ten</label>
        <input type="text" name="name"> <br>
        <label for="Image">Image</label>
        <input type="file" name="profile_picture"> <br>
        <label for="">Date</label>
        <input type="date" name="birth_date"><br>
        <label for="">dung cu</label>
        <input type="text" name="instrument"><br>
        <label for="">link</label>
        <input type="text" name="biography"><br>
        <button class="btn btn-success" type="submit">
            Them
        </button>

    </form>
@endsection
