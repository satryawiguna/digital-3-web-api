app.constant('USER_ROLES', {
    all: '*',
    super: 'super',
    admin: 'admin',
    agent: 'agent',
    member: 'member',
    guest: 'guest'
});

app.constant('AUTH_EVENTS', {
    loginSuccess: 'auth-login-success',
    loginFailed: 'auth-login-failed',
    logoutSuccess: 'auth-logout-success',
    notAuthenticated: 'auth-not-authenticated',
    tokenExpired: 'auth-token-expired',                 //401 Error
    notAuthorized: 'auth-not-authorized',               //403 Error
    notFound: 'auth-not-found',                         //404 Error
    sessionExpired: 'auth-session-expired',             //440 Error
    internalServerError: 'auth-internal-server-error',  //500 Error
    serviceNotAvailable: 'auth-service-not-available'   //503 Error
});

app.constant('LOADING_EVENTS', {
    loadingStart: 'loading-start',
    loadingFinish: 'loading-finish'
});

app.constant('OTHER_EVENTS', {
    messages: 'messages',
    userInfo: 'userInfo'
});

app.constant('BASE_API_URL', 'http://api.digital3.local.com:8888/api/');

app.constant('BASE_URL', 'http://api.digital3.local.com:8888/');

app.constant('SALT', '4dm!nFCM5');
