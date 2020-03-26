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

Route::get('/recursion','RecursionController@allChildAccounts');
Route::get('/recure','RecureController@fib');


Route::group(['prefix'=>'/admin','middleware' => 'roles','roles' => ['Admin']], function () {
    Route::get('/', function () {
        return view('admin');
    })->name('admin');

Route::get('/admin', [
       'uses' => 'AppController@getAdminPage',
       'as' => 'admin',
       'middleware' => 'roles',
       'roles' => ['Admin']
   ]);

   Route::post('/admin/assign-roles', [
           'uses' => 'AppController@postAdminAssignRoles',
           'as' => 'admin.assign',
           'middleware' => 'roles',
           'roles' => ['Admin']
       ]);

       Route::get('/signup', [
        'uses' => 'AuthController@getSignUpPage',
        'as' => 'signup'
    ]);
    Route::post('/signup', [
        'uses' => 'AuthController@postSignUp',
        'as' => 'signup'
    ]);
    Route::get('/import_excel_user', 'ImportExcelController@userimport');
    Route::get('/import_excel_block', 'ImportExcelController@blockimport');

    Route::post('/import_excel/importuser', 'ImportExcelController@importuser');
    Route::post('/import_excel/importblock', 'ImportExcelController@importblock');
    Route::post('/import_excel/importcustomer', 'ImportExcelController@importcustomer');
    Route::post('/import_excel/importcar', 'ImportExcelController@importcar');
    Route::post('/import_excel/importshow', 'ImportExcelController@importshow');
    Route::get('/import_excel/userdata', 'ImportExcelController@getuserdata');
    Route::get('/import_excel/structuredata', 'ImportExcelController@getstructuredata');

    Route ::resource('peradmin','PerAdminController');
    Route::post('peradmin/search', 'PerAdminController@search')->name('peradmin.search');

    Route::resource('/userauth', 'UserAuthController');
    Route::post('/userauth/search', 'UserAuthController@search')->name('userauth.search');

    Route::post('user-management/search', 'UserManagementController@search')->name('user-management.search');
    Route::resource('user-management', 'UserManagementController');

    Route::resource('employee-management', 'EmployeeManagementController');
    Route::post('employee-management/search', 'EmployeeManagementController@search')->name('employee-management.search');

    Route::resource('/structure', 'StructureController');
    Route::post('/structure/search', 'StructureController@search')->name('structure.search');

    Route::resource('/server', 'ServerController');
    Route::post('/server/search', 'ServerController@search')->name('server.search');

    Route::resource('/portreflink', 'PortRefLinkController');
    Route::post('/portreflink/search', 'PortRefLinkController@search')->name('portreflink.search');
	Route::resource('/membertype', 'MemberTypeController');
    Route::post('/membertype/search', 'MemberTypeController@search')->name('membertype.search');

    Route::resource('/block', 'BlockController');
    Route::post('/block/search', 'BlockController@search')->name('block.search');

    Route::resource('system-management/country', 'CountryController');
    Route::post('system-management/country/search', 'CountryController@search')->name('country.search');

    Route::post('addCountry', 'CountryController@add');


    Route::resource('system-management/state', 'StateController');
    Route::post('system-management/state/search', 'StateController@search')->name('state.search');

    Route::resource('system-management/city', 'CityController');
    Route::post('system-management/city/search', 'CityController@search')->name('city.search');

    Route::resource('/porttype', 'PortTypeController');
    Route::post('/porttype/search', 'PortTypeController@search')->name('porttype.search');
    Route::resource('/portcat', 'PortCatController');
    Route::post('/portcat/search', 'PortCatController@search')->name('portcat.search');
	  Route::resource('/portfolioadmin', 'PortfolioAdminController');
    Route::post('/portfolioadmin/search', 'PortfolioAdminController@search')->name('portfolioadmin.search');
    Route::get('/portfolioadmin/{dep}','PortfolioAdminController@portDep');
    Route::get('/portfolioadmin/{block}','PortfolioAdminController@portblock');
    Route::get('/portfolioadmin','PortfolioAdminController@index');
    Route::get('/portfolioadmin/shows/{id}',['uses'=>'PortfolioAdminController@showdetail']);
    Route::get('/portfolioadmin/uploadfile/{id}',['uses'=>'PortfolioAdminController@gotoup']);
    Route::get('/portfolioadmin/port/file/{id}',['uses'=>'PortfolioAdminController@portfile']);
    Route::get('/portfolioadmin/uploadfile/{id}/{portnumber}/{fileportref}{cat}/{ref}/{filerefname}',['uses'=>'FileAdminController@create']);
    Route::get('/portfolioadmin/editfile/{id}/{portnumber}/{fileportref}{cat}/{ref}/{filerefname}/{fileid}',['uses'=>'FileAdminController@edit']);
    Route::post('/portfileup','FileAdminController@change')->name('file.change');
    Route::get('/showfile/{id}',['uses'=>'PortfolioAdminController@showfile']);
    //Route::post('/portfolioadmin/fixup','FileAdminController@fixup')->name('file.fix');
    Route::match(['put', 'patch'], '/file/fixup/{id}','FileAdminController@fixup')->name('file.fix');

        Route::get('/file/fix/{id}','FileAdminController@fix');

	  Route::resource('/notiadmin', 'NotiAdminController');
    Route::post('/notiadmin/search', 'NotiAdminController@search')->name('notiadmin.search');

	Route::resource('/message_category', 'MessageCategoryController');
    Route::post('/message_category/search', 'MessageCategoryController@search')->name('message_category.search');

    Route::resource('/message-type', 'MessageTypeController');
    Route::post('/message-type/search', 'MessageTypeController@search')->name('message-type.search');

	  Route::resource('/match-id', 'MatchIdController');
    Route::post('/match-id/search', 'MatchIdController@search')->name('match-id.search');


    Route::resource('usergroup', 'UserGroupController');
    Route::post('usergroup/search', 'UserGroupController@search')->name('usergroup.search');

    Route::resource('memgroup', 'MemberGroupController');
    Route::post('memgroup/search', 'MemberGroupController@search')->name('memgroup.search');

    Route::resource('pidgroup', 'PidGroupController');
    Route::post('pidgroup/search', 'PidGroupController@search')->name('pidgroup.search');

    Route::resource('/match-user-group', 'MatchUserIdController');
    Route::post('/match-user-group/search', 'MatchUserIdController@search')->name('match-user-group.search');

    Route::resource('/match-member-group', 'MatchMemberIdController');
    Route::post('/match-member-group/search', 'MatchMemberIdController@search')->name('match-member-group.search');
    Route::get('/academicmember', 'MatchMemberIdController@wealththai');

    Route::resource('/match-pid-group', 'MatchPidIdController');
    Route::post('/match-pid-group/search', 'MatchPidIdController@search')->name('match-pid-group.search');

    Route::resource('/permission', 'PermissionController');
    Route::post('/permission/search', 'PermissionController@search')->name('permission.search');


	Route::resource('/view', 'ViewController');
    Route::post('/view/search', 'ViewController@search')->name('view.search');

    Route::resource('/service', 'ServiceCenterController');
    Route::post('/service/search', 'ServiceCenterController@search')->name('service.search');
    //Route::post('/service/save','ServiceCenterController@store')->name('servicecenter.store');

    Route::resource('/serviceform', 'ServiceFormController');
    Route::post('/serviceform/search', 'ServiceFormController@search')->name('serviceform.search');
    Route::post('/serviceform/sent', 'ServiceFormController@sentservice')->name('serviceform.sentservice');


    Route::resource('/view-member', 'ViewperController');
    Route::post('/view-member/search', 'ViewperController@search')->name('view-member.search');

	Route::resource('/match-view', 'MatchViewController');
    Route::post('/match-view/search', 'MatchViewController@search')->name('match-view.search');

    Route::resource('/match-view-member', 'MatchViewperController');
      Route::post('/match-view-member/search', 'MatchViewperController@search')->name('match-view-member.search');


    Route::resource('usergroup', 'UserGroupController');
    Route::post('usergroup/search', 'UserGroupController@search')->name('usergroup.search');

    Route::resource('memgroup', 'MemberGroupController');
    Route::post('memgroup/search', 'MemberGroupController@search')->name('memgroup.search');

    Route::resource('pidgroup', 'PidGroupController');
    Route::post('pidgroup/search', 'PidGroupController@search')->name('pidgroup.search');


    Route::resource('/group-of-service', 'GroupOfServiceController');
    Route::post('/group-of-service/search', 'GroupOfServiceController@search')->name('group-of-service.search');

    Route::resource('/type-of-service', 'TypeOfServiceController');
    Route::post('/type-of-service/search', 'TypeOfServiceController@search')->name('type-of-service.search');



    Route::resource('/event-type', 'EventTypeController');
    Route::post('/event-type/search', 'EventTypeController@search')->name('event-type.search');

    Route::resource('/file-auth', 'FileAuthController');
    Route::post('/file-auth/search', 'FileAuthController@search')->name('file-auth.search');

    Route::resource('/event', 'EventController');
    Route::get('/event/show/{id}',['uses'=>'EventController@showevent']);
    Route::post('/event/search', 'EventController@search')->name('event.search');

    Route::resource('/file-cat', 'FileCategoryController');
    Route::post('/file-cat/search', 'FileCategoryController@search')->name('file-cat.search');
    Route::resource('/file-cat-group', 'FileCategoryGroupController');
    Route::post('/file-cat-group/search', 'FileCategoryGroupController@search')->name('file-cat-group.search');


    Route::resource('/file-package', 'FilePackageController');
    Route::post('/file-package/search', 'FilePackageController@search')->name('file-package.search');

    Route::resource('/file-packagecat', 'FilePackagecatController');
    Route::post('/file-packagecat/search', 'FilePackagecatController@search')->name('file-packagecat.search');

    Route::resource('/file', 'FileController');
    Route::post('/file/search', 'FileController@search')->name('file.search');



    Route::get('/event/{id}',['uses'=>'EventController@mem']);
    Route::get('/user/resetpassword/{id}',['uses'=>'UserManagementController@repassword']);
  //  Route::post('/uppass/{id}','UserManagementController@uppass');
    Route::match(['put', 'patch'], '/uppass/{id}','UserManagementController@uppass');
    Route::get('/member/resetpassword/{id}',['uses'=>'PerAdminController@repassword']);
    Route::match(['put', 'patch'], 'member/uppass/{id}','PerAdminController@uppass');



    Route::get('/typelists/{org}', 'ServiceFormController@listtype');

    Route::resource('/asset-category', 'AssetCategoryController');
    Route::post('/asset-category/search', 'AssetCategoryController@search')->name('asset-category.search');
    Route::resource('/asset-status', 'AssetStatusController');
    Route::post('/asset-status/search', 'AssetStatusController@search')->name('asset-status.search');

    Route::resource('/asset-type', 'AssetTypeController');
    Route::post('/asset-type/search', 'AssetTypeController@search')->name('asset-type.search');
    Route::resource('/port-asset', 'PortAssetTypeController');
    Route::post('/port-asset/search', 'PortAssetTypeController@search')->name('port-asset.search');

    Route::resource('/asset-attachment', 'AssetAttachtController');
    Route::post('/asset-attachment/search', 'AssetAttachtController@search')->name('asset-attachment.search');
    Route::resource('/asset-transaction', 'AssetTransactionController');
    Route::resource('/asset-admin', 'AssetAdminController');
    Route::get('/assetadmin/fetch_data', 'AssetAdminController@fetch_data');
    Route::post('/asset-admin/search', 'AssetAdminController@search')->name('asset-admin.search');
    Route::resource('/party', 'PartyController');
    Route::post('/party/search', 'PartyController@search')->name('party.search');

    Route::resource('/province', 'ProvinceController');
    Route::post('/province/search', 'ProvinceController@search')->name('province.search');
    Route::resource('/district', 'DistrictController');
    Route::post('/district/search', 'DistrictController@search')->name('district.search');
    Route::resource('/subdistrict', 'SubDistrictController');
    Route::post('/subdistrict/search', 'SubDistrictController@search')->name('subdistrict.search');
    Route::get('/portfolio/asset/{id}',['uses'=>'AssetController@ownassetadmin']);
    Route::get('/pagination/fetch_data', 'UserManagementController@fetch_data');
    Route::get('/assetcat/fetch_data', 'AssetCategoryController@fetch_data');
    Route::resource('/leadstatus', 'LeadStatusController');
    Route::post('/leadstatus/search', 'LeadStatusController@search')->name('leadstatus.search');
	    Route::resource('/event-regis-status', 'EventRegisStatusController');
    Route::post('/event-regis-status/search', 'EventRegisStatusController@search')->name('event-regis-status.search');

	Route::resource('/policy', 'PolicyController');
    Route::post('/policy/search', 'PolicyController@search')->name('policy.search');


	    Route::resource('/tool-category', 'ToolCategoryController');
    Route::post('/tool-category/search', 'ToolCategoryController@search')->name('tool-category.search');

    Route::resource('/tool-type', 'ToolTypeController');
    Route::post('/tool-type/search', 'ToolTypeController@search')->name('tool-type.search');

    Route::resource('/term-of-payment', 'TermOfPaymentController');
    Route::post('/term-of-payment/search', 'TermOfPaymentController@search')->name('term-of-payment.search');

    Route::resource('/tooladmin', 'ToolAdminController');
    Route::post('/tooladmin/search', 'ToolAdminController@search')->name('tooladmin.search');

    Route::resource('/member-tool-status', 'MemberToolStatusController');
    Route::post('/member-tool-status/search', 'MemberToolStatusController@search')->name('member-tool-status.search');

    Route::resource('/toolsetadmin', 'ToolSetAdminController');
    Route::post('/toolsetadmin/search', 'ToolSetAdminController@search')->name('toolsetadmin.search');

    Route::resource('/toolpackageadmin', 'ToolPackageAdminController');
    Route::post('/toolpackageadmin/search', 'ToolPackageAdminController@search')->name('toolpackageadmin.search');

    Route::resource('/tool-package-to-set', 'ToolPackageToSetController');
    Route::post('/tool-package-to-set/search', 'ToolPackageToSetController@search')->name('tool-package-to-set.search');

    Route::resource('/member-tool-admin', 'MemberToolAdminController');
    Route::post('/member-tool-admin/search', 'MemberToolAdminController@search')->name('member-tool-admin.search');

    Route::resource('/tool-order-status', 'ToolOrderStatusController');
    Route::post('/tool-order-status/search', 'ToolOrderStatusController@search')->name('tool-order-status.search');

    Route::resource('/tool-order', 'ToolOrderController');
    Route::post('/tool-order/search', 'ToolOrderController@search')->name('tool-order.search');
    Route::get('/tool-order/invoice/{id}', 'ToolOrderController@invoice');
    Route::get('/tool-order-changestatus/{id}/{number}', 'ToolOrderController@changeorderstatus');

	    Route::resource('/tool-status', 'ToolStatusController');
    Route::post('/tool-status/search', 'ToolStatusController@search')->name('tool-status.search');

Route::resource('/onlinetool', 'OnlineToolController');
Route::post('/onlinetool/search', 'OnlineToolController@search')->name('onlinetool.search');
Route::get('/onlinetool/update/status', 'OnlineToolController@updatestatus');

Route::resource('/onlinetoollog', 'OnlineToolLogController');
Route::post('/onlinetoollog/search', 'OnlineToolLogController@search')->name('onlinetoollog.search');


	    Route::resource('/leadadmin', 'LeadAdminController');
    Route::post('/leadadmin/searchnormal', 'LeadAdminController@searchnormal')->name('leadadmin.searchnormal');
    Route::post('/leadadmin/search', 'LeadAdminController@search')->name('leadadmin.search');
    Route::get('/leadadminchangstatus/{id}/{statusid}', 'LeadAdminController@changestatus');
    Route::get('/leadadminchangpriority/{id}/{number}', 'LeadAdminController@changepriority');



	Route::resource('/prospectadmin', 'ProspectAdminController');
Route::get('/convert/prospectadmin/{id}', 'ProspectAdminController@convert');
Route::post('/prospectadmin/searchnormal', 'ProspectAdminController@searchnormal')->name('prospectadmin.searchnormal');
Route::post('/prospectadmin/search', 'ProspectAdminController@search')->name('prospectadmin.search');
Route::get('/prospectadmin/status/{id}/{statusid}', 'ProspectAdminController@changestatus');
Route::get('/prospectadmin/priority/{id}/{number}', 'ProspectAdminController@changepriority');
Route::get('/prospectadmin/type/{id}/{number}', 'ProspectAdminController@changetype');


Route::resource('/partnermanage', 'PartnerController');
Route::post('/partnermanage/search', 'PartnerController@search')->name('partnermanage.search');

Route::post('/partnerregister/search', 'PartnerController@search')->name('partnerregister.search');
Route::get('/selectmember', 'PartnerController@selectmember');



Route::get('/changestatuspartner/{statusid}/{pid}', 'PartnerController@changestatuspartner');
Route::resource('/viewpartner', 'ViewpartnerController');
Route::post('/viewpartner/search', 'ViewpartnerController@search')->name('viewpartner.search');


Route::resource('/match-view-partner', 'MatchViewpartnerController');
Route::post('/match-view-partner/search', 'MatchViewpartnerController@search')->name('match-view-partner.search');

Route::resource('/partnergroup', 'PartnerGroupController');
Route::post('/partnergroup/search', 'PartnerGroupController@search')->name('partnergroup.search');
Route::resource('/match-partner-group', 'MatchPartnerGroupController');
Route::post('/match-partner-group/search', 'MatchPartnerGroupController@search')->name('match-partner-group.search');


Route::resource('/partnerstructure', 'PartnerStructureController');
Route::post('/partnerstructure/search', 'PartnerStructureController@search')->name('partnerstructure.search');
Route::resource('/partnerblock', 'PartnerBlockController');
Route::post('/partnerblock/search', 'PartnerBlockController@search')->name('partnerblock.search');
Route::resource('/partnerauth', 'PartnerAuthController');
Route::post('/partnerauth/search', 'PartnerAuthController@search')->name('partnerauth.search');


Route::resource('/case-category', 'CaseCategoryController');
Route::post('/case-category/search', 'CaseCategoryController@search')->name('case-category.search');

Route::resource('/case-type', 'CaseTypeController');
Route::post('/case-type/search', 'CaseTypeController@search')->name('case-type.search');

Route::resource('/case-middle-data-type', 'CaseMiddledataTypeController');
Route::post('/case-middle-data-type/search', 'CaseMiddledataTypeController@search')->name('case-middle-data-type.search');

Route::resource('/case-middle-data', 'CaseMiddledataController');
Route::post('/case-middle-data/search', 'CaseMiddledataController@search')->name('case-middle-data.search');


Route::resource('/cases', 'CasesController');
Route::post('/cases/search', 'CasesController@search')->name('cases.search');

Route::resource('/case-auth', 'CaseAuthController');
Route::post('/case-auth/search', 'CaseAuthController@search')->name('case-auth.search');


Route::resource('/procedures', 'ProceduresController');
Route::post('/procedures/search', 'ProceduresController@search')->name('procedures.search');

Route::resource('/stage', 'StageController');
Route::post('/stage/search', 'StageController@search')->name('stage.search');

Route::resource('/process', 'ProcessController');
Route::post('/process/search', 'ProcessController@search')->name('process.search');

Route::resource('/procedures-to-process', 'ProceduresToProcessController');
Route::post('/procedures-to-process/search', 'ProceduresToProcessController@search')->name('procedures-to-process.search');


Route::resource('/path', 'PathController');
Route::post('/path/search', 'PathController@search')->name('path.search');


Route::resource('/conditiontype', 'ConditionTypeController');
Route::post('/conditiontype/search', 'ConditionTypeController@search')->name('conditiontype.search');

Route::resource('/condition', 'ConditionController');
Route::post('/condition/search', 'ConditionController@search')->name('condition.search');

Route::resource('/casecondition', 'CaseConditionController');
Route::post('/casecondition/search', 'CaseConditionController@search')->name('casecondition.search');

Route::resource('/pathcondition', 'PathConditionController');
Route::post('/pathcondition/search', 'PathConditionController@search')->name('pathcondition.search');

Route::resource('/proposal', 'ProposalController');
Route::post('/proposal/search', 'ProposalController@search')->name('proposal.search');


Route::resource('/offer-category', 'OfferCategoryController');
Route::post('/offer-category/search', 'OfferCategoryController@search')->name('offer-category.search');

Route::resource('/offertype', 'OfferTypeController');
Route::post('/offertype/search', 'OfferTypeController@search')->name('offertype.search');

Route::resource('/offer', 'OfferController');
Route::post('/offer/search', 'OfferController@search')->name('offer.search');


Route::resource('/campaign', 'CampaignController');
Route::post('/campaign/search', 'CampaignController@search')->name('campaign.search');

Route::resource('/promotion', 'PromotionController');
Route::post('/promotion/search', 'PromotionController@search')->name('promotion.search');


Route::resource('/action-category', 'ActionCategoryController');
Route::post('/action-category/search', 'ActionCategoryController@search')->name('action-category.search');

Route::resource('/action-type', 'ActionTypeController');
Route::post('/action-type/search', 'ActionTypeController@search')->name('action-type.search');
Route::resource('/stageaction', 'StageActionController');
Route::post('/stageaction/search', 'StageActionController@search')->name('stageaction.search');
Route::resource('/action', 'ActionController');
Route::post('/action/search', 'ActionController@search')->name('action.search');

Route::resource('/caseaction', 'CaseActionController');
Route::post('/caseaction/search', 'CaseActionController@search')->name('caseaction.search');


Route::resource('/caseproposal', 'CaseProposalController');
Route::post('/caseproposal/search', 'CaseProposalController@search')->name('caseproposal.search');

Route::resource('/pathconditiondetail', 'PathConditionDetailController');
Route::post('/pathconditiondetail/search', 'PathConditionDetailController@search')->name('pathconditiondetail.search');

Route::resource('/case-type-config', 'CaseTypeConfigController');
Route::post('/case-type-config/search', 'CaseTypeConfigController@search')->name('case-type-config.search');

Route::resource('/case-report', 'CaseReportController');
Route::post('/case-report/search', 'CaseReportController@search')->name('case-report.search');

Route::resource('/case-type-report', 'CaseTypeReportController');
Route::post('/case-type-report/search', 'CaseTypeReportController@search')->name('case-type-report.search');

Route::resource('/case-subtype', 'CaseSubTypeController');
Route::post('/case-subtype/search', 'CaseSubTypeController@search')->name('case-subtype.search');

Route::resource('/case-log', 'CaseLogController');
Route::post('/case-log/search', 'CaseLogController@search')->name('case-log.search');

Route::post('/updatepathcondition','CaseAjaxController@updatepathcondition');
Route::post('/createactiontostage','CaseAjaxController@createactiontostage');
Route::get('/deleteaction','StageController@deleteaction');

Route::resource('/case-status', 'CaseStatusController');
Route::post('/case-status/search', 'CaseStatusController@search')->name('case-status.search');

Route::resource('/case-channel', 'CaseChannelController');
Route::post('/case-channel/search', 'CaseChannelController@search')->name('case-channel.search');
});


