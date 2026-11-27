@props([
    'url',
    'color' => 'primary',
    'align' => 'center',
])

<table class="action" align="{{ $align }}" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="{{ $align }}">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
                <tr>
                    <td align="{{ $align }}">
                        <a href="{{ $url }}"
                           target="_blank"
                           style="
                                display:inline-block;
                                background:#2563eb;
                                color:#ffffff;
                                text-decoration:none;
                                padding:15px 35px;
                                border-radius:10px;
                                font-size:16px;
                                font-weight:bold;
                                font-family:Arial, Helvetica, sans-serif;
                                border:1px solid #2563eb;
                           ">
                            {{ $slot }}
                        </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>