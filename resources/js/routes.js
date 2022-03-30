export default [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/developer', component: require('./components/Developer.vue').default },
    { path: '/users', component: require('./components/Users.vue').default },
    { path: '/students', component: require('./components/Student.vue').default },
    { path: '/tutors', component: require('./components/Tutor.vue').default },
    { path: '/coupons', component: require('./components/Coupon.vue').default },
    { path: '/users', component: require('./components/Users.vue').default },
    { path: '/products', component: require('./components/product/Products.vue').default },
    { path: '/product/pages', component: require('./components/product/Page.vue').default },
    { path: '/product/category', component: require('./components/product/Category.vue').default },
	{ path: '/sub-category', component: require('./components/product/SubCategory.vue').default },
	{ path: '/courses', component: require('./components/product/Course.vue').default },
	{ path: '/topics', component: require('./components/product/Topic.vue').default },
    { path: '/videos', component: require('./components/product/Video.vue').default },
    { path: '/site-setting', component: require('./components/product/Setting.vue').default },
    { path: '*', component: require('./components/NotFound.vue').default }
];
