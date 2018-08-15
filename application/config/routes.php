<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//default controllers
$route['default_controller'] = 'home_controller/index';
$route['beta'] = 'beta_controller/index';
$route['cat/(:any)'] = 'webapp/list_news_controller/index/$1/1';
$route['cat/(:any)/(:num)'] = 'webapp/list_news_controller/index/$1/$2';
$route['tag/(:num)'] = 'webapp/list_news_controller/tag/$1/1';
$route['tag/(:num)/(:num)'] = 'webapp/list_news_controller/tag/$1/$2';
$route['news/(:any)'] = 'webapp/detail_controller/index/$1';
$route['contact'] = 'webapp/contact_controller/index';
$route['contact/send'] = 'webapp/contact_controller/send';
$route['search'] = 'webapp/search_controller/find/1';
$route['search/(:num)'] = 'webapp/search_controller/find/$1';
$route['du-hoc-han-quoc'] = 'webapp/koreanstudyabroad_controller/index/1';
$route['du-hoc-han-quoc/(:any)'] = 'webapp/koreanstudyabroad_controller/index/1/$1';
$route['dao-tao-han-ngu'] = 'webapp/koreanstudyabroad_controller/index/2';
$route['chuong-trinh-dao-tao/(:any)'] = 'webapp/koreanstudyabroad_controller/index/2/$1';

//admin
$route['admin'] = 'dm/admin_controller/index';
$route['logout'] = 'dm/admin_controller/logout';
$route['login'] = 'dm/admin_controller/login_submit';
$route['edit-profile'] = 'dm/admin_controller/change_password';
$route['edit-profile-change-password-submit'] = 'dm/admin_controller/change_password_submit';

$route['add-category'] = 'dm/category_controller/index';

$route['manage-intro'] = 'dm/intro_controller/index';
$route['intro-manager/create'] = 'dm/intro_controller/create';
$route['intro-manager/update/:num'] = 'dm/intro_controller/update';
$route['intro-manager/delete/:num'] = 'dm/intro_controller/delete';
$route['intro-manager-create-submit'] = 'dm/intro_controller/create_add';
$route['intro-manager/create-cancel'] = 'dm/intro_controller/create_cancel';
$route['intro-manager-update-submit'] = 'dm/intro_controller/update_add';
$route['intro-manager/update-cancel'] = 'dm/intro_controller/update_cancel';

$route['manage-study-category'] = 'dm/study_controller/view_all';
$route['study-manager/create-category'] = 'dm/study_controller/create_category';
$route['study-manager/update-category/:num'] = 'dm/study_controller/update_category';
$route['study-manager/delete-category/:num'] = 'dm/study_controller/delete_category';
$route['study-manager/add-child/:num'] = 'dm/study_controller/add_child';
$route['study-manager-create-category-submit'] = 'dm/study_controller/create_category_add';
$route['study-manager/create-category-cancel'] = 'dm/study_controller/create_category_cancel';
$route['study-manager-update-category-submit'] = 'dm/study_controller/update_category_add';
$route['study-manager/update-category-cancel'] = 'dm/study_controller/update_category_cancel';
$route['study-manager-add-child-category-submit'] = 'dm/study_controller/add_child_category';
$route['manage-study-news'] = 'dm/news_controller/all_news';

$route['news-manager/update-study-news/:num'] = 'dm/news_controller/update_study_news';
$route['study-news-manager-update-study-news-submit'] = 'dm/news_controller/update_study_news_submit';
$route['news-manager/update-study-news-cancel'] = 'dm/news_controller/update_study_news_cancel';
$route['news-manager/delete-study-news/:num'] = 'dm/news_controller/delete_news_id';

$route['news-manager-add-news-submit'] = 'dm/news_controller/add_news_add';
$route['news-manager-add-news-into-category-submit'] = 'dm/news_controller/add_news_into_category_add';
$route['news-manager/add-news'] = 'dm/news_controller/add_news';
$route['news-manager/add-news-cancel'] = 'dm/news_controller/add_news_cancel';
$route['news-manager/add-news/:num'] = 'dm/news_controller/add_news_into_category';
$route['study-manager/delete-news-category/:num'] = 'dm/news_controller/delete_news_category';

$route['university-manager'] = 'dm/university_controller/index';
$route['university-manager/create-university'] = 'dm/university_controller/create_university';
$route['university-manager/update-university/:num'] = 'dm/university_controller/update_university';
$route['university-manager/delete-university/:num'] = 'dm/university_controller/delete_university';
$route['university-manager-create-university-submit'] = 'dm/university_controller/create_university_submit';
$route['university-manager/create-university-cancel'] = 'dm/university_controller/create_university_cancel';
$route['university-manager-update-university-submit'] = 'dm/university_controller/update_university_submit';

