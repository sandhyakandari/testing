<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\Players\PlayerController;
use App\Http\Controllers\DrawController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|s
 */

Route::group(['middleware' => ['web', 'visitor']], function () {
    Route::get('/', [MainController::class, 'home'])->name('home');

    Route::get('/about-us', [MainController::class, 'aboutUs'])->name('aboutUs');
    Route::get('/contactus', [MainController::class, 'contactUs'])->name('contact');
    Route::post('/contactus', [MainController::class, 'contacuUsdata'])->name('contactus');
    Route::get('/players', [MainController::class, 'players'])->name('players');

    Route::get('/academies', [MainController::class, 'academies'])->name('academies');

    Route::get('/tournament-calendar', [MainController::class, 'tournamentCalendar'])->name('tournamentCalendar');
    Route::any('/ascending-upcoming-tournament', [HomeController::class, 'ascendingUpcomingTournament'])->name('ascendingUpcomingTournament');
    Route::any('/ascending-recent-tournament', [HomeController::class, 'ascendingRecentTournament'])->name('ascendingRecentTournament');
    Route::any('/ascending-current-tournament', [HomeController::class, 'ascendingCurrentTournament'])->name('ascendingCurrentTournament');

    Route::get('/academy-detail', [MainController::class, 'academyDetail'])->name('academyDetail');
    Route::get('/player-detail', [MainController::class, 'playerDetail'])->name('playerDetail');
    Route::get('/tournament-detail', [MainController::class, 'tournamentDetail'])->name('tournamentDetail');
    Route::any('/academy-search', [HomeController::class, 'academySearch'])->name('academySearch');
    Route::any('/player-search', [HomeController::class, 'playerSearch'])->name('playerSearch');
    Route::get('/top-10-players', [HomeController::class, 'topTenPlayer'])->name('topTenPlayer');
    Route::get('/top-100-players', [HomeController::class, 'topHundredPlayers'])->name('topHundredPlayers');
    Route::get('/rank/{category}/{sub_category}', [MainController::class, 'rank'])->name('rank');
    Route::get('/fetchEarliestTournament', [HomeController::class, 'fetchEarliestTournament'])->name('fetchEarliestTournament');
    Route::get('/fetchRecentTournamentResult', [HomeController::class, 'fetchRecentTournamentResult'])->name('fetchRecentTournamentResult');
    Route::get('/terms-condition', [MainController::class, 'termsCondition'])->name('termsCondition');
    Route::get('/important-policy', [MainController::class, 'importantPolicy'])->name('importantPolicy');
    Route::get('/register', [HomeController::class, 'getRegister'])->name('getRegister');
    Route::post('/register', [HomeController::class, 'register'])->name('register');
    Route::get('/verifyMail', [HomeController::class, 'verifyMail']);
    Route::get('/login', [HomeController::class, 'getLogin'])->name('getLogin');
    Route::post('/login', [HomeController::class, 'login'])->name('login');
    Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
    // draw
    Route::post('/has-draw', [DrawController::class, 'hasDraw'])->name('hasDraw');
    Route::post('/check-draw-type', [DrawController::class, 'checkTypeOfDraw'])->name('checkTypeOfDraw');
    Route::post('/fetch-draw-data', [DrawController::class, 'fetchDrawData'])->name('fetchDrawData');
});

// forgot password

