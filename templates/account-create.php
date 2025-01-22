<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
</head>
<body>
    <h1>Create Account</h1>
    <form action="index.php?action=create" method="post">
        <div>
            <label for="first_name">First Name *</label>
            <input type="text" id="first_name" name="first_name" required>
        </div>
        <div>
            <label for="last_name">Last Name *</label>
            <input type="text" id="last_name" name="last_name" required>
        </div>
        <div>
            <label for="email">Email *</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="company_name">Company Name</label>
            <input type="text" id="company_name" name="company_name">
        </div>
        <div>
            <label for="position">Position</label>
            <input type="text" id="position" name="position">
        </div>
        <div>
            <label for="phone1">Phone 1</label>
            <input type="tel" id="phone1" name="phone1">
        </div>
        <div>
            <label for="phone2">Phone 2</label>
            <input type="tel" id="phone2" name="phone2">
        </div>
        <div>
            <label for="phone3">Phone 3</label>
            <input type="tel" id="phone3" name="phone3">
        </div>
        <div>
            <button type="submit">Create Account</button>
        </div>
    </form>
</body>
</html>