$route['program-manager'] = 'dm/program_controller/index';
$route['program-manager/create-program'] = 'dm/program_controller/create_program';
$route['program-manager/update-program/:num'] = 'dm/program_controller/update_program';
$route['program-manager/delete-program/:num'] = 'dm/program_controller/delete_program';
$route['program-manager-create-program-submit'] = 'dm/program_controller/create_program_submit';
$route['program-manager/create-program-cancel'] = 'dm/program_controller/create_program_cancel';
$route['program-manager-update-program-submit'] = 'dm/program_controller/update_program_submit';
$route['program-manager/update-program-cancel'] = 'dm/program_controller/update_program_cancel';

$route['schedule-manager'] = 'dm/schedule_controller/index';
$route['schedule-manager/create-schedule'] = 'dm/schedule_controller/create_schedule';
$route['schedule-manager/update-schedule/:num'] = 'dm/schedule_controller/update_schedule';
$route['schedule-manager/delete-schedule/:num'] = 'dm/schedule_controller/delete_schedule';
$route['schedule-manager-create-schedule-submit'] = 'dm/schedule_controller/create_schedule_submit';
$route['schedule-manager/create-schedule-cancel'] = 'dm/schedule_controller/create_schedule_cancel';
$route['schedule-manager-update-schedule-submit'] = 'dm/schedule_controller/update_schedule_submit';
$route['schedule-manager/update-schedule-cancel'] = 'dm/schedule_controller/update_schedule_cancel';

$route['learning-tips-manager'] = 'dm/learning_tips_controller/index';
$route['learning-tips-manager/create-learning-tips'] = 'dm/learning_tips_controller/create_learning_tips';
$route['learning-tips-manager/update-learning-tips/:num'] = 'dm/learning_tips_controller/update_learning_tips';
$route['learning-tips-manager/delete-learning-tips/:num'] = 'dm/learning_tips_controller/delete_learning_tips';
$route['learning-tips-manager-create-learning-tips-submit'] = 'dm/learning_tips_controller/create_learning_tips_submit';
$route['learning-tips-manager/create-learning-tips-cancel'] = 'dm/learning_tips_controller/create_learning_tips_cancel';
$route['learning-tips-manager-update-learning-tips-submit'] = 'dm/learning_tips_controller/update_learning_tips_submit';
$route['learning-tips-manager/update-learning-tips-cancel'] = 'dm/learning_tips_controller/update_learning_tips_cancel';

$route['news-manager'] = 'dm/hotnews_controller/index';
$route['news-manager/create-news'] = 'dm/hotnews_controller/create_news';
$route['news-manager/update-news/:num'] = 'dm/hotnews_controller/update_news';
$route['news-manager/delete-news/:num'] = 'dm/hotnews_controller/delete_news';
$route['news-manager-create-news-submit'] = 'dm/hotnews_controller/create_news_submit';
$route['news-manager/create-news-cancel'] = 'dm/hotnews_controller/create_news_cancel';
$route['news-manager-update-news-submit'] = 'dm/hotnews_controller/update_news_submit';
$route['news-manager/update-news-cancel'] = 'dm/hotnews_controller/update_news_cancel';


$route['tag-manager'] = 'dm/tag_controller/index';
$route['tag-manager/create-tag'] = 'dm/tag_controller/create_tag';
$route['tag-manager/update-tag/:num'] = 'dm/tag_controller/update_tag';
$route['tag-manager/delete-tag/:num'] = 'dm/tag_controller/delete_tag';
$route['tag-manager-create-tag-submit'] = 'dm/tag_controller/create_tag_submit';
$route['tag-manager/create-tag-cancel'] = 'dm/tag_controller/create_tag_cancel';
$route['tag-manager-update-tag-submit'] = 'dm/tag_controller/update_tag_submit';
$route['tag-manager/update-tag-cancel'] = 'dm/tag_controller/update_tag_cancel';

$route['faq-manager'] = 'dm/faq_controller/index';
$route['faq-manager/create-faq'] = 'dm/faq_controller/create_faq';
$route['faq-manager/update-faq/:num'] = 'dm/faq_controller/update_faq';
$route['faq-manager/delete-faq/:num'] = 'dm/faq_controller/delete_faq';
$route['faq-manager-create-faq-submit'] = 'dm/faq_controller/create_faq_submit';
$route['faq-manager/create-faq-cancel'] = 'dm/faq_controller/create_faq_cancel';
$route['faq-manager-update-faq-submit'] = 'dm/faq_controller/update_faq_submit';
$route['faq-manager/update-faq-cancel'] = 'dm/faq_controller/update_faq_cancel';

$route['slider-manager'] = 'dm/slider_controller/index';
$route['slider-manager/create-slider'] = 'dm/slider_controller/create_slider';
$route['slider-manager/update-slider/:num'] = 'dm/slider_controller/update_slider';
$route['slider-manager/delete-slider/:num'] = 'dm/slider_controller/delete_slider';
$route['slider-manager-create-slider-submit'] = 'dm/slider_controller/create_slider_submit';
$route['slider-manager-update-slider-submit'] = 'dm/slider_controller/update_slider_submit';

