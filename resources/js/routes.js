export default [
     // frontend routes start**************************************************************

      // frontend routes end **************************************************************

    // admin routes**************************************************************
    { path: '/admin/dashboard', component: require('./components/admin/Dashboard.vue').default },

    //course_manager routes
    { path: '/admin/course_manager/category', component: require('./components/admin/course_manager/Category.vue').default },
	{ path: '/admin/course_manager/sub-category', component: require('./components/admin/course_manager/SubCategory.vue').default },
	{ path: '/admin/course_manager/courses', component: require('./components/admin/course_manager/Course.vue').default },
	{ path: '/admin/course_manager/topics', component: require('./components/admin/course_manager/Topic.vue').default },
    { path: '/admin/course_manager/videos', component: require('./components/admin/course_manager/Video.vue').default },
    
    //users routes
    { path: '/admin/profile', component: require('./components/admin/users/Profile.vue').default },
    { path: '/admin/developer', component: require('./components/admin/Developer.vue').default },
    { path: '/admin/users', component: require('./components/admin/users/Users.vue').default },
    { path: '/admin/students', component: require('./components/admin/users/Student.vue').default },
    { path: '/admin/tutors', component: require('./components/admin/users/Tutor.vue').default },

    { path: '/admin/coupons', component: require('./components/admin/Coupon.vue').default },
    //{ path: '/admin/products', component: require('./components/product/Products.vue').default },
   
   //Quiz manager routes
   { path: '/admin/quiz_manager', component: require('./components/admin/quiz_manager/QnsAns.vue').default },
  

    //users settings
    { path: '/admin/pages', component: require('./components/admin/settings/Page.vue').default },
    { path: '/admin/sliders', component: require('./components/admin/settings/Slider.vue').default },
    { path: '/admin/site-setting', component: require('./components/admin/settings/Setting.vue').default },
    { path: '*', component: require('./components/NotFound.vue').default }

    // admin routes end **************************************************************
];
