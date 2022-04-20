<template>
    <!-- SignIn Area Starts Here -->
    <section class="section signup-area signin-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-5 order-2 order-xl-0">
                    <div class="signup-area-textwrapper">
                        <h2 class="font-title--md mb-0">Sign in</h2>
                        <p class="mt-2 mb-lg-4 mb-3">Don't have account? <a href="signup.html"
                                class="text-black-50">Sign up</a></p>
                        <form action="#">
                            <div class="form-element success">
                                <div class="form-alert">
                                    <label for="name">Email</label>
                                </div>
                                <div class="form-alert-input">
                                    <input type="email" placeholder="Arif Ahmed" id="name" />
                                    <div class="form-alert-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-check">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="form-element active">
                                <div class="d-flex justify-content-between">
                                    <label for="confirm-password">Password</label>
                                    <a href="forget-password.html" class="text-primary fs-6">Forget Password</a>
                                </div>

                                <div class="form-alert-input">
                                    <input type="password" placeholder="Type here..." id="confirm-password" />
                                    <div class="form-alert-icon" onclick="showPassword('confirm-password',this);">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="form-element d-flex align-items-center terms">
                                <input class="checkbox-primary me-1" type="checkbox" id="agree" />
                                <label for="agree" class="text-secondary mb-0 fs-6">Remember me</label>
                            </div>
                            <div class="form-element">
                                <button type="submit" class="button button-lg button--primary w-100">Sign in</button>
                            </div>
                            <span class="d-block text-center text-secondary">or sign in with</span>
                        
                        </form>
                    </div>
                </div>
                <div class="col-xl-7 order-1 order-xl-0">
                    <div class="signup-area-image">
                        <img src="/front/dist/images/signup/Illustration.png" alt="Illustration Image" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- SignIn Area Ends Here -->
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