$route['gallery-corner-manager'] = 'dm/gallery_corner_controller/index';
$route['gallery-corner-manager/create-gallery'] = 'dm/gallery_corner_controller/create_gallery';
$route['gallery-corner-manager/update-gallery/:num'] = 'dm/gallery_corner_controller/update_gallery';
$route['gallery-corner-manager/delete-gallery/:num'] = 'dm/gallery_corner_controller/delete_gallery';
$route['gallery-corner-manager-create-gallery-submit'] = 'dm/gallery_corner_controller/create_gallery_submit';
$route['gallery-corner-manager-update-gallery-submit'] = 'dm/gallery_corner_controller/update_gallery_submit';

$route['sharing-manager'] = 'dm/sharing_controller/index';
$route['sharing-manager/create-sharing'] = 'dm/sharing_controller/create_sharing';
$route['sharing-manager/update-sharing/:num'] = 'dm/sharing_controller/update_sharing';
$route['sharing-manager/delete-sharing/:num'] = 'dm/sharing_controller/delete_sharing';
$route['sharing-manager-create-sharing-submit'] = 'dm/sharing_controller/create_sharing_submit';
$route['sharing-manager-update-sharing-submit'] = 'dm/sharing_controller/update_sharing_submit';

$route['sub-category-manager'] = 'dm/subcategory_controller/create_subcategory';
$route['sub-category-manager-create-sub-category-submit'] = 'dm/subcategory_controller/create_subcategory_submit';
$route['news-sub-category-manager'] = 'dm/subcategory_controller/create_news_subcategory';
$route['subcategory-manager-add-news-subcategory-submit'] = 'dm/subcategory_controller/create_news_subcategory_submit';

$route['scholarship-manager'] = 'dm/scholarship_controller/index';
$route['scholarship-manager/create-scholarship'] = 'dm/scholarship_controller/create_scholarship';
$route['scholarship-manager/update-scholarship/:num'] = 'dm/scholarship_controller/update_scholarship';
$route['scholarship-manager/delete-scholarship/:num'] = 'dm/scholarship_controller/delete_scholarship';
$route['scholarship-manager-create-scholarship-submit'] = 'dm/scholarship_controller/create_scholarship_submit';
$route['scholarship-manager-update-scholarship-submit'] = 'dm/scholarship_controller/update_scholarship_submit';

$route['recruitment-manager'] = 'dm/recruitment_controller/index';
$route['recruitment-manager/create-recruitment'] = 'dm/recruitment_controller/create_recruitment';
$route['recruitment-manager/update-recruitment/:num'] = 'dm/recruitment_controller/update_recruitment';
$route['recruitment-manager/delete-recruitment/:num'] = 'dm/recruitment_controller/delete_recruitment';
$route['recruitment-manager-create-recruitment-submit'] = 'dm/recruitment_controller/create_recruitment_submit';
$route['recruitment-manager-update-recruitment-submit'] = 'dm/recruitment_controller/update_recruitment_submit';

$route['gallery-manager'] = 'dm/gallery_controller/index';
$route['gallery-manager/create-gallery'] = 'dm/gallery_controller/create_gallery';
$route['gallery-manager/delete-gallery/:num'] = 'dm/gallery_controller/delete_gallery';
$route['gallery-manager/update-gallery/(:any)'] = 'dm/gallery_controller/update_gallery/$1';
$route['gallery-manager-create-gallery-submit'] = 'dm/gallery_controller/create_gallery_submit';
$route['gallery-manager-update-gallery-submit'] = 'dm/gallery_controller/update_gallery_submit';

$route['setting-manager'] = 'dm/setting_controller/index';
$route['setting-manager-update-submit'] = 'dm/setting_controller/updateSettingSubmit';

$route['feature-manager'] = 'dm/feature_controller/index';
$route['feature-manager/create-feature'] = 'dm/feature_controller/create';
$route['feature-manager/update-feature/:num'] = 'dm/feature_controller/update';
$route['feature-manager/delete-feature/:num'] = 'dm/feature_controller/delete';
$route['create-feature-submit'] = 'dm/feature_controller/createSubmit';
$route['update-feature-submit'] = 'dm/feature_controller/updateSubmit';

$route['main-feature-manager'] = 'dm/mainfeature_controller/index';
$route['update-mainfeature-submit'] = 'dm/mainfeature_controller/updateSubmit';

$route['studyabroad-manager'] = 'dm/studyabroad_controller/index';
$route['studyabroad-manager/create-studyabroad'] = 'dm/studyabroad_controller/create_studyabroad';
$route['studyabroad-manager/update-studyabroad/:num'] = 'dm/studyabroad_controller/update_studyabroad';
$route['studyabroad-manager/delete-studyabroad/:num'] = 'dm/studyabroad_controller/delete_studyabroad';
$route['studyabroad-manager-create-studyabroad-submit'] = 'dm/studyabroad_controller/create_studyabroad_submit';
$route['studyabroad-manager/create-studyabroad-cancel'] = 'dm/studyabroad_controller/create_studyabroad_cancel';
$route['studyabroad-manager-update-studyabroad-submit'] = 'dm/studyabroad_controller/update_studyabroad_submit';
$route['studyabroad-manager/update-studyabroad-cancel'] = 'dm/studyabroad_controller/update_studyabroad_cancel';