Route::get('password/forget', [HomeController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [HomeController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset', [HomeController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [HomeController::class, 'reset'])->name('password.update');

// player dashboard
Route::group(['middleware' => ['web', 'playerMiddleware']], function () {
    Route::get('/player-register', [HomeController::class, 'playerRegister'])->name('player.register');
    Route::post('/playerRegister', [HomeController::class, 'playerRegisterFun'])->name('player.registerFun');
    Route::get('/player/dashboard', [MainController::class, 'playerDashboard'])->name('player.dashboard');
    Route::get('/player/my-profile', [MainController::class, 'myProfile'])->name('player.myProfile');
    Route::get('/player/change-password', [MainController::class, 'changePassword'])->name('player.changePassword');
    Route::get('/player/upcoming-tournaments', [MainController::class, 'upcomingTournaments'])->name('players.upcomingTournaments');
    Route::post('/player/upcoming-tournament-search', [HomeController::class, 'playerUpcomingTournamentSearch'])->name('players.playerUpcomingTournamentSearch');
    Route::get('/player/tournament-history', [MainController::class, 'tournamentHistory'])->name('players.tournamentHistory');
    Route::post('/player/store-my-profile', [HomeController::class, 'storeMyProfile'])->name('player.storeMyProfile');
    Route::post('/player/store-change-password', [HomeController::class, 'storeChangePassword'])->name('player.storeChangePassword');
    Route::post('/player/profile-image-store', [HomeController::class, 'playerProfileImage'])->name('player.playerProfileImage');
    Route::get('/player/upload-images', [MainController::class, 'playerUploadImages'])->name('player.playerUploadImages');
    Route::post('/player/upload-images-store', [HomeController::class, 'playerUploadImagesStore'])->name('player.playerUploadImagesStore');
    Route::get('/player/delete-images-store', [HomeController::class, 'playerDeleteImagesStore'])->name('player.playerDeleteImagesStore');
    Route::post('/player/player-register-tournament', [HomeController::class, 'playerRegisterTournament'])->name('player.playerRegisterTournament');
    Route::post('/player/updateEmail', [HomeController::class, 'playerEmailUpdate'])->name('player.playerEmailUpdate');
    Route::post('/player/updateAITANumber', [HomeController::class, 'playerAITANumberUpdate'])->name('player.playerAITANumberUpdate');
    Route::post('/player/withdraw-tournament', [HomeController::class, 'playerWithdrawTournament'])->name('player.playerWithdrawTournament');

});

// academy dashboard
Route::group(['middleware' => ['web', 'academyMiddleware']], function () {
    Route::get('/academy-register', [HomeController::class, 'academyRegister'])->name('academy.register');
    Route::post('/academyRegister', [HomeController::class, 'academyRegisterFun'])->name('academy.registerFun');
    Route::get('/academy/dashboard', [MainController::class, 'academyDashboard'])->name('academy.dashboard');
    Route::get('/academy/my-profile', [MainController::class, 'academyProfile'])->name('academy.academyProfile');
    Route::get('/academy/change-password', [MainController::class, 'academyChangePassword'])->name('academy.academyChangePassword');
    Route::get('/academy/registered-player', [MainController::class, 'academyRegisteredPlayer'])->name('academy.academyRegisteredPlayer');
    Route::get('/academy/upload-images', [MainController::class, 'academyUploadImages'])->name('academy.academyUploadImages');
    Route::post('/academy/store-academy-profile', [HomeController::class, 'storeAcademyProfile'])->name('academy.storeAcademyProfile');
    Route::post('/academy/store-academy-change-password', [HomeController::class, 'storeAcademyChangePassword'])->name('academy.storeAcademyChangePassword');
    Route::get('/academy/recent-tournaments', [MainController::class, 'recentTournament'])->name('academy.recentTournament');
    Route::get('/academy/upcoming-tournaments', [MainController::class, 'tournaments'])->name('academy.tournaments');
    Route::post('/academy/upload-images', [HomeController::class, 'uploadImages'])->name('academy.uploadImages');
    Route::get('/academy/delete-images', [HomeController::class, 'academyDeleteImages'])->name('academy.academyDeleteImages');
    Route::post('/academy/profile-image', [HomeController::class, 'academyProfileImage'])->name('academy.academyProfileImage');
    Route::get('/academy/create-tournament', [MainController::class, 'academyCreateTournament'])->name('academy.academyCreateTournament');
    Route::post('/academy/store-tournament', [HomeController::class, 'storeTournament'])->name('academy.storeTournament');
    Route::get('/academy/approved-player', [HomeController::class, 'approvedPlayer'])->name('academy.approvedPlayer');
    Route::get('/academy/dissapprovePlayer', [HomeController::class, 'dissapprovePlayer'])->name('academy.dissapprovePlayer');
    Route::post('/academy/store-tournament-image', [HomeController::class, 'storeTournamentImage'])->name('academy.storeTournamentImage');
    Route::get('/academy/edit-tournament', [MainController::class, 'academyEditTournament'])->name('academy.academyEditTournament');
    Route::post('/academy/store-edit-tournament', [HomeController::class, 'storeEditTournament'])->name('academy.storeEditTournament');
    Route::post('/academy/updateEmail', [HomeController::class, 'academyEmailUpdate'])->name('academy.academyEmailUpdate');
    Route::post('/academy/updateAITANumber', [HomeController::class, 'academyAITANumberUpdate'])->name('academy.academyAITANumberUpdate');
    Route::get('/academy/registration-player', [MainController::class, 'manualRegisteredPlayer'])->name('academy.manualRegisteredPlayer');
    Route::get('/academy/registration', [MainController::class, 'academyPlayerRegistration'])->name('academy.academyPlayerRegistration');
    Route::post('/academy/player-register-by-academy', [HomeController::class, 'playerRegisterByAcademy'])->name('academy.playerRegisterByAcademy');
    Route::get('/academy/delete-tournament', [HomeController::class, 'c'])->name('academy.academyDeleteTournament');
    Route::get('/academy/current-tournament', [MainController::class, 'currentTournaments'])->name('academy.currentTournaments');
    Route::get('/academy/show-registered-player', [MainController::class, 'showRegisteredPlayerList'])->name('academy.showRegisteredPlayerList');
    Route::post('/academy/fetch-registered-player-data', [DrawController::class, 'fetchRegisteredPlayerDataOnTournament'])->name('academy.fetchRegisteredPlayerDataOnTournament');
    Route::get('/academy/prepare-draw', [MainController::class, 'drawPrepare'])->name('academy.drawPrepare');
    Route::post('/academy/drawCreate', [DrawController::class, 'drawCreate'])->name('academy.drawCreate');
    Route::get('/academy/draw-create', [MainController::class, 'draw'])->name('academy.createDraw');
    Route::post('/academy/resultSessionExpire', [DrawController::class, 'resultSessionExpire'])->name('academy.resultSessionExpire');
    Route::post('/academy/store-draw', [DrawController::class, 'storeDraw'])->name('academy.storeDraw');
    Route::get('/academy/draw', [MainController::class, 'drawPage'])->name('academy.drawPage');
    Route::post('/academy/show-draw-to-academy', [DrawController::class, 'showDrawToAcademy'])->name('academy.showDrawToAcademy');
    Route::post('/academy/get-match-score', [DrawController::class, 'getMatchScore'])->name('academy.getMatchScore');
    Route::post('/academy/get-Qualify-match-score', [DrawController::class, 'getQualifyMatchScore'])->name('academy.QualifyMatchScore');
    Route::get('/academy/create-next-round', [DrawController::class, 'nextQualifyRound'])->name('academy.nextQualifyRound');
    Route::get('/academy/move-to-mains', [DrawController::class, 'moveToMainDraw'])->name('academy.moveToMainDraw');
});

// admin route
Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
Route::post('/admin/auth', [AdminController::class, 'adminAuth'])->name('admin.adminAuth');
Route::group(['middleware' => ['web', 'isAdmin']], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.adminDashboard');
    // player
    Route::get('/admin/players', [AdminController::class, 'playerList'])->name('admin.playerList');
    Route::get('/admin/player-detail', [AdminController::class, 'playerDetail'])->name('admin.playerDetail');
    Route::get('/admin/player-publish', [AdminController::class, 'playerPublish'])->name('admin.playerPublish');
    Route::post('/admin/player-show-homepage', [AdminController::class, 'playerShowHomepage'])->name('admin.playerShowHomepage');
    Route::post('/admin/player-hide-homepage', [AdminController::class, 'playerHideHomepage'])->name('admin.playerHideHomepage');
    Route::get('/admin/player-updates', [AdminController::class, 'playerUpdates'])->name('admin.playerUpdates');
    Route::post('/admin/player-email-update', [AdminController::class, 'playerEmailUpdate'])->name('admin.playerEmailUpdate');
    Route::post('/admin/player-aita-update', [AdminController::class, 'playerAitaUpdate'])->name('admin.playerAitaUpdate');
    Route::get('/admin/player-csv-download', [AdminController::class, 'playerDownloadCsv'])->name('admin.playerDownloadCsv');
    Route::get('/admin/player-unpublish', [AdminController::class, 'playerUnpublish'])->name('admin.playerUnpublish');

    // academy
    Route::get('/admin/academies', [AdminController::class, 'academyList'])->name('admin.academyList');
    Route::get('/admin/academy-detail', [AdminController::class, 'academyDetail'])->name('admin.academyDetail');
    Route::get('/admin/academy-publish', [AdminController::class, 'academyPublish'])->name('admin.academyPublish');
    Route::post('/admin/academy-show-homepage', [AdminController::class, 'academyShowHomepage'])->name('admin.academyShowHomepage');
    Route::post('/admin/academy-hide-homepage', [AdminController::class, 'academyHideHomepage'])->name('admin.academyHideHomepage');
    Route::get('/admin/academy-updates', [AdminController::class, 'academyUpdates'])->name('admin.academyUpdates');
    Route::post('/admin/academy-email-update', [AdminController::class, 'academyEmailUpdate'])->name('admin.academyEmailUpdate');
    Route::post('/admin/academy-aita-update', [AdminController::class, 'academyAitaUpdate'])->name('admin.academyAitaUpdate');
    Route::get('/admin/academy-csv-download', [AdminController::class, 'academyDownloadCsv'])->name('admin.academyDownloadCsv');
    Route::get('/admin/academy-unpublish', [AdminController::class, 'academyUnpublish'])->name('admin.academyUnpublish');
    Route::get('/admin/players/filterByAgeGroup', [PlayerController::class, 'filterByAgeGroup']);

    // rank
    Route::get('/admin/rank-list', [AdminController::class, 'rankList'])->name('admin.rankList');
    Route::post('/admin/importRankings', [AdminController::class, 'importRankings'])->name('admin.importRankings');
    Route::get('/admin/update-ranking', [AdminController::class, 'updateRanking'])->name('admin.updateRanking');
    Route::post('/admin/store-ranking-data', [AdminController::class, 'storeRankingData'])->name('admin.storeRankingData');
    Route::get('/admin/delete-ranking', [AdminController::class, 'deleteRanking'])->name('admin.deleteRanking');
    Route::post('/admin/rank-added-date', [AdminController::class, 'rankAddedDate'])->name('admin.rankAddedDate');
    Route::post('/admin/delete-all-data', [AdminController::class, 'deleteRankAllData'])->name('admin.deleteRankAllData');

    // tournaments
    Route::get('/admin/tournaments', [AdminController::class, 'tournamentsList'])->name('admin.tournamentsList');
    Route::get('/admin/tournament-detail', [AdminController::class, 'tournamentDetail'])->name('admin.tournamentDetail');
    Route::get('/admin/tournament-csv-download', [AdminController::class, 'tournamentDownloadCsv'])->name('admin.tournamentDownloadCsv');
    Route::get('/admin/tournament-delete', [AdminController::class, 'tournamentDelete'])->name('admin.tournamentDelete');

    //code by sandhya
    Route::get('/admin/add-banner', [AdminController::class, 'AddBanner'])->name('admin.Banner');
    Route::post('/admin/storeSlider', [AdminController::class, 'StoreSlider'])->name('admin.storeSlider');
    Route::get('/admin/edit-slide/{id}', [AdminController::class, 'editSlider'])->name('admin.editSlide');
    Route::get('/admin/delete-slide/{id}', [AdminController::class, 'deleteSlider'])->name('admin.deleteSlide');
    Route::get('/admin/visitors', [AdminController::class, 'UniqueVisitors'])->name('admin.Visitors');

    //end
    Route::get('/admin/logout', [AdminController::class, 'adminLogOut'])->name('admin.adminLogOut');
    Route::get('/admin/players/filterByAgeGroup', [PlayerController::class, 'filterByAgeGroup']);
});
