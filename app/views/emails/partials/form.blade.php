<table border="1" cellspacing="5" cellpadding="5" style="font-size:14px">
        @foreach($data['form_data'] as $field => $value)
            <tr>
                <td><strong>{{ $field }}:</strong></td><td>{{ nl2br($value) }}</td>
            </tr>
        @endforeach
</table>

