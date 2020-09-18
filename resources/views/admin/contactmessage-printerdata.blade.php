<h5 style="font-weight: bold; margin-top: 2rem">Nyomtató adatai a kérdés idején ({{ $date->format('Y-m-d H:i') }})</h5>
<dl>
    <dt>Név</dt>
    <dd>{{ $printer->name }}</dd>
    <dt>Gyártó</dt>
    <dd>{{ $printer->manufacturer->name }}</dd>
</dl>
