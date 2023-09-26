<p>Olá {{ $user->primeiro_nome  }}, </p>
<p>Seja bem-vindo ao Sistema da Garden Flowers.</p>
<a href="{{ config('app.site_url') }}/verificar-email?token={{ $user->token }}">Verificar Email</a>
