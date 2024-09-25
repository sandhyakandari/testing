@php
    $id = session('id');
    $check_player = DB::table('players')->where('id', '=', $id)->first();
@endphp

<div class="left-panel">
    <div class="profile-box patient-profile">
        <div class="upper-box">
            <figure class="profile-image">
                <form action="{{ route('player.playerProfileImage') }}" method="POST" class="profile-image-form"
                    name="profileImageForm" enctype="multipart/form-data">
                    @csrf
                    <img src="{{ $check_player->photo }}"
                        alt="{{ $check_player->first_name }} {{ $check_player->middle_name }} {{ $check_player->last_name }}">
                    <input type="file" name="profileImage" id="profileImage" class="profileImageInput">
                    <label for="profileImage" class="profile-image-edit">
                        <i class="fas fa-pencil"></i>
                    </label>
                </form>
            </figure>
            <div class="title-box centred">
                <div class="inner">
                    <h3>
                        {{ $check_player->first_name }} {{ $check_player->middle_name }} {{ $check_player->last_name }}
                    </h3>
                    <p>
                        <i class="fas fa-envelope"></i> {{ $check_player->email }}
                    </p>
                    @if ($check_player->ita_number)
                        <p>
                            <i class="fab fa-digital-ocean"></i> {{ $check_player->ita_number }}
                        </p>
                    @endif
                    <button class="profile-img-change-btn theme-btn-one" id="profileImgChangeBtn">Save</button>
                </div>
            </div>
        </div>
        <div class="profile-info">
            <ul class="list clearfix">
                <li>
                    <a href="{{ route('player.dashboard') }}"
                        class="{{ request()->routeIs('player.dashboard') ? 'current' : '' }}">
                        <i class="fas fa-columns"></i>Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('player.myProfile') }}"
                        class="{{ request()->routeIs('player.myProfile') ? 'current' : '' }}">
                        <i class="fas fa-user"></i>My Profile
                    </a>
                </li>
                <li>
                    <a href="{{ route('players.upcomingTournaments') }}"
                        class="{{ request()->routeIs('players.upcomingTournaments') ? 'current' : '' }}">
                        <i class="fas fa-clock"></i>Upcoming Tournaments
                    </a>
                </li>
                <li>
                    <a href="{{ route('players.tournamentHistory') }}"
                        class="{{ request()->routeIs('players.tournamentHistory') ? 'current' : '' }}">
                        <i class="fas fa-history"></i>Tournament History
                    </a>
                </li>
                <li>
                    <a href="{{ route('player.playerUploadImages') }}"
                        class="{{ request()->routeIs('player.playerUploadImages') ? 'current' : '' }}">
                        <i class="fa fa-file-image"></i>Upload Images
                    </a>
                </li>
                <li>
                    <a href="{{ route('player.changePassword') }}"
                        class="{{ request()->routeIs('player.changePassword') ? 'current' : '' }}">
                        <i class="fas fa-unlock-alt"></i>Change Password
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
