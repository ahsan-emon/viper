<x-mail::message>
# New Offer
# 20% flat discount!

It applies on all products!

<x-mail::button :url="'https://bd.linkedin.com/in/md-ahsan-ullah-emon-ab06b91a1'" color="success">
Click
</x-mail::button>
<x-mail::panel>
New product arrived daily
</x-mail::panel>
<x-mail::table>
| Laravel       | Table         | Example  |
| ------------- |:-------------:| --------:|
| Col 2 is      | Centered      | $10      |
| Col 3 is      | Right-Aligned | $20      |
</x-mail::table>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

