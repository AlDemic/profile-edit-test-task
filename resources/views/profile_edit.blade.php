@extends('layout')

@section('title', 'User profile - edit')

@section('center')
    <div id="msg"></div>

    <h3 style="color:green">Вносите изменения только для нужных полей</h3>

    <form id="editProfileForm" enctype="multipart/form-data">
        @csrf

        <input type="hidden" id="userId" value="{{ $user->id }}" />
        <label>
            Имя: {{ $user->name }}
            <input type="text" name="name" minlength="3" maxlength="12" placeholder="Новое имя юзера" />
        </label>

        <br/>
        <label>
            Почта: {{ $user->email }}
            <input type="email" name="email" maxlength="128" placeholder="Новая почта юзера" />
        </label>

        <br/>
        <label>
            Телефон: {{ $user->m_phone }}
            <input type="text" name="mPhone" minlength="6" maxlength="24" placeholder="Новый телефон юзера" />
        </label>

        <br/>
        <label>
            Текущий аватар пользователя:
            <img src="/storage/{{ ($user->avatar === '' ? null : $user->avatar)  ?? 'user.png' }}"  
                width="48"
                height="48" 
                alt="User avatar"
            /><br/>
            <input type="file" name="avatar" />
        </label>

        <br/>
        <button type="submit">Изменить</button>
    </form>
@endsection

@section('scripts')
    @vite('resources/js/user.js')
@endsection