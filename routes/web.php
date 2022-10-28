<?php

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

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware('auth')->get('home', function (){
    if (\auth()->user()->hasRole('ادمین')){
        redirect()->route('home');
        redirect()->route('user.dashboard.entryPanel.index');
    }
})->name('index');

Route::middleware(['auth', 'role:ادمین'])->prefix('administrator')->group(function () {
    // dashboard //
    Route::get('/dashboard', 'HomeController@index')->name('home');
    Route::get('/dashboard/list-users', 'HomeController@listUsers')->name('home.listUsers');
    Route::get('/dashboard/user/excel', 'HomeController@excel')->name('home.user.excel');

    // Grade  //
    Route::get('grade/description', 'GradeController@indexDescription')->name('grade.description.index');
    Route::get('grade/description/create', 'GradeController@createDescription')->name('grade.description.create');
    Route::post('grade/description/store', 'GradeController@storeDescription')->name('grade.description.store');
    Route::get('grade/description/edit/{gradeDescription}', 'GradeController@editDescription')->name('grade.description.edit');
    Route::put('grade/description/update/{gradeDescription}', 'GradeController@updateDescription')->name('grade.description.update');
    Route::delete('grade/description/destroy/{gradeDescription}', 'GradeController@destroyDescription')->name('grade.description.destroy');


    Route::resource('/grade', 'GradeController');
    // video
    Route::get('/video/select-type', 'VideoController@selectType')->name('video.selectType');
    Route::get('/video/{type}', 'VideoController@index')->name('video.index');
    Route::get('/video/create/{type}', 'VideoController@create')->name('video.create');
    Route::post('/video/store/{type}', 'VideoController@store')->name('video.store');
    Route::get('/video/edit/{video}', 'VideoController@edit')->name('video.edit');
    Route::put('/video/update/{video}', 'VideoCont
    roller@update')->name('video.update');
    Route::delete('/video/destroy/{video}', 'VideoController@destroy')->name('video.destroy');
    // pdf
    Route::get('/document/{type}', 'DocumentController@index')->name('document.index');
    Route::get('/document/create/{type}', 'DocumentController@create')->name('document.create');
    Route::post('/document/store/{type}', 'DocumentController@store')->name('document.store');
    Route::get('/document/edit/{document}', 'DocumentController@edit')->name('document.edit');
    Route::put('/document/update/{document}', 'DocumentController@update')->name('document.update');
    Route::delete('/document/destroy/{document}', 'DocumentController@destroy')->name('document.destroy');

    Route::resource('/lesson', 'LessonController');
    Route::get('/book/book-part', 'BookController@indexPart')->name('book-part.index');
    Route::get('/book/book-part/ajax-part', 'BookController@ajaxParts')->name('book-part.ajaxParts');
    Route::get('/topic', 'TopicController@index')->name('topic.index');
    Route::post('/topic', 'TopicController@store')->name('topic.store');
    Route::get('/topic/ajax-topic', 'TopicController@ajaxTopics')->name('topic.ajaxTopics');
    Route::get('/topic/edit/{topic}', 'TopicController@edit')->name('topic.edit');
    Route::put('/topic/edit/{topic}', 'TopicController@update')->name('topic.update');
    Route::delete('/topic/destroy/{topic}', 'TopicController@destroy')->name('topic.destroy');
    Route::post('/book/book-part', 'BookController@storePart')->name('book-part.store');
    Route::get('/book/book-part/{part}/edit', 'BookController@editPart')->name('book-part.edit');
    Route::put('/book/book-part/{part}/update', 'BookController@updatePart')->name('book-part.update');
    Route::delete('/book/book-part/{part}/destroy', 'BookController@destroyPart')->name('book-part.destroy');
    Route::resource('/book', 'BookController');
    Route::post('/book/select', 'BookController@search')->name('book.search');
    // Role //
    Route::resource('/role', 'RoleController');
    // Permission  //
    Route::resource('/permission', 'PermissionController');
    //  User Management   //
    Route::resource('/userManagement', 'UserController');
    Route::post('/userManagement/UploadImage/{id}', 'UserController@UploadImage')->name('UploadImage');

    Route::post('/search-lessens', 'HomeController@searchLessons')->name('searchLessons');
    Route::post('/search-sessions', 'HomeController@searchSessions')->name('searchSessions');
    Route::post('/search-parts', 'HomeController@searchParts')->name('searchParts');
    Route::post('/search-topics', 'HomeController@searchTopics')->name('searchTopics');

    Route::get('/online-contact', function (){
        return 'در حال ساخت ....';
    })->name('admin.onlineContact');

    Route::get('/question-bank', function (){
        return 'در حال ساخت ....';
    })->name('admin.questionBank');

    Route::resource('/news', 'NewsController');

    Route::prefix('/discount')->group(function (){
        Route::get('/', 'DiscountController@index')->name('discount.index');
        Route::post('/', 'DiscountController@store')->name('discount.store');
        Route::get('/edit/{discount}', 'DiscountController@edit')->name('discount.edit');
        Route::put('/update/{discount}', 'DiscountController@update')->name('discount.update');
        Route::delete('/destroy/{discount}', 'DiscountController@destroy')->name('discount.destroy');
        Route::prefix('/karan-discount')->group(function (){
            Route::get('/', 'KaranDiscountController@index')->name('discount.karanDiscount.index');
            Route::post('/', 'KaranDiscountController@store')->name('discount.karanDiscount.store');
        });
        Route::prefix('/plan-exam-discount')->group(function (){
            Route::get('/', 'ExamDiscountController@index')->name('discount.examDiscount.index');
            Route::get('/create', 'ExamDiscountController@create')->name('discount.examDiscount.create');
            Route::post('/', 'ExamDiscountController@store')->name('discount.examDiscount.store');
            Route::post('/get-grade-planExams', 'ExamDiscountController@getGradePlanExams')->name('discount.examDiscount.exams');
//            Route::get('/edit/{planExam}', 'ExamDiscountController@index')->name('discount.examDiscount.index');
            Route::post('/', 'ExamDiscountController@store')->name('discount.examDiscount.store');
        });
    });

    Route::prefix('/store')->group(function (){
        Route::get('/', 'SubscriptionSaleController@index')->name('store.subscription.index');
        Route::post('/', 'SubscriptionSaleController@store')->name('store.subscription.store');
        Route::get('/video-pack', 'VideoPackSaleController@index')->name('store.videoPack.index');
        Route::post('/video-pack', 'VideoPackSaleController@store')->name('store.videoPack.store');
    });

    // ExamBook //
//    Route::get('/exam', 'ExamController@index')->name('exam.index');
//    Route::resource('/examBook', 'ExamBookController');
//    Route::resource('/textBook', 'TextBookController');
    Route::get('/DescriptiveTestBook', 'ExamBookController@DescriptiveTest')->name('DescriptiveTest');
    Route::post('/DescriptiveTestBook/store', 'ExamBookController@DescriptiveTestStore')->name('DescriptiveTest.Store');
    Route::delete('/DescriptiveTestBook/delete/{id}', 'ExamBookController@DescriptiveTestDelete')->name('DescriptiveTest.Delete');

    Route::prefix('/education')->group(function (){
        Route::get('/text-book/attachments', 'EducationController@textBookAttachmentsIndex')->name('education.textBookAttachmentsIndex');
        Route::post('/text-book/attachments', 'EducationController@textBookAttachmentsStore')->name('education.textBookAttachmentsStore');
        Route::get('/text-book/attachments/edit/{textBook}', 'EducationController@textBookAttachmentsEdit')->name('education.textBookAttachments.edit');
        Route::put('/text-book/attachments/update/{textBook}', 'EducationController@textBookAttachmentsUpdate')->name('education.textBookAttachments.update');
        Route::delete('/text-book/attachments/destroy/{textBook}', 'EducationController@textBookAttachmentsDestroy')->name('education.textBookAttachments.destroy');
        Route::get('/karan-bala/attachments', 'EducationController@karanBalaAttachmentsIndex')->name('education.karanBalaAttachmentsIndex');
        Route::post('/karan-bala/attachments', 'EducationController@karanBalaAttachmentsStore')->name('education.karanBalaAttachmentsStore');
        Route::get('/karan-bala/attachments/edit/{karanBala}', 'EducationController@karanBalaAttachmentsEdit')->name('education.karanBalAttachments.edit');
        Route::put('/karan-bala/attachments/update/{karanBala}', 'EducationController@karanBalaAttachmentsUpdate')->name('education.karanBalaAttachments.update');
        Route::delete('/karan-bala/attachments/destroy/{karanBala}', 'EducationController@karanBalaAttachmentsDestroy')->name('education.karanBalaAttachments.destroy');
        Route::get('/exam-book/attachments', 'EducationController@examBookAttachmentsIndex')->name('education.examBookAttachmentsIndex');
        Route::post('/exam-book/attachments', 'EducationController@examBookAttachmentsStore')->name('education.examBookAttachmentsStore');
        Route::get('/exam-book/attachments/edit/{examBook}', 'EducationController@examBookAttachmentsEdit')->name('education.examBookAttachments.edit');
        Route::put('/exam-book/attachments/update/{examBook}', 'EducationController@examBookAttachmentsUpdate')->name('education.examBookAttachments.update');
        Route::delete('/exam-book/attachments/destroy/{examBook}', 'EducationController@examBookAttachmentsDestroy')->name('education.examBookAttachments.destroy');
        Route::get('/descriptive-test/attachments', 'EducationController@descriptiveTestAttachmentsIndex')->name('education.descriptiveTestAttachmentsIndex');
        Route::post('/descriptive-test/attachments', 'EducationController@descriptiveTestAttachmentsStore')->name('education.descriptiveTestAttachmentsStore');
        Route::get('/descriptive-test/attachments/edit/{descriptiveTest}', 'EducationController@descriptiveTestAttachmentsEdit')->name('education.descriptiveTestAttachments.edit');
        Route::put('/descriptive-test/attachments/update/{descriptiveTest}', 'EducationController@descriptiveTestAttachmentsUpdate')->name('education.descriptiveTestAttachments.update');
        Route::delete('/descriptive-test/attachments/destroy/{descriptiveTest}', 'EducationController@descriptiveTestAttachmentsDestroy')->name('education.descriptiveTestAttachments.destroy');
        Route::get('/introduce-book/attachments', 'EducationController@IntroduceBookAttachmentsIndex')->name('education.IntroduceBookAttachmentsIndex');
        Route::post('/introduce-book/attachments', 'EducationController@IntroduceBookAttachmentsStore')->name('education.IntroduceBookAttachmentsStore');
        Route::get('/introduce-book/attachments/edit/{introduceBook}', 'EducationController@IntroduceBookAttachmentsEdit')->name('education.IntroduceBookAttachments.edit');
        Route::put('/introduce-book/attachments/update/{introduceBook}', 'EducationController@IntroduceBookAttachmentsUpdate')->name('education.IntroduceBookAttachments.update');
        Route::delete('/introduce-book/attachments/destroy/{introduceBook}', 'EducationController@IntroduceBookAttachmentsDestroy')->name('education.IntroduceBookAttachments.destroy');
        Route::get('/appendices/attachments/{type?}', 'EducationController@AppendicesAttachmentsIndex')->name('education.AppendicesAttachmentsIndex');
        Route::post('/appendices/attachments', 'EducationController@appendicesAttachmentsStore')->name('education.AppendicesAttachmentsStore');
        Route::get('/appendices/attachments/edit/{appendices}', 'EducationController@AppendicesAttachmentsEdit')->name('education.AppendicesAttachments.edit');
        Route::put('/appendices/attachments/update/{appendices}', 'EducationController@AppendicesAttachmentsUpdate')->name('education.AppendicesAttachments.update');
        Route::delete('/appendices/attachments/destroy/{appendices}', 'EducationController@AppendicesAttachmentsDestroy')->name('education.AppendicesAttachments.destroy');
        Route::get('/books-exercises/attachments', 'EducationController@booksExerciseAttachmentsIndex')->name('education.booksExercisesAttachmentsIndex');
        Route::post('/books-exercises/attachments', 'EducationController@booksExerciseAttachmentsStore')->name('education.booksExercisesAttachmentsStore');
        Route::get('/books-exercises/attachments/edit/{booksExercise}', 'EducationController@booksExerciseAttachmentsEdit')->name('education.booksExercisesAttachments.edit');
        Route::put('/books-exercises/attachments/update/{booksExercise}', 'EducationController@booksExerciseAttachmentsUpdate')->name('education.booksExercisesAttachments.update');
        Route::delete('/books-exercises/attachments/destroy/{booksExercise}', 'EducationController@booksExerciseAttachmentsDestroy')->name('education.booksExercisesAttachments.destroy');
        Route::get('/exam-question-sample/attachments', 'EducationController@ExamQuestionSampleAttachmentsIndex')->name('education.ExamQuestionSampleAttachmentsIndex');
        Route::post('/exam-question-sample/attachments', 'EducationController@ExamQuestionSampleAttachmentsStore')->name('education.ExamQuestionSampleAttachmentsStore');
        Route::get('/exam-question-sample/attachments/edit/{examQuestionSample}', 'EducationController@ExamQuestionSampleAttachmentsEdit')->name('education.ExamQuestionSampleAttachments.edit');
        Route::put('/exam-question-sample/attachments/update/{examQuestionSample}', 'EducationController@ExamQuestionSampleAttachmentsUpdate')->name('education.ExamQuestionSampleAttachments.update');
        Route::delete('/exam-question-sample/attachments/destroy/{examQuestionSample}', 'EducationController@ExamQuestionSampleAttachmentsDestroy')->name('education.ExamQuestionSampleAttachments.destroy');
        Route::get('/general-test', 'EducationController@generalExamBookIndex')->name('education.generalExamBookIndex');
        Route::post('/general-test', 'EducationController@generalExamBookStore')->name('education.generalExamBookStore');
        Route::prefix('/selection-exam')->group(function (){
            Route::prefix('/topic')->group(function (){
                Route::get('/test', 'ExamController@selectionExamTopicTestIndex')->name('education.selectionExam.topic.test.Index');
                Route::post('/test', 'ExamController@selectionExamTopicTestStore')->name('education.selectionExam.topic.test.Store');
                Route::get('/descriptive', 'ExamController@selectionExamTopicDescriptiveTestIndex')->name('education.selectionExam.topic.descriptiveTest.Index');
                Route::post('/descriptive', 'ExamController@selectionExamTopicDescriptiveTestStore')->name('education.selectionExam.topic.descriptiveTest.Store');
            });
            Route::prefix('/standard')->group(function (){
                Route::get('/test', 'ExamController@selectionExamStandardTestIndex')->name('education.selectionExam.standard.test.Index');
                Route::post('/test', 'ExamController@selectionExamStandardTestStore')->name('education.selectionExam.standard.test.Store');
                Route::get('/descriptive', 'ExamController@selectionExamStandardDescriptiveTestIndex')->name('education.selectionExam.standard.descriptiveTest.Index');
                Route::post('/descriptive', 'ExamController@selectionExamStandardDescriptiveTestStore')->name('education.selectionExam.standard.descriptiveTest.Store');
            });
        });
        Route::prefix('/plan-exam')->group(function (){
            Route::prefix('/placement-test')->group(function (){
                Route::get('/test', 'ExamController@planExamTestPlacementTestIndex')->name('education.planExam.placementTest.test.index');
                Route::post('/test', 'ExamController@planExamTestPlacementTestStore')->name('education.planExam.placementTest.test.store');
                Route::get('/descriptive', 'ExamController@planExamDescriptivePlacementTestIndex')->name('education.planExam.placementTest.descriptive.index');
                Route::post('/descriptive', 'ExamController@planExamDescriptivePlacementTestStore')->name('education.planExam.placementTest.descriptive.store');
            });
            Route::get('/test', 'ExamController@planExamTestIndex')->name('education.planExam.test.Index');
            Route::post('/test', 'ExamController@planExamTestStore')->name('education.planExam.test.Store');
            Route::get('/descriptive', 'ExamController@planExamDescriptiveTestIndex')->name('education.planExam.descriptive.Index');
            Route::post('/descriptive', 'ExamController@planExamDescriptiveTestStore')->name('education.planExam.descriptive.Store');
        });
    });
    // identifier //
    Route::prefix('/identifier')->group(function (){
        Route::get('/', 'IdentifierController@index')->name('identifier.index');
        Route::get('/list-users', 'IdentifierController@listUsers')->name('identifier.listUsers');
        Route::get('/excel', 'IdentifierController@excel')->name('identifier.excel');
    });
    // contact //
    Route::prefix('/contact')->group(function (){
        Route::get('/files/{type}/{format?}', 'ContactController@file')->name('contact.file.index');
        Route::get('/teacher-rates', 'ContactController@teacherRate')->name('contact.teacherRate.index');
        Route::get('/list-teachers', 'ContactController@listTeacher')->name('contact.teacherRate.list');
    });

    Route::prefix('/home-setting')->group(function (){
        Route::get('/logo', 'SettingController@logo')->name('setting.logo.index');
        Route::post('/logo', 'SettingController@logo')->name('setting.logo.store');
        Route::get('/grade-agent', 'SettingController@agent')->name('setting.agent.index');
        Route::post('/grade-agent', 'SettingController@agent')->name('setting.agent.store');
        Route::get('/help/{type}', 'SettingController@help')->name('setting.help.index');
        Route::post('/help/{type}', 'SettingController@help')->name('setting.help.store');
        Route::get('/student', 'SettingController@student')->name('setting.student.index');
        Route::post('/student', 'SettingController@student')->name('setting.student.store');
        Route::delete('/student/{studentImage}', 'SettingController@studentDestroy')->name('setting.student.destroy');
        Route::get('/karan-competition', 'SettingController@karanCompetitionIndex')->name('setting.karanCompetition.index');
        Route::post('/karan-competition', 'SettingController@karanCompetitionStore')->name('setting.karanCompetition.store');
        Route::get('/karan-competition/edit/{karanCompetition}', 'SettingController@karanCompetitionEdit')->name('setting.karanCompetition.edit');
        Route::put('/karan-competition/update/{karanCompetition}', 'SettingController@karanCompetitionUpdate')->name('setting.karanCompetition.update');
        Route::delete('/karan-competition/destroy/{karanCompetition}', 'SettingController@karanCompetitionDestroy')->name('setting.karanCompetition.destroy');
        Route::get('/teacher', 'SettingController@teacherIndex')->name('setting.teacherList.index');
        Route::post('/teacher', 'SettingController@teacherStore')->name('setting.teacherList.store');
        Route::get('/teacher/edit/{teacher}', 'SettingController@teacherEdit')->name('setting.teacherList.edit');
        Route::put('/teacher/update/{teacher}', 'SettingController@teacherUpdate')->name('setting.teacherList.update');
        Route::delete('/teacher/destroy/{teacher}', 'SettingController@teacherDestroy')->name('setting.teacherList.destroy');
        Route::get('/teacher-list', 'SettingController@teacherList')->name('setting.teacherList.list');
    });
});

Route::middleware('auth')->group(function () {
    // dashboard //
    Route::prefix('/dashboard')->group(function (){
        Route::prefix('/desktop')->group(function (){
            Route::get('/', 'User\DesktopController@index')->name('user.dashboard.desktop.index');
            Route::get('/contact-us', 'User\DesktopController@contactUsIndex')->name('user.dashboard.contactUs.index');
            Route::post('/contact-us', 'User\DesktopController@contactUsStore')->name('user.dashboard.contactUs.store');
            Route::delete('/contact-us/{userFile}', 'User\DesktopController@contactUsDestroy')->name('user.dashboard.contactUs.destroy');
            Route::get('/rate-teacher', 'User\DesktopController@rateTeachersIndex')->name('user.dashboard.rateTeacher.index');
            Route::post('/rate-teacher', 'User\DesktopController@rateTeachersStore')->name('user.dashboard.rateTeacher.store');
            Route::get('/speak-to-student', 'User\DesktopController@speakToStudent')->name('user.dashboard.speakToStudent.index');
            Route::get('/news', 'User\DesktopController@news')->name('user.dashboard.news.index');
            Route::prefix('/user-file')->group(function (){
                Route::get('/', 'User\DesktopController@UserFileIndex')->name('user.dashboard.UserFile.index');
                Route::post('/', 'User\DesktopController@UserFileStore')->name('user.dashboard.UserFile.store');
                Route::get('/edit/{userFile}', 'User\DesktopController@UserFileEdit')->name('user.dashboard.UserFile.edit');
                Route::put('/update/{userFile}', 'User\DesktopController@UserFileUpdate')->name('user.dashboard.UserFile.update');
                Route::delete('/destroy/{userFile}', 'User\DesktopController@UserFileDestroy')->name('user.dashboard.UserFile.destroy');
            });
            Route::prefix('/exam-report')->group(function (){
                Route::get('/', 'User\DesktopController@examReportIndex')->name('user.dashboard.examReport.index');
            });
            Route::prefix('/schedule')->group(function (){
                Route::post('/', 'User\DesktopController@scheduleStore')->name('user.dashboard.schedule.store');
                Route::put('/update/{schedule}', 'User\DesktopController@scheduleUpdate')->name('user.dashboard.schedule.update');
                Route::delete('/destroy/{schedule}', 'User\DesktopController@scheduleDestroy')->name('user.dashboard.schedule.destroy');
                Route::get('/edit/{schedule}/{type?}/{lesson?}', 'User\DesktopController@scheduleEdit')->name('user.dashboard.schedule.edit');
                Route::get('/{type?}/{lesson?}', 'User\DesktopController@scheduleIndex')->name('user.dashboard.schedule.index');
            });
            Route::prefix('/study-process')->group(function (){
                Route::get('/{period?}', 'User\DesktopController@studyProcess')->name('user.dashboard.studyProcess.index');
            });
        });
        Route::prefix('/entry-panel')->group(function (){
            Route::get('/', 'User\EntryPanelController@index')->name('user.dashboard.entryPanel.index');
            Route::put('/{user}', 'User\EntryPanelController@update')->name('user.dashboard.entryPanel.update');
        });
    });
});


//Route::get('/home', function (){
//    return redirect()->route('grades');
//})->name('home');

Route::post('/ckeditor/upload','CKeditorController@upload')->name('ckeditor.upload');

// UserManagement //
Route::post('/registerUser', 'SubmitUserController@store')->name('register-user');

Route::get('/', [SiteController::class, 'grades'])->name('grades');

Route::get('/download-document/{document}', [DocumentController::class, 'downloadDocument'])->name('downloadDocument');
Route::get('/download-audio/{test}', [DocumentController::class, 'downloadAudio'])->name('downloadAudio');

Route::get('/lessons/{gradeId}', [SiteController::class, 'lessons'])->name('lessons');

Route::get('/lessons/{lesson}/choose-lesson-item', [SiteController::class, 'chooseLessonItem'])->name('lesson.chooseLessonItem');

Route::get('/lessons/{lesson}/choose-selection-exam-item', [SiteController::class, 'chooseSelectionExamItem'])->name('lesson.chooseSelectionExamItem');

Route::get('/lessons/{lesson}/choose-selection-exam-standard-session', [SiteController::class, 'chooseSelectionExamStandardSession'])->name('lesson.chooseSelectionExamStandardSession');

Route::get('/lessons/{book}/choose-selection-exam-standard', [SiteController::class, 'chooseSelectionExamStandard'])->name('lesson.chooseSelectionExamStandard');

Route::get('/lessons/{book}/choose-appendices-item', [SiteController::class, 'chooseAppendicesItem'])->name('appendices.chooseAppendicesItem');

Route::get('/lessons/{lesson}/choose-book-exercise-session', [SiteController::class, 'chooseExamQuestionSampleSession'])->name('lesson.chooseBookExerciseSession');

Route::get('/book/{book}', [SiteController::class, 'book'])->name('book');
Route::get('/book/session/{lessonId}/{operation?}', [SiteController::class, 'sessionBook'])->name('sessionBook');
Route::get('/book/introduce/{book}', [SiteController::class, 'introduceBook'])->name('introduceBook');

Route::get('/karanbala/{grade}', 'GradeController@karanBala')->name('grade.karanbala');

Route::get('/online-contact', [SiteController::class, 'onlineContact'])->name('onlineContact');
Route::get('/about-us', [SiteController::class, 'aboutUs'])->name('aboutUs');

Route::get('/overview/lesson/{lesson}', [SiteController::class, 'overviewBook'])->name('overview.book');
Route::get('/overview/textBook/{topic}', [SiteController::class, 'textBook'])->name('overview.textBook');
Route::get('/overview/descriptive/{topic}', [SiteController::class, 'descriptive'])->name('overview.descriptive');
Route::get('/overview/examBook/{topic}', [SiteController::class, 'examBook'])->name('overview.examBook');
Route::get('/overview/appendices/{book}/{type?}', [SiteController::class, 'appendices'])->name('overview.appendices');
Route::get('/overview/test/{topic}', [SiteController::class, 'test'])->name('overview.test');
Route::get('/overview/examQuestionSample/{item}/{period?}', [SiteController::class, 'examQuestionSample'])->name('overview.examQuestionSample');
Route::get('/overview/generalTest/{book}', [SiteController::class, 'generalTest'])->name('overview.generalTest');
Route::get('/overview/bookExercises/{book}', [SiteController::class, 'bookExercises'])->name('overview.bookExercises');
Route::get('/overview/karanBala/{topic}', [SiteController::class, 'karanBala'])->name('overview.karanBala');

Route::prefix('/exam')->middleware('auth')->group(function (){
    Route::get('/{item}', [SiteController::class, 'exam'])->name('exam');
    Route::get('/select-exam/{item}', [SiteController::class, 'selectExam'])->name('exam.index');
    Route::get('/create/{exam}/', [SiteController::class, 'createExam'])->name('exam.create');
    Route::get('/view/{userExamAnswer}/', [SiteController::class, 'examView'])->name('exam.view');
    Route::post('/{userExamAnswer}/submit-exam/', [SiteController::class, 'submitExam'])->name('exam.submitExam');
    Route::get('/result/{userExamAnswer}', [SiteController::class, 'examResult'])->name('exam.result');
    Route::post('/submit-general-tests', [SiteController::class, 'submitGeneralTests'])->name('generalTest.submitGeneralTests');
    Route::prefix('/karan-bala')->group(function (){
        Route::get('choose-exam-type', [SiteController::class, 'chooseExamType'])->name('karanBala.exam.chooseExamType');
        Route::prefix('/placement-test')->group(function (){
//            Route::get('/', 'User\PlacementTestController@index')->name('user.dashboard.exam');
            Route::get('/choose-lesson', 'User\PlacementTestController@chooseLesson')->name('user.dashboard.exam.placementTest.chooseLesson');
            Route::get('/find-exam/{lesson}', 'User\PlacementTestController@findExam')->name('user.dashboard.exam.placementTest.findExam');
            Route::get('/analyse-test/{userExamAnswer}', 'User\PlacementTestController@analyseTest')->name('user.dashboard.exam.placementTest.analyseTest');
            Route::get('/topics', 'User\PlacementTestController@topics')->name('user.dashboard.exam.placementTest.topics');
        });
    });
});
