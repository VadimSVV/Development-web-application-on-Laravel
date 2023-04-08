if(Auth::user()->isAdmin !=1){
    return redirect()->guest('auth/login');
}