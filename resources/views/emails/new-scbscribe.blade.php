 <x-mail::message>


thank you for subscribing

<x-mail::button :url="route('front.home')">
Button Text {{ $email }}
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

