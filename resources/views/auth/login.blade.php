@extends('layouts.app')

@section('content')
<style>
    body
{
    margin: 0;
    padding: 0;
    background: url(https://realestatepaperpushers.com/images/misc/greentc1.jpg);
    background-size: cover;
    font-family: sans-serif;
}
.loginbox
{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    width: 350px;
    height: 470px;
    padding: 80px 40px;
    box-sizing: border-box;
    background: rgba(0,0,0,.5);
}
.user
{
    width: 100px;
    height: 100px;
    border-radius: 50%;
    overflow: hidden;
    position: absolute;
    top: calc(-100px/2);
    left: calc(50% - 50px);
}
h2
{
    margin: 0;
    padding: 0 0 20px;
    color: #efed40;
    text-align: center;
}
.loginbox p
{
    margin: 0;
    padding: 0;
    font-weight: bold;
    color: #fff;
}
.loginbox input
{
    width: 100%;
    margin-bottom: 20px;
}
.loginbox input[type="text"],
.loginbox input[type="password"]
{
    /*border: none;
    border-bottom: 1px solid #fff;
    background: transparent;
    outline: none;
    height: 40px;
    color: #fff;
    font-size: 16px;*/
}
::placeholder
{
    color: rgba(255,255,255,.5);
}
.loginbox input[type="submit"]
{
    border: none;
    outline: none;
    height: 40px;
    color: #fff;
    font-size: 16px;
    background: #ff267e;
    cursor: pointer;
    border-radius: 20px;
}
.loginbox input[type="submit"]:hover
{
    background: #efed40;
    color: #262626;
    
}
</style>

<!DOCTYPE html>
<html>
    <head>
       <meta charset="utf-8">
        <title>Tramsparent login form </title>
        <link rel="stylesheet" type="text/css" href="app1.css">
     </head>
       <body>
           <div class="loginbox">
               <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHMAAAB8CAMAAABty38BAAAAk1BMVEX///80NDQREiQAAADs7O0vLy8oKCgkJCQrKyshISEZGRmMjIxbW1sMDSEUFBTh4eEAABv5+flTU1Py8vI/Pz97e3usrKxra2sLCwuhoaG3t7fT09MAABXLy8tISEiGhobCwsKUlJRjY2MmJjJFRU1lZW11dX1TU10dHi1zc3M5OUMxMTttbXJPT1RbXGZaWl+AgIcnm3EbAAAE/ElEQVRoge2ZC3OyOhCGRa4Jd+SuIgioVWv9/7/uhAStXFIrpM43Z3hsKyMpb7O72eyms9nExMTExMTExMQEDbvinXrxRuNkoCQf0fI9iqbHQ0XkEKIo8a7fuOk7wKiB4ofJSFLlFe4BESjr+z07gQan3RBD3v/hQb9moQGuhWhEt7uBrMQPg2MYMrC9rUltSURYC5m8kTaG+8bHeM1NZ5YYSBznQ6f6u0yMUH0ic4uxkqbcK8kpAb4dQQ9JBkCqEFP0iQNGa3p9lq0wzLumGZKPJI2Jpt1vWYSc3TVtDcoIYFROdqAwUnNN1RS1uyaaqYC8KeAJjtf0Ke5EuMK35gPjNTOaO2uH/oXmhq4Z/juayei4VZ/YNoZJ6zeAO1bzB3+CyoYCD+PGL0RGe+IvE9HjlsN+2wA5+t7IF5FhjN7NYqqmmBAbBmjfdG+EIb9+8sTn/JATtrchHqog0GbOKbyhZaOTLfIXVVN59JuqVImJgR5GoWmC6GFUFd4ig42TENBEjcd6AGsGrDR9mnHFR0uy1VxSFmhTgaQOZlVoIva7s1HfYU1RHr9OCFn/Cg0bQUrmaWwYaS57Ne+r81GT1TRnM63PuDDtaIoOM0m0dfS5szkGz1NxmAWR7XQnClodAmN/zmap0fGm2xpCNFNmkqjGbYcRaEcL0WTVk1Us3KZ1QdYeQdYnU1GzEUagm8xVnJUNZtkPi/LfM4U9T8aagF0IEVEXElWFV3tu4/3TYX7Y4DshH/KS1+szVb53amxZoBaTUgpUUdYqAP8eE8JOMP858fadR0c1DCXtZbTtHL/YmheP7YRoID0YynK9VwoIMhuTV2DostddR1poSGRR4mjV+Iq0uiSFmQJ4xYsZ5TtkTwcC6Z56cEoXSErAuebjfksBgIHu0t9yEmgkdXJcgSvdsJJfNHcZCSjJJh1u50Ugg04VLeIesyqM6quwM0KC3NCDPjvpLWflyngLVHVKuGHob4Rh9OThFDq7c+3QKq0Jbu1Ou7cqQ6KDyqEF3/swUlma4HZB6UmlQR02tTnh0c01LovQRUQb5Q6Jo22/0Yhx8R9koFE9dWBt3PR1SZveyAd15PDCzKQea0gDCoXuGriD2hNsBNR1Uk1br6TXoLoTGxeb9Pbez4CjoR8Og8SAFJxSRDctGvV6EvSohwdogkv8pqiU3hAzoAGlhm0lFpCZbF36GA6kr0rS8kttt8YbRfPlMsymtPG/p92uPWfxk9l+hfxyml+MnWa90b6C0OkzX9Z8OcvbAZDHTFUctG+baiIPlFWgqA2sA+1lloiy9JKuqMgStx1XiAmp6gAAZOW5siihgVzgL5lU8WYceQkIeQMCWVIU8RFFkmQA0T1R2/hr1oW1LSxTP8o2XrAl/8h1tG3w4amZH6dLVkfEExMTExMTExMT/yuE9zPj389s3kSf/z2V5kGf6zr+1le5pVvoa27lh7/UtPb5pciLr6I4ntTNefP5lQdZcjkNnrJOsPRvrJVlWasV+kk09WK/K3efX2VRlkV0vWae78bqavA00POKY3E6lvvTqSjyE7pGT77sy91udylXxLbWdV8Wl6L8PBdfZaai1znLRmged+frubwW1/Ja7i7n3fWCJM+X/bUsz0edaOq5dcxP+eF4mB8KPs/zVXEY404UDig8LPxCF+jn/IAeZ+l1iOK41auXjj+4h9Nwyae018o7+A9SRV1NtqooIAAAAABJRU5ErkJggg==" class="user">
               <h2>Log In Here</h2>
               <form method="POST" action="{{ route('login') }}">
                        @csrf
                   <p>Email</p>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                   <p>Password</p>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                    <label class="form-check-label my-3" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>

                    <input class="form-check-input my-3" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                   <input type="submit" name="" value="Log In">
                    @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                 
               </form>

           </div>

     </body>
     <footer> <a href="{{ route('documentation') }}" class="link-primary" style="margin-left: 50px">Documentation</a></footer>
</html>
@endsection