Route::resource('/eventmarketing', 'EventMarketingController');
Route::get('/eventmarketing/show/{id}',['uses'=>'EventMarketingController@showevent']);
Route::post('/eventmarketing/search', 'EventMarketingController@search')->name('eventmarketing.search');
//Route::get('/profile/{username}','PerProfileController@profile');
//Route::get('/edit/{username}','EditprofileController@profile');
Route::get('noti/reply/{id}',['as'=>'edit/reply','uses'=>'NotiController@reply']);

Route::get('noti/forward/{id}',['as'=>'edit/forward','uses'=>'NotiController@forward']);

Route::prefix('/MessageCenter')->group(function() {
  Route::post('/noti/notigroup', 'NotiController@notigroup')->name('noti.notigroup');
  Route::get('/noti/sent-to-group','NotiController@creategroup')->name('noti.creategroup');

Route::resource('/ccnoti', 'CCNotiController');
Route::post('/ccnoti/search', 'CCNotiController@search')->name('ccnoti.search');


Route::get('noti/show/{id}',['as'=>'edit/show','uses'=>'NotiController@show']);
Route::resource('/noti', 'NotiController');
Route::post('/noti/search', 'NotiController@search')->name('noti.search');
Route::get('/noti-sentbox','NotiController@sentbox');
Route::post('/noti-sentbox/search', 'NotiController@searchsentbox')->name('noti.searchsentbox');
Route::get('/noti-inbox','NotiController@inbox');
Route::post('/noti-inbox/search', 'NotiController@searchinbox')->name('noti.searchinbox');
});

