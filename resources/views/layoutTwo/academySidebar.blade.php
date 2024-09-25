@php
    $id = session('id');
    $check_academy = DB::table('academies')->where('id', '=', $id)->first();
@endphp
<div class="left-panel" id="academySidebarLeftPanel">
    <div class="profile-box patient-profile">
        <div class="upper-box">
            <figure class="profile-image">
                <form action="{{ route('academy.academyProfileImage') }}" method="POST" class="profile-image-form"
                    name="profileImageForm" enctype="multipart/form-data">
                    @csrf
                    <img src="{{ $check_academy->photo }}" alt="{{ $check_academy->name }}">
                    <input type="file" name="profileImage" id="profileImage" class="profileImageInput">
                    <label for="profileImage" class="profile-image-edit">
                        <i class="fas fa-pencil"></i>
                    </label>
                </form>
            </figure>
            <div class="title-box centred">
                <div class="inner">
                    <h3>
                        {{-- {{ dd($check_academy) }} --}}
                        {{ $check_academy->name }}
                    </h3>
                    <p>
                        <i class="fas fa-envelope"></i> {{ $check_academy->email }}
                    </p>
                    @if ($check_academy->aita_number)
                        <p>
                            <i class="fab fa-digital-ocean"></i> {{ $check_academy->aita_number }}
                        </p>
                    @endif
                    <button class="profile-img-change-btn theme-btn-one" id="profileImgChangeBtn">Save</button>
                </div>
            </div>
        </div>
        <div class="profile-info">
            <ul class="list clearfix">
                <li>
                    <a href="{{ route('academy.dashboard') }}"
                        class="{{ request()->routeIs('academy.dashboard') ? 'current' : '' }}">
                        <i class="fas fa-columns"></i>Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('academy.academyProfile') }}"
                        class="{{ request()->routeIs('academy.academyProfile') ? 'current' : '' }}">
                        <i class="fas fa-user"></i>Profile
                    </a>
                </li>
                <li class="current dropdown" id="tournamentList">
                    <a href="javascript:void(0)" class="">
                        <i class="fa fa-chess"></i>Tournaments
                    </a>
                    <ul class="tournament-dropdown" id="tournament-dropdown">
                        <li>
                            <a href="{{ route('academy.academyCreateTournament') }}"
                                class="{{ request()->routeIs('academy.academyCreateTournament') ? 'current' : '' }}">
                                Create Tournament
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('academy.recentTournament') }}"
                                class="{{ request()->routeIs('academy.recentTournament') ? 'current' : '' }}">
                                Recent Tournament
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('academy.currentTournaments') }}"
                                class="{{ request()->routeIs('academy.currentTournaments') ? 'current' : '' }}">
                                Current Tournament
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('academy.tournaments') }}"
                                class="{{ request()->routeIs('academy.tournaments') ? 'current' : '' }}">
                                Upcoming Tournamet
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('academy.showRegisteredPlayerList') }}"
                                class="{{ request()->routeIs('academy.showRegisteredPlayerList') ? 'current' : '' }}">
                                Players
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('academy.drawPage') }}"
                                class="{{ request()->routeIs('academy.drawPage') ? 'current' : '' }}">
                                Draw
                            </a>
                        </li>
                    </ul>
                    <div class="dropdown-btn"><span class="fas fa-angle-down"></span></div>
                </li>
                <li>
                    <a href="{{ route('academy.academyRegisteredPlayer') }}"
                        class="{{ request()->routeIs('academy.academyRegisteredPlayer') ? 'current' : '' }}">
                        <i class="fa fa-user-check"></i>Registered Players
                    </a>
                </li>
                <li>
                    <a href="{{ route('academy.academyUploadImages') }}"
                        class="{{ request()->routeIs('academy.academyUploadImages') ? 'current' : '' }}">
                        <i class="fa fa-file-image"></i>Upload Images
                    </a>
                </li>
                <li>
                    <a href="{{ route('academy.manualRegisteredPlayer') }}"
                        class="{{ request()->routeIs('academy.manualRegisteredPlayer') ? 'current' : '' }}">
                        <i class="fas fa-unlock-alt"></i>Player Registration
                    </a>
                </li>
                <li>
                    <a href="{{ route('academy.academyChangePassword') }}"
                        class="{{ request()->routeIs('academy.academyChangePassword') ? 'current' : '' }}">
                        <i class="fas fa-unlock-alt"></i>Change Password
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
