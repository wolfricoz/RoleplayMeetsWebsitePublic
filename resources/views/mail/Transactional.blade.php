<div
  style="text-align: center; border: 1px solid #000; padding: 20px; margin: 0 auto; width: 80%; background: #D1D5DB; border-radius: 25px;">
  <h1 style="text-decoration: underline">{{ config('site_settings.site_name') }}</h1>
  <div>
    <h2>{{ $email_title }}</h2>
    @isset($title)
      <h3 style="color: #1F2937">{{ $title }}</h3>
    @endisset
    @isset($user)
      <p style="font-size: small; color: #4B5563; padding:0; margin:0;">by {{ $user->username }}</p>
    @endisset
    <p>{{ $content }}</p>
    @isset($footer)
      <p>{{ $footer }}</p>
    @endisset
    @isset($reason)
      <h3>Your post was rejected:</h3>
      <p>{{ $reason }}</p>
    @endisset
    @isset($url)
      <a
        style="border: 1px solid; border-radius: 30px; padding: 10px; margin: 2px; background: #2563EB; color: #E5E7EB;"
        href="{{ $url }}">View Post</a>
    @endisset

    <p>Thank you for using {{ config('site_settings.site_name') }}</p>

  </div>
</div>
<p style="text-align: center;">If you prefer not to receive these emails, you can unsubscribe by clicking <a
    href="{{ route('users.unsubscribe', $user) }}">unsubscribe</a></p>