Route::resource('system-management/notiper', 'NotiperController');
Route::post('system-management/notiper/search', 'NotiperController@search')->name('notiper.search');
Route::get('sentbox','NotiperController@sentbox');
Route::post('sentbox/search', 'NotiperController@searchsentbox')->name('notiper.searchsentbox');
Route::get('inbox','NotiperController@inbox');
Route::post('inbox/search', 'NotiperController@searchinbox')->name('notiper.searchinbox');



Route ::resource('perregis','PerregisController');
Route ::get('quickregister','QuickregisController@create');
Route ::post('quickregister/store','QuickregisController@store')->name('quickregis.store');
Route::get('message/forward/{id}',['as'=>'edit/forward','uses'=>'NotiperController@forward']);
Route::get('message/reply/{id}',['as'=>'edit/reply','uses'=>'NotiperController@reply']);
Route::post('/person/register','Auth\RegistePersonController@store');


Route::get('/wealth', function () {
    return view('dashboard');
})->middleware('auth');

Auth::routes();

Route::prefix('/wealththaiagent')->group(function() {
Route::get('/','Auth\LoginController@showLoginForm')->name('login');
Route::post('/','Auth\LoginController@login')->name('login.submit');
Route::post('/','Auth\LoginController@login',[ 'before' => 'throttle:2,60', 'uses' => 'AuthController@postLogin'])->name('login.submit');





Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

Route::get('/password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/reset','Auth\ResetPasswordController@reset');
Route::get('/password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');


});
Route::get('logout','Auth\LoginController@logout')->name('logout');


