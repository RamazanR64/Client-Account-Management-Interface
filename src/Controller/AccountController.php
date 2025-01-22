<?php
class AccountController {
    private AccountRepository $repository;
    
    public function __construct(AccountRepository $repository) {
        $this->repository = $repository;
    }
    
    public function handleRequest(): void {
        $action = $_POST['action'] ?? $_GET['action'] ?? 'list';
        
        switch ($action) {
            case 'create':
                $this->handleCreate();
                break;
            case 'edit':
                $this->handleEdit();
                break;
            case 'delete':
                $this->handleDelete();
                break;
            default:
                $this->handleList();
        }
    }
    
    private function handleList(): void {
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 10;
        
        $accounts = $this->repository->getPaginated($page, $perPage);
        $totalAccounts = $this->repository->getTotalCount();
        $totalPages = ceil($totalAccounts / $perPage);
        
        include __DIR__ . '/../../templates/account-list.php';
    }
    
    private function handleCreate(): void {
        $errors = [];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = $this->validateInput();
            
            if (empty($errors)) {
                $account = new Account(
                    $_POST['first_name'],
                    $_POST['last_name'],
                    $_POST['email'],
                    $_POST['company_name'] ?: null,
                    $_POST['position'] ?: null,
                    $_POST['phone1'] ?: null,
                    $_POST['phone2'] ?: null,
                    $_POST['phone3'] ?: null
                );
                
                if ($this->repository->save($account)) {
                    header('Location: index.php?message=Account created successfully');
                    exit;
                }
                $errors[] = 'Failed to create account';
            }
        }
        
        include __DIR__ . '/../../templates/account-create.php';
    }
    
    private function handleEdit(): void {
        $id = (int)($_GET['id'] ?? 0);
        $account = $this->repository->findById($id);
        
        if (!$account) {
            header('Location: index.php?error=Account not found');
            exit;
        }
        
        $errors = [];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = $this->validateInput($id);
            
            if (empty($errors)) {
                $account = new Account(
                    $_POST['first_name'],
                    $_POST['last_name'],
                    $_POST['email'],
                    $_POST['company_name'] ?: null,
                    $_POST['position'] ?: null,
                    $_POST['phone1'] ?: null,
                    $_POST['phone2'] ?: null,
                    $_POST['phone3'] ?: null
                );
                $account->setId($id);
                
                if ($this->repository->save($account)) {
                    header('Location: index.php?message=Account updated successfully');
                    exit;
                }
                $errors[] = 'Failed to update account';
            }
        }
        
        include __DIR__ . '/../../templates/account-form.php';
    }
    
    private function handleDelete(): void {
        $id = (int)($_POST['id'] ?? 0);
        
        if ($id && $this->repository->delete($id)) {
            header('Location: index.php?message=Account deleted successfully');
        } else {
            header('Location: index.php?error=Failed to delete account');
        }
        exit;
    }
    
    private function validateInput(?int $currentId = null): array {
        $errors = [];
        
        if (empty($_POST['first_name'])) {
            $errors[] = 'First name is required';
        }
        
        if (empty($_POST['last_name'])) {
            $errors[] = 'Last name is required';
        }
        
        if (empty($_POST['email'])) {
            $errors[] = 'Email is required';
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email format';
        } else {
            $existingAccount = $this->repository->findByEmail($_POST['email']);
            if ($existingAccount && $existingAccount->getId() !== $currentId) {
                $errors[] = 'Email already exists';
            }
        }
        
        return $errors;
    }
}