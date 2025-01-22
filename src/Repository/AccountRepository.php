<?php
class AccountRepository {
    private PDO $db;
    
    public function __construct(PDO $db) {
        $this->db = $db;
    }
    
    public function save(Account $account): bool {
        if ($account->getId() === null) {
            return $this->insert($account);
        }
        return $this->update($account);
    }
    
    private function insert(Account $account): bool {
        $sql = "INSERT INTO accounts (first_name, last_name, email, company_name, position, 
                phone1, phone2, phone3) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $account->getFirstName(),
            $account->getLastName(),
            $account->getEmail(),
            $account->getCompanyName(),
            $account->getPosition(),
            $account->getPhone1(),
            $account->getPhone2(),
            $account->getPhone3()
        ]);
    }

    private function update(Account $account): bool {
        $sql = "UPDATE accounts SET 
                first_name = ?, last_name = ?, email = ?, 
                company_name = ?, position = ?, 
                phone1 = ?, phone2 = ?, phone3 = ? 
                WHERE id = ?";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $account->getFirstName(),
            $account->getLastName(),
            $account->getEmail(),
            $account->getCompanyName(),
            $account->getPosition(),
            $account->getPhone1(),
            $account->getPhone2(),
            $account->getPhone3(),
            $account->getId()
        ]);
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM accounts WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function findById(int $id): ?Account {
        $stmt = $this->db->prepare("SELECT * FROM accounts WHERE id = ?");
        $stmt->execute([$id]);
        
        $row = $stmt->fetch();
        if (!$row) {
            return null;
        }
        
        return $this->createAccountFromRow($row);
    }
    
    public function findByEmail(string $email): ?Account {
        $stmt = $this->db->prepare("SELECT * FROM accounts WHERE email = ?");
        $stmt->execute([$email]);
        
        $row = $stmt->fetch();
        if (!$row) {
            return null;
        }
        
        return $this->createAccountFromRow($row);
    }
    
    public function getPaginated(int $page = 1, int $perPage = 10): array {
        $offset = ($page - 1) * $perPage;
        $stmt = $this->db->prepare("SELECT * FROM accounts ORDER BY id DESC LIMIT ? OFFSET ?");
        $stmt->bindValue(1, $perPage, PDO::PARAM_INT);
        $stmt->bindValue(2, $offset, PDO::PARAM_INT);
        $stmt->execute();
        
        $accounts = [];
        while ($row = $stmt->fetch()) {
            $accounts[] = $this->createAccountFromRow($row);
        }
        
        return $accounts;
    }
    
    public function getTotalCount(): int {
        return $this->db->query("SELECT COUNT(*) FROM accounts")->fetchColumn();
    }
    
    private function createAccountFromRow(array $row): Account {
        $account = new Account(
            $row['first_name'],
            $row['last_name'],
            $row['email'],
            $row['company_name'],
            $row['position'],
            $row['phone1'],
            $row['phone2'],
            $row['phone3']
        );
        $account->setId($row['id']);
        return $account;
    }
}