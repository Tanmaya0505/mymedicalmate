<!DOCTYPE html>
<html>
<head>
    <title>My MedicalMate</title>
</head>
<body>
    <h1>{{ $details['title'] }}</h1>
    <p>{{ $details['body'] }}</p>
    <p>OPT:{{ $details['otp'] }}</p>
    <p>Image<image src="{{ $details['logo_url'] }}" class="list-doc-star-img" ></p>
    <p>{{ $details['guest_name'] }}</p>
   
    <p>Thank you</p>
</body>
</html>