Route::get('/dashboard', 'DashboardController@index');
// Route::get('/system-management/{option}', 'SystemMgmtController@index');
Route::prefix('/')->group(function() {
Route::get('/','Auth\PersonLoginController@showLoginForm')->name('person.login');
Route::post('/','Auth\PersonLoginController@login')->name('person.login.submit');
Route::get('/person','PersonController@index')->name('person.dashboard');
Route::get('show','PersonController@show')->name('person.portfolio');

Route::get('portshow','PersonController@portshow')->name('person.portfolio');

Route::get('portshoworg','PersonController@portshoworg');
Route::get('/portshoworgs/{org}','PersonController@org');

Route::get('portshowgroup','PersonController@portshowgroup');
Route::get('portshowgroups/{org}','PersonController@group');

Route::get('referallink','PersonController@ref');
//Route::get('note','PersonController@note')->name('person.note');

Route::get('create','PersonController@create');
Route::get('logout','Auth\PersonLoginController@logout')->name('person.logout');


Route::post('/password/email', 'Auth\PersonForgotPasswordController@sendResetLinkEmail')->name('person.password.email');

Route::get('/password/reset','Auth\PersonForgotPasswordController@showLinkRequestForm')->name('person.password.request');
Route::post('/password/reset','Auth\PersonResetPasswordController@reset');
Route::get('/password/reset/{token}','Auth\PersonResetPasswordController@showResetForm')->name('person.password.reset');


});
Route::get('/note/{id}',['as'=>'edit/note','uses'=>'PersonController@note']);

Route::resource('/organize', 'OrganizeController');
Route::post('/organize/search', 'OrganizeController@search')->name('organize.search');

Route::resource('/organizeauth', 'OrganizeAuthController');
Route::post('/organizeauth/search', 'OrganizeAuthController@search')->name('organizeauth.search');
//Route::get('/organizeauths/{org}','OrganizeAuthController@org');
Route::get('/organizelist', 'OrganizeAuthController@index');
Route::get('/organizelists/{org}', 'OrganizeAuthController@org');
Route::get('/organize/port/{id}', 'OrganizeController@portorg');
Route::get('/organize/member/{id}', 'OrganizeController@memberorg');
Route::delete('/organize/leave/{id}',array('uses' => 'OrganizeController@leaveorg', 'as' => 'leave.org'));
Route::get('/organizerequest', 'OrganizeAuthController@request');
Route::patch('/organizeauth/update/{id}','OrganizeAuthController@updaterequest')->name('organizeauth.updaterequest');

Route::resource('/organizeauth', 'OrganizeAuthController');
Route::post('/organizeauth/search', 'OrganizeAuthController@search')->name('organizeauth.search');
Route::resource('/family', 'FamilyController');
Route::get('/family/port/{id}', 'FamilyController@portgroup');


Route::delete('/family/leave/{id}',array('uses' => 'FamilyController@leavegroup', 'as' => 'leave.group'));
Route::patch('/family/update/{id}','FamilyController@approve')->name('family.approve');


Route::post('/family/search', 'FamilyController@search')->name('family.search');

Route::get('/familyauth/list/{id}', 'FamilyAuthController@home');

Route::resource('/familyauth', 'FamilyAuthController');
Route::get('/familylist', 'FamilyAuthController@list');
Route::get('/familylists/{org}', 'FamilyAuthController@listgroup');

Route::get('/familyrequest', 'FamilyAuthController@request');
Route::patch('/familyauth/update/{id}','FamilyAuthController@updaterequest')->name('familyauth.updaterequest');


Route::post('/familyauth/search', 'FamilyAuthController@search')->name('familyauth.search');

Route::resource('/portauth', 'PortAuthController');
Route::post('/portauth/search', 'PortAuthController@search')->name('portauth.search');

Route::resource('/portorgauth', 'PortOrgAuthController');
Route::post('/portorgauth/search', 'PortOrgAuthController@search')->name('portorgauth.search');


Route::resource('/portgroupauth', 'PortGroupAuthController');
Route::post('/portgroupauth/search', 'PortGroupAuthController@search')->name('portgroupauth.search');

Route::get('message/show/{id}',['as'=>'edit/show','uses'=>'NotiperController@show']);

Route::post('/update','PersonController@update');

Route::get('/profile', 'ProfileController@index');








Route::prefix('/SecurityBroke')->group(function() {
//portfolio
Route::resource('/file', 'FileController');
Route::post('/file/search', 'FileController@search')->name('file.search');

Route::get('/asset/create/integrate','AssetController@create');
Route::resource('/asset-transactionuser', 'AssetTransactionUserController');
Route::post('/asset-transactionuser/search', 'AssetTransactionUserController@search')->name('asset-transactionuser.search');
Route::get('/create/asset/transaction/{id}','AssetTransactionUserController@create');
Route::post('/port-transaction/search', 'AssetTransactionUserController@porttransearch')->name('porttran.search');


Route::resource('/portfolio', 'PortfolioController');
Route::post('/portfolio/search', 'PortfolioController@search')->name('portfolio.search');
Route::get('portstruc/{dep}','PortfolioController@portDep');
Route::get('portblock/{block}','PortfolioController@portblock');
Route::get('portfolio','PortfolioController@index');
Route::get('/portfolio/shows/{id}',['uses'=>'PortfolioController@showdetail']);
Route::get('/portfolio/uploadfile/{id}',['uses'=>'PortfolioController@gotoup']);
Route::get('/portfolio/port/file/{id}',['uses'=>'PortfolioController@portfile']);
Route::get('/portfolio/port/file/{id}',['uses'=>'PortfolioController@portfile']);
Route::get('/portfolio/uploadfile/{id}/{portnumber}/{fileportref}{cat}/{ref}/{filerefname}',['uses'=>'FileController@create']);
Route::post('/fileupload',['uses'=>'FileController@choosegroup'])->name('file.choosegroup');
Route::get('/portfolio/editfile/{id}/{portnumber}/{fileportref}{cat}/{ref}/{filerefname}/{fileid}',['uses'=>'FileController@edit']);
Route::post('/portfileup','FileController@change')->name('file.change');
Route::get('/portfolio/submit/file',['uses'=>'FileController@submitfile']);
Route::get('/complete/file',['uses'=>'FileController@gotocomplete']);

Route::resource('/asset', 'AssetController');
Route::post('/asset/search', 'AssetController@search')->name('asset.search');
Route::get('/portfolio/asset/{id}',['uses'=>'AssetController@ownasset']);

Route::get('/portfolio/asset/detail/{id}/{portid}',['uses'=>'AssetController@detail']);
Route::get('/asset/uploadfile/{id}/{portnumber}/{fileportref}{cat}/{ref}/{filerefname}',['uses'=>'FileController@create']);
Route::get('/member/uploadfile/{id}/{fileportref}{cat}/{ref}/{filerefname}',['uses'=>'FileController@create']);

Route::get('/asset/editfile/{id}/{portnumber}/{fileportref}{cat}/{ref}/{filerefname}/{fileid}',['uses'=>'FileController@edit']);
Route::get('/asset/create/{id}',['uses'=>'AssetController@create']);
Route::get('/asset-transaction/create/{id}',['uses'=>'AssetTransactionUserController@create']);
Route::get('/asset-transaction/show/{id}/{portnum}',['uses'=>'AssetTransactionUserController@index']);
Route::get('/portfolio-transaction/{id}',['uses'=>'AssetTransactionUserController@porttransaction']);


Route::match(['put', 'patch'], '/file/fakedelete/{id}/{portid}/{ref}','FileController@fakedelete');
Route::resource('/file', 'FileController');
Route::post('/file/search', 'FileController@search')->name('file.search');

Route::get('/showfile/{id}',['uses'=>'PortfolioController@showfile']);


//Member-Management
Route ::resource('per','PerController');
Route::post('per/search', 'PerController@search')->name('per.search');
Route::get('/membernote/{id}',['as'=>'edit/membernote','uses'=>'PerController@membernote']);
Route::post('/noteup','PerController@noteup');
Route::get('/per/tool/{id}','PerController@membertool');

//report
Route::get('system-managements/report', 'ReportController@index');
Route::post('system-managements/report/search', 'ReportController@search')->name('report.search');
Route::post('system-managements/report/excel', 'ReportController@exportExcel')->name('report.excel');
Route::post('system-managements/report/pdf', 'ReportController@exportPDF')->name('report.pdf');

Route::get('reportper', 'ReportPerController@index');
Route::post('reportper/search', 'ReportPerController@search')->name('reportper.search');
Route::post('reportper/excel', 'ReportPerController@exportExcel')->name('reportper.excel');
Route::post('reportper/pdf', 'ReportPerController@exportPDF')->name('reportper.pdf');


Route::get('/memreport', 'printout\ktbfirstpageController@index');
Route::post('/memreport/search', 'printout\ktbfirstpageController@search')->name('mem.search');
Route::post('/memreport/excel', 'printout\ktbfirstpageController@exportExcel')->name('mem.excel');
Route::post('/mempdfmake', 'printout\ktbfirstpageController@exportPDF')->name('per.pdf');


Route::get('/memmtsreport', 'printout\MtsfirstpageController@index');
Route::post('/memmtsreport/search', 'printout\MtsfirstpageController@search')->name('memmts.search');
Route::post('/memmtsreport/excel', 'printout\MtsfirstpageController@exportExcel')->name('memmts.excel');
Route::post('/mempdfmtsmake', 'printout\MtsfirstpageController@exportPDF')->name('permts.pdf');
Route::get('/mymember','PerController@mymember');
Route::get('/case/uploadfile/{id}/{fileportref}{cat}/{ref}/{filerefname}',['uses'=>'FileController@create']);
Route::get('/offer/uploadfile/{id}/{fileportref}{cat}/{ref}/{filerefname}',['uses'=>'FileController@create']);


});

