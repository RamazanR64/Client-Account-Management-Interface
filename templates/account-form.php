<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= isset($account) ? 'Edit Account' : 'Create Account' ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1><?= isset($account) ? 'Edit Account' : 'Create Account' ?></h1>
        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-error">
                <?php foreach ($errors as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" class="account-form">
            <input type="hidden" name="action" value="<?= isset($account) ? 'edit' : 'create' ?>">
            
            <div class="form-group">
                <label for="first_name">First Name *</label>
                <input type="text" id="first_name" name="first_name" required
                       value="<?= htmlspecialchars($account->getFirstName() ?? $_POST['first_name'] ?? '') ?>">
            </div>
            
            <div class="form-group">
                <label for="last_name">Last Name *</label>
                <input type="text" id="last_name" name="last_name" required
                       value="<?= htmlspecialchars($account->getLastName() ?? $_POST['last_name'] ?? '') ?>">
            </div>
            
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" required
                       value="<?= htmlspecialchars($account->getEmail() ?? $_POST['email'] ?? '') ?>">
            </div>
            
            <div class="form-group">
                <label for="company_name">Company Name</label>
                <input type="text" id="company_name" name="company_name"
                       value="<?= htmlspecialchars($account->getCompanyName() ?? $_POST['company_name'] ?? '') ?>">
            </div>
            
            <div class="form-group">
                <label for="position">Position</label>
                <input type="text" id="position" name="position"
                       value="<?= htmlspecialchars($account->getPosition() ?? $_POST['position'] ?? '') ?>">
            </div>
            
            <div class="form-group">
                <label for="phone1">Phone 1</label>
                <input type="tel" id="phone1" name="phone1"
                       value="<?= htmlspecialchars($account->getPhone1() ?? $_POST['phone1'] ?? '') ?>">
            </div>
            
            <div class="form-group">
                <label for="phone2">Phone 2</label>
                <input type="tel" id="phone2" name="phone2"
                       value="<?= htmlspecialchars($account->getPhone2() ?? $_POST['phone2'] ?? '') ?>">
            </div>
            
            <div class="form-group">
                <label for="phone3">Phone 3</label>
                <input type="tel" id="phone3" name="phone3"
                       value="<?= htmlspecialchars($account->getPhone3() ?? $_POST['phone3'] ?? '') ?>">
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>