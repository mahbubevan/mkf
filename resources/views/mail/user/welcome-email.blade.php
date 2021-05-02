@component('mail::message')
    <h4>{{__('Welcome MR ')}}, {{__($user->name)}}</h4>
    <p> {{__('You have successfully registered to our site !')}} </p>
@endcomponent