Route::get('Nonlife/create', 'FileController@Allinone');
Route::get('Nonlife/memberorganize', 'FileController@memor');
Route::get('Nonlife/allinone/createmember/','PerController@create');
Route::get('Nonlife/allinone/createorganize','OrganizeUserController@create');
Route::get('Nonlife/Nonlife/allinone/createasset/',['uses'=>'AssetController@create']);
Route::get('Nonlife/allasset','AssetController@allasset');
Route::get('Nonlife/showfromall/{id}/{port}','AssetController@showfromall');
Route::get('Nonlife/editfromall/{id}','AssetController@editfromall');
Route::post('Nonlife/allasset/search','AssetController@searchfromall')->name('asset-searchfromall.searchfromall');
Route::post('Nonlife/allinone/save','FileController@saveallinone');
//Route::resource('system-management/userauth', 'UserAuthController');
//Route::post('system-management/userauth/search', 'UserAuthController@search')->name('userauth.search');
Route::get('Nonlife/onlynon','AssetController@onlynon');
Route::get('Nonlife/editonlynon/{id}','AssetController@editonlynon');
Route::get('Nonlife/showonlynon/{id}/{port}','AssetController@showonlynon');
Route::post('Nonlife/onlynon/search','AssetController@searchonlynon')->name('asset-searchonlynon.searchonlynon');



Route::get('avatars/{name}', 'EmployeeManagementController@load');

Route::get('/findMemberCiti','PortfolioAdminController@findMemberCiti');
Route::get('/findDivisionName','BlockController@findBlockName');
Route::get('/findDivName','PerController@findDivName');
Route::get('/findDiviName','PortfolioController@findDiviName');
Route::get('/findPortName','PerController@findPortName');
Route::get('/findPortnum','PerController@findPortnum');

Route::get('/prodview','TestController@prodfunct');
Route::get('/findProductName','TestController@findProductName');
Route::get('/findPrice','TestController@findPrice');


Route::get('dep/{depId}/users','PersonUserController@index');
Route::get('dep/{depId}/division','DivisionDepartmentController@index');
Route::get('users/{userId}/division','DivisionUserController@index');

Route::get('division/{dep}','DivisionController@divDep');
Route::get('test',function(){
  return App\Division::with('department')->get();
});

Route::get('divisionDep','DivisionController@divisionDep');


Route::get('test2',function(){
  return App\Portfolio::with('department')->get();
});

Route::get('/portfolioDep','PortfolioController@portfolioDep');

Route::get('treeview',array('as'=>'jquery.treeview','uses'=>'TreeController@treeView'));


Route::get('editProfile','PersonController@edit');
Route::get('Profile','PersonController@profile');


Route ::resource('sharing','SharingperController');




Route::resource('category','CategoryController');
Route::get('profile', function(){
    return view('profile');
});

Route::resource('/serviceuser', 'ServiceUserController');
Route::get('/serviceuser/list/{org}', 'ServiceUserController@listtype');
Route::get('/serviceuser/group/{org}', 'ServiceUserController@groupservice');
Route::get('/serviceuser/lists/all', 'ServiceUserController@showall');

Route::resource('/servicecenter', 'ServicePerController');

Route::resource('/servicetracking', 'ServiceTrackingController');
Route::post('servicetracking/search', 'ServiceTrackingController@searchinbox');
Route::post('service/tracking/search', 'ServiceTrackingController@search')->name('servicetracking.search');
Route::post('/servicecenter/sent', 'ServicePerController@sentservice')->name('serviceper.sentservice');
Route::get('/service/{org}', 'ServicePerController@listtype');
Route::get('/service/{org}', 'ServicePerController@listtype');
Route::get('/service/group/{org}', 'ServicePerController@groupservice');
Route::get('/allservice', 'ServicePerController@showall');
Route::get('/groupservice/{org}', 'ServicePerController@listgroup');

Route::resource('post','PostController');
Route::POST('addPost','PostController@addPost');
Route::POST('editPost','PostController@editPost');
Route::POST('deletePost','PostController@deletePost');

Route::get('/webservice','IframeController@index');

Route::get('previous','Auth\LoginController@re')->name('previous');
Route::resource('reflink','RefController');
Route::get('/reflink/event/link','RefController@eventlink');
Route::post('/reflink/event/link/get', 'RefController@storeeventlink')->name('reflink.storeeventlink');
Route::get('/reflink/smart/link','RefController@smartlink');
Route::post('/reflink/smart/link/get', 'RefController@storesmartlink')->name('reflink.storesmartlink');
Route::get('/reflink/content/link','RefController@contentlink');
Route::get('/reflink/service/link','RefController@servicelink');
Route::post('/reflink/service/link/get', 'RefController@storeservicelink')->name('reflink.storeservicelink');
Route::post('/reflink/content/link/get', 'RefController@storesmartlink')->name('reflink.storecontentlink');
Route::get('/findevent','Reftroller@findevent');

Route::get('/findservice','ServiceTrackingController@findservice');
Route::get('/findcatmsg','ServiceTrackingController@findcatmsg');
Route::get('/myservice/{org}', 'ServiceTrackingController@listservice');
Route::get('/groupmyservice/{org}', 'ServiceTrackingController@groupservice');

Route::resource('/user/servicetracking', 'ServiceTrackingUserController');
Route::get('/user/servicetracking/list/{org}', 'ServiceTrackingUserController@listservice');
Route::resource('userprofile', 'UserProfileController');
Route::get('/userprofile/resetpassword/{id}',['uses'=>'UserProfileController@repassword']);
Route::match(['put', 'patch'], '/userprofile/useruppass/{id}','UserProfileController@uppass');
Route::match(['put', 'patch'], '/userprofile/useruppid/{id}','UserProfileController@uppid');


Route::get('/userprofile/user/pid/{id}', 'UserProfileController@mypid');
Route::get('/userprofile/resetpassword/{id}',['uses'=>'UserProfileController@repassword']);
Route::match(['put', 'patch'], '/userprofile/useruppid/{id}','UserProfileController@uppid');
Route::resource('organizeprofile', 'OrganizeProfileController');

