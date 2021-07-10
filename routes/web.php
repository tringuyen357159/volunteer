<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//MAIN-----------------------------------------------

Route::group(['namespace' => 'Client'], function () {
    //DONATE
    Route::get('/tai-tro', 'DonateController@index')->name('client.donate');

    Route::group(['middleware' => 'login-volunteer'], function () {

        //EVENT
        Route::post('/dang-ky-su-kien', 'EventController@RegisterEvent')->name('client.event.register');
        Route::get('/quan-ly-su-kien/delete/{event_id}/{user_id}', 'VolunteerController@deleteEvent')->name('client.deleteevent');
        //COMMENT_EVENT
        Route::post('/binh-luan', 'CommentController@store')->name('comment.event');
        //VOLUNTEER
        Route::get('/ho-so', 'VolunteerController@showProfile')->name('client.getProfile');
        Route::post('/ho-so/update', 'VolunteerController@updateProfile')->name('client.updateProfile');
        Route::get('/ho-so/update', 'VolunteerController@showPassword')->name('client.getPassword');
        Route::post('/ho-so/update/password', 'VolunteerController@updatePassword')->name('client.updatePassword');
        Route::get('/quan-ly-su-kien', 'VolunteerController@eventManagement')->name('client.eventmanagement');
    });

    Route::get('/', 'HomeController@Home')->name('home');
    Route::get('/contact', 'FeedbackController@index')->name('feedback');
    Route::get('/welcome', function () {
        return view('main.pages.welcome');
    });

    //DONATE
    Route::get('/donate', function () {
        return view('main.pages.donate');
    });

    //FEED BACK
    Route::post('/contact', 'FeedbackController@store')->name('feedback.store');

    //NEWS
    Route::get('/tintuc', 'NewsController@news')->name('news.list');
    Route::get('/tintuc/tinhnguyen', 'NewsController@NewsVolunteer')->name('news.vlt');
    Route::get('/tintuc/tochuc', 'NewsController@NewsOrg')->name('news.org');
    Route::get('/tintuc/blog', 'NewsController@NewsBlog')->name('news.blog');
    Route::get('/tin-tuc/{slug}', 'NewsController@DetailNews')->name('news.detailnews');

    //EVENT
    Route::get('/su-kien', 'EventController@ListEvent')->name('client.event');
    Route::get('/su-kien/{slug}', 'EventController@DetailEvent')->name('client.detailevent');

    //VOLUNTEER
    Route::group(['middleware' => 'active_user','check-mail'], function () {
        Route::post('/dang-nhap', 'VolunteerController@storeLogin')->name('client.postLogin');
    });
    Route::get('/dang-nhap', 'VolunteerController@showLogin')->name('client.getLogin');

    Route::get('/dang-ky', 'VolunteerController@showRegister')->name('client.getRegister');
    Route::post('/dang-ky', 'VolunteerController@storeRegister')->name('client.postRegister');
    Route::get('/dang-xuat', 'VolunteerController@logout')->name('client.logout');

    //FORGOTPASSWORD
    Route::get('/quen-mat-khau', 'ForgotPasswordClientController@getEmail')->name('client.email.get');
    Route::post('/quen-mat-khau', 'ForgotPasswordClientController@postEmail')->name('client.email.post');
    Route::get('/mat-khau-moi/{token}', 'ForgotPasswordClientController@getPassword')->name('client.password.get');
    Route::post('/mat-khau-moi', 'ForgotPasswordClientController@resetPassword')->name('client.password.post');

    //REGISTER-SENDMAIL
    Route::get('/xac-thuc/{id}', 'VolunteerController@verifyemail')->name('client.verify.mail');
});


//ADMIN------------------------------------------------

