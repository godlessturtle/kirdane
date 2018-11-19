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
$route['default_controller'] = 'MainController';
$route['404_override'] = 'MainController/notFound';
$route['translate_uri_dashes'] = FALSE;

//frontend
$route['c/(:num)/(:any)'] 			= 'MainController/single';

$route['sendComment'] 				= 'MainController/sendComment';
$route['author/(:num)/1']				= 'MainController/author';
$route['author/(:num)/(:num)']		= 'MainController/author/$1';

$route['category/(:any)/(:num)/1']	= 'MainController/category';
$route['category/(:any)/(:num)/(:num)']	= 'MainController/category';


$route['page/(:any)']               = 'MainController/page/$1';
//üyelik
$route['register']					= 'MainController/register';
$route['register/finish']			= 'MainController/registUser';

//giriş
$route['user-login']				= 'MainController/loginPage';
$route['login']						= 'MainController/login';

//cıkıs
$route['logout']					= 'MainController/logout';
$route['search?(:any)']             = 'MainController/search';



//user profile
$route['profile']                       = 'UserProfileController/index';
$route['profile/update']                = "UserProfileController/updateProfile";

$route['posts']                         = 'UserProfileController/posts';
$route['password']                      = 'UserProfileController/password';

$route['post']                          = 'UserProfileController/post';
$route['submit/post']                   = 'UserProfileController/createPost';
$route['profile/post/delete/(:any)']    = 'UserProfileController/deletePost/$1';

$route['change/password']               = 'UserProfileController/changePass';











//backend
//panel routeları
$route['panel'] 					= 'AdminController';
$route['panel/login']				= 'AdminController/loginPage';
$route['panel/login/finish']		= 'AdminController/login';
$route['panel/logout']				= 'AdminController/logout';
$route['panel/profile']				= 'AdminController/profile';
$route['panel/adminUpdate']			= 'AdminController/updateProfile';
$route['panel/admin/update/(:any)']	= 'AdminController/updateAdmin/$1';


//post
$route['panel/posts'] 				= 'AdminController/posts';
$route['panel/posts/(:num)']        = 'AdminController/posts/$1';
$route['panel/create/post']			= 'AdminController/newPost';
$route['panel/new/post']			= 'AdminController/createPost';
$route['panel/edit/post/(:num)']	= 'AdminController/editPost';
$route['panel/update/post']			= 'AdminController/updatePost';
$route['panel/deletePost']			= 'AdminController/deletePost';


//kategori
$route['panel/categories'] 	        = 'AdminController/categories';
$route['panel/categories/(:num)'] 	= 'AdminController/categories/$1';
$route['panel/createCategory'] 		= 'AdminController/createCategory';
$route['panel/deleteCategory'] 		= 'AdminController/deleteCategory';
$route['panel/edit/cat/(:num)']		= 'AdminController/editCategory';
$route['panel/update/cat']			= 'AdminController/updateCategory';

//yorumlar
$route['panel/comments/approved']	    = 'AdminController/approvedComments';
$route['panel/comments/waiting']	    = 'AdminController/waitingComments';
$route['panel/approveComment/(:num)']   = 'AdminController/approveComment';
$route['panel/deleteComment/(:num)']    = 'AdminController/deleteComment';


//ayarlar
$route['panel/settings']			= 'AdminController/settings';
$route['panel/settings/submit']		= 'AdminController/updateSettings';
$route['panel/settings/footer']		= 'AdminController/footersettings';
$route['panel/footer/submit']       = 'AdminController/footerUpdate';
$route['panel/settings/homepage']   = 'AdminController/homepageSettings';
$route['panel/settings/hp/update']  = 'AdminController/homePageUpdate';
$route['panel/settings/hp/cat']     = 'AdminController/hpCatUpdate';
$route['panel/settings/hp/recent']  = 'AdminController/hpRecentUpdate';
$route['panel/settings/bs/update']  = 'AdminController/bottomSliderUpdate';


//sayfalar
$route['panel/pages']                = 'AdminController/listPages';
$route['panel/new/page']             = 'AdminController/newPage';
$route['panel/create/page']          = 'AdminController/createPage';
$route['panel/edit/page/(:num)']     = 'AdminController/editPage';
$route['panel/update/page']          = 'AdminController/updatePage';
$route['panel/delete/page']          = 'AdminController/deletePage';


//menüler
$route['panel/menus']                = 'AdminController/menus';
$route['panel/new/menu']			 = 'AdminController/createMenu';
$route['panel/menu/submit']			 = 'AdminController/insertMenu';
$route['panel/menu/delete/(:num)']   = 'AdminController/deleteMenu/$1';
$route['panel/menu/edit/(:num)']     = 'AdminController/editMenu/$1';
$route['panel/menu/update']          = 'AdminController/updateMenu';
$route['panel/new/submenu/(:num)']   = 'AdminController/createSubMenu';
$route['panel/submenu/submit']       = 'AdminController/subMenu';

$route['panel/galleries'] = 'AdminController/galleries';

$route['panel/users'] = 'AdminController/usersPage';
$route['panel/upgrade/user/(:num)'] = 'AdminController/userUpGrade/$1';
$route['panel/downgrade/user/(:num)'] = 'AdminController/userDownGrade/$1';
$route['panel/deleteUser/(:num)'] = 'AdminController/deleteUser/$1';


$route['panel/admins'] = 'AdminController/adminsPage';
$route['panel/create/admin'] = 'AdminController/addAdmin';
$route['panel/delete/admin/(:num)'] = 'AdminController/deleteAdmin/$1';

$route['panel/sidebar/videos'] = 'AdminController/sidebarVideos';
$route['panel/add/video'] = 'AdminController/insertVideo';
$route['panel/delete/video/(:num)'] = 'AdminController/deleteVideo/$1';

//$route['test/(.+)'] = 'MainController/test/$1';