Route::resource('/organizeadmin', 'OrganizeAdminController');
Route::post('/organizeadmin/search', 'OrganizeAdminController@search')->name('organizeadmin.search');
Route::get('/organizeadmin/branch/{id}', 'OrganizeAdminController@findbranch');

    Route::resource('/organizeuser', 'OrganizeUserController');
    Route::post('/organizeuser/search', 'OrganizeUserController@search')->name('organizeuser.search');
    Route::get('/organizeuser/branch/{id}', 'OrganizeUserController@findbranch');

    Route::resource('/branch', 'BranchController');
    Route::post('/branchuser/search', 'BranchController@search')->name('branch.search');

    Route::resource('/branchuser', 'BranchUserController');
    Route::post('/branch/search', 'BranchUserController@search')->name('branchuser.search');
    Route::get('/branch/create/{id}', 'BranchUserController@create');
    Route::get('/branch/update/{id}', 'BranchUserController@edit');

Route::get('/loggedout','LogoutController@logoutpage');
Route::get('/member/resetpassword/{id}',['uses'=>'PersonController@repassword']);
Route::match(['put', 'patch'], '/pass/{id}','PersonController@uppass');
Route::get('/link/{id}','LinkController@index');
Route::get('/member/link/{id}','LinkPerController@index');
Route::get('portfolio/showport/shows/{id}',['uses'=>'PersonController@showdetail']);
Route::get('port/showfile/{id}',['uses'=>'PersonController@showfile']);
Route::get('person/port/asset/{id}',['uses'=>'PersonController@ownasset']);
Route::get('person/port/asset/detail/{id}/{portid}',['uses'=>'PersonController@detail']);
Route::get('person/port-transaction/{id}',['uses'=>'PersonController@porttransaction']);
Route::post('person/asset/search', 'PersonController@assetsearch')->name('assetper.search');
Route::post('person/porttransaction/search', 'PersonController@porttransearch')->name('porttranper.search');
Route::get('person/asset-transaction/show/{id}/{portnum}',['uses'=>'PersonController@assettransaction']);
Route::get('person/asset-transaction/{id}','PersonController@detailtransaction');
Route::get('/findPortLabel','PortfolioController@findPortLabel');
Route::get('/findAssetLabel','AssetController@findAssetLabel');
Route::get('/findAssetIssue','AssetController@findAssetIssue');
Route::get('/findAssetIssueName','AssetController@findAssetIssueName');
Route::get('/findAssetIssueBranch','AssetController@findAssetIssueBranch');
Route::get('/findPortnum','AssetController@findPortnum');
Route::get('/findPortmember','AssetController@findPortMember');
Route::get('/findPortasset','AssetController@findPortAsset');
Route::get('/findmemrefid','AssetController@findMemRefid');
Route::get('/findmemid','AssetController@findMemId');
Route::get('/findmemtype','AssetController@findMemType');
Route::get('/findassettype','AssetController@findAssetType');
Route::get('/findPartyName','AssetController@findPartyName');
Route::get('/findProvince','AjaxlinkController@findProvince');
Route::get('/findDistrict','AjaxlinkController@findDistrict');
Route::get('/findSubdistrict','AjaxlinkController@findSubdistrict');
Route::get('/findFileCat','AjaxlinkController@findFileCat');
Route::get('/findToolSet','AjaxlinkController@findToolSet');
Route::get('/findpartnerblock','AjaxlinkController@findpartnerblock');
Route::get('/findCaseType','AjaxlinkController@findCaseType');
Route::get('/findCondition','AjaxlinkController@findCondition');
Route::get('/findAction','AjaxlinkController@findAction');
Route::get('/AssetTypeInfo','AjaxlinkController@AssetTypeInfo');

Route::get('/findOfferType','AjaxlinkController@findOfferType');

Route::get('/findOfferTypeCampaign','AjaxlinkController@findOfferTypeCampaign');

Route::get('/pathcondetail','AjaxlinkController@pathcondetail');

Route::resource('/match-member-wealththai', 'MatchMemberWealththaiController');
Route::post('/match-member-wealththai/search', 'MatchMemberWealththaiController@search')->name('match-member-wealththai.search');
Route::resource('/partywealththai', 'PartyWealththaiController');
Route::post('/partywealththai/search', 'PartyWealththaiController@search')->name('partywealththai.search');
Route::get('/academiclibrary','AcademicController@index');
Route::get('/formupload','AcademicController@formupload');
Route::get('/elearning','AcademicController@elearning');
Route::get('/privilege','AcademicController@privilege');
Route::get('/announcement','AcademicController@announcement');
Route::get('/regiswealththai','AcademicController@regiswealththai');

Route::get('/Profile/publicid','PersonController@pid');
Route::get('/Profile/member/pid/{id}', 'PersonController@mypid');
Route::match(['put', 'patch'], '/Profile/memberuppid/{id}','PersonController@uppid');
Route::get('/familys/fetch_data', 'FamilyController@fetch_data');
Route::get('/family/{id}/edit/{status}', 'FamilyController@status');
Route::delete('/organizeauth/delete/{id}','OrganizeAuthController@destroy');



Route::resource('/prospect', 'ProspectController');
Route::get('/convert/prospect/{id}', 'ProspectController@convert');
Route::post('/prospect/searchnormal', 'ProspectController@searchnormal')->name('prospect.searchnormal');
Route::post('/prospect/search', 'ProspectController@search')->name('prospect.search');
Route::get('/prospect/status/{id}/{statusid}', 'ProspectController@changestatus');
Route::get('/prospect/priority/{id}/{number}', 'ProspectController@changepriority');
Route::get('/prospect/type/{id}/{number}', 'ProspectController@changetype');


Route::resource('/prospectcoor', 'ProspectCoorController');
Route::get('/convert/prospectcoor/{id}', 'ProspectCoorController@convert');
Route::post('/prospectcoor/searchnormal', 'ProspectCoorController@searchnormal')->name('prospectcoor.searchnormal');
Route::post('/prospectcoor/search', 'ProspectCoorController@search')->name('prospectcoor.search');
Route::get('/prospectcoor/status/{id}/{statusid}', 'ProspectCoorController@changestatus');
Route::get('/prospectcoor/priority/{id}/{number}', 'ProspectCoorController@changepriority');
Route::get('/prospectcoor/type/{id}/{number}', 'ProspectCoorController@changetype');


Route::resource('/lead', 'LeadController');
Route::post('/lead/searchnormal', 'LeadController@searchnormal')->name('lead.searchnormal');
Route::post('/lead/search', 'LeadController@search')->name('lead.search');
Route::get('/leadchangstatus/{id}/{statusid}', 'LeadController@changestatus');
Route::get('/leadchangpriority/{id}/{number}', 'LeadController@changepriority');

Route::resource('/eventuser', 'EventUserController');
Route::post('/eventuser/search', 'EventUserController@search')->name('eventuser.search');
Route::get('/eventuser/eventregis/{id}',['uses'=>'EventToMemberController@regisevent']);
Route::get('/eventuser/checkevent/{id}',['uses'=>'EventToMemberController@checkevent']);


Route::resource('/eventcoor', 'EventCoorController');
Route::post('/eventcoor/search', 'EventCoorController@search')->name('eventcoor.search');
Route::get('/eventcoor/eventregis/{id}',['uses'=>'EventToMemberCoorController@regisevent']);
Route::get('/eventcoor/checkevent/{id}',['uses'=>'EventToMemberCoorController@checkevent']);
Route::resource('/eventtomembercoor', 'EventToMemberCoorController');
Route::get('/eventcoor/{id}/{number}', 'EventCoorController@changestatus');
Route::get('/eventcoor/changeref/{id}/{number}/{number2}', 'EventCoorController@changeref');


Route::resource('/eventmember', 'EventMemberController');
Route::post('/eventmember/search', 'EventMemberController@search')->name('eventmember.search');
Route::get('/eventmember/eventregis/{id}/event',['uses'=>'RegisterEventController@regisevent']);
Route::get('/eventmember/checkevent/{id}',['uses'=>'RegisterEventController@checkevent']);
Route::resource('/registerevent', 'RegisterEventController');

Route::get('/userprofile/lineuserid/up','UserProfileController@uplineuserid');


Route::resource('/eventtomember', 'EventToMemberController');
Route::get('/Profile/lineuserid/up','PersonController@uplineuserid');

Route::get('mql4','Mql4Controller@index');

Route::resource('/member-tool', 'MemberToolController');
Route::post('/member-tool/search', 'MemberToolController@search')->name('member-tool.search');
Route::get('/Profile/lineuserid/up','PersonController@uplineuserid');
Route::get('/repasswordpage','PersonController@repasswordpage');

Route::resource('/toolmember', 'ToolMemberController');
Route::post('/toolmember/search', 'ToolMemberController@search')->name('toolmember.search');
Route::post('/toolordermember/package/store', 'ToolMemberController@storepackage')->name('toolmember.storepackage');