Route::group(['namespace' => 'admin', 'prefix' => 'admin'], function () {

    Route::get('/login', 'AdminController@showlogin')->name('login.show');
    Route::post('/login', 'AdminController@login')->name('admin.login');
    Route::get('/logout', 'AdminController@logout')->name('admin.logout');
    Route::get('/forget-password', 'ForgotPasswordController@getEmail')->name('email.get');
    Route::post('/forget-password', 'ForgotPasswordController@postEmail')->name('email.post');
    Route::get('/reset-password/{token}', 'ForgotPasswordController@getPassword')->name('password.get');
    Route::post('reset-password/', 'ForgotPasswordController@resetPassword')->name('password.post');

    Route::group(['middleware' => 'login-admin'], function () {

        Route::get('/dashboard', [
            'as' => 'dashboard',
            'uses' => 'AdminController@dashboard',
        ]);

        //MESSAGE
        Route::get('/chat', 'ChatController@index')->name('chat.show');
        Route::get('/message/{id}', 'ChatController@getMessage')->name('message');
        Route::post('/message', 'ChatController@sendMessage');

        //PROFILE
        Route::get('/profile', 'AdminController@profile')->name('admin.profile');


        Route::post('/profile/employee/update', 'AdminController@UpdateEmployee')->name('updateemployee.profile');
        Route::get('/changepassword', 'AdminController@showpassword')->name('admin.showpassword');
        Route::post('/profile/admin/update', 'AdminController@UpdateAdmin')->name('updateadmin.profile');
        Route::post('/profile/resetpassword', 'AdminController@updatePassword')->name('updatepassword.profile');

        //USER
        Route::prefix('users')->group(function () {

            Route::get('/', [
                'as' => 'user.index',
                'uses' => 'UserController@index',
                'middleware' => 'check-ACL:user-list'
            ]);
            Route::get('/edit/{id}', [
                'as' => 'user.edit',
                'uses' => 'UserController@edit',
                'middleware' => 'check-ACL:user-edit'
            ]);
            Route::post('/update/{id}', [
                'as' => 'user.update',
                'uses' => 'UserController@update',
                'middleware' => 'check-ACL:user-update'
            ]);
        });

        //ROLE
        Route::prefix('roles')->group(function () {

            Route::get('/', [
                'as' => 'role.index',
                'uses' => 'roleController@index',
                'middleware' => 'check-ACL:role-list'
            ]);

            Route::get('/create', [
                'as' => 'role.create',
                'uses' => 'roleController@create',
                'middleware' => 'check-ACL:role-add'
            ]);
            Route::post('/create', [
                'as' => 'role.store',
                'uses' => 'roleController@store',
                'middleware' => 'check-ACL:role-add'
            ]);
            Route::get('/edit/{id}', [
                'as' => 'role.edit',
                'uses' => 'roleController@edit',
                'middleware' => 'check-ACL:role-edit'
            ]);
            Route::post('/update/{id}', [
                'as' => 'role.update',
                'uses' => 'roleController@update',
                'middleware' => 'check-ACL:role-update'
            ]);
            Route::get('/delete/{id}', [
                'as' => 'role.delete',
                'uses' => 'roleController@delete',
                'middleware' => 'check-ACL:role-delete'
            ]);
        });

        //BANNER
        Route::prefix('banner')->group(function () {

            Route::get('/', [
                'as' => 'banner.index',
                'uses' => 'bannerController@index',
                'middleware' => 'check-ACL:banner-list'
            ]);
            Route::get('/create', [
                'as' => 'banner.create',
                'uses' => 'bannerController@create',
                'middleware' => 'check-ACL:banner-add'
            ]);
            Route::post('/create', [
                'as' => 'banner.store',
                'uses' => 'bannerController@store',
                'middleware' => 'check-ACL:banner-add'
            ]);
            Route::get('/edit/{id}', [
                'as' => 'banner.edit',
                'uses' => 'bannerController@edit',
                'middleware' => 'check-ACL:banner-edit'
            ]);
            Route::post('/update/{id}', [
                'as' => 'banner.update',
                'uses' => 'bannerController@update',
                'middleware' => 'check-ACL:banner-update'
            ]);
            Route::get('/delete/{id}', [
                'as' => 'banner.delete',
                'uses' => 'bannerController@delete',
                'middleware' => 'check-ACL:banner-delete'
            ]);
        });

        //NEWS
        Route::prefix('news')->group(function () {

            Route::get('/', [
                'as' => 'news.show',
                'uses' => 'NewsController@index',
                'middleware' => 'check-ACL:news-list'
            ]);
            Route::get('/add', [
                'as' => 'news.showadd',
                'uses' => 'NewsController@create',
                'middleware' => 'check-ACL:news-add'
            ]);
            Route::post('/add', [
                'as' => 'news.add',
                'uses' => 'NewsController@store',
                'middleware' => 'check-ACL:news-add'
            ]);
            Route::get('/edit/{id}', [
                'as' => 'news.edit',
                'uses' => 'NewsController@edit',
                'middleware' => 'check-ACL:news-edit'
            ]);
            Route::post('/update', [
                'as' => 'news.update',
                'uses' => 'NewsController@update',
                'middleware' => 'check-ACL:news-update'
            ]);
            Route::get('/delete/{id}', [
                'as' => 'news.delete',
                'uses' => 'NewsController@delete',
                'middleware' => 'check-ACL:news-delete'
            ]);
        });

        //EVENT
        Route::prefix('event')->group(function () {

            Route::get('/', [
                'as' => 'event.list',
                'uses' => 'EventController@index',
                'middleware' => 'check-ACL:event-list'
            ]);
            Route::get('/add', [
                'as' => 'event.show',
                'uses' => 'EventController@create',
                'middleware' => 'check-ACL:event-add'
            ]);
            Route::post('/add', [
                'as' => 'event.add',
                'uses' => 'EventController@store',
                'middleware' => 'check-ACL:event-add'
            ]);
            Route::get('/edit/{id}', [
                'as' => 'event.edit',
                'uses' => 'EventController@edit',
                'middleware' => 'check-ACL:event-edit'
            ]);
            Route::post('/update', [
                'as' => 'event.update',
                'uses' => 'EventController@update',
                'middleware' => 'check-ACL:event-update'
            ]);
            Route::get('/delete/{id}', [
                'as' => 'event.delete',
                'uses' => 'EventController@delete',
                'middleware' => 'check-ACL:event-delete'
            ]);

            Route::get('/list-agree', [
                'as' => 'event.list.agree',
                'uses' => 'EventController@listAgree',
                'middleware' => 'check-ACL:event-listagree'
            ]);

            Route::get('/list-wait-agree', [
                'as' => 'event.list.wait.agree',
                'uses' => 'EventController@listWaitAgree',
                'middleware' => 'check-ACL:event-listwaitagree'
            ]);

            Route::get('/agree/{id}', [
                'as' => 'event.update.agree',
                'uses' => 'EventController@Agree',
                'middleware' => 'check-ACL:event-updateagree'
            ]);
        });

        //TOOL
        Route::prefix('tool')->group(function () {

            Route::get('/', [
                'as' => 'tool.list',
                'uses' => 'ToolController@index',
                'middleware' => 'check-ACL:tool-list'
            ]);
            Route::get('/add', [
                'as' => 'tool.show',
                'uses' => 'ToolController@create',
                'middleware' => 'check-ACL:tool-add'
            ]);
            Route::post('/add', [
                'as' => 'tool.add',
                'uses' => 'ToolController@store',
                'middleware' => 'check-ACL:tool-add'
            ]);
            Route::get('/edit/{id}', [
                'as' => 'tool.edit',
                'uses' => 'ToolController@edit',
                'middleware' => 'check-ACL:tool-edit'
            ]);
            Route::post('/update', [
                'as' => 'tool.update',
                'uses' => 'ToolController@update',
                'middleware' => 'check-ACL:tool-update'
            ]);
            Route::get('/delete/{id}', [
                'as' => 'tool.delete',
                'uses' => 'ToolController@delete',
                'middleware' => 'check-ACL:tool-delete'
            ]);
        });

        //ACTIVE USER
        Route::group(['middleware' => 'active_user'], function () {

            Route::post('/set-active-user', [
                'as' => 'volunteer.active',
                'uses' => 'VolunteerController@active',
                'middleware' => 'check-ACL:volunteer-active'
            ]);

            Route::get('/set-active-user/{id}', [
                'as' => 'volunteer.openactive',
                'uses' => 'VolunteerController@openactive',
                'middleware' => 'check-ACL:volunteer-openactive'
            ]);
        });

        //VOLUNTEER
        Route::prefix('/volunteer')->group(function () {

            Route::get('/', [
                'as' => 'volunteer.show',
                'uses' => 'VolunteerController@index',
                'middleware' => 'check-ACL:volunteer-list'
            ]);
            Route::get('/volunteer/edit/{id}', [
                'as' => 'volunteer.edit',
                'uses' => 'VolunteerController@show_role',
                'middleware' => 'check-ACL:volunteer-edit'
            ]);
            Route::post('/volunteer/update', [
                'as' => 'volunteer.update',
                'uses' => 'VolunteerController@updatevolunteer',

            ]);
        });

        //EVENT-REGISTER
        Route::prefix('/event-register')->group(function () {

            Route::get('/', [
                'as' => 'eventregister.show',
                'uses' => 'EventVolunteerController@index',
                'middleware' => 'check-ACL:eventregister-list'
            ]);
        });

        //SPONSOR
        Route::prefix('sponsor')->group(function () {

            Route::get('/', [
                'as' => 'sponsor.list',
                'uses' => 'sponsorController@index',
            ]);
            Route::get('/add', [
                'as' => 'sponsor.show',
                'uses' => 'sponsorController@create',
                'middleware' => 'check-ACL:sponsor-add'
            ]);
            Route::post('/add', [
                'as' => 'sponsor.add',
                'uses' => 'sponsorController@store',
                'middleware' => 'check-ACL:sponsor-add'
            ]);
            Route::get('/edit/{id}', [
                'as' => 'sponsor.edit',
                'uses' => 'sponsorController@edit',
                'middleware' => 'check-ACL:sponsor-edit'
            ]);
            Route::post('/update', [
                'as' => 'sponsor.update',
                'uses' => 'sponsorController@update',
                'middleware' => 'check-ACL:sponsor-update'
            ]);
            Route::get('/delete/{id}', [
                'as' => 'sponsor.delete',
                'uses' => 'sponsorController@delete',
                'middleware' => 'check-ACL:sponsor-delete'
            ]);
        });

        //FEEDBACK
        Route::prefix('feedback')->group(function () {
            Route::get('/feedback', [
                'as' => 'feedback.show',
                'uses' => 'FeedbackController@index',
                'middleware' => 'check-ACL:feedback-list'
            ]);
            Route::get('/feedback/delete/{id}', [
                'as' => 'feedback.delete',
                'uses' => 'FeedbackController@delete',
                'middleware' => 'check-ACL:feedback-delete'
            ]);
        });

        //NHÂN VIÊN
        Route::prefix('employee')->group(function () {
            Route::get('/', [
                'as' => 'employee.list',
                'uses' => 'EmployeeController@index',
                'middleware' => 'check-ACL:employee-list'
            ]);
            Route::get('/create', [
                'as' => 'employee.create',
                'uses' => 'EmployeeController@create',
                'middleware' => 'check-ACL:employee-add'
            ]);
            Route::post('/create', [
                'as' => 'employee.store',
                'uses' => 'EmployeeController@store',
                'middleware' => 'check-ACL:employee-add'
            ]);
            Route::get('/delete/{id}', [
                'as' => 'employee.delete',
                'uses' => 'EmployeeController@delete',
                'middleware' => 'check-ACL:employee-delete'
            ]);
        });

        //DETAIL_SPENDING
        Route::prefix('detail_spending')->group(function () {
            Route::get('/', [
                'as' => 'deatail.show',
                'uses' => 'SponsorController@list',
            ]);
        });

        //MAKE USER FROM SPONSERS
        Route::get('/makeuser/{id}', [
            'as' => 'user.parse',
            'uses' => 'sponsorController@showmakeuser',
            'middleware' => 'check-ACL:makeuser'
        ]);
        Route::post('/taouser/{id}', [
            'as' => 'user.doneparse',
            'uses' => 'sponsorController@makeuser',
            'middleware' => 'check-ACL:makeuser'
        ]);

        //MAKE SPONSER FROM USER
        Route::get('/makesponsor/{id}', [
            'as' => 'sponser.parse',
            'uses' => 'sponsorController@showmakesponser',
            'middleware' => 'check-ACL:makesponsor'
        ]);
        Route::post('/update/{id}', [
            'as' => 'sponsor.doneparse',
            'uses' => 'sponsorController@makesponser',
            'middleware' => 'check-ACL:makesponsor'
        ]);

        //DONATE
        Route::get('/sponsor/donate/{id}', [
            'as' => 'sponsor.showdonate',
            'uses' => 'sponsorController@showdonate',
            'middleware' => 'check-ACL:makeuser'
        ]);
        Route::post('/sponsor/donatemore/{id}', [
            'as' => 'sponsor.donate',
            'uses' => 'sponsorController@donate',
            'middleware' => 'check-ACL:makeuser'
        ]);

        //MANAGEMENT USER
        Route::prefix('comment')->group(function () {
            Route::get('/', [
                'as' => 'comment.list',
                'uses' => 'CommentController@list',
                'middleware' => 'check-ACL:comment-list'
            ]);
            Route::get('/delete/{id}', [
                'as' => 'comment.delete',
                'uses' => 'CommentController@delete',
                'middleware' => 'check-ACL:comment-delete'
            ]);
        });

        Route::prefix('statistic')->group(function () {
            Route::get('/', [
                'as' => 'statistic.list',
                'uses' => 'SponsorController@statistical',
                'middleware' => 'check-ACL:statistic-list'
            ]);
        });
        //!--------------------------------------------------------------------------------------
        Route::get('/mark-read-all', 'AdminController@markAllNotification')->name('markAll.Notification');
        Route::get('/mark-read/{id}', 'AdminController@markNotification')->name('mark.Notification');
    });
});
