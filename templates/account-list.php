<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Management</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Account Management</h1>
        
        <?php if (isset($_GET['message'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_GET['message']) ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-error">
                <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php endif; ?>
        
        <div class="actions">
            <a href="index.php?action=create" class="btn btn-primary">Create New Account</a>
        </div>
        
        <?php if (empty($accounts)): ?>
            <p>No accounts found.</p>
        <?php else: ?>
            <table class="accounts-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Company</th>
                        <th>Position</th>
                        <th>Phones</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($accounts as $account): ?>
                        <tr>
                            <td><?= htmlspecialchars($account->getFirstName() . ' ' . $account->getLastName()) ?></td>
                            <td><?= htmlspecialchars($account->getEmail()) ?></td>
                            <td><?= htmlspecialchars($account->getCompanyName() ?? '-') ?></td>
                            <td><?= htmlspecialchars($account->getPosition() ?? '-') ?></td>
                            <td>
                                <?php
                                $phones = array_filter([
                                    $account->getPhone1(),
                                    $account->getPhone2(),
                                    $account->getPhone3()
                                ]);
                                echo !empty($phones) ? htmlspecialchars(implode(', ', $phones)) : '-';
                                ?>
                            </td>
                            <td class="actions">
                                <a href="index.php?action=edit&id=<?= $account->getId() ?>" 
                                   class="btn btn-small btn-secondary">Edit</a>
                                
                                <form method="POST" style="display: inline;" 
                                      onsubmit="return confirm('Are you sure you want to delete this account?');">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?= $account->getId() ?>">
                                    <button type="submit" class="btn btn-small btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <?php if ($totalPages > 1): ?>
                <div class="pagination">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="index.php?page=<?= $i ?>" 
                           class="<?= $i === $page ? 'active' : '' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>