Route::get('/toolmember/toolset/{id}','ToolSetMemberController@index');
Route::get('/toolmember/toolpackage/{id}','ToolSetMemberController@toolpackage');
Route::resource('/toolordermember','ToolOrderMemberController');
Route::post('/toolordermember/search', 'ToolOrderMemberController@search')->name('toolordermember.search');
Route::post('/toolordermember/package/save', 'ToolOrderMemberController@storepackage')->name('toolordermember.storepackage');


Route::resource('/mytool','MemberToolMemberController');
Route::post('/mytool/search', 'MemberToolMemberController@search')->name('mytool.search');

Route::resource('/memberassigntool','MemberAssignToolController');
Route::post('/memberassigntool/search', 'MemberAssignToolController@search')->name('memberassigntool.search');

Route::resource('/tools', 'ToolController');
Route::post('/tools/search', 'ToolController@search')->name('tools.search');

Route::get('/tools/{id}/toolset', 'ToolSetController@index');
Route::resource('/toolset', 'ToolSetController');
Route::post('/toolset/search', 'ToolSetController@search')->name('toolset.search');
Route::resource('/check-order','ToolOrderUserController');
Route::post('/check-order/search', 'ToolOrderUserController@search')->name('check-order.search');
Route::get('/check-order/{id}/{number}', 'ToolOrderUserController@changeorderstatus');
Route::resource('/partnerregister', 'PartnerRegisController');
Route::post('/gotopartner', 'PartnerRegisController@gotopartner');


//partner
Route::prefix('/wealththaipartner')->group(function() {
Route::get('/','Auth\PartnerLoginController@showLoginForm')->name('partner.login');
Route::post('/','Auth\PartnerLoginController@login')->name('partner.login.submit');
Route::get('/logout','Auth\PartnerLoginController@logout');
Route::get('/dashboard','Partner\DashboardController@index');
Route::resource('/messagecenter-partner','Partner\NotiPartnerController');
Route::get('/messagecenter-partner/show/{id}',['as'=>'edit/show','uses'=>'Partner\NotiPartnerController@show']);
Route::post('/messagecenter-partner/search', 'Partner\NotiPartnerController@search')->name('messagecenter-partner.search');
Route::get('/messagecenter-partner-sentbox','Partner\NotiPartnerController@sentbox');
Route::post('/messagecenter-partner-sentbox/search', 'Partner\NotiPartnerController@searchsentbox')->name('messagecenter-partner.searchsentbox');
Route::get('/messagecenter-partner-inbox','Partner\NotiPartnerController@inbox');
Route::post('/messagecenter-partner-inbox/search', 'Partner\NotiPartnerController@searchinbox')->name('messagecenter-partner.searchinbox');
Route::get('/messagecenter-partner/reply/{id}',['as'=>'edit/reply','uses'=>'Partner\NotiPartnerController@reply']);
Route::get('/messagecenter-partner/forward/{id}',['as'=>'edit/forward','uses'=>'Partner\NotiPartnerController@forward']);
Route::post('/messagecenter-partner/message/messagegroup', 'Partner\NotiPartnerController@notigroup')->name('messagecenter-partner.notigroup');
Route::get('/messagecenter-partner/message/sent-to-group','Partner\NotiPartnerController@creategroup')->name('messagecenter-partner.creategroup');

});
Route::get('country',function(){
    return App\Country::all();
});
//partner

//wealththaiinsurance Add Function
Route::resource('/wealththaiinsurance/offer', 'OfferUserController');
Route::resource('/wealththaiinsurance/offeruser', 'OfferforUserController');
Route::post('/wealththaiinsurance/offer', 'OfferUserController@store')->name('offeruser.store');
Route::match(['put', 'patch'], '/wealththaiinsurance/offer/{id}','OfferUserController@update')->name('offeruser.update');
Route::resource('/wealththaiinsurance', 'InsuranceController');
Route::get('/wealththaiinsuranceuser', 'InsuranceController@indexuser');
Route::get('/wealththaiinsurance/load/country', 'InsuranceController@loadcountry');
Route::get('/wealththaiinsurance/load/district', 'InsuranceController@loaddistrict');
Route::get('/wealththaiinsurance/load/subdistrict', 'InsuranceController@loadsubdistrict');
Route::get('/wealththaiinsurance/load/city', 'InsuranceController@loadcity');
Route::get('/wealththaiinsurance/load/day', 'InsuranceController@loadday');
Route::get('/wealththaiinsurance/load/month', 'InsuranceController@loadmonth');
Route::get('/wealththaiinsurance/load/year', 'InsuranceController@loadyear');
Route::get('/wealththaiinsurance/load/membertype', 'InsuranceController@loadmembertype');
Route::get('/wealththaiinsurance/load/user', 'InsuranceController@loaduser');
Route::get('/wealththaiinsurance/load/coordinate', 'InsuranceController@loadcoordinate');
Route::get('/wealththaiinsurance/load/partner', 'InsuranceController@loadpartner');
Route::get('/wealththaiinsurance/load/casechannel', 'InsuranceController@loadcasechannel');
Route::get('/wealththaiinsurance/load/member', 'InsuranceController@loadmember');
Route::get('/wealththaiinsurance/load/assettype', 'InsuranceController@loadassettype');
Route::get('/wealththaiinsurance/load/allassettype', 'InsuranceController@loadallassettype');

Route::get('/wealththaiinsurance/load/issuer', 'InsuranceController@loadissuer');
Route::get('/wealththaiinsurance/load/casecat', 'InsuranceController@loadcasecat');
Route::get('/wealththaiinsurance/load/casetype', 'InsuranceController@loadcasetype');
Route::get('/wealththaiinsurance/load/casesubtype', 'InsuranceController@loadcasesubtype');
Route::get('/wealththaiinsurance/load/memberpid', 'InsuranceController@loadmemberpid');
Route::get('/wealththaiinsurance/load/assurance', 'InsuranceController@loadassurance');
Route::get('/wealththaiinsurance/load/publicid', 'InsuranceController@loadpublicid');
Route::get('/wealththaiinsurance/load/guildmember', 'InsuranceController@loadguildmember');
Route::get('/wealththaiinsurance/load/groupmember', 'InsuranceController@loadgroupmember');
Route::get('/wealththaiinsurance/load/grouppid', 'InsuranceController@loadgrouppid');
Route::get('/wealththaiinsurance/load/grouppartner', 'InsuranceController@loadgrouppartner');
Route::get('/wealththaiinsurance/load/getcaseport/{id}', 'InsuranceController@getcaseport');


Route::post('/wealththaiinsurance/add/member', 'InsuranceController@addmember');
Route::post('/wealththaiinsurance/add/memberfile', 'InsuranceController@addmemberfile');
Route::post('/wealththaiinsurance/add/membercar', 'InsuranceController@addmembercar');
Route::get('/wealththaiinsurance/choose/memberasset', 'InsuranceController@choosememberasset');
Route::get('/wealththaiinsurance/choose/memberassetfile', 'InsuranceController@choosememberassetfile');
Route::post('/wealththaiinsurance/store/portfolio', 'InsuranceController@storeport');
Route::post('/wealththaiinsurance/store/portfoliotocase', 'InsuranceController@storeportfoliotocase');


Route::post('/wealththaiinsurance/store/member', 'InsuranceController@storemember');
Route::post('/wealththaiinsurance/store/advisor', 'InsuranceController@storeadvisor');

Route::post('/wealththaiinsurance/store/asset', 'InsuranceController@storeasset');
Route::post('/wealththaiinsurance/store/case', 'InsuranceController@storecase');
Route::post('/wealththaiinsurance/store/caseproposaloffer', 'InsuranceController@storecaseproposaloffer');

Route::post('/wealththaiinsurance/store/proposal', 'InsuranceController@storeproposal');
Route::post('/wealththaiinsurance/update/proposal', 'InsuranceController@updateproposal');

Route::post('/wealththaiinsurance/update/offer', 'InsuranceController@updateoffer');
Route::post('/wealththaiinsurance/update/offerdelete', 'InsuranceController@updateofferdelete');
Route::post('/wealththaiinsurance/update/offerclick', 'InsuranceController@updateofferclick');
Route::post('/wealththaiinsurance/update/somecase', 'InsuranceController@updatesomecase');
Route::post('/wealththaiinsurance/update/casetracking', 'InsuranceController@updatecasetracking');
Route::post('/wealththaiinsurance/update/casepayment', 'InsuranceController@updatecasepayment');


////wealththaiinsurance Add Function

////wealththaiinsurance View Function

Route::get('/wealththaiinsurance/all/cases', 'InsuranceController@allcase');
Route::get('/wealththaiinsurance/all/casesuser', 'InsuranceController@allcaseuser');
Route::get('/wealththaiinsurance/all/searchcase', 'InsuranceController@searchcase');
Route::get('/wealththaiinsurance/all/searchcaseuser', 'InsuranceController@searchcaseuser');
Route::post('/wealththaiinsurance/all/searchcasepost', 'InsuranceController@searchcasepost');
Route::get('/wealththaiinsurance/all/casestatus', 'InsuranceController@casestatus');
Route::get('/wealththaiinsurance/load/alluser', 'InsuranceController@alluser');

Route::get('/wealththaiinsurance/cases/{id}/detail/show', 'InsuranceController@showdetail');
Route::get('/wealththaiinsurance/cases/{id}/detail/showuser', 'InsuranceController@showdetailuser');
Route::get('/wealththaiinsurance/cases/{id}/offer/show', 'InsuranceController@showoffer');
Route::get('/wealththaiinsurance/casesuser/{id}/offer/show', 'InsuranceController@showofferuser');
Route::get('/wealththaiinsurance/casesdetail/{id}/detail/show', 'InsuranceController@loadcasesdetail');

Route::get('/wealththaiinsurance/cases/load', 'InsuranceController@loadcases');
Route::get('/wealththaiinsurance/alloffer/load', 'InsuranceController@loadalloffer');
Route::get('/wealththaiinsurance/interestoffer/load', 'InsuranceController@loadinterestoffer');
Route::get('/wealththaiinsurance/lastestoffer/load', 'InsuranceController@loadlastestoffer');
Route::get('/wealththaiinsurance/confirmoffer/load', 'InsuranceController@confirmofferload');


Route::post('/wealththaiinsurance/casefile/load', 'InsuranceController@loadcasefile');
Route::post('/wealththaiinsurance/assetfile/load', 'InsuranceController@loadassetfile');
Route::post('/wealththaiinsurance/offer/load', 'InsuranceController@loadoffer');
Route::post('/wealththaiinsurance/submitedit/case/{id}', 'InsuranceController@updatecase');

Route::get('/wealththaiinsurance/all/offerproposal', 'InsuranceController@offer');
Route::get('/wealththaiinsurance/load/proposal', 'InsuranceController@loadproposal');
Route::get('/wealththaiinsurance/load/confirmoffer', 'InsuranceController@loadconfirmoffer');

Route::get('/wealththaiinsurance/load/promotion', 'InsuranceController@loadpromotion');

Route::get('/wealththaiinsurance/cases/edit/{id}', 'InsuranceController@edit');
Route::get('/wealththaiinsurance/caseslog/load', 'InsuranceController@caselogload');
Route::get('/wealththaiinsurance/caseaction/load', 'InsuranceController@loadcaseaction');
Route::get('/wealththaiinsurance/casecondition/load', 'InsuranceController@loadcasecondition');
Route::get('/wealththaiinsurance/load/editcase', 'InsuranceController@loadeditcase');

Route::get('/wealththaiinsurance/renew/case', 'InsuranceController@renewcase');
Route::post('/wealththaiinsurance/cases/cancel', 'InsuranceController@casecancel');
Route::get('/wealththaiinsurance/cases/recheckoffer', 'InsuranceController@recheckoffer');
Route::get('/wealththaiinsurance/all/case/stage', 'InsuranceController@allcasebystage');
Route::get('/wealththaiinsurance/all/case/stageuser', 'InsuranceController@allcasebystageuser');

Route::get('/wealththaiinsurance/cases/quotation/{id}', 'InsuranceController@quotation');
Route::get('/wealththaiinsurance/cases/quotationcustomer/{id}', 'InsuranceController@quotationcustomer');
Route::get('/wealththaiinsurance/cases/consolidatequotation/{id}', 'InsuranceController@consolidatequotation');
Route::get('/wealththaiinsurance/cases/consolidatequotationcustomer/{id}', 'InsuranceController@consolidatequotationcustomer');

Route::get('/wealththaiinsurance/cases/invoice/{id}', 'InsuranceController@invoice');
Route::get('/wealththaiinsurance/cases/update/stage', 'InsuranceController@updatestage');

////wealththaiinsurance View Function

////wealththaiinsurance Report Function
Route::get('/wealththaiinsurance/report/userperfomance', 'MisReportController@userperfomancereport');
Route::get('/wealththaiinsurance/report/liquidityasset', 'MisReportController@liquidityassetreport');

Route::post('/wealththaiinsurance/report/case/cancel', 'MisReportController@getcasecancel');

Route::get('/wealththaiinsurance/report/cordinator', 'MisReportController@coordinator');
Route::get('/wealththaiinsurance/report/managementreport', 'MisReportController@managementreport');
Route::get('/wealththaiinsurance/report/managementreportbycoor', 'MisReportController@managementreportbycoor');
Route::get('/wealththaiinsurance/report/managementreportbyuser', 'MisReportController@managementreportbyuser');
Route::get('/wealththaiinsurance/report/casecancelreport', 'MisReportController@casecancelreport');
Route::get('/wealththaiinsurance/report/liquidityassetlist', 'MisReportController@liquidityassetlist');

Route::get('/wealththaiinsurance/report/teamperformance', 'MisReportController@teamperformance');
Route::get('/wealththaiinsurance/report/customerranking', 'MisReportController@customerranking');
Route::get('/wealththaiinsurance/report/customerport', 'MisReportController@customerport');
Route::get('/wealththaiinsurance/report/userranking', 'MisReportController@userranking');
Route::get('/wealththaiinsurance/report/distributioninsight', 'MisReportController@distributioninsight');
Route::get('/wealththaiinsurance/report/customerportcase', 'MisReportController@customerportcase');
Route::get('/wealththaiinsurance/report/customercase', 'MisReportController@customercase');
Route::get('/wealththaiinsurance/report/usercase', 'MisReportController@usercase');
Route::get('/wealththaiinsurance/report/customerperfomance', 'MisReportController@customerperfomance');

Route::post('/wealththaiinsurance/report/getliquidityasset', 'MisReportController@getliquidityasset');
Route::post('/wealththaiinsurance/report/coordinatorfiltercase', 'MisReportController@coordinatorfiltercase');
Route::post('/wealththaiinsurance/report/filtercase', 'MisReportController@filtercase');
Route::post('/wealththaiinsurance/report/filtercasebyuser', 'MisReportController@filtercasebyuser');
Route::post('/wealththaiinsurance/report/filterreturncase', 'MisReportController@filterreturncase');
Route::post('/wealththaiinsurance/report/filterblock', 'MisReportController@filterblock');
Route::post('/wealththaiinsurance/report/filterblockbyuser', 'MisReportController@filterblockbyuser');
Route::post('/wealththaiinsurance/report/getcolumnchart', 'MisReportController@getcolumnchart');

Route::post('/wealththaiinsurance/report/filtercustomer', 'MisReportController@filtercustomer');
Route::post('/wealththaiinsurance/report/filterport', 'MisReportController@filterport');
Route::post('/wealththaiinsurance/report/filterportcase', 'MisReportController@filterportcase');
Route::post('/wealththaiinsurance/report/filtercustomercase', 'MisReportController@filtercustomercase');
Route::post('/wealththaiinsurance/report/filterusercase', 'MisReportController@filterusercase');
Route::post('/wealththaiinsurance/report/filtercustomerperfomance', 'MisReportController@filtercustomerperfomance');
Route::post('/wealththaiinsurance/report/filteruser', 'MisReportController@filteruser');

Route::post('/wealththaiinsurance/report/userauth', 'MisReportController@userauth');
Route::get('/wealththaiinsurance/report/getblock', 'MisReportController@getblock');
Route::get('/wealththaiinsurance/report/getuserinstructure', 'MisReportController@getuserinstructure');
Route::get('/wealththaiinsurance/report/export/excel', 'MisReportController@exportExcel');
Route::get('/wealththaiinsurance/get/structure', 'MisReportController@getstructure');
////wealththaiinsurance Report Function
Route::get('email-test', function(){
	$details['email'] = 'kontrakarn.th@gmail.com';
    dispatch(new App\Jobs\QueueJobs($details))->delay(now()->addMinutes(1));
    dd('done');
});
Route::get('email-send', function(){
  return Artisan::call('queue:restart')
;
});
Route::get('/justrun' , function(){
        Artisan::call('schedule:run');
        return 'OK';
    });
    Route::get('testemailsend', 'FortestfunctionController@emailtest');
Route::get('firebase','FirebaseController@index');
Route::get('firebase-get-data', 'FirebaseController@getData');